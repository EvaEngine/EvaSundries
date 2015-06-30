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

    public function onConstruct()
    {
        $this->createdAt = $this->createdAt ?: time();
    }

    public function getImageUrl()
    {
        if ($this->type == 'post') {
            return  $this->getImageUrlByUri($this->image);
        } elseif ($this->type == 'subscription') {
            return $this->image;
        }
    }

    public function getImageUrlByUri($uri)
    {
        if (!$uri) {
            return null;
        }
        $thumbWithClass = new ThumbWithClass();

        return $thumbWithClass->__invoke($uri, $style);
    }
}