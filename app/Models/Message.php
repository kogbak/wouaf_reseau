<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class Message extends Model
{
 

    protected $fillable = [ // comprend pas trop remplissable 
        'message',
        'image',
        'tags'
    ];

    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
       
        return $this->belongsTo('app\Models\User');
    }

}
