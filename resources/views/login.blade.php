<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite('resources/css/app.css')

        <title>Log In</title>
    </head>

    <body class="bg-neutral-900 text-white">

        <div class="grid grid-cols-3 items-center">

            <div class="w-full">
                {{-- Espacio vacio a la izquierda --}}
            </div>

            {{-- Nuestro componente de Log In y Registro, contiene todos los campos del formulario y botones interactivos --}}
            <div class="max-w-8xl w-full mx-auto items-center flex justify-center h-screen">
                
                <div class="bg-slate-800 border border-slate-700 rounded-lg p-6 space-y-5 w-3/4">

                    <div class="border-b-2 border-slate-700 mb-8">

                        <h1 class="text-2xl font-bold mb-4 text-center">Log In</h1>

                    </div>

                    <form action="" method="post" class="flex flex-col">

                        <label for="email" class="text-lg text-white mb-1 font-semibold">Email</label>
                        <input type="text" name="email" id="email" class="p-2 rounded bg-slate-900 border border-slate-700 mb-4">

                        <label for="password" class="text-lg text-white mb-1 font-semibold">Password</label>
                        <input type="password" name="password" id="password" class="p-2 rounded bg-slate-900 border border-slate-700 mb-4">

                        <label for="device" class="text-lg text-white mb-1 font-semibold">Device</label>
                        <select name="device" id="device" class="p-2 rounded bg-slate-900 border border-slate-700 mb-20">

                            <option value="pc">PC</option>

                            <option value="mobile">Mobile</option>

                        </select>

                        <input type="button" value="Log In" id="loginBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer duration-150 mb-4">

                        <input type="button" value="Continue as Guest" id="guestBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer duration-150 mb-2">

                    </form>

                    <div class="border-t-2 border-slate-700 mt-8 flex justify-center">

                        <p class="text-xl mt-4">Don't have an account?</p>

                        <a href="{{ route('register') }}" class="text-xl mt-4 ml-2 text-blue-500 hover:text-yellow-500 underline underline-offset-1">Register</a>

                    </div>

                </div>

            </div>

            <div class="w-full">
                {{-- Espacio vacio a la derecha --}}
            </div>

        </div>

        {{-- En estas seccion crearemos la solicitud que se envia a la API --}}
        <script>

            document.getElementById('loginBtn').addEventListener('click', function(){

                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var device = document.getElementById('device').value;

                // Validamos los campos
                if (!email || !password || !device)
                {
                    alert('All fields are required');
                    return;
                }

                // Datos a enviar en la peticion
                var loginData = {

                    email: email,
                    password: password,
                    name: device

                }

                // Headers de la solicitud
                var requestOptions = {
    
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify(loginData)

                };

                // Solicitud AJAX a la API
                fetch('http://127.0.0.1:8000/api/login', requestOptions)
                    .then(response => {

                        if(!response.ok)
                        {
                            return response.json().then(errorData => {throw new Error(errorData.message)});
                        }

                        return response.json();
                    })
                    .then(data => {

                        if(data.token)
                        {
                            alert('Login successful');

                            // Guardamos el token en el navegador
                            sessionStorage.setItem('token', data.token);

                            // Guardamos el ID de usuario en el navegador
                            sessionStorage.setItem('user_id', data.user_id);

                            // Obtenemos el token de sesion y el ID de usuario para enviarlo al BACKEND del Cliente WEB en una peticion AJAX:
                            var token = sessionStorage.getItem('token');
                            var user_id = sessionStorage.getItem('user_id');
                            const token_request_Options = {

                                method: 'POST',
                                headers: {

                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                                },

                                body: JSON.stringify({ token: token, user_id: user_id })
                            };

                            if(token)
                            {
                                fetch('/store-token', token_request_Options)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('Token and User ID stored in session: ', data);
                                    })
                                    .catch(error => console.error('Error: ', error));
                            }

                            // Redireccionamos a la pagina principal
                            window.location.href = '{{ route('index') }}';
                        }
                        else
                        {
                            alert('Login failed ' + data.message);
                        }

                    })
                    .catch(error => {

                        console.log('error', error);
                        alert('An error occurred');

                    });
            })

            document.getElementById('guestBtn').addEventListener('click', function(){

                window.location.href = '{{ route('guestIndex') }}';
            })

        </script>
        
    </body>
</html>