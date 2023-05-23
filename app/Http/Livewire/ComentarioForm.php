<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class ComentarioForm extends Component
{
    public $post;

    public $comentario;
    public $comentarios;

    public function mount()
    {
        $this->comentarios = $this->post->comentarios;
    }

    protected $rules = [
        'comentario' => 'required|max:255'
    ];

    public function submitForm()
    {

        $this->validate();

        $comentarioNuevo = Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario
        ]);
        $this->comentarios->prepend($comentarioNuevo);
        $this->comentario = '';
    }


    public function render()
    {
        return view('livewire.comentario-form');
    }
}
