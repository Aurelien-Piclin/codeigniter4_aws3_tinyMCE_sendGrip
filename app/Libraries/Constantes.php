<?php

namespace App\Libraries;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Database\Config;

abstract class Constantes
{

    public const ERRORMESSAGE = [
        'emailRecipient' => [
            'required' => 'Email is required.',
            'valid_email' =>'Email recipient is not valid.',
            'max_length' => 'Email is too long (max 250).'
        ],
        'emailSubject' => [
            'required' => 'Email subject is required.',
            'max_length' => "Email subject is too long (max 250)."
        ],
        'emailBody' => [
            'required' =>"Email body is required.",
        ]
    ];

    /*
     * PATH SAVE FILE HTML
     */
    public const EMAIL_PATH = '../app/Data/';


    /**
     * SENDGRID CONSTANTES
     */
    public const SENDGRID_APIKEY = '';
    public const EMAIL_FROM = '';
    public const NAME_EMAIL = '';


    /**
     * AWS CONSTANTE
     */
    public const CREDENTIAL_AWS_ACCESS_KEY = '';
    public const CREDENTIAL_AWS_SECRET_KEY = '';
    public const AWS_REGION = '';
    public const AWS_BUCKET_NAME = '';


}