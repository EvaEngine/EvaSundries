<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-2-28
 * Time: 下午2:38
 */

namespace Eva\EvaSundries\Entities;


use Eva\EvaEngine\Mvc\Model;

class Options extends Model
{
    protected $tableName = 'wscn_options';
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $optionName;
    /**
     * @var string
     */
    public $optionValue;
    /**
     * @var string
     */
    public $optionComment;
    /**
     * @var int
     */
    public $createdAt;
}