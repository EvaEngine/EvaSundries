<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 15-2-28
 * Time: 下午2:43
 */

namespace Eva\EvaSundries\Models;

use Eva\EvaSundries\Entities\CommonStars;
use Eva\EvaUser\Models\Login;

class CommonStar extends CommonStars
{
    public static $simpleDump = array(
        'id',
        'type',
        'postId',
        'title',
        'summary',
        'imageUrl' => 'getImageUrl',
        'sourceUrl',
        'createdAt',
    );

    public static $postDump = array(
        'id',
        'userId',
        'postId',
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

    /**
     * @param $type
     * @param $postId
     * @return bool
     */
    public function getStarStatus($type, $postId)
    {
        $currentUser = Login::getCurrentUser();
        $userId = $currentUser['id'];

        if ($userId == 0) { //未登录
            return false;
        }

        $params = array(
            'userId' => $userId,
            'type' => $type,
            'postId' => $postId
        );

        $cacheKey = $this->createCacheKey($params);

        if ($this->getCache()->exists($cacheKey)){
            $star = $this->getCache()->get($cacheKey);
        } else {
            $conditions = " userId = $userId AND type = '$type' AND postId = $postId ";
            $star = CommonStars::findFirst($conditions);
            $this->getCache()->save($cacheKey, $star, $this->cacheTime);
        }

        return empty($star) ? false : true;
    }
}