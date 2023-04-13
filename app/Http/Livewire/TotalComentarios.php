<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TotalComentarios extends Component
{
    public $post;
    public $totalComentarios;

    protected $listeners = ['actualizarComentarios'];

    // La función mount se ejecuta automáticamente cuando es instanciado LikePost
    public function mount($post)
    {
        // Asigna la cantidad de comentarios a la instancia del objeto
        $this->totalComentarios = $post->comentarios->count();
    }

    public function actualizarComentarios()
    {
        $this->totalComentarios++;
    }

    public function render()
    {
        return view('livewire.total-comentarios');
    }
}
