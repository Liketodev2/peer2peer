<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function likes(){
        return $this->belongsTo('App\Models\Like');
    }
    public function agrees(){
        return $this->belongsTo('App\Models\Agree');
    }
    public function reposts(){
        return $this->belongsTo('App\Models\Repost');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at','desc');
    }
    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
