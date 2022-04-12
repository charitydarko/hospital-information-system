<?php

namespace App\Models;

use CodeIgniter\Model;

class PharmacyBillingDetailsModel extends Model
{
    protected $table = 'pharmacy_billing_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'appointment_id',
        'item_name',
        'description',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $returnType = 'App\Entities\PharmacyBillingDetailsEntity';

}
