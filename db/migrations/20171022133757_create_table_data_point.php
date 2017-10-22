<?php


use Phinx\Migration\AbstractMigration;

class CreateTableDataPoint extends AbstractMigration
{
    const TABLE_NAME = "data_point";

    public function up()
    {
        $task = $this->table(static::TABLE_NAME, ["id" => false, "primary_key" => "data_point_uuid"]);
        $task->addColumn("data_point_uuid", "uuid")
            ->addColumn("data_point_recorded_timestamp", "timestamp", ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn("task_uuid", "uuid")
            ->save();
    }

    public function down()
    {
        $this->table(static::TABLE_NAME)->drop();
    }
}
