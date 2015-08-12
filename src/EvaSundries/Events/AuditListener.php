<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/8/11
 * Time: 下午2:10
 */
namespace Eva\EvaSundries\Events;

use Eva\EvaSundries\Entities\UserAuditLogs;
use Eva\EvaEngine\Exception;

class AuditListener
{
    public function createOperation($event, $operationData)
    {
        //被操作用户的ID
        $subjectUser = $operationData['subjectUser'];

        $auditLog = new UserAuditLogs();
        $auditLog->operatorId = $operationData['operatorId'];
        $auditLog->subjectId = $subjectUser->id;
        $auditLog->operationName = $subjectUser->status;
        $auditLog->spamAt = $subjectUser->updatedAt;
        $auditLog->spamReason = $subjectUser->spamReason;
        $auditLog->createdAt = time();

        if ($auditLog->create() === false) {
            throw new Exception\ResourceConflictException("User audit log save failed");
        }
    }
}
