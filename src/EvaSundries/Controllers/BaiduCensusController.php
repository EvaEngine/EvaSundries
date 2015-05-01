<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-4-28
 * Time: 上午11:18
 */

namespace Eva\EvaSundries\Controllers;

use Eva\EvaEngine\IoC;
use Eva\EvaSundries\Utils\BaiduAnalysisUrl;

class BaiduCensusController extends \Phalcon\Mvc\Controller
{
    public function censusAction()
    {
        $url = $this->request->getQuery('url');
        $url = urlencode($url);

        $baiduAnalysisId = IoC::get('config')->blog->baiduAnalysisId;

        $baiduAnalysisUtil = new BaiduAnalysisUrl($baiduAnalysisId, $url);

        $firstUrl = $baiduAnalysisUtil->getFirstRequestUrl();
        $secondUrl = $baiduAnalysisUtil->getSecondRequestUrl();

        self::request($firstUrl);
        self::request($secondUrl);
    }

    private static function request($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_exec($ch);

        curl_close($ch);
    }
}