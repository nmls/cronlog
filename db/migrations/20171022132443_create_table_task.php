<?php


use Phinx\Migration\AbstractMigration;

class CreateTableTask extends AbstractMigration
{

    const TABLE_NAME = "task";

    public function up()
    {
        $task = $this->table(static::TABLE_NAME, ["id" => false, "primary_key" => "task_uuid"]);
        $task->addColumn("task_uuid", "uuid")
            ->addColumn("task_name", "string", ["limit" => 128])
            ->save();
    }

    public function down()
    {
        $this->table(static::TABLE_NAME)->drop();
    }
}
