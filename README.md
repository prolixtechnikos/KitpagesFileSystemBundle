KitpagesFileSystemBundle
========================

This is a bundle that provides a filesystem abstraction layer. Basicaly this does the
same as the gaufrette library from KnpLabs, but it manages much more efficiently big files. We can
manage a 2GB file with a memory limit of 128Mo for the PHP process. We never transfert the entire
content in a $content variable.

With this bundle you can save your files on different filesystems (S3, Local filesystem, FTP,...)

Some elements of the configuration system are based on the code of the KnpGaufretteBundle.

Actual state
============
This bundle is in alpha state. The first adapters are :

* Local adapter : file system of the server
* S3 adapter : for Amazon Web Service AWS S3

Installation
============
You need to add the following lines in your deps :

    [FileSystemBundle]
        git=git://github.com/kitpages/KitpagesFileSystemBundle.git
        target=Kitpages/FileSystemBundle

Only if you use AmazonS3
    [aws-sdk]
        git=http://github.com/amazonwebservices/aws-sdk-for-php
        target=aws-sdk
        version=1.5.4

AppKernel.php
        $bundles = array(
        ...
            new Kitpages\FileSystemBundle\KitpagesFileSystemBundle(),
        );

// AWS SDK needs a special autoloader
require_once __DIR__.'/../vendor/aws-sdk/sdk.class.php';
=======

Configuration example
=====================

kitpages_file_system:
    file_system_list:
        kitpagesFile:
            local:
                directory_public: %kernel.root_dir%/../web
                directory_private: %kernel.root_dir%
                base_url: %base_url%
        kitpagesAmazon:
            amazon_s3:
                bucket_name: %kitpagesFile_amazons3_bucketname%
                key: %kitpagesFile_amazons3_key%
                secret_key: %kitpagesFile_amazons3_secretkey%

Usage example
=============
