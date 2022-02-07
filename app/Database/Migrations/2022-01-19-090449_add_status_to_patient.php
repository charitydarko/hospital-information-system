<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToPatient extends Migration
{
  public function up () 
  {
    $this->forge->addColumn('patient', [
      'status' => [
        'type' => 'INT',
        'default' => 1
      ]
    ]);
  }

  public function down() 
  {
    $this->forge->dropColumn('patient', 'status');
  }
}
