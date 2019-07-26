<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(int $id)
 */
class Todo extends Model
{
    use SoftDeletes;
    protected $dates =['deleted_at'];
    protected $fillable = [
        'user_id', 'title', 'complete'
    ];
    protected $casts = [
        'complete' => 'boolean',
    ];
     public function user(){
         return $this->belongsTo('App\Todo');
     }
}
