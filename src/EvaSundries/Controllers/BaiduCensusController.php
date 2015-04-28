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

        dd($firstUrl);
    }
}