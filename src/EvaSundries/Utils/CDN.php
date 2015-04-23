<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 14-11-25
 * Time: 下午5:42
 */
namespace Eva\EvaSundries\Utils;

use Eva\EvaEngine\IoC;

class CDN
{
    public static function update($urls)
    {
        $urlArr = explode("\n", $urls);

        $urlList = array();

        foreach ($urlArr as $key => $url) {
            $url = trim($url);

            $domain = self::getDomain($url);
            if (self::isDir($url)) {
                $urlList['dir'][$domain][] = $url;
            } else {
                $urlList['file'][$domain][] = $url;
            }
        }

        $domainMap = array(
            'markets.s.wallstcn.com'            => 'ucdn-uwvxf',
            'uploads.cdn.wallstreetcn.com'      => 'ucdn-0cykc',
            'activity.wallstreetcn.com'         => 'ucdn-i0nhgn',
            'img.cdn.wallstreetcn.com'          => 'ucdn-kio11i',
            'wscn.cdn.wallstreetcn.com'         => 'ucdn-5s5t1j',
            'markets.static.wallstreetcn.com'   => 'ucdn-albnfl',
        );

        foreach ($urlList as $type => $list) {
            foreach ($list as $domain => $urls) {
                $domainId = $domainMap[$domain];
                self::refresh($urls, $domainId, $type);
            }
        }
    }

    private static function refresh(array $urls, $domainId, $type)
    {
        $publicKey = IoC::get('config')->EvaSundries->ucloud->publicKey;
        $privateKey = Ioc::get('config')->EvaSundries->ucloud->privateKey;
        $params = array(
            'Action' => 'RefreshUcdnDomainCache',
            'PublicKey' => $publicKey,
            'DomainId' => $domainId,
            'Type' => $type,
        );

        $refreshUrls = array();
        foreach ($urls as $key => $url) {
            $refreshUrls['UrlList.' . $key] = $url;
        }

        $params = array_merge($params, $refreshUrls);

        $signature = self::_verfy_ac($privateKey, $params);

        $url = self::createUrl($params, $signature);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        if ($result->RetCode != 0) {
            p($params);
            dd($result);
        }
    }

    private static function createUrl($params, $signature)
    {
        $url = "api.ucloud.cn/?";
        foreach ($params as $key => $value) {
            $param = "&$key=$value";
            $url .= $param;
        }
        $url .= "&Signature=$signature";

        return $url;
    }

    private static function getDomain($url)
    {
        $pattern = "/([\w-]+\.)*(com|net|org|gov|cc|biz|info|cn)(\.(cn|hk))*/";
        preg_match($pattern, $url, $matches);
        if(count($matches) > 0) {
            return $matches[0];
        }
    }

    private static function _verfy_ac($privateKey, $params)
    {
        ksort($params);
        # 参数串排序
        $params_data = "";

        foreach($params as $key => $value) {
            $params_data .= $key;
            $params_data .= $value;
        }

        $params_data .= $privateKey;
        return sha1($params_data);
        # 生成的Signature值
    }

    private static function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return TRUE;
        }
        $start  = $length * -1;
        return (substr($haystack, $start) === $needle);
    }

    private static function isDir($url) {
        return self::endsWith($url, '/') ? true : false;
    }
}