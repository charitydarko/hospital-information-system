<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSetting extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'favicon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'language'  => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'site_align'  => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'footer_text'  => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'time_zone'  => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->createTable('setting');
    }

    public function down()
    {
        $this->forge->dropTable('setting');
    }
}
