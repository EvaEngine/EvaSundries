<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-3-2
 * Time: 下午2:27
 */

namespace Eva\EvaSundries\Controllers\Admin;

use Eva\EvaEngine\Exception;
use Eva\EvaSundries\Utils\CDN;

/**
 * @resourceName("更新CDN文件")
 * @resourceDescription("更新CDN文件")
 */
class CDNController extends AdminControllerBase {
    /**
     * @operationName("展示页面")
     * @operationDescription("展示页面")
     */
    public function indexAction() {

    }

    /**
     * @operationName("更新")
     * @operationDescription("更新")
     */
    public function updateAction() {
        $url = $this->request->getPost('url');

        $result = CDN::update($url);

        return $this->showResponseAsJson($result);
    }

} 