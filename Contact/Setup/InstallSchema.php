<?php
/**
 *  Teleb Contact InstallSchema
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Teleb\Contact\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Constant contact question table name
     */
    const TELEB_CONTACT_QUESTION = 'teleb_contact_question';

    /**
     * Install table teleb_contact_question
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::TELEB_CONTACT_QUESTION)
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Question id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'User name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            [],
            'User e-mail'
        )->addColumn(
            'telephone',
            Table::TYPE_TEXT,
            255,
            [],
            'User telephone'
        )->addColumn(
            'theme',
            Table::TYPE_TEXT,
            255,
            [],
            'Question theme'
        )->addColumn(
            'comment',
            Table::TYPE_TEXT,
            '64k',
            [],
            'Comment'
        )->addColumn(
            'answer',
            Table::TYPE_TEXT,
            '64k',
            [],
            'Answer'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ],
            'Question created at'
        )->addColumn(
            'update_at',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT_UPDATE
            ],
            'Question update at'
        )->addColumn(
            'is_answered',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'default' => '0'
            ],
            'Is Answered'
        )->setComment(
            'Contact Question Table'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
