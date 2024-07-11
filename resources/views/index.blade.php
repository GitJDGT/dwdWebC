<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- 
            Al utilizar el CDN para aplicar los estilos las flechas de paginacion se corrigen, pero con la instalacion no sucede igual de facil 
            para corregir el error de las flechas de paginacion con Tailwind instalado hay que decirle que lea todos los archivos de blade.php
            para que modifique los estilos necesarios en las vistas autogeneradas de Laravel blade "**/**/**/*.blade.php" en el archivo tailwind.config
        --}}

        {{-- Estilos personalizados de la vista --}}
        @vite('resources/css/app.css')
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

        {{-- Fullcalendar --}}
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

        {{-- Flatpickr --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <title>Index DWD</title>

    </head>

    <body class="bg-neutral-900 text-white">

        {{-- SOBRE LA INFORMACION:

            Cada atributo que llamamos aqui en el FOREACH es un atributo intrinseco (Es un campo de la Base de Datos) o un atributo del modelo
            , el modelo basicamente es un aquetipo que utilizamos para crear cada una de las instancias de nuestro objeto, entonces las factorys
            utilizan la migracion y el modelo para crear los datos de prueba.

            En laravel hay Mutators y Accessors, los Mutators cambian el valor antes de que sea almacenado en base de datos, con los Accessor te puedes hacer "campos virtuales" que 
            como tal no estan almacenados en base de datos, pero que son accesibles como si lo estuvieran, este que usas es un Accessor (published_at y scheduled) y 
            por eso puedes acceder a esos campos que no está definidos en la migracion.
            
        --}}

        {{-- SOBRE LA VISTA Y ESTILOS:

            Creamos un grupo de DIVs con un contenedor y una grilla dentro del contenedor, la grilla contiene dentro unas filas (2) y estas se dividen entre el calendario y un 
            FOREACH que sera lo que traiga nuestros objetos para su visualizacion.

            Tambien se implemeto una ventana modal para la modificacion de la informacion de las citas la cual esta conformada por un div que funciona como contenedor externo
            y otro que funciona como contenedor interno que presenta un formulario para la captacion de datos.

        --}}

        {{-- Barra de Navegacion: INICIO --}}
        <nav class="bg-slate-600">

            <div class="mx-auto px-4">

                <div class="flex justify-between">

                    <div class="flex space-x-7 items-center justify-start py-2">

                        <h1 class="text-2xl font-bold">DWD</h1>
    
                        <a href="{{ route('index') }}" class="text-white mx-2">Home</a>

                    </div>

                    <div class="flex items-center ">
                        
                        <button name="logoutBtn" id="logoutBtn" class="bg-red-500 hover:bg-red-900 border border-red-400 rounded p-1">Logout</button>
                        
                    </div>


                </div>

            </div>

        </nav>
        {{-- Barra de Navegacion: FINAL --}}

        {{-- Contenido principal de la vista: INICIO --}}
        <div class="grid grid-rows-2 w-auto">

            <div class="flex w-full items-center justify-center">

                <div id="calendar" class="w-2/4 mx-2 p-2 xl:w-1/4">

                    {{-- Aqui va el Calendario --}}

                </div>

                <div class="flex items-center">

                    <div class="flex flex-col">

                        <label for="TimePicker" class="text-white text-center">Select the time:</label>
    
                        <input type="time" name="TimePicker" id="TimePicker" class="text-white text-center bg-slate-700 border border-slate-500 hover:bg-slate-800 hover:border-white rounded p-1 mx-1 items-center justify-center">

                    </div>

                    <div class="flex flex-col">

                        <label for="registerTitle" class="text-white text-center">Type a title:</label>

                        <input type="text" name="registerTitle" id="registerTitle" class="text-white text-left bg-slate-700 border border-slate-500 hover:bg-slate-800 hover:border-white rounded p-1 mx-1 items-center justify-center">

                    </div>
                    
                    <div class="mt-6 items-center justify-center">
    
                        <input type="button" class="bg-gray-400 rounded border border-gray-400 text-white font-semibold hover:cursor-pointer hover:bg-gray-500 hover:border-white duration-150 text-lg p-1 mx-1" id="sendBtn" value="Send">

                    </div>
                    
                </div>
                
            </div>

            <div class="w-full">

                <div class="container mx-auto p-4">

                    <div class="grid grid-cols-3 gap-3 mt-1 mb-4">
        
                        @foreach ($appointments as $appointment)
        
                            <?php //dd($appointments);?>
                
                            <div class="flex bg-slate-700 border rounded border-slate-700 hover:bg-slate-800 hover:border-yellow-200 duration-150 p-2 xl:space-x-10">
                
                                <div class="bg-gray-600 rounded text-sm text-wrap w-2/3 pt-1 text-center">

                                    <h2 class="text-md xl:text-lg font-semibold">{{ $appointment['title'] }}</h2>
                                    
                                    <p class="text-md">Created at: {{ $appointment['published_at'] }}</p>
            
                                    <p class="text-md">Scheduled for: {{ $appointment['scheduled_for'] }}</p>

                                </div>

                                <div class="flex flex-col xl:flex-row w-1/3 items-center justify-center xl:justify-normal space-y-2 xl:space-y-0 xl:space-x-5">

                                    <input type="button" class="bg-blue-600 rounded border border-blue-600 hover:cursor-pointer hover:bg-blue-700 hover:border-white duration-150 text-lg font-semibold p-1 editBtn" data-id="{{ $appointment['id'] }}" value="Edit">
                                    <input type="button" class="bg-red-600 rounded border border-red-600 hover:cursor-pointer hover:bg-red-700 hover:border-white duration-150 text-lg font-semibold p-1 deleteBtn" data-id="{{ $appointment['id'] }}" value="Delete">
                                    
                                </div>
                
                            </div>
                            
                        @endforeach
        
                    </div>
        
                    {{ $appointments -> links() }}
        
                </div>

            </div>

        </div>
        {{-- Contenido principal de la vista: FINAL --}}



        {{-- Ventana modal: INICIO --}}
        <div id="modal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">

            <div class="modal-content bg-slate-700 p-6 rounded-lg max-w-md">

                <span class="close absolute top-0 right-0 px-3 py-2 cursor-pointer font-bold text-white bg-red-400 rounded-xl">X</span>

                <h2 class="text-lg font-bold mb-4">Editar Cita</h2>

                <form id="editForm">

                    <label for="modal-title" class="block mb-2">Title:</label>
                    <input type="text" id="modal-title" name="modal-title" required class="w-full bg-slate-800 border border-slate-900 rounded px-3 py-2 mb-4">

                    <label for="modal-timePicker" class="block mb-2">Scheduled for:</label>
                    <input type="datetime-local" id="modal-timePicker" name="modal-timePicker" required class="w-full bg-slate-800 border border-slate-900 rounded px-3 py-2 mb-4">

                    <input type="button" id="saveBtn" name="saveBtn" value="Save changes" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer duration-150">

                </form>

            </div>

        </div>
        {{-- Ventana modal: FINAL --}}



        {{-- Scripts de JavaScript para interacciones: INICIO --}}
        <script>

            document.addEventListener('DOMContentLoaded', function() {

                /*  SOBRE EL FLATPICKR

                    Aqui colocamos nuestro selector de hora y le especificamos el formato de 24 horas.
                    para mas informacion: https://flatpickr.js.org/examples/
                */
                
                flatpickr('#TimePicker', {

                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true

                });


                /*  SOBRE EL CALENDARIO

                    Aqui configuramos las interacciones del calendario, colocando que sea seleccionable cada casilla y que
                    hacer en caso de que una casilla sea seleccionada, asi como su interaccion a la hora de presionar el boton
                    SEND.
                */

                const calendarEl = document.getElementById('calendar');

                const calendar = new FullCalendar.Calendar(calendarEl, {

                    initialView: 'dayGridMonth',

                    eventColor: 'green',

                    events: [

                        // {
                        //     title: 'All Day Event',
                        //     start: '2024-06-01'
                        // }

                    ],

                    selectable: true,
                    select: function(dateInfo) 
                    {
                        var selected_Time = document.getElementById('TimePicker').value;
                        var selected_Date = dateInfo.startStr;
                        var selected_DateTime = selected_Date + ' ' + selected_Time;

                        console.log('Fecha y hora seleccionadas:', selected_DateTime);


                        // Colocamos un evento para que el boton sea quien nos envie la informacion que pasara al servidor

                        document.getElementById('sendBtn').addEventListener('click', function() {

                            console.log('Fecha y hora enviadas: ', selected_DateTime);
                            
                            registrarCita(selected_DateTime);

                        })
                    },

                });



                // Renderizar el CALENDARIO:

                calendar.render();



                // Funcion de REGISTRO de citas:
                function registrarCita(infoCita)
                {
                    var user_id = sessionStorage.getItem('user_id');

                    // Datos de la cita a enviar al servidor:

                    var registerTitle = document.getElementById('registerTitle').value;
    
                    var citaData = {
    
                        "user_id": user_id,
                        "title": registerTitle,
                        "scheduled_for": infoCita
    
                    };
    
    
                    // Token de sesion:
    
                    var token = sessionStorage.getItem('token');
    
    
                    // Configuracion de la peticion:
    
                    var requestOptions = {
    
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        },
    
                        body: JSON.stringify(citaData)
    
                    };
    
                    
                    // Enviar la solicitud POST al servidor para registar la cita:

                    fetch('http://127.0.0.1:8000/api/v1/appointments', requestOptions)
                        .then(response => response.json())
                        .then(result => console.log(result))
                        .catch(error => {
    
                            console.error('Error al enviar la solicitud: ', error);
    
                        })

                    window.location.reload();

                }



                // Funcion de ELIMINACION de citas:
                function eliminarCita(id) 
                {
                    // Token de sesion:
    
                    var token = sessionStorage.getItem('token');
    
    
                    // Configuracion de la peticion:
    
                    var requestOptions = {
    
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
    
                    };


                    // Enviar la solicitud DELETE al servidor para registar la cita:

                    fetch('http://127.0.0.1:8000/api/v1/appointments/' + id, requestOptions)
                        .then(response => {

                            if(response.ok) 
                            {

                                location.reload();

                                console.log('Cita Eliminada');

                            } 
                            else 
                            {
                                console.log('Error al eliminar la cita: ', response.status)
                            }

                        })
                        .catch(error => {

                            console.error('Error al enviar la solicitud: ', error)

                        })
                }



                // Funcion de EDICION de citas:
                function editarCita(id, title, dateTime)
                {

                    var user_id = sessionStorage.getItem('user_id');

                    // Nuevos datos de la cita a enviar al servidor:
                    
                    var editCitaData = {

                        "user_id": user_id,
                        "title": title,
                        "scheduled_for": dateTime

                    };

                    // Token de sesion:

                    var token = sessionStorage.getItem('token');


                    // Configuracion de la peticion:

                    var requestOptions = {

                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        },

                        body: JSON.stringify(editCitaData)

                    };

                    // Enviar la solicitud PUT al servidor para editar la cita:

                    fetch('http://127.0.0.1:8000/api/v1/appointments/' + id, requestOptions)
                        .then(response => response.json())
                        .then(result => console.log(result))
                        .catch(error => {

                            console.error('Error al enviar la solicitud: ', error);
                        })
                }



                // Funciones complementarias de EDICION de citas:
                async function buscarCita(id)
                {
                    // Esta funcion debe obtener un ID como parametro para buscar la cita entre las que hayamos registrado.

                    try {

                        var token = sessionStorage.getItem('token');

                        var response = await fetch('http://127.0.0.1:8000/api/v1/appointments/' + id, {

                            method: 'GET',
                            headers: {

                                'Content-Type': 'application/json',
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json'
                            }
                        });

                        if(!response.ok)
                        {
                            throw new Error('Error al obtener la cita: ${response.status}');
                        }

                        var citaEncontrada = await response.json();
                        return citaEncontrada;

                    }
                    catch (error) {

                        console.error('Error en la llamada AJAX: ', error);
                        throw error;

                    }

                }

                function rellenarCamposModales(appointment)
                {
                    // Esta funcion recibe por parametro una cita y saca sus datos para rellenar campos de la ventana modal

                    document.getElementById('modal-title').value = appointment.data.title;
                    document.getElementById('modal-timePicker').value = appointment.data.scheduled_for;
                }



                // Obtenemos la ventana modal y realizamos las funciones que la muestran y cierran:
                var modal = document.getElementById('modal');
                var closeBtn = document.querySelector('.close');

                function showModal(id)
                {
                    // Obtenemos el ID de la cita que se pretende editar para enviarlo mas facilmente a la funcion de EDITAR CITA
                    
                    var idSelecto = id;

                    modal.classList.remove('hidden');

                    flatpickr('#modal-timePicker', {

                        enableTime: true,
                        noCalendar: false,
                        dateFormat: "Y/m/d H:i",
                        time_24hr: true

                    });

                    saveBtn.addEventListener('click', function(){

                        var newTitle = document.getElementById('modal-title').value;
                        var newDateTime = document.getElementById('modal-timePicker').value.replaceAll('/', '-');

                        editarCita(idSelecto, newTitle, newDateTime);

                    });

                }

                function closeModal()
                {
                    modal.classList.add('hidden');
                }

                closeBtn.addEventListener('click', function(){

                    closeModal();

                });

                window.addEventListener('click', function(event){

                    if(event.target === modal)
                    {
                        closeModal();
                    }

                });



                // Evento de Click para los botones de ELIMINAR cita:
                document.querySelectorAll('.deleteBtn').forEach(item => {

                    item.addEventListener('click', event => {

                        var id = item.getAttribute('data-id');

                        //console.log('Eliminar cita con ID: ',id);

                        eliminarCita(id);

                    })

                })

                // Evento CLICK para los botones de EDITAR cita:
                document.querySelectorAll('.editBtn').forEach(item => {

                    item.addEventListener('click', async event => {

                        var id = item.getAttribute('data-id');

                        var citaBuscada = await buscarCita(id);  

                        rellenarCamposModales(citaBuscada);

                        showModal(id);

                    })

                })

                // Evento CLICK en boton de LOGOUT:
                document.getElementById('logoutBtn').addEventListener('click', event => {

                    var token = sessionStorage.getItem('token');

                    var requestOptions = {

                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }

                    };

                    fetch('http://127.0.0.1:8000/api/logout', requestOptions)
                        .then(response => {

                            if(response.ok)
                            {

                                sessionStorage.removeItem('token');
                                window.location.href = '{{ route('login') }}';
                            }
                            else
                            {
                                console.log('Something went wrong loging out: ', response.status);
                            }

                        })
                        .catch(error => {

                            console.error('Error in the AJAX request: ', error);

                        });
                    
                });

            });
            

        </script>
        {{-- Scripts de JavaScript para interacciones: FINAL --}}

    </body>
</html>
