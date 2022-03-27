<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillDetails extends Migration
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
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'quantity' => [
                'type' => 'INT'
            ],
            'price' => [
                'type' => 'FLOAT'
            ],
            'subtotal' => [
                'type' => 'FLOAT'
            ]
            
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('billing_details');
    }

    public function down()
    {
        $this->forge->dropTable('billing_details');
    }
}
