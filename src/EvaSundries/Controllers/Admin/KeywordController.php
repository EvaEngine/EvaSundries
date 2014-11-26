<?php

namespace Eva\EvaSundries\Controllers\Admin;

use Eva\EvaBlog\Models\PostSearcher;
use Eva\EvaSearch\Models\KeywordCount;
use Eva\EvaSundries\Forms;

// +----------------------------------------------------------------------
// | [phalcon]
// +----------------------------------------------------------------------
// | Author: Haohong<haohong725@wallstreetcn.com>
// +----------------------------------------------------------------------
// + Datetime: 14-11-19 10:40
// +----------------------------------------------------------------------
// + BlockController.php
// +----------------------------------------------------------------------


/**
 * @resourceName("Keyword Managment")
 * @resourceDescription("Search Keyword Count Managment")
 */
class KeywordController extends AdminControllerBase
{
    /**
     * @operationName("List search keywords")
     * @operationDescription("list search keywords")
     */
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

        $paginator->setQuery($query);
        $pager = $paginator->getPaginate();
        $this->view->setVar("pager", $pager);


        $data = array();
        $postSearcher = new PostSearcher();

        foreach($pager->items as $item) {
            $keyword = trim($item->keyword);
            $page = $postSearcher->searchPosts(
                array(
                    'q' => $keyword,
                    'status' => 'published',
                    'increase' => false             //搜索关键词统计
                )
            );

            $_item = $item->toArray();
            $_item['latestTime'] = date('Y-m-d H:i:s', $_item['latestTime']);
            $totalItems = $page->total_items;
            $_item['totalItems'] = $totalItems;
            $data[] = $_item;

        }

        $this->view->setVar('data', $data);
    }

}