<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
  /** table name */
  protected $table = 'tasks';

  /**
    * mass assignable attributes
    *
    * @var array
  */
  protected $fillable = [
    'user_id','appointment','type','status','body','reminder'
  ];

  /**
    * hidden attributes
    *
    * @var array
    */
  protected $hidden = [];

  /**
    * user task relationship
    *
    * @return BelongsTo
  */
  public function user(){
    return $this->belongsTo(User::class);
  }
}
