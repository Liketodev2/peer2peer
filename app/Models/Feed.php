<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopePublished($query)
    {
        return $query
            ->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query
            ->where('status', 0)
            ->where('seen', 0)->count();
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function likes(){
        return $this->belongsTo('App\Models\Like');
    }
    public function likes_pivot(){
        return $this->belongsTo('App\Models\Like','id','feed_id');
    }
    public function agrees_pivot(){
        return $this->belongsTo('App\Models\Agree','id','feed_id');
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
