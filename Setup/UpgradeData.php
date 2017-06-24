<?php

namespace Yireo\ExampleSetup\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();

        $table = $setup->getTable('example_setup');
        $select = $connection->select()->from($table);
        $rows = $connection->fetchAssoc($select);

        if (empty($rows)) {
            $data = ['name' => 'Test'];
            $connection->insert($table, $data);
        }

        $setup->endSetup();
    }
}
