<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{

    


    public function messages(){

        return $this->hasMany(Message::class); // peut poster 0 a plusieure messages
    
    }

    public function comments(){
        
        return $this->hasMany('app\Models\Comment'); // peut poster 0 ou plusieure commentaires
    
    }


    public function role(){
        
        return $this->belongsTo(Role::class); // peut avoir 1/1 donc user ou admin
    
    }

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // tous les champs qu'on a définie dans la migration sinon erreur dans une save ou un create
        'nom',
        'prenom',
        'wouafname',
        'image',
        'email',
        'password',
        '_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        '_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
       return auth()->user()->role_id === 2;
        
    }

    
}
