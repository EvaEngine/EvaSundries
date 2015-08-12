<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/8/11
 * Time: 下午1:42
 */

namespace Eva\EvaSundries\Models;

use Eva\EvaSundries\Entities\UserAuditLogs;

class UserAuditLog extends UserAuditLogs
{
    public function findLogs($query)
    {
        $itemQuery = $this->getDI()->getModelsManager()->createBuilder();

        if (!empty($query['operationName']) && $query['operationName'] != 'all') {
            $itemQuery->andWhere('operationName = :operationName:', array('operationName' => "{$query['operationName']}"));
        }

        if (!empty($query['spamReason']) && $query['spamReason'] != 'all') {
            $itemQuery->andWhere('spamReason = :spamReason:', array('spamReason' => $query['spamReason']));
        }

        $itemQuery->from(__CLASS__);

        $itemQuery->orderBy('createdAt DESC');

        return $itemQuery;
    }
}