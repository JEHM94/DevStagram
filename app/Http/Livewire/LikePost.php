<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    // La función mount se ejecuta automáticamente cuando es instanciado LikePost
    public function mount($post)
    {
        // Verifica si el Usuario que está autenticado le dio Like al Post
        auth()->user() ? $this->isLiked = $post->checkLike(auth()->user()) : false;
        // Asigna la cantidad de likes a la instancia del objeto
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        // Protege la función de dar like de los usuarios no autenticados
        if (!auth()->user()) return;

        // Verifica si el usuario ya dió like al post
        if ($this->post->checkLike(auth()->user())) {
            // Elimina el like del Post
            $this->post->likes()->where('post_id', $this->post->id)->delete();

            // Con esta línea livewier interpreta el cambio y actualiza el DOM haciendo el rerender automáticamente
            $this->isLiked = false;
            $this->likes--;
            
            return;
        }

        // Guarda el Like del Post
        $this->post->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        // Con esta línea livewier interpreta el cambio y actualiza el DOM
        $this->isLiked = true;
        $this->likes++;
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
