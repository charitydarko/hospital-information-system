<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
      'firstname',
      'lastname',
      'email',
      'mobile',
      'phone',
      'password',
      'user_role',
      'age',
      'date_of_birth',
      'address',
      'gender',
      'picture',
      'status',
      'created_by'
    ];

    protected $returnType = 'App\Entities\UserEntity';

}