<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'product', 'status', 'amount', 'purchased_method', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * cart belongs to a user
     *
     * @return  BelongsTo
     * @var
    */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
