<?php

namespace App\Models;

class VitalsModel extends \CodeIgniter\Model{
  protected $table = 'vitals';
  protected $primaryKey = 'id';
  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = [
    'appointment_id',
    'blood_pressure',
    'pulse',
    'weight',
    'height',
    'note',
    'created_by',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $returnType = 'App\Entities\VitalsEntity';
}