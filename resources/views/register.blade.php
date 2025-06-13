<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite('resources/css/app.css')

        <title>Register</title>
    </head>

    <body class="bg-neutral-900 text-white">

        <div class="grid grid-cols-3 items-center">

            <div class="w-full">
                {{-- Espacio vacio a la izquierda --}}
            </div>

            {{-- Nuestro componente de Registro, contiene todos los campos del formulario y botones interactivos --}}
            <div class="max-w-8xl w-full mx-auto items-center flex justify-center h-screen">
                
                <div class="bg-slate-800 rounded-lg p-6 space-y-5 w-3/4">

                    <div class="border-b-2 border-slate-700 mb-8">

                        <h1 class="text-2xl font-bold mb-4 text-center">Create your account</h1>

                    </div>

                    <form action="" method="post" class="flex flex-col">

                        <label for="email" class="text-lg text-white mb-1 font-semibold">Email</label>
                        <input type="text" name="email" id="email" class="p-2 rounded bg-slate-900 border border-slate-700 mb-4">

                        <label for="password" class="text-lg text-white mb-1 font-semibold">Password</label>
                        <input type="password" name="password" id="password" class="p-2 rounded bg-slate-900 border border-slate-700 mb-4">

                        <label for="username" class="text-lg text-white mb-1 font-semibold">Name</label>
                        <input type="text" name="username" id="username" class="p-2 rounded bg-slate-900 border border-slate-700 mb-4">
                        
                        <br>

                        <input type="button" value="Register" id="registerBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer duration-150 mb-4">

                        

                    </form>

                    <div class="border-t-2 border-slate-700 mt-8 flex justify-center">

                        <p class="text-xl mt-4">Already have an account?</p>

                        <a href="{{ route('login') }}" class="text-xl mt-4 ml-2 text-blue-500 hover:text-yellow-500 underline underline-offset-1">Log In</a>

                    </div>

                </div>

            </div>

            <div class="w-full">
                {{-- Espacio vacio a la derecha --}}
            </div>

        </div>

        {{-- En estas seccion crearemos la solicitud que se envia a la API --}}
        <script>

            document.getElementById('registerBtn').addEventListener('click', function(){

                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var username = document.getElementById('username').value;

                // Validamos los campos
                if (!email || !password || !username)
                {
                    alert('All fields are required');
                    return;
                }

                // Datos a enviar en la peticion
                var registerData = {

                    name: username,
                    email: email,
                    password: password

                }

                // Headers de la solicitud
                var requestOptions = {
    
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify(registerData)

                };

                // Solicitud AJAX a la API
                fetch('http://127.0.0.1:8000/api/register', requestOptions)
                    .then(response => {

                        if(!response.ok)
                        {
                            return response.json().then(errorData => {throw new Error(errorData.message)});
                        }

                        return response.json();
                    })
                    .then(data => {

                        if(data)
                        {
                            alert('Register successful');

                            // Redireccionamos a la pagina principal
                            window.location.href = '{{ route('login') }}';
                        }
                        else
                        {
                            alert('Register failed ' + data.message);
                        }

                    })
                    .catch(error => {

                        console.log('error', error);
                        alert('An error occurred');

                    });
            })

        </script>
        
    </body>
</html>