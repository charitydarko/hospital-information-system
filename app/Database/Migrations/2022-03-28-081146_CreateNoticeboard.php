<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoticeboard extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'Null' => true
            ],
            'start_date' => [
                'type' => 'DATE'
            ],
            'end_date' => [
                'type' => 'DATE'
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'status' => [
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
        $this->forge->createTable('noticeboard');
    }

    public function down()
    {
        $this->forge->dropTable('noticeboard');
    }
}
