<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    //******************************************************************************************** */
    //**************Mostrar usuarios que hay actualmente registrados solo a los admin************* */
    public function index()
    {
        // Verifica si el usuario está autenticado y si su rol es 'admin'.
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }
        // Obtiene todos los usuarios registrados en la base de datos
        // y los pasa a la vista 'usuarios.index'.
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }
    //********************************************************************************************* */
    //********************************************************************************************* */



    //********************************************************************************************* */
    //**************Mostrar formulario para crear un nuevo usuario solo a los admin**************** */
    public function edit($id)
    {
        // Verifica si el usuario está autenticado y si su rol es 'admin'.
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        // Busca el usuario por su ID.
        // Luego, pasa el usuario a la vista 'usuarios.edit'.
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }
    //********************************************************************************************* */
    //********************************************************************************************* */



    //**************************************************************************************************** */
    //**************Almacenar un nuevo usuario en la base de datos solo a los admin*********************** */
    public function update(Request $request, $id)
    {
        // Verifica si el usuario está autenticado y si su rol es 'admin'.
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        // Busca el usuario por su ID y valida los datos del formulario.
        $usuario = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|in:admin,user',
        ]);

        // Actualiza el usuario con los datos del formulario.
        $usuario->update($request->only('name', 'email', 'rol'));
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
    //***************************************************************************************************** */
    //***************************************************************************************************** */



    //******************************************************************************************************* */
    //**************Eliminar un usuario de la base de datos solo a los admin********************************* */
    public function destroy($id)
    {
        // Verifica si el usuario está autenticado y si su rol es 'admin'.
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        try {
            // Busca el usuario por su ID.
            $usuario = User::findOrFail($id);

            // Evita que un usuario se elimine a sí mismo
            if (auth()->id() == $id) {
                return redirect()->route('usuarios.index')->with('error', 'No puedes eliminarte a ti mismo.');
            }

            // Borrar todas las reservas asociadas al usuario
            $usuario->reservas()->delete();

            // Elimina el usuario de la base de datos
            $usuario->delete();

            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
    //******************************************************************************************************** */
    //******************************************************************************************************** */



    //*************************************************************************************************** */
    //******************************Bloquear usuarios**************************************************** */
    public function bloquear($id)
    {
        
        // Evitar que un usuario se bloquee a sí mismo
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'No puedes bloquearte a ti mismo.');
        }

        // Busca el usuario por su ID y actualiza su estado ha bloqueado.
        $usuario = User::findOrFail($id);
        $usuario->bloqueado = true;
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario bloqueado correctamente.');
    }
    //*************************************************************************************************** */
    //*************************************************************************************************** */



    //****************************************************************************************************** */
    //**********************************Desbloquear usuarios************************************************ */
    public function desbloquear($id)
    {
        // Busca el usuario por su ID y actualiza su estado a desbloqueado.
        $usuario = User::findOrFail($id);
        $usuario->bloqueado = false;
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario desbloqueado correctamente.');
    }
}
    //****************************************************************************************************** */
    //****************************************************************************************************** */