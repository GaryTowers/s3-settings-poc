### S3 settings validation
This is a proof of concept to confirm that there is a way to validate S3 settings without uploading a file.

This POC validates settings by requesting the ACLs for a bucket (see doc).

It can validate
* Key
* Signature
* Bucket name

It cannot validate
* Prefix

### Install
* Clone the project 
* Install AWS S3 PHP sdk by running the command `composer install`
* Place the project on a php web server