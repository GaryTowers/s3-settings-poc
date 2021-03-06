### S3 settings validation
This is a proof of concept to confirm that there is a way to validate S3 settings without uploading a file.

This POC validates settings by requesting the ACLs for a bucket [see documentation](http://docs.aws.amazon.com/aws-sdk-php/v2/api/class-Aws.S3.S3Client.html#_getBucketAcl).

It can validate
* Key
* Signature
* Bucket name

It cannot validate
* Prefix

### Install
* Clone the project anc `cd` to it
* Install AWS S3 PHP sdk by running the command `composer install`
* Place the project on a php web server

### Run 
* Fire up your web server and open the index.php on your prefered browser/httt client
* If you will see a JSON response with some instructions and error types then you are good to start testing!
* Do a get request to `index.php?cred_key=<aws_key>&cred_secret=<aws_secret>&bucket=<bucket_name>`