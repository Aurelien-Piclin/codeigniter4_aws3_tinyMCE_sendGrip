<?php

namespace App\Controllers;

use App\Libraries\Constantes;
use App\Libraries\SendGrid;
use App\Libraries\UploadAWS;
use App\Models\EmailsModel;

class SendingController extends BaseController
{
    public function contact()
    {

        helper(['form']);
        if (!empty($_POST)) {

            $rules = [
                'emailRecipient' => 'required|valid_email|max_length[250]',
                'emailSubject' => 'required|max_length[250]',
                'emailBody' => 'required',
            ];

            if ($this->validate($rules, Constantes::ERRORMESSAGE)) {

                $uuid = uniqid('email_');

                $dataSend = [
                    'uuid' => $uuid,
                    'fileName' => $uuid . '.html',
                    'emailRecipient' => $this->request->getVar('emailRecipient'),
                    'emailSubject' => $this->request->getVar('emailSubject'),
                    'emailBody' => $this->request->getVar('emailBody'),
                ];


                SendGrid::sendAndSave($dataSend);
                UploadAWS::uploadToS3($dataSend['fileName'], Constantes::AWS_BUCKET_NAME, Constantes::EMAIL_PATH . $dataSend['fileName']);

                $dataSQL = [
                    'uuid' => $uuid,
                    'to_email' => $this->request->getVar('emailRecipient'),
                    'from_email' => Constantes::EMAIL_FROM,
                    'email_subject' => $this->request->getVar('emailSubject'),
                    'email_body' => $this->request->getVar('emailBody'),
                    'aws_bucket' => Constantes::AWS_BUCKET_NAME,
                    'aws_folder' => '',
                    'aws_file_name' => $uuid . '.html',
                ];

                $emails = new EmailsModel();
                $emails->save($dataSQL);

                return redirect()->to('/thank_you');
            }
        }
        return $this->twig->render('./contact/sending.html.twig', ['validations' => $this->validator ?? '']);
    }

    public function thanks() {
        return $this->twig->render('./contact/thanks.html.twig', []);
    }

}