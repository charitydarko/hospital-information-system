<?php

namespace App\Models;

class PatientModel extends \CodeIgniter\Model{
  protected $table = 'patient';
  protected $primaryKey = 'id';
  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = [
    'firstname',
    'lastname',
    'age',
    'date_of_birth',
    'phone',
    'mobile',
    'email',
    'gender',
    'town',
    'city',
    'region',
    'address',
    'occupation',
    'marital_status',
    'religion',
    'insurance_type',
    'insurance_number',
    'registration_code',
    'emergency_contact_name',
    'emergency_contact_phone',
    'emergency_contact_address'
  ];

  protected $returnType = 'App\Entities\PatientEntity';

}