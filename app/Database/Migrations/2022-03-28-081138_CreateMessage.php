<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'sender_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'receiver_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'subject' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'Null' => true
            ],
            'message' => [
                'type' => 'TEXT',
                'Null' => true
            ],
            'sender_status' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'receiver_status' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATE'
            ],
            'updated_at' => [
                'type' => 'DATE'
            ],
            'deleted_at' => [
                'type' => 'DATE'
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('message');
    }

    public function down()
    {
        $this->forge->dropTable('message');
    }
}
