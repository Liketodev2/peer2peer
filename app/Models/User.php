<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'type',
        'company_name',
        'avatar',
        'parent_id',
        'main'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    public function agrees(){
        return $this->hasMany('App\Models\Agree');
    }
    public function repost(){
        return $this->hasMany('App\Models\Repost');
    }
    public function reposts(){
        return $this->belongsToMany('App\Models\Feed','reposts','user_id','feed_id');
    }
    public function feed(){
        return $this->hasMany('App\Models\Feed');
    }
    public function comment_like(){
        return $this->hasMany('App\Models\CommentLike');
    }

    public function isAdmin() {
        if($this->is_admin == 1){
            return true;
        }
        return false;
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows','follow_id','user_id')->withPivot('trust');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows','user_id','follow_id')->withPivot('trust');
    }

    public function showCategory()
    {
        return $this->belongsToMany(User::class, 'show_feeds','user_id','blocked_id');
    }

    public function follow_action()
    {
        return $this->hasMany('App\Models\Follow');
    }
    public function block_action()
    {
        return $this->hasMany('App\Models\BlackList');
    }

    public function showCategory_action()
    {
        return $this->hasMany('App\Models\ShowFeed');
    }

}
