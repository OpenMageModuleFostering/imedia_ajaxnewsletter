<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    ALTER TABLE `{$installer->getTable('newsletter/subscriber')}`
    ADD first_name varchar(100) NOT NULL DEFAULT '';
");
$installer->run("
    ALTER TABLE `{$installer->getTable('newsletter/subscriber')}`
    ADD last_name varchar(100) NOT NULL DEFAULT '';
");
$installer->run("
    ALTER TABLE `{$installer->getTable('newsletter/subscriber')}`
    ADD gender varchar(100) NOT NULL DEFAULT '';
");
$installer->run("
    ALTER TABLE `{$installer->getTable('newsletter/subscriber')}`
    ADD customer_type varchar(100) NOT NULL DEFAULT '';
");
$installer->endSetup();