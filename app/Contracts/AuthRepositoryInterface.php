<?php

namespace App\Contracts;

interface AuthRepositoryInterface {

    public function createUser(array $data);

    public function checkUser(array $data);
}