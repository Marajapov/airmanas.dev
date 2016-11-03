<?php

return [

    'driver' => 'smtp',
	'host' => 'smtp.gmail.com',
	'port' => 587,
	'from' => ['address' => 'gambit210420@gmail.com', 'name' => 'Abakan'],
	'encryption' => 'tls',
    'username' => 'gambit210420@gmail.com',//ваш логин
    'password' => 'ulutsoft123',//ваш пароль*/
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,

    /*'driver' => 'smtp',
    'host' => 'smtp.yandex.ru',
    'port' => 465,
    'encryption' => 'ssl',
    'username' => 'ktrkkg@yandex.ru',//ваш логин
    'password' => 'slimshady11',//ваш пароль*/

];
