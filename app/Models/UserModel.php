<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
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

    public function getUsers($user_id = false) {
      if ($user_id === false) {
          return $this->findAll();
      }

      return $this->where(['user_id' => $user_id])->first();
    }

    public function create($data = []) {	 
		  return $this->db->insert($this->table,$data);
	  }

    public function read($user_type) { 
      return $this->where(['user_role' => $user_type])->findAll();
    } 

  
}