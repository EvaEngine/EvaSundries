<?php
namespace Eva\EvaSundries\Forms;

use Eva\EvaEngine\Form;
use Phalcon\Forms\Element\Select;

class FilterForm extends Form
{
    /**
     * @var string
     */
    public $keyword;

    /**
     *
     * @var string
     */
    public $q;

    /**
     *
     * @Type(Select)
     * @Option("10":"10")
     * @Option("25":"25")
     * @Option("50":"50")
     * @Option("100":"100")
     * @var string
     */
    public $limit;

    public function initialize($entity = null, $options = null)
    {
        $this->initializeFormAnnotations();
    }
}
