<?php

namespace App\Libraries;

use SendGrid\Mail\Mail;

abstract class SendGrid
{

    public static function sendAndSave($dataSend)
    {
        $email = new Mail();
        $email->setFrom(Constantes::EMAIL_FROM, Constantes::NAME_EMAIL);
        $email->setSubject($dataSend['emailSubject']);
        $email->addTo($dataSend['emailRecipient']);
        $email->addContent("text/html", $dataSend['emailBody']);

        $sendgrid = new \SendGrid(Constantes::SENDGRID_APIKEY);

        $sendgrid->send($email);

        if (!is_dir(Constantes::EMAIL_PATH)) {
            mkdir(Constantes::EMAIL_PATH);
        }

        self::saveBodyInHtmlFile($dataSend['fileName'], $dataSend['emailBody']);

    }

    private static function saveBodyInHtmlFile($fileName, $htmlContent) {

        file_put_contents(Constantes::EMAIL_PATH . $fileName, $htmlContent);

    }

}