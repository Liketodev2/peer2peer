<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelWhiteList extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['url','status','user_id'];

}
