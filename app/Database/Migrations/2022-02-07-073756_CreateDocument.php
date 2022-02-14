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
          'description' => [
            'type' => 'TEXT',
            'null' => true
          ],
          'hidden_attach_file' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => false
          ],
          'date' => [
            'type' => 'Date',
            'null' => false
          ],
          'upload_by' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true
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
