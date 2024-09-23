<?php

namespace Idle\Login;

use Idle\Persistence\Persistence;
use Kreait\Firebase\Contract\Auth;

class AuthService
{

    private readonly Auth $auth;

    private readonly Persistence $persistence;

    public function __construct(Auth $auth, Persistence $persistence)
    {
        $this->auth = $auth;
        $this->persistence = $persistence;
    }

    public function login(string $email, string $password): string
    {
        $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
        return $signInResult->idToken();
    }

    public function verify(string $idToken): string
    {
        $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        return $verifiedIdToken->claims()->get('sub');
    }

    public function register(string $email, string $password, string $name, string $code): bool
    {
        $success = $this->persistence->redeem($code);
        if (!$success) {
            return false;
        }
        $userProperties = [
            'email' => $email,
            'emailVerified' => false,
            'password' => $password,
            'displayName' => $name,
            'disabled' => false,
        ];
        $this->auth->createUser($userProperties);
        return true;
    }
}
