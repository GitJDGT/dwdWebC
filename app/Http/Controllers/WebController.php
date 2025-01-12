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

        // Nos aseguramos de validar el token de la sesion para acceder a la API, de lo contrario la retornamos la vista de Login.

        $token = session('api_token');

        if(!$token)
        {
            return redirect() -> route('login') -> withErrors(['message' => 'Token not found.']);
        }

        // Obtenemos informacion de la API, en caso de que la consulta de esta informacion falle, tambien retornamos la vista de Login.

        $response = Http::withToken($token) -> get("http://127.0.0.1:8000/api/v1/appointments?page={$page}"); // /api/v1/appointments

        if($response -> failed())
        {
            return redirect() -> route('login') -> withErrors(['message' => 'Something went wrong retrieving the data.']);
        }

        $data = $response -> collect();
        
        //$items = array_filter( $data['data'], function($items) { return $items['author']['user_id'] == session('api_userID'); } ) ; // Se obtienen los recursos de la pagina actual.
        //dd($data);
        $items = $data['data'];
        $total = $data['meta']['total']; // Obtenemos el total de recursos que comprende nuestra coleccion. HAY QUE HACER QUE ESTO SE ACTUALICE SEGUN EL USUARIO Y NO EN TOTAL
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
