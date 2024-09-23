<?php

namespace Idle\Persistence;

class Credentials
{
    public function getHostname(): string
    {
        return "localhost:3306";
    }

    public function getDatabase(): string
    {
        return "idle";
    }

    public function getUsername(): string
    {
        return "root";
    }

    public function getPassword(): string
    {
        return "abc";
    }
}
