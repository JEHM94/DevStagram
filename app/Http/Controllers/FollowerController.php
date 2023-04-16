<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // ********** NOT IN USE, DELETE ***********//
    // Moved to FollowUser
    /* public function store(User $user)
    {
        // Verifica si el usuario autenticado aún no sigue al usuario del perfil
        if (!$user->isFollower(auth()->user()))
            // Guarda el nuevo seguidor
            $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    } */
}
