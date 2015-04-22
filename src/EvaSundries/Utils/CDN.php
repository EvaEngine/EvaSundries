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
    public static function update($url)
    {
        $publicKey = IoC::get('config')->EvaSundries->ucloud->publicKey;
        $privateKey = Ioc::get('config')->EvaSundries->ucloud->privateKey;

        $ch = curl_init();

        $domain = self::getDomain($url);

        $domainMap = array(
            'markets.s.wallstcn.com'            => 'ucdn-uwvxf',
            'uploads.cdn.wallstreetcn.com'      => 'ucdn-0cykc',
            'activity.wallstreetcn.com'         => 'ucdn-i0nhgn',
            'img.cdn.wallstreetcn.com'          => 'ucdn-kio11i',
            'wscn.cdn.wallstreetcn.com'         => 'ucdn-5s5t1j',
            'markets.static.wallstreetcn.com'   => 'ucdn-albnfl',
        );

        $params = array(
            'Action' => 'RefreshUcdnDomainCache',
            'PublicKey' => $publicKey,
            'DomainId' => $domainMap[$domain],
            'Type' => 'file',
            'UrlList.0' => $url,
        );

        $signature = self::_verfy_ac($privateKey, $params);

        $url = self::createUrl($params, $signature);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
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
}