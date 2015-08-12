<?php

namespace Eva\EvaSundries\Entities;

use Eva\EvaEngine\Mvc\Model;

class UserAuditLogs extends Model
{
    protected $tableName = 'user_operation_logs';
    /**
     * @var int
     */
    public $id;
    /**
     * 执行操作的用户ID
     * @var int
     */
    public $operatorId;
    /**
     * 被操作的用户ID
     * @var int
     */
    public $subjectId;
    /**
     * 操作行为名称，如删除，修改
     * @var string
     */
    public $operationName;
    /**
     * 被禁言时间
     * @var int
     */
    public $spamAt;
    /**
     * 禁言原因
     * @var int
     */
    public $spamReason;
    /**
     * @var int
     */
    public $createdAt;

    public function beforeCreate()
    {
        $this->createdAt = time();
    }

    public function initialize()
    {
        $this->belongsTo(
            'operatorId',
            'Eva\EvaUser\Entities\Users',
            'id',
            array(
                'alias' => 'operator'
            )
        );

        $this->belongsTo(
            'subjectId',
            'Eva\EvaUser\Entities\Users',
            'id',
            array(
                'alias' => 'subject'
            )
        );
    }
}