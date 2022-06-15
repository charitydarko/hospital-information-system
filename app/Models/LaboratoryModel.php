<?php

namespace App\Models;

use CodeIgniter\Model;

class LaboratoryModel extends Model
{
    protected $table = 'laboratory';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'appointment_id',
        'diagnosis_id',
        'attach_file',
        'note',
        'served_by',
        'fees',
        'fees_reason',
        'status'
    ];

    protected $returnType = 'App\Entities\LaboratoryEntity';

}
