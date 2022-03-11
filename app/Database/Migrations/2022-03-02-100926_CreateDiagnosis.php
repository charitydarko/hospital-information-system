<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiagnosis extends Migration
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
            'complain' => [
                'type' => 'TEXT'
            ],
            'diagnosis' => [
                'type' => 'TEXT'
            ],
            'prescription' => [
                'type' => 'TEXT',
            ],
            'laboratory' => [
                'type' => 'TEXT',
            ],
            'visiting_fees' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'visiting_fees_reason' => [
                'type' => 'TEXT',
            ],
            'note' => [
                'type' => 'TEXT',
            ],
            'created_by' => [
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
        $this->forge->createTable('diagnosis');
    }

    public function down()
    {
        $this->forge->dropTable('diagnosis');
    }
}
