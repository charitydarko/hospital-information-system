<?php

namespace App\Models;

class SettingModel extends \CodeIgniter\Model{
  protected $table = 'setting';
  protected $primaryKey = 'id';
  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = [
    'title',
    'name',
    'description',
    'email',
    'phone',
    'logo',
    'favicon',
    'language',
    'site_align',
    'footer_text',
    'time_zone',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $returnType = 'App\Entities\SettingEntity';
}