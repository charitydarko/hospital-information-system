<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
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
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'user_role' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'gender' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'age' => [
                'type' => 'INT',
                'null' => true,
            ],
            'date_of_birth' => [
                'type' => 'Date',
                'null' => true,
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
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
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
