<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ContactoController;


    //***************************************************************** */
    //****************Rutas para la página principal******************* */
    Route::get('/', function () {
        if (auth()->check()) {
            return redirect()->route('index'); // Redirige si está logueado
        }
        return view('principal');
        //$data = Estudiante::latest()->paginate(5);
        //return view('index', compact('data'))->with('i', (request()->input('page', 1) -
        //1) * 5);
    });
    //***************************************************************** */
    //***************************************************************** */


    //***************************************************************** */
    //***************Rutas para la página de inicio de sesión********** */
    Route::get('/dashboard', function () {
        return redirect()->route('index');
    })->middleware(['auth', 'verified'])->name('dashboard');
    //***************************************************************** */
    //***************************************************************** */



    //******************************************************************* */
    //****************Rutas para la administración de usuarios*********** */
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::patch('/usuarios/{id}/bloquear', [UsuarioController::class, 'bloquear'])->name('usuarios.bloquear');
    Route::patch('/usuarios/{id}/desbloquear', [UsuarioController::class, 'desbloquear'])->name('usuarios.desbloquear');
    //******************************************************************** */
    //******************************************************************** */



    //******************************************************************** */
    //****************Rutas para el perfil de cada ususario*************** */
    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //******************************************************************** */
    //******************************************************************** */



    //********************************************************************* */
    //*******************Rutas para la política de privacidad************** */
    Route::get('/politica', function(){
        return view('politica');
    })->name('politica');
    //********************************************************************* */
    //********************************************************************* */


    //Rutas para principal2
    Route::get('/principal2', [HotelController::class, 'index'])->name('index');


    //******************************************************************** */
    //****************Rutas para la administración de hoteles************* */
    Route::get('/hoteles', [HotelController::class, 'hoteles'])->name('hoteles.index');
    Route::get('/hoteles/{id}', [HotelController::class, 'show'])->name('hoteles.show');
    Route::post('/hoteles/buscar', [HotelController::class, 'buscar'])->name('hoteles.buscar');
    //********************************************************************* */
    //********************************************************************* */


    //Rutas del perfil
    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile');


    //********************************************************************* */
    //****************Rutas para la administración de reservas************* */
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::post('/reservas/{id}/confirmar', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');
    Route::post('/reservas/{id}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
    //********************************************************************* */
    //********************************************************************* */

    
    //Rutas de contacto
    Route::get("/contacto", [ContactoController:: class, 'index'])->name('contacto.index');
    Route::post("/contacto", [ContactoController:: class, 'enviar'])->name('contacto.enviar');


    //Ruta para el pdf
    Route::get('/report', [ReservaController::class, 'report'])->name('reservas.report');
    
    //cierre ruta middleware con auth y verified
    });


    require __DIR__.'/auth.php';