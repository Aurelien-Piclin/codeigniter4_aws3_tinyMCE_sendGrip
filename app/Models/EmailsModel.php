<?php

namespace App\Models;
use CodeIgniter\Model;

class EmailsModel extends Model {

    protected $table = 'emails';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'uuid',
        'to_email',
        'from_email',
        'email_subject',
        'email_body',
        'aws_bucket',
        'aws_folder',
        'aws_file_name'
    ];


}