<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Estilos personalizados de la vista --}}
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tutorial</title>

</head>

<body class="bg-neutral-900 text-white">

    <nav class="bg-slate-800 p-1 items-center border border-slate-700 rounded">

        <div class="mx-auto px-4">

            <div class="flex justify-between">

                <div class="flex space-x-7 items-center justify-start py-2">

                    <h1 class="text-2xl font-bold text-yellow-500">DWD Tutorial</h1>

                    <a href="{{ route('index') }}" class="font-bold text-2xl text-slate-300 hover:text-green-500 duration-300">Home</a>

                </div>

                {{-- <div class="flex items-center">

                    <button name="logoutBtn" id="logoutBtn" class="text-red-900 font-bold text-2xl hover:text-red-500 duration-300">Log out</button>

                </div> --}}

            </div>

        </div>

    </nav>

    <div class="flex flex-col-3 items-center justify-center">

        <div class="w-1/3">
            
            {{-- Espacio Vacio 1 --}}

        </div>

        <div class="flex justify-center w-1/3">
            
            <div class="bg-slate-800 p-6 rounded break-words max-w-full border border-slate-700 mt-10">

                <div class="font-semibold">

                    The User can only interact with their own Appointments, any other Appointment not created by the user will not be visible or will
                    have its buttons greyed out like in the Guest Session.

                </div>

                <br>

                {{-- Como hacer una cita (Appointment) --}}
                <div>

                    <h1 class="text-2xl font-bold">How To Make an Appointment?</h1>

                    <br>

                    In order to make an appointment the user must be authenticated first, then follow the next steps:
                    
                    <br>
                    <br>

                    <img class="w-full border border-slate-700" src="{{asset('build/assets/images/tutorial1.png')}}" alt="">

                    <br>

                    1. Select the Time for the appointment.

                    <br>

                    2. Type a Title for the appointment.

                    <br>

                    3. Click on the calendar selecting the date for the appointment.

                    <br>

                    4. Finally save the appointment by clicking on the <span class="text-center bg-green-600 rounded border border-green-600 font-semibold text-lg p-1 mx-1">Send</span> button.

                </div>

                <br>

                {{-- Como editar una cita (Appointment) --}}
                <div>

                    <h1 class="text-2xl font-bold">How To Edit an Appointment?</h1> 

                    <br>

                    To modify the selected Time, Title or Date of the appointment simply
                    click on the <span class="text-center bg-blue-500 rounded border border-blue-500 font-semibold text-lg p-1 mx-1">Edit</span> button of one of your appointments.

                    <br>
                    <br>

                    <img class="w-full border border-slate-700" src="{{asset('build/assets/images/tutorial2.png')}}" alt="">

                    <br>

                    In the modal screen that appears afterwards you can change the Title, Time and / or Date of the appointmnent.
                    Contrary to the previous segment, this doesn't have to be done in a specific order, after all the changes have
                    been made simply click on the <span class="text-center bg-blue-500 rounded border border-blue-500 font-semibold text-lg p-1 mx-1">Save changes</span> button.
                </div>

                <br>

                {{-- Como eliminar una cita --}}
                <div>

                    <h1 class="text-2xl font-bold">How To Delete an Appointment?</h1>

                    <br>

                    To delete an existing Appointment simply click on the <span class="text-center bg-red-500 rounded border border-red-500 font-semibold text-lg p-1 mx-1">Delete</span> button that appears next to the details of said Appointment.

                </div>

                <br>

                {{-- Como saber que fue efectuada la interaccion --}}
                <div>

                    <h1 class="text-2xl font-bold">How Do I know if the Interaction Was Successful?</h1>

                    <br>

                    After every succesfull interaction the system will show a confirmation dialog in a pop-up window.

                    <br>
                    
                    In case of unexpected errors the system will show the error in the same way.

                </div>

            </div>
            
        </div>

        <div class="w-1/3">

            {{-- Espacio Vacio 2 --}}
            
        </div>
        
    </div>
    
</body>
</html>
