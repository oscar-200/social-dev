@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 shadow p-6">
            <form class="mt-10 md:mt-0" action="{{route('perfil.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 m-1 text-center">{{ session('mensaje') }}</p>  
                @endif
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500
                        @enderror"
                        value= "{{ auth()->user()->username }}"

                    />
                    @error('username')
                        <p class="bg-red-500 text-white rounded-lg text-sm p-2 m-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo
                    </label>
                    <input 
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Tu correo"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500
                        @enderror"
                        value= "{{ auth()->user()->email }}"

                    />
                    @error('email')
                        <p class="bg-red-500 text-white rounded-lg text-sm p-2 m-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña de verificacion
                    </label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500
                        @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white rounded-lg text-sm p-2 m-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil
                    </label>
                    <input 
                        type="file"
                        id="imagen"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection