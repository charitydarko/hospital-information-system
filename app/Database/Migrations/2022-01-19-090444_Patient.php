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
            'constraint' => 5,
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
          ],
          'date_of_birth' => [
            'type' => 'DATE',
          ],
          'age' => [
            'type' => 'INT',
          ],
          'phone' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
          ],
          'email' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
          ],
          'address' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
          ],
          'occupation' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
          ],
          'marital_status' => [
            'type' => 'INT',
          ],
          'registration_code' => [
            'type' => 'VARCHAR',
            'constraint' => 32,
          ],
          'other' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
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
