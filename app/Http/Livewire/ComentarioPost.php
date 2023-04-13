<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Post;
use Livewire\Component;

class ComentarioPost extends Component
{
    public $post;
    public $nuevoComentario = '';
    public $totalComentarios;
    public $mensaje;

    // Esta función se ejecuta sola cuando se actualiza el objeto de nuevoComentario
    public function updatedNuevoComentario()
    {
        // Desaparece el mensaje previo
        $this->mensaje = '';
        // Valida el textarea
        $this->validate([
            'nuevoComentario' => 'required|max:255'
        ]);
    }

    public function comentar()
    {
        // Valida nuevamente al presionar el botón de comentar
        $this->updatedNuevoComentario();

        if (!empty($this->nuevoComentario)) {
            // Guarda el nuevo comentario
            Comentario::create([
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id,
                'comentario' => $this->nuevoComentario
            ]);

            // Actualiza el DOM
            $this->post = Post::find($this->post->id);
            // Limpia el textarea
            $this->nuevoComentario = '';
            // Mensaje
            $this->mensaje = 'Comentario Enviado';
            // Actualiza la cantidad de comentarios
            $this->emit('actualizarComentarios');
        }
    }

    public function render()
    {
        return view('livewire.comentario-post');
    }
}
