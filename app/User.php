<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','customer_id','first_name','middle_name','last_name','username', 'date_of_birth_or_age', 'gender', 'marital_status', 'telephone', 'residence', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * user task relationship
     *
     * @return HasMany
     * @var
     */
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    /**
     * user shopping cart relationship
     *
     * @return HasMany
     * @var
     */
    public function cart(){
        return $this->hasMany(ShoppingCart::class);
    }
}
