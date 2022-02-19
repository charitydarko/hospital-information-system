<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
          ],
          'patient_id' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
          ],
          'doctor_id' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => true
          ],
          'category' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => true
          ],
          'description' => [
            'type' => 'TEXT',
            'null' => true
          ],
          'hidden_attach_file' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => false
          ],
          'upload_by' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true
          ],
          'created_at' => [
              'type' => 'Date',
              'null' => true,
          ],
          'updated_at' => [
              'type' => 'Date',
              'null' => true,
          ],
          'deleted_at' => [
              'type' => 'Date',
              'null' => true,
          ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('document');
    }

    public function down()
    {
        $this->forge->dropTable('document');
    }
}

