<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // En tu controlador


//******************************************************************************* */
//***************Mostrar la vista del formulario de contacto********************* */
// 
public function index() 
    {             
        return view('contacto');
    }
//******************************************************************************* */
//******************************************************************************* */



//********************************************************************************** */
//****************Manejar el envío del formulario de contacto*********************** */
public function enviar(Request $request)
    {
        // Validar datos
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Enviar correo
        Mail::send('emails.contacto', ['datos' => $datos], function ($message) use ($datos) {
            $message->to('eliashb05@gmail.com')
                    ->subject('Nuevo mensaje de contacto: ' . $datos['asunto'])
                    ->replyTo($datos['email'], $datos['nombre']);
        });
        // Redirigir con mensaje de éxito
        return back()->with('mensaje', '¡Gracias por contactarnos! Te responderemos pronto.');
    }
}
//*********************************************************************************** */
//*********************************************************************************** */