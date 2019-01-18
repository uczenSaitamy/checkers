<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

abstract class AbstractUser extends Model implements Authenticatable
{
    public static function findByEmail($email)
    {
        return (new static)::where('email', $email)->first();
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        return $this->setAttribute($this->getRememberTokenName(), $value);
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
