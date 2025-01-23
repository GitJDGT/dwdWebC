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

        <title>Guest Index DWD</title>

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
        <nav class="bg-blue-800 p-1 items-center border border-slate-700 rounded">

            <div class="mx-auto px-4">

                <div class="flex justify-between">

                    <div class="flex space-x-7 items-center justify-start py-2">

                        <h1 class="text-2xl font-bold">DWD Guest</h1>
    
                        <a href="{{ route('index') }}" class="font-bold text-2xl hover:text-yellow-500 duration-300">Home</a>

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

                <div class="flex items-center bg-slate-800 border border-slate-700 rounded p-2">

                    <div class="flex flex-col">

                        <label for="TimePicker" class="text-white text-center">Select the time:</label>
    
                        <input type="time" name="TimePicker" id="TimePicker" class="text-white text-center bg-slate-900 border border-slate-700 hover:bg-slate-800 hover:border-white rounded p-1 mx-1 items-center justify-center">

                    </div>

                    <div class="flex flex-col">

                        <label for="registerTitle" class="text-white text-center">Type a title:</label>

                        <input type="text" name="registerTitle" id="registerTitle" maxlength="20" class="text-white text-left bg-slate-900 border border-slate-700 hover:bg-slate-800 hover:border-white rounded p-1 mx-1 items-center justify-center">

                    </div>
                    
                    <div class="mt-6 items-center justify-center">
    
                        <input type="button" class="bg-green-600 rounded border border-green-600 font-semibold hover:cursor-pointer hover:bg-green-700 hover:border-green-700 duration-300 text-lg p-1 mx-1" id="sendBtn" value="Send">

                    </div>
                    
                </div>
                
            </div>

            <div class="w-full">

                <div class="container mx-auto p-4">

                    <div class="grid grid-cols-3 gap-3 mt-1 mb-4">
        
                        @foreach ($guestAppointments as $guestAppointment)
        
                            <?php $userID = 0; ?>
                
                            
                                <div class="flex bg-slate-800 border rounded border-slate-700 hover:border-yellow-500 duration-300 p-2 xl:space-x-10">
                    
                                    <div class="bg-gray-700 rounded text-sm text-wrap w-2/3 pt-1 text-center">

                                        <h2 class="text-md xl:text-lg font-semibold">{{ $guestAppointment['title'] }}</h2>
                                        
                                        <p class="text-md">Created at: {{ $guestAppointment['published_at'] }}</p>
                
                                        <p class="text-md">Scheduled for: {{ $guestAppointment['scheduled_for'] }}</p>

                                    </div>

                                    <div class="flex flex-col xl:flex-row w-1/3 items-center justify-center xl:justify-normal space-y-2 xl:space-y-0 xl:space-x-5">

                                        <?php if($guestAppointment['author']['user_id'] == $userID) {?>

                                            <input type="button" class="bg-blue-500 border border-blue-500 rounded hover:cursor-pointer hover:bg-blue-700 hover:border-blue-700 duration-300 text-lg font-semibold p-1 editBtn" data-id="{{ $appointment['id'] }}" value="Edit">
                                            <input type="button" class="bg-red-500 border border-red-500 rounded hover:cursor-pointer hover:bg-red-700 hover:border-red-700 duration-300 text-lg font-semibold p-1 deleteBtn" data-id="{{ $appointment['id'] }}" value="Delete">

                                        <?php } else { ?>

                                            <input type="button" class="bg-gray-500 border border-gray-500 rounded hover:cursor-not-allowed hover:bg-gray-700 hover:border-gray-700 duration-300 text-lg font-semibold p-1 LockedEditBtn" value="Edit">
                                            <input type="button" class="bg-gray-500 border border-gray-500 rounded hover:cursor-not-allowed hover:bg-gray-700 hover:border-gray-700 duration-300 text-lg font-semibold p-1 LockedDeleteBtn" value="Delete">

                                        <?php }?>

                                        
                                    </div>
                    
                                </div>
                            
                            
                        @endforeach
        
                    </div>
        
                    {{ $guestAppointments -> withPath('/guest') -> links() }}
        
                </div>

            </div>

        </div>
        {{-- Contenido principal de la vista: FINAL --}}



        {{-- Ventana de Dialogo: INICIO --}}
        <div id="dialog" class="dialog hidden fixed inset-0 items-center z-50">

            <div class="dialog-content bg-slate-800 p-6 rounded max-w-md mx-auto mt-20 border border-slate-700 flex flex-col items-center">

                <h2 class="message mb-4"></h2>

                <button class="closeDialog bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded duration-300">Close</button>

            </div>

        </div>
        {{-- Ventana de Dialogo: FINAL --}}



        {{-- Scripts de JavaScript para interacciones: INICIO --}}
        <script>

            // Obtenemos nuestra ventana de dialogo para mostrar mensajes:
            const dialog = document.getElementById('dialog');
            const messageElement = document.querySelector('.message');

            
            // Esta funcion ejecutara cuando cargue la pagina y contiene todas las demas funciones que requerimos para la interfaz:  
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

                    events: [],

                    selectable: true,
                    select: function(dateInfo) 
                    {
                        var selected_Time = document.getElementById('TimePicker').value;
                        var selected_Date = dateInfo.startStr;
                        var selected_DateTime = selected_Date + ' ' + selected_Time;
                    },

                });



                // Renderizar el CALENDARIO:

                calendar.render();



                // Obtenemos el cuadro de dialogo y realizamos las funciones que lo muestran y cierran:

                var dialog = document.getElementById('dialog');
                var closeDialogBtn = document.querySelector('.closeDialog');

                function showDialog()
                {
                    dialog.classList.remove('hidden');
                }

                function closeDialog()
                {
                    dialog.classList.add('hidden');
                    window.location.reload();
                }

                closeDialogBtn.addEventListener('click', function(){

                    closeDialog();

                });

                window.addEventListener('click', function(event){

                    if(event.target === dialog)
                    {
                        closeDialog();
                    }
                });

                document.getElementById('sendBtn').addEventListener('click', function() {

                    messageElement.textContent = "Please click 'Home' and Log in. You must be logged in to make an appointment.";
                    console.log("Please Log in");

                    showDialog();

                })
                
            });
            
        </script>
        {{-- Scripts de JavaScript para interacciones: FINAL --}}

    </body>
</html>
