<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-2-28
 * Time: 下午2:38
 */

namespace Eva\EvaSundries\Entities;


use Eva\EvaEngine\Mvc\Model;
use Eva\EvaFileSystem\ViewHelpers\ThumbWithClass;

class CommonStars extends Model
{
    protected $tableName = 'common_stars';

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $type;

    /**
     * @var int
     */
    public $postId;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $sourceUrl;

    /**
     * @var int
     */
    public $createdAt;

    public $cacheTime = 86400;  //一天

    public function onConstruct()
    {
        $this->createdAt = $this->createdAt ?: time();
    }

    public function getImageUrl($style = '')
    {
        if ($this->type == 'post') {
            return  $this->getImageUrlByUri($this->image);
        } elseif ($this->type == 'subscription') {
            return $this->image;
        }
    }

    public function getImageUrlByUri($uri, $style = '')
    {
        if (!$uri) {
            return null;
        }
        $thumbWithClass = new ThumbWithClass();

        return $thumbWithClass->__invoke($uri, $style);
    }

    public function getCache()
    {
        /** @var \Phalcon\Cache\Backend\Libmemcached $cache */
        $cache =  $this->getDI()->get('modelsCache');
        return $cache;
    }

    public function createCacheKey($params){
        ksort($params);
        $str = $this->cachePrefix;
        foreach($params as $k=>$v){
            $str .= $k.'_'.$v.'_';
        }

        return $str;
    }

    public function refreshCache($params)
    {
        $cacheKey = $this->createCacheKey($params);
        if($this->getCache()->exists($cacheKey)){
            $this->getCache()->delete($cacheKey);
        }
    }

    public function afterSave()
    {
        $this->refreshCache(array(
            'type'=> 'post',
            'userId'=>$this->userId,
            'postId'=>$this->postId
        ));
        $this->refreshCache(array(
            'type'=> 'subscription',
            'userId'=>$this->userId,
            'postId'=>$this->postId
        ));
    }

    public function afterDelete()
    {
        $this->refreshCache(array(
            'type'=> 'post',
            'userId'=>$this->userId,
            'postId'=>$this->postId
        ));
        $this->refreshCache(array(
            'type'=> 'subscription',
            'userId'=>$this->userId,
            'postId'=>$this->postId
        ));
    }

}