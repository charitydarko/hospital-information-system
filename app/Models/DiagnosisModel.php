<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosisModel extends Model
{
    protected $table = 'diagnosis';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'appointment_id',
        'complain',
        'diagnosis',
        'prescription',
        'visiting_fees',
        'visiting_fees_reason',
        'note',
        'created_by',
    ];

    protected $returnType = 'App\Entities\DiagnosisEntity';

}
