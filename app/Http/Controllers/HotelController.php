<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */



//********************************************************************************************* */
//**************Mostrar la vista principal con los hoteles destacados************************** */
   public function index() {
    // Carga solo las columnas necesarias y limito a 8 hoteles
    $hoteles = Hotel::select(['idhoteles', 'nombre', 'imagen', 'precio', 'valoracion', 'localizacion'])
                   ->orderBy('valoracion', 'desc')
                   ->withCount('reservas')
                   ->take(8)
                   ->get();
                   
    return view('principal2', compact('hoteles'));
}
//********************************************************************************************* */
//********************************************************************************************* */



//***************************************************************************************************** */
//******************Buscar Hoteles segun los criterios de la barra de busqueda************************* */ 
public function buscar(Request $request)
{
    // Valida los datos del formulario
    $request->validate([
        'destino' => 'required|string|max:255',
        'fecha_entrada' => 'required|date|before_or_equal:fecha_salida|after_or_equal:today',
        'fecha_salida' => 'required|date|after_or_equal:fecha_entrada',
        'habitaciones' => 'required|integer|min:1',
    ],[
        'fecha_entrada.before_or_equal' => 'La fecha de entrada debe ser igual o anterior a la fecha de salida.',
        'fecha_entrada.after_or_equal' => 'La fecha de entrada debe ser igual o posterior a hoy.',
        'fecha_salida.before_or_equal' => 'La fecha de salida debe ser igual o anterior a la fecha de entrada.',
    ]);
    // Busca hoteles que coincidan con el destino y ordena por valoración contando las reservas también
    $hoteles = Hotel::where('localizacion', 'LIKE', '%' . $request->destino . '%')
        ->orderBy('valoracion', 'desc')
         ->withCount('reservas')
        ->get();


    // Retorna la vista de resultados con los hoteles encontrados
    return view('hoteles.resultados', compact('hoteles'));
}

//****************************************************************************************************** */
//****************************************************************************************************** */



//*************************************************************************************************** */
//***************Mostrar los hoteles paginados de 8 en 8********************************************* */
    public function hoteles(){
        // Aqui obtengo hoteles con el modelo Hotel y los pagino de 8 en 8.
        $hoteles = Hotel::paginate(8); 
        // Retorno la vista hoteles y le paso la variable hoteles
        return view('hoteles', compact('hoteles'));
    }
//*************************************************************************************************** */
//*************************************************************************************************** */



//**************************************************************************************************** */
//***********************Mostrar un hotel por su ID*************************************************** */
    public function show($id){
        // Busca el hotel por su ID
        $hotel = Hotel::findOrFail($id);
        // Retorno la vista hoteles.show y le paso los datos del hotel a la vista
        return view('hoteles.show', compact('hotel'));
    }
    
}
//**************************************************************************************************** */
//**************************************************************************************************** */