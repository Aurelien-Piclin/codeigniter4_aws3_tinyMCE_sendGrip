<?php

namespace App\Libraries;

use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\ObjectUploader;
use Aws\S3\S3Client;

abstract class UploadAWS
{
    public static function uploadToS3($fileName, $bucketName, $s3Path) {

        $s3 = new S3Client([
            'region' => Constantes::AWS_REGION,
            'version' => 'latest',
            'credentials' => [
                'key' => Constantes::CREDENTIAL_AWS_ACCESS_KEY,
                'secret' => Constantes::CREDENTIAL_AWS_SECRET_KEY,
            ],
        ]);

        $source = fopen($s3Path, 'rb');

        $uploader = new ObjectUploader( $s3,
            $bucketName,
            $fileName,
            $source
        );

        try {
            $result = $uploader->upload();
            // If the SDK chooses a multipart upload, try again if there is an exception.
            // Unlike PutObject calls, multipart upload calls are not automatically retried.
        } catch (MultipartUploadException $e) {
            rewind($source);
            $uploader = new MultipartUploader($s3, $source, [
                'state' => $e->getState(),
            ]);
        }

        fclose($source);
    }


}