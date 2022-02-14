<?php

namespace App\Models;

class DocumentModel extends \CodeIgniter\Model{
  protected $table = 'document';
  protected $primaryKey = 'id';
  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = [
    'patient_id',
    'description',
    'hidden_attach_file',
    'date',
    'upload_by'
  ];

  protected $returnType = 'App\Entities\DocumentEntity';
}