<?php
/**
 * Wscn
 *
 * @link      https://github.com/wallstreetcn/wallstreetcn
 * @copyright Copyright (c) 2010-2014 WallstreetCN
 * @author    WallstreetCN Team: shao<liujaysen@gmail.com>
 */
namespace Eva\EvaSundries\Entities;

//记录多盟请求的数据
class Domob extends \Eva\EvaEngine\Mvc\Model
{
    protected $tableName = 'collect_domob';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $appId;

    /**
     *
     * @var string
     */
    public $mac;

    /**
     *
     * @var string
     */
    public $idfa;

    /**
     *
     * @var integer
     */
    public $createdAt;

    public function onConstruct()
    {
        $this->createdAt = time();
    }
}
