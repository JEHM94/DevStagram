<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowFollowers extends Component
{
    public $idModal;
    public $users;
    public $profile;
    public $isFollowing = [];

    public function render()
    {
        return view('livewire.show-followers');
    }

    public function follow(User $user)
    {
        // Verifica si el usuario autenticado aún no sigue al usuario del perfil
        if (!$user->isFollower(auth()->user())) {
            // Guarda el nuevo seguidor
            $user->followers()->attach(auth()->user()->id);

            $this->isFollowing[$user->username] = !$this->isFollowing[$user->username];
        }
    }

    public function unfollow(User $user)
    {
        if ($user->isFollower(auth()->user())) {
            // Elimina el follow
            $user->followers()->detach(auth()->user()->id);

            $this->isFollowing[$user->username] = !$this->isFollowing[$user->username];
        }
    }

    public function updateModal()
    {
        // Actualiza el DOM
        if ($this->idModal === 'followers')
            $this->users = $this->profile->followers;
        else
            $this->users = $this->profile->followings;

        $this->render();
    }
}
