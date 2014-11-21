<?php

namespace Eva\EvaSundries\Controllers\Admin;

use Eva\EvaBlog\Models\PostSearcher;
use Eva\EvaSearch\Models\KeywordCount;
use Eva\EvaSundries\Forms;

// +----------------------------------------------------------------------
// | [phalcon]
// +----------------------------------------------------------------------
// | Author: Mr.5 <haohong725@wallstreetcn.com>
// +----------------------------------------------------------------------
// + Datetime: 14-11-19 10:40
// +----------------------------------------------------------------------
// + BlockController.php
// +----------------------------------------------------------------------



class KeywordController extends AdminControllerBase
{
    public function indexAction()
    {
        $limit = $this->request->getQuery('limit', 'int', 10);
        $limit = $limit > 100 ? 100 : $limit;
        $limit = $limit < 10 ? 10 : $limit;

        $query = array(
            'keyword' => $this->request->getQuery('keyword', 'string'),
            'count' => $this->request->getQuery('count', 'int'),

            'order' => $this->request->getQuery('order', 'string'),
            'limit' => $limit,
            'page' => $this->request->getQuery('page', 'int', 1),
        );

        $form = new Forms\FilterForm();
        $form->setValues($this->request->getQuery());
        $this->view->setVar('form', $form);

        $keywordCount = new KeywordCount();
        $keywordCounts = $keywordCount->findKeywordCount($query);

        $paginator = new \Eva\EvaEngine\Paginator(
            array(
                "builder" => $keywordCounts,
                "limit" => $limit,
                "page" => $query['page']
            )
        );

        $page = $paginator->getPaginate();

        $paginator->setQuery($query);
        $pager = $paginator->getPaginate();

        $data = array();
        $postSearcher = new PostSearcher();

        foreach($pager->items as $item) {
            $keyword = trim($item->keyword);
            $pager = $postSearcher->searchPosts(
                array(
                    'q' => $keyword,
                    'status'=>'published'
                )
            );

            $_item = $item->toArray();
            $totalItems = $pager->total_items;
            $_item['totalItems'] = $totalItems;
            $data[] = $_item;
        }

        $this->view->setVar('data', $data);
    }

}