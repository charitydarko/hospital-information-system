<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVitals extends Migration
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
            'blood_pressure' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'pulse' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'weight' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'height' => [
                'type' => 'VARCHAR',
                'constraint' => 20
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
        $this->forge->createTable('vitals');
    }

    public function down()
    {
        $this->forge->dropTable('vitals');
    }
}
