<?php
/**
 * Wscn
 *
 * @link      https://github.com/wallstreetcn/wallstreetcn
 * @copyright Copyright (c) 2010-2014 WallstreetCN
 * @author    WallstreetCN Team: shao<liujaysen@gmail.com>
 */
namespace Eva\EvaSundries\Entities;

class Idfa extends \Eva\EvaEngine\Mvc\Model
{
    protected $tableName = 'collect_idfa';

    /**
     *
     * @var string
     */
    public $idfa;

    /**
     *
     * @var string
     */
    public $appId;

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
