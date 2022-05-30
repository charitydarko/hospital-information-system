<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAppointment extends Migration
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
            'schedule_id' => [
                'type' => 'INT',
                'unique' => false
            ],
            'patient_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
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
        $this->forge->createTable('appointment');
    }

    public function down()
    {
        $this->forge->dropTable('appointment');
    }
}
