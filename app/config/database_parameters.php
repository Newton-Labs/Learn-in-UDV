<?php
    //$db = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $container->setParameter('database_driver', 'pdo_mysql');
    $container->setParameter('database_host', getenv('MYSQL_HOST'));
    $container->setParameter('database_port', 3306);
    $container->setParameter('database_name', getenv('MYSQL_NAME'));
    $container->setParameter('database_user', 'fcpauldiaz');
    $container->setParameter('database_password', getenv('MYSQL_PASSWORD'));
    $container->setParameter('secret', getenv('SECRET'));
    $container->setParameter('locale', 'es');
    $container->setParameter('mailer_transport', gmail);
    $container->setParameter('mailer_host', null);
    $container->setParameter('mailer_user', getenv('USERNAME_SENGRID'));
    $container->setParameter('mailer_password', getenv('PASSWORD_SENGRID'));
