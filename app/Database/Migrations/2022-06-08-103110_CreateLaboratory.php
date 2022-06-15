<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaboratory extends Migration
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
            'appointment_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'attach_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'diagnosis_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'note' => [
                'type' => 'TEXT',
            ],
            'fees' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'fees_reason' => [
                'type' => 'TEXT',
            ],
            'served_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable('laboratory');
    }

    public function down()
    {
        $this->forge->dropTable('laboratory');
    }
}
