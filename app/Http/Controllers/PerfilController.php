<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug( $request->username )]);

        $userId = auth()->user()->id;

        $this->validate($request, [
            'username' => [
                'required',
                'unique:users,username,' . $userId,
                'min:3',
                'max:20',
                'not_in:editar-perfil,socialdev,social-dev'
            ],
            'email' => [
                'required',
                'unique:users,email,' . $userId,
                'email',
                'max:60'
            ],
            'password' => ['required']
        ]);


        $validate = auth()->attempt([
            'email' => auth()->user()->email,
            'password' => $request->password
        ]);

        if( !$validate )
        {
            return back()->with('mensaje', 'Contraseña incorrecta');
        }

        if($request->imagen)
        {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000 ,1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
