<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
      'sender_id',
      'receiver_id',
      'subject',
      'message',
      'sender_status',
      'receiver_status',
    ];

    protected $returnType = 'App\Entities\MessageEntity';

}