<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerificarCorreoPersonalizado;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    //******************************************************************* */
    //**************Enviar notificación de verificación de correo******** */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificarCorreoPersonalizado);
    }
    //******************************************************************* */
    //******************************************************************* */


    //*************************************************************************** */
    //**************Relación uno a muchos con la tabla reservas****************** */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id');
    }
}
    //*************************************************************************** */
    //*************************************************************************** */