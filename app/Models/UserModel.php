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
      'address',
      'gender',
      'picture',
      'status',
      'created_by'
    ];

    protected $returnType = 'App\Entities\UserEntity';

    public function getUsers($id = false) {
      if ($id === false) {
          return $this->findAll();
      }

      return $this->where(['id' => $id])->first();
    }

    public function create($data = []) {	 
		  return $this->db->insert($this->table,$data);
	  }

    public function read($user_type) { 
      return $this->where(['user_role' => $user_type])->findAll();
    } 

  
}