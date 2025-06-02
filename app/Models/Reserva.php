<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idreserva';
    protected $fillable = [
        'idhotel',
        'id',
        'fecha_entrada',
        'fecha_salida',
        'num_habitaciones',
        'total_pagar',
        'estado',
    ];


    
    //************************************************************************************************** */
    //************Relaciones muchos a uno con las tablas de hoteles y usuarios************************** */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'idhotel', 'idhoteles');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
    //************************************************************************************************** */
    //************************************************************************************************** */