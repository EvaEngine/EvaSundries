<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 14-11-25
 * Time: 下午5:42
 */
namespace Eva\EvaSundries\Utils;

class CDN {

    public static function update($url)
    {
        $ch = curl_init();

        $url = 'api.ucloud.cn/?Action=DescribeUcdnDomain&PublicKey=ucloudmr5.simple@gmail.com1386555530796251119&Signature=968b9b2b42f13b012391936c20fd02879ee3fb01';

        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
dd($result);
        return null;
    }

    private function _verfy_ac($private_key, $params) {
        ksort($params);
        # 参数串排序
        $params_data = "";

        foreach($parans as $key => $value) {
            $params_data .= $key;
            $params_data .= $value;
        }

        $params_data .= $private_key;
        return sha1($params_data);
        # 生成的Signature值
    }

}