<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function messages(){
        return $this->hasMany('App\Models\Message','conversation_id','id');
    }

    public function from_user(){
        return $this->hasOne('App\Models\User','id','from_id');
    }
    public function to_user(){
        return $this->hasOne('App\Models\User','id','to_id');
    }
}
