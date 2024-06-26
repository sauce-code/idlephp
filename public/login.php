<?php

require_once '../vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withServiceAccount('../config/idle-1f800-firebase-adminsdk-6elgd-2d5db3ec22.json');

$auth = $factory->createAuth();

$userProperties = [
    'email' => 'user2@example.com',
    'password' => 'secretPassword',
];

$signInResult = $auth->signInWithEmailAndPassword($userProperties["email"],$userProperties["password"]);

//echo var_dump($signInResult);

$verifiedIdToken = $auth->verifyIdToken($signInResult->idToken());


$uid = $verifiedIdToken->claims()->get('sub');

echo var_dump($uid);
echo "<br>";

$user = $auth->getUser($uid);

echo var_dump($user);

//echo var_dump($user);

//echo var_dump($abc);
