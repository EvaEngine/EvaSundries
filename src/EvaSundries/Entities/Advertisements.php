<?php
namespace Eva\EvaSundries\Entities;

/*
 * 供广告平台商调用
 * 记录设备的相关标示符
 */
class Advertisements extends \Eva\EvaEngine\Mvc\Model
{
    protected $tableName = 'collect_ads';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var string
     */
    public $udid;

    /**
     *
     * @var string
     */
    public $mac;

    /**
     *
     * @var string
     */
    public $appId;

    /**
     *
     * @var string
     */
    public $idfa;

    /**
     *
     * @var string
     */
    public $openudid;

    /**
     *
     * @var string
     */
    public $os;

    /**
     *
     * @var string
     */
    public $callbackurl;

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
