<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class PasswordReset extends Model
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'email', 'token'
    ];
}
