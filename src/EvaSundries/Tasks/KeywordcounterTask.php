<?php

namespace Eva\EvaSundries\Tasks;

use Eva\CounterRank\Utils\CounterRankUtil;
use Eva\EvaEngine\Tasks\TaskBase;
use Eva\EvaEngine\Mvc\Model;
use Eva\EvaSearch\Models\KeywordCount;
use mr5\CounterRank\CounterIterator;


class KeywordcounterTask extends TaskBase
{
    public function mainAction($params)
    {
        $this->persistAction($params);
    }

    public function persistAction($params) {
        $counterRank = new CounterRankUtil();
        $counterRank = $counterRank->getCounterRank('keywords');
        $keywordCount = new KeywordCount();
        $count = 0;
        $tableName = $keywordCount->getSource();
        foreach ($counterRank->getIterator(100, CounterIterator::PERSIST_WITH_DELETING) as $items) {
            $insertValues = '';
            $values = '';
            $count += count($items);
            $keywords = '';
            foreach ($items as $keyword => $heat) {
                if ($keywords != '') {
                    $keywords .= ',';
                }
                $keywords .= "'".$keyword."'";
                $insertValues .= "('{$keyword}', 1),";
                $values .= " WHEN keyword='{$keyword}' THEN `count`+{$heat} ";
            }
            $insertValues = substr($insertValues, 0, strlen($insertValues)-1);

            $sql = <<<SQL
INSERT {$tableName} (`keyword`, `count`) VALUES $insertValues
ON DUPLICATE KEY
UPDATE `count` = CASE
  {$values}
  ELSE `count`
END
SQL;
            $keywordCount->getWriteConnection()->execute($sql);
        }
        $this->output->writelnComment('Done! Persist ' . $count . ' items;');
    }

}