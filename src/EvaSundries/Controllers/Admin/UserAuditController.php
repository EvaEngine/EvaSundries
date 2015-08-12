<?php

namespace Eva\EvaSundries\Controllers\Admin;

use Eva\EvaSundries\Models\UserAuditLog;
use Eva\EvaSundries\Forms;

class UserAuditController extends AdminControllerBase
{
    public function indexAction()
    {
        $limit = $this->request->getQuery('limit', 'int', 25);
        $limit = $limit > 100 ? 100 : $limit;
        $limit = $limit < 10 ? 10 : $limit;
        $query = array(
            'operationName' => $this->request->getQuery('operationName'),
            'spamReason' => $this->request->getQuery('spamReason'),
            'limit' => $limit,
            'page' => $this->request->getQuery('page', 'int', 1),
        );

        $form = new Forms\AuditLogForm();
        $form->setValues($this->request->getQuery());
        $this->view->setVar('form', $form);

        $auditLogModel = new UserAuditLog();
        $logs = $auditLogModel->findLogs($query);

        $paginator = new \Eva\EvaEngine\Paginator(array(
            "builder" => $logs,
            "limit" => $limit,
            "page" => $query['page']
        ));
        $paginator->setQuery($query);
        $pager = $paginator->getPaginate();
        $this->view->setVar('pager', $pager);
    }
}