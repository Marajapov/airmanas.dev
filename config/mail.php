<?php

return [
    'driver' => 'smtp',
	'host' => 'smtp.gmail.com',
	'port' => 587,
	'from' => ['address' => 'gambit210420@gmail.com', 'name' => 'Abakan'],
	'encryption' => 'tls',
    'username' => 'gambit210420@gmail.com',
    'password' => 'ulutsoft123',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,

];
