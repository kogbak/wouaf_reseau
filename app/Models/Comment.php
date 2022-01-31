<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    public function message(){

        return $this->belongsTo(Message::class); // Appartien à 1 message (commentaire reponse)
       

    }

    public function user(){

        return $this->belongsTo('app\Models\User'); // Appartien à 1 utilisateur
       

    }

}

