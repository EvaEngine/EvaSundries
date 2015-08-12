<?php
namespace Eva\EvaSundries\Forms;

use Eva\EvaEngine\Form;
use Phalcon\Forms\Element\Select;

class AuditLogForm extends Form
{
    /**
     *
     * @Type(Select)
     * @Option("all":"all")
     * @Option("active":"active")
     * @Option("deleted":"deleted")
     * @var string
     */
    public $operationName;

    /**
     *
     * @Type(Select)
     * @Option("all":"all")
     * @Option("1":"评论过多")
     * @Option("2":"多次过滤")
     * @Option("3":"多次举报")
     * @var string
     */
    public $spamReason;

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
