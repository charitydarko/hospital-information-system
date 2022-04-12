<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePharmacyBill extends Migration
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
            'discount' => [
                'type' => 'FLOAT',
                'Null' => true
            ],
            'tax' => [
                'type' => 'FLOAT',
                'Null' => true
            ],
            'total' => [
                'type' => 'FLOAT',
                'Null' => true
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'Null' => true
            ],
            'note' => [
                'type' => 'TEXT',
                'Null' => true
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'served_by' => [
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
        $this->forge->createTable('pharmacy_billing');
    }

    public function down()
    {
        $this->forge->dropTable('pharmacy_billing');
    }
}
