<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAccountOpeningTimestampsToPatient extends Migration
{
  public function up () 
  {
    $this->forge->addColumn('patient', [
      'created_at' => [
        'type' => 'DATETIME',
        'null' => true,
        'default' => null
      ], 
      'updated_at' => [
        'type' => 'DATETIME',
        'null' => true,
        'default' => null
      ]
    ]);
  }

  public function down() 
  {
    $this->forge->dropColumn('patient', 'created_at');
    $this->forge->dropColumn('patient', 'updated_at');
  }
}
