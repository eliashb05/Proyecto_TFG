<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreo;
use App\Models\Reserva;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ReservaController extends Controller{


//************************************************************************************ */
//****************Muestra las reservas del usuario************************************ */   
public function index()
    {
        //Filtra las reservas por el ID del usuario
        $reservas = Reserva::where('id', Auth::id())
        //Carga los datos de la relación hotel y usuario
        ->with(['hotel', 'usuario'])
        //Devuelve todas las reservas
        ->get();

        // Devuelve la vista 'reservas' con los datos de las reservas.
        return view('reservas')->with('reservas', $reservas);
    }
//************************************************************************************ */
//************************************************************************************ */



//************************************************************************************************************** */
//***********************Almacena una nueva reserva en la base de datos***************************************** */
public function store(Request $request)
{
    // Valida los datos del formulario
    $request->validate([
        'idhotel' => 'required|exists:hoteles,idhoteles',
        'id' => 'required|exists:users,id',
        'fecha_entrada' => 'required|date|after_or_equal:today',
        'fecha_salida' => 'required|date|after:fecha_entrada',
        'num_habitaciones' => 'required|integer|min:1',
        'total_pagar' => 'required|numeric|min:1',
    ],  [
            //Sacar errores de validación personalizados
            'fecha_entrada.after_or_equal' => 'La fecha de entrada debe ser posterior o igual al día de hoy.',
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha de entrada.',
        ]);

    // Busca el hotel al que se quiere hacer la reserva
    $hotel = Hotel::findOrFail($request->idhotel);
    $habitacionesDisponibles = $hotel->habitaciones;

    // Verifica cuántas habitaciones ya están reservadas en ese rango de fechas
    $habitacionesReservadas = Reserva::where('idhotel', $request->idhotel)
        ->where(function($query) use ($request) {
            // Para evitar conflictos de reservas, se verifica si las fechas de entrada y salida se superponen
            // Para saber si una reserva empieza entre las fechas pedidas
            $query->whereBetween('fecha_entrada', [$request->fecha_entrada, $request->fecha_salida])
            // Para saber si una reserva termina entre las fechas pedidas
                ->orWhereBetween('fecha_salida', [$request->fecha_entrada, $request->fecha_salida])
                // Para saber si la reserva empieza antes y termina después de las fechas pedidas
                ->orWhere(function($query) use ($request) {
                    $query->where('fecha_entrada', '<', $request->fecha_entrada)
                        ->where('fecha_salida', '>', $request->fecha_salida);
                });
        })
        // Suma el número de habitaciones reservadas en ese rango de fechas
        ->sum('num_habitaciones');

    // Verifica si hay suficientes habitaciones disponibles
    if ($habitacionesReservadas + $request->num_habitaciones > $habitacionesDisponibles) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['fecha' => 'No hay suficientes habitaciones disponibles en las fechas seleccionadas.']);
    }

    // Calcula los días de estancia
    $dias = (new \DateTime($request->fecha_salida))->diff(new \DateTime($request->fecha_entrada))->days;

    // Calcula el total a pagar
    $totalPagar = $dias * $hotel->precio * $request->num_habitaciones;

    // Crea la reserva
    Reserva::create([
        'idhotel' => $request->idhotel,
        'id' => $request->id,
        'fecha_entrada' => $request->fecha_entrada,
        'fecha_salida' => $request->fecha_salida,
        'num_habitaciones' => $request->num_habitaciones,
        'total_pagar' => $totalPagar,
        'estado' => 'Pendiente',
    ]);
    
     // Redirigir o retornar una respuesta
     return redirect()->route('reservas.index')->with('success', 'Reserva realizada con éxito');
}

//***************************************************************************************************************** */
//***************************************************************************************************************** */



//******************************************************************************************************************** */
//***********************Generar un PDF con todas las reservas del usuario******************************************** */
     public function report(){
        //Filtra las reservas por el ID del usuario
        $reservas = Reserva::where('id', Auth::id())
        //Carga los datos de la relación hotel y usuario
        ->with(['hotel', 'usuario'])
        //Devuelve todas las reservas
        ->get();
        //Genera el PDF con los datos de las reservas
        $pdf = pdf::loadView('report', compact('reservas'));
        //Descarga el PDF
        return $pdf->download('reporte-reservas.pdf');
    }
//********************************************************************************************************************* */
//********************************************************************************************************************* */



//********************************************************************************************************************* */
//***********************Confirmar una reserva************************************************************************* */
    public function confirmar($id)
    {

        //Cambia el estado de la reserva a 'Confirmado'
        $reserva = Reserva::find($id);
        $reserva->estado = 'Confirmado';
        $reserva->save();;

        //Busca el hotel
        $hotel = Hotel::findOrFail($reserva->idhotel);

        //Resta las habitaciones reservadas al total de habitaciones del hotel
        $hotel->habitaciones -= $reserva->num_habitaciones;
        $hotel->save();
        
        //Envia un email al usuario con los datos de la reserva confirmada
        Mail::to($reserva->usuario->email)->send(new EnviarCorreo($reserva));
        return response()->json(['success' => 'Reserva confirmada con éxito. Te hemos enviado un correo con los detalles de la reserva.']);
    }
//********************************************************************************************************************* */
//********************************************************************************************************************* */



//********************************************************************************************************************* */
//***********************Cancelar una reserva************************************************************************** */
    public function cancelar($id)
    {

        $reserva = Reserva::find($id);
        $reserva->estado = 'Cancelado';
        $reserva->save();
       
        
        if ($reserva) {
            //Busca el hotel
            $hotel = Hotel::findOrFail($reserva->idhotel);

            //Suma las habitaciones reservadas al total de habitaciones del hotel
            $hotel->habitaciones += $reserva->num_habitaciones;
            $hotel->save();

            //Elimina la reserva
            $reserva->delete();
        }
        
        return response()->json(['success' => 'Reserva cancelada con éxito.']);
    }
}
//**********************************************************************************************************************/
//**********************************************************************************************************************/