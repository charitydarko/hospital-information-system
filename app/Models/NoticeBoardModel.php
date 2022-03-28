<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticeBoardModel extends Model
{
    protected $table = 'noticeboard';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
      'title',
      'description',
      'start_date',
      'end_date',
      'created_by',
      'status'
    ];

    protected $returnType = 'App\Entities\NoticeBoardEntity';

}