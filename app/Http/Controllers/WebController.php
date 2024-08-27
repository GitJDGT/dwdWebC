<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class WebController extends Controller
{
    // Configuramos el controlador que se disparara con las rutas WEB.

    public function indexApi()
    {
        // Obtenemos la informacion usando la libreria HTTP de Laravel y luego
        // almacenamos la respuesta de la API en una variable de nombre DATA y accedemos al atributo DATA, META TOTAL y META PER_PAGE de la respuesta de la API
        // finalmente retornamos la vista con la funcion VIEW y pasamos la informacion codificada en JSON bajo el nombre de APPOINTMENT.

        $page = request() -> page;

        // Necesitamos obtener el token de la sesion para acceder a la API, de lo contrario la peticion Get no podra traer la informacion y causara que
        // $data quede vacia.

        // $token = $_POST['token']; // ESTO NO SIRVE
        // echo "El token es: $token";

        $response = Http::get("http://127.0.0.1:8000/api/v1/appointments?page={$page}"); // /api/v1/appointments
        
        // Comprobamos la respuesta de autenticacion del servidor (NO FUNCIONA).
        // if($response -> status() === 401)
        // {
        //     return redirect() -> route('login');
        // }

        $data = $response -> collect();
        
        $items = $data['data']; // Se obtienen los recursos de la pagina actual.
        $total = $data['meta']['total']; // Obtenemos el total de recursos que comprende nuestra coleccion.
        $PerPage = $data['meta']['per_page']; // Obtenemos los recursos que se muestran por pagina.

        // Creamos una instancia de nuestro paginador

        $paginator = new LengthAwarePaginator($items, $total, $PerPage);

        return view('index', ['appointments' => $paginator]);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function logout()
    {
        return view('login');
    }
}
