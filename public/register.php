<?php

require_once '../vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withServiceAccount('../config/idle-1f800-firebase-adminsdk-6elgd-2d5db3ec22.json')
    // ->withDatabaseUri('idle-1f800.firebaseapp.com')
;

$auth = $factory->createAuth();


$userProperties = [
    'email' => 'user2@example.com',
    'emailVerified' => false,
    //'phoneNumber' => '+15555550100',
    'password' => 'secretPassword',
    'displayName' => 'John Doe',
    //'photoUrl' => 'http://www.example.com/12345678/photo.png',
    'disabled' => false,
];

$createdUser = $auth->createUser($userProperties);
