<?php

namespace App\Models;

use CodeIgniter\Model;

class BillingDetailsModel extends Model
{
    protected $table = 'billing_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'appointment_id',
        'item_name',
        'description',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $returnType = 'App\Entities\BillingDetailsEntity';

}
