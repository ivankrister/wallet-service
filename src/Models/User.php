<?php

namespace DotcodeIo\Wallet\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
