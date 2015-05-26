<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-2-28
 * Time: 下午2:43
 */

namespace Eva\EvaSundries\Models;

use Eva\EvaSundries\Entities\CommonStars;

class CommonStar extends CommonStars
{
    public static $simpleDump = array(
        'id',
        'type',
        'postId',
        'title',
        'summary',
//        'getImageUrl' => 'image',
        'image' => 'getImageUrl',
        'sourceUrl',
        'createdAt',
    );

    public function getStarsBuilder($params)
    {
        $itemQuery = $this->getModelsManager()->createBuilder();
        $itemQuery->from(__CLASS__);

        if ($params['userId']) {
            $itemQuery->andWhere('userId = :userId:', array('userId' => $params['userId']));
        }

        if ($params['postId']) {
            $itemQuery->andWhere('postId = :postId:', array('postId' => $params['postId']));
        }

        if ($params['type']) {
            $itemQuery->andWhere('type = :type:', array('type' => $params['type']));
        }

        $order = 'createdAt DESC';
        $itemQuery->orderBy($order);

        return $itemQuery;
    }

} 