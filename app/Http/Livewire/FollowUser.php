<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FollowUser extends Component
{
    public $user;
    public $followers;
    public $followings;
    public $totalFollowers;
    public $totalFollowings;
    public $isFollower;

    public function mount()
    {
        $this->followers = $this->user->followers;
        $this->followings = $this->user->followings;

        $this->totalFollowers = $this->followers->count();
        $this->totalFollowings = $this->followings->count();

        auth()->user() ? $this->isFollower = $this->user->isFollower(auth()->user()) : null;
    }

    public function follow()
    {
        // Verifica si el usuario autenticado aún no sigue al usuario del perfil
        if (!$this->isFollower) {
            // Guarda el nuevo seguidor
            $this->user->followers()->attach(auth()->user()->id);

            // Actualiza el DOM
            $this->totalFollowers++;
            $this->isFollower = true;
        }
    }

    public function unfollow()
    {
        if ($this->isFollower) {
            // Elimina el follow
            $this->user->followers()->detach(auth()->user()->id);

            // Actualiza el DOM
            $this->totalFollowers--;
            $this->isFollower = false;
        }
    }



    public function render()
    {
        return view('livewire.follow-user');
    }
}
