<?php
/**
 * Teleb Contact question
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Question
 *
 * @package Teleb\Contact\Model\ResourceModel
 */
class Question extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('teleb_contact_question', 'id');
    }
}
