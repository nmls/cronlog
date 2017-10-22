<?php

use Phinx\Migration\AbstractMigration;

class LinkTablesTaskAndDataPoint extends AbstractMigration
{
    const TABLE_NAME = "data_point";

    public function up()
    {
        $this->table(static::TABLE_NAME)
            ->addForeignKey(
                'task_uuid'
                , 'task'
                , 'task_uuid'
                , ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )->save();
    }

    public function down()
    {
        $this->table(static::TABLE_NAME)->dropForeignKey("task_uuid");
    }

}
