<?php

namespace Eva\EvaSundries\Forms;

// +----------------------------------------------------------------------
// | [phalcon]
// +----------------------------------------------------------------------
// | Author: Mr.5 <mr5.simple@gmail.com>
// +----------------------------------------------------------------------
// + Datetime: 14-8-18 16:29
// +----------------------------------------------------------------------

use Eva\EvaEngine\Form;

class OptionForm extends Form
{
    /**
     * @Type(Hidden)
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $optionName;

    /**
     * @Type(TextArea)
     * @var string
     */
    public $optionValue;

    /**
     * @var string
     */
    public $optionComment;

    /**
     * @Type(Hidden)
     * @var integer
     */
    public $createdAt;

    public function initialize($entity = null, $options = null)
    {
    }
}