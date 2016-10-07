<?php
    require 'vendor/autoload.php';
    header('Content-Type: application/json');

    $result = [
        'welcome' => 'This is a POC that returns the ACL data of an AWS S3',
        'instructions' => 'Just do a GET request with the required query params',
        'params' => [
            'cred_key' => [
                'type' => 'string',
                'required' => true
            ],
            'cred_secret' => [
                'type' => 'string',
                'required' => true
            ],
            'bucket' => [
                'type' => 'string',
                'required' => true
            ],
        ],
        'errorTypes' =>[
            'InvalidAccessKeyId' => 'Invalid key',
            'SignatureDoesNotMatch' => 'Invalid signature',
            'NoSuchBucket' => 'Credentials OK but the bucket does not exist'
        ]
    ];

    if ( $_GET['cred_key'] && $_GET['cred_secret'] && $_GET['bucket']) {
        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => [
                'key'    => $_GET['cred_key'],
                'secret' => $_GET['cred_secret']
            ]
        ]);

        try{
            $bucket = $s3->getBucketAcl([
                'Bucket' => $_GET['bucket']
            ]);

            $result = $bucket->toArray();
        }
        catch(AWS\S3\Exception\S3Exception $exception){
            http_response_code($exception->getStatusCode());
            $result = [
                'error' => $exception->getAwsErrorCode(),
                'type' => $exception->getAwsErrorType(),
                'message' => $exception->getMessage()
            ];
        }
    }
    echo json_encode($result);
?>