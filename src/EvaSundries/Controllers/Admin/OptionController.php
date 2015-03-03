<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-3-2
 * Time: 下午2:27
 */

namespace Eva\EvaSundries\Controllers\Admin;


use Eva\EvaSundries\Entities\Options;
use Eva\EvaSundries\Forms\OptionForm;
use Eva\EvaEngine\Exception;

/**
 * @resourceName("网站配置文件")
 * @resourceDescription("网站配置文件")
 */
class OptionController extends AdminControllerBase {
    /**
     * @operationName("配置选项列表")
     * @operationDescription("配置选项列表")
     */
    public function indexAction() {
        $currentPage = $this->request->getQuery('page', 'int'); // GET
        $limit = $this->request->getQuery('limit', 'int');
        $order = $this->request->getQuery('order', 'int');
        $limit = $limit > 50 ? 50 : $limit;
        $limit = $limit < 10 ? 10 : $limit;

        $items = $this->modelsManager->createBuilder()
            ->from('Eva\EvaSundries\Entities\Options')
            ->orderBy('id DESC');

        $paginator = new \Eva\EvaEngine\Paginator(array(
            "builder" => $items,
            "limit"=> 500,
            "page" => $currentPage
        ));
        $pager = $paginator->getPaginate();
        $this->view->setVar('pager', $pager);
    }

    /**
     * @operationName("编辑配置")
     * @operationDescription("编辑配置")
     */
    public function editAction($id) {
        $this->view->changeRender('admin/option/create');

        $form = new OptionForm();
        $option = Options::findFirst($id);

        $form->setModel($option);
        $this->view->setVar('form', $form);
        $this->view->setVar('item', $option);

        if($this->request->isPost()) {
            $form->bind($this->request->getPost(), $option);
            if (!$form->isValid()) {
                return $this->showInvalidMessages($form);
            }
            $form = $form->getEntity();
            $form->assign($this->request->getPost());
            try {
                $form->save();
            } catch (\Exception $e) {
                return $this->showException($e, $option->getMessages());
            }
            $this->flashSession->success('SUCCESS_FORM_UPDATED');

            return $this->redirectHandler('/admin/option/edit/' . $option->id);
        }

    }

    /**
     * @operationName("新建配置")
     * @operationDescription("新建配置")
     */
    public function createAction() {
        $form = new OptionForm();
        $option = new Options();

        $form->setModel($option);
        $this->view->setVar('form', $form);

        if($this->request->isPost()) {
            $data = $this->request->getPost();
            $data['createdAt'] = time();
            $form->bind($data, $option);
            if (!$form->isValid()) {
                return $this->showInvalidMessages($form);
            }
            $option = $form->getEntity();
            try {
                if (!$option->save()) {
                    throw new Exception\RuntimeException('Create option failed');
                }
                $this->flashSession->success('SUCCESS_OPTIONS_CREATED');
            } catch (\Exception $e) {
                return $this->showException($e, $option->getMessages());
            }
            return $this->redirectHandler('/admin/option/edit/' . $option->id);
        }
    }

} 