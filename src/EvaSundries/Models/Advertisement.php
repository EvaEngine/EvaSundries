<?php

namespace Eva\EvaSundries\Models;

use Eva\EvaSundries\Entities\Advertisements;

class Advertisement extends Advertisements
{
    public function injectSendNiaoge($idfa, $appId = '738227477')
    {
        $idfa = json_decode($idfa, true);
        $idfa = $idfa['idfa'];

        $cache = $this->getCache();
        $cacheKey = $this->createCacheKey(array('source' => 'niaoge', 'idfa' => $idfa, 'appId' => $appId));

        if ($cache->exists($cacheKey)) {
            $ad = $cache->get($cacheKey);
        } else {
            $ad = Advertisements::findFirst(array(
                "conditions" => "source = :source: AND appId = :appId: AND idfa = :idfa: AND createdAt > :createdAt:",
                "bind" => array(
                    'source' => 'niaoge',
                    'appId' => $appId,
                    'idfa' => $idfa,
                    'createdAt' => time() - 3600 * 24 * 7,
                ),
            ));

            if ($ad) {
                $cache->save($cacheKey, $ad, 3*24*60*60);
            }
        }

        if ($ad) {
            $url = $ad->callbackurl;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);

            curl_close($ch);
        }
    }

    public function injectSendWanpu($idfa, $appId = '738227477')
    {
        $cache = $this->getCache();
        $cacheKey = $this->createCacheKey(array('source' => 'wanpu', 'idfa' => $idfa, 'appId' => $appId));

        if ($cache->exists($cacheKey)) {
            $ad = $cache->get($cacheKey);
        } else {
            $ad = Advertisements::findFirst(array(
                "conditions" => "source = :source: AND appId = :appId: AND idfa = :idfa: AND createdAt > :createdAt:",
                "bind" => array(
                    'source' => 'wanpu',
                    'appId' => $appId,
                    'idfa' => $idfa,
                    'createdAt' => time() - 3600 * 24 * 7,
                ),
            ));

            if ($ad) {
                $cache->save($cacheKey, $ad, 3*24*60*60);
            }
        }

        if ($ad) {
            $url = "http://ios.wapx.cn/ios/receiver/activate?app=$appId&idfa=$idfa";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);

            curl_close($ch);
        }
    }

    public function getCache()
    {
        /** @var \Phalcon\Cache\Backend\Libmemcached $cache */
        $cache =  $this->getDI()->get('modelsCache');
        return $cache;
    }

    public function createCacheKey($params){
        ksort($params);
        $str = 'wscn_idfa_';
        foreach($params as $k=>$v){
            $str .= $k.'_'.$v.'_';
        }

        return md5($str);
    }
}