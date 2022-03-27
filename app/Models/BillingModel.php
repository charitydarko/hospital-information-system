<?php

namespace App\Models;

use CodeIgniter\Model;

class BillingModel extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'appointment_id',
        'discount',
        'tax',
        'total',
        'payment_method',
        'note',
        'status',
        'served_by',
    ];

    protected $returnType = 'App\Entities\BillingEntity';

}
