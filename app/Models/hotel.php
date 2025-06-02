<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $table = 'hoteles';
    public $timestamps = false;
    protected $primaryKey = 'idhoteles';



    //*************************************************************************** */
    //**************Relación uno a muchos con la tabla reservas****************** */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idhotel', 'idhoteles');
    }
    //*************************************************************************** */
    //*************************************************************************** */
}