Learn-In Platform (Universidad Da Vinci version)
==================
[![Build Status](https://travis-ci.org/Newton-Labs/Learn-in-UDV.svg?branch=master)](https://travis-ci.org/Newton-Labs/Learn-in-UDV)
![Heroku](http://heroku-badge.herokuapp.com/?app=learn-in-udv&style=flat)
[![Symfony](http://img.shields.io/badge/Symfony2-2.8.2-blue.svg)](http://syfmony.com)
[![Symfony](http://img.shields.io/badge/PHP-7.0.2-red.svg)](http://syfmony.com)
![PHP](http://img.shields.io/badge/Buildpack-PHP-lightgrey.svg)
[![NodeJS](http://img.shields.io/badge/Buildpack-NodeJS-lightgrey.svg)](http://nodejs.com)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/926fb08c-8a06-4eb0-b60e-63a3876362a2/big.png)](https://insight.sensiolabs.com/projects/926fb08c-8a06-4eb0-b60e-63a3876362a2)

A Symfony modified  on January 31, 2016, 10:50 am.

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

This project is another Learn-In version modified to supply a [blackboard](http://lac.blackboard.com/sites/international/globalmaster/) minor version

Features Custom Registration, Password Resetting, Custom Email Activation,
Custom Profile, Custom Profile Edition, Standard Login. Powered By
Bootstrap and developed by Newton Labs.

###Bundles Integrated

This project contains a custom [UserBundle][2] based on [FOSUserBundle][3].

Administrate Entities [EasyAdminBundle][6].

Upload PDF and Word documents [VichUploaderBundle][8].

Bootstrap 3.3 [Bootstrap][9].

Urlize specific fields to create unique slug. [Doctrine-Extensions][11].

Soft delete entities [STOF][12].

Unit Tests and Functional tests [PHPUnit][13].

Populate database with fake data [AliceBundle][14].


[jQuery][16].

[Bootstrap input style.][17]

[Star Rating Bundle.][18]

Amazon [SDK for AWS3.][19]

[Guafrette Bundle][20] to use [Gaufrette][21] as a storage layer to AWS3.

Gaufrette help [documentation][22]

##Usage instructions

1. Install [Symfony y Composer][4]
2. Install [MySQL][5]
3. Install PHP
4. Run MySQL service
5. Clone this repository
6. Go to terminal
7. Run composer install in folder path
8. Create database: php app/console doctrine:database:create
9. Create tables:  php app/console doctrine:schema:update --force
10. Run server: php app/console server:run


Live version: [Learn-In-UDV](http://learn-in-udv.herokuapp.com)

 ##Contributions
 
 All contributions are welcome, use the issues to report bugs and pull requests to solve bugs.

[1]:  http://symfony.com/doc/2.6/book/installation.html
[2]:  https://github.com/fcpauldiaz/plataforma_virtual/tree/master/src/UserBundle
[3]:  https://github.com/FriendsOfSymfony/FOSUserBundle
[4]:http://symfony.com/doc/current/book/installation.html
[5]: https://dev.mysql.com/downloads/installer/
[6]:https://github.com/javiereguiluz/EasyAdminBundle
[7]:https://github.com/FriendsOfSymfony/FOSCommentBundle
[8]:https://github.com/dustin10/VichUploaderBundle
[9]:http://getbootstrap.com
[10]:https://github.com/lexik/LexikTranslationBundle
[11]:https://github.com/l3pp4rd/DoctrineExtensions/tree/master/example
[12]:https://github.com/stof/StofDoctrineExtensionsBundle
[13]:http://symfony.com/doc/current/book/testing.html
[14]:https://github.com/hautelook/AliceBundle
[15]:https://github.com/genemu/GenemuFormBundle
[16]:https://packagist.org/packages/symfony-bundle/jquery-bundle
[17]:http://markusslima.github.io/bootstrap-filestyle/
[18]:https://github.com/blackknight467/StarRatingBundle
[19]:https://github.com/aws/aws-sdk-php
[20]:https://github.com/KnpLabs/KnpGaufretteBundle
[21]:https://github.com/KnpLabs/Gaufrette
[22]:https://github.com/KnpLabs/Gaufrette/issues/369




