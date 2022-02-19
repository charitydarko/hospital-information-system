<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Patient extends Migration
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
          'firstname' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
          ],
          'lastname' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
          ],
          'gender' => [
            'type' => 'INT',
            'constraint' => 11,
          ],
          'date_of_birth' => [
            'type' => 'DATE',
          ],
          'age' => [
            'type' => 'INT',
            'constraint' => 11,
          ],
          'phone' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'mobile' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'email' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'town' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'city' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'region' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'address' => [
            'type' => 'TEXT',
          ],
          'occupation' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
          ],
          'marital_status' => [
            'type' => 'INT',
            'constraint' => 11,
          ],
          'religion' => [
            'type' => 'INT',
            'constraint' => 11,
          ],
          'registration_code' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'emergency_contact_name' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
          ],
          'emergency_contact_phone' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
          ],
          'emergency_contact_address' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
          ],
          'other' => [
            'type' => 'TEXT'
          ],
          'status' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
          ],
          'created_by' => [
              'type' => 'VARCHAR',
              'constraint' => 50,
              'null' => true,
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
        $this->forge->createTable('patient');
    }

    public function down()
    {
      $this->forge->dropTable('patient');
    }
}
