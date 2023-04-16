<div>
    <div class="text-gray-800 text-sm mb-3 font-bold mt-5">
        <!-- Modal toggle -->
        <button data-modal-target="followers" data-modal-toggle="followers" type="button">
            {{ $totalFollowers }}
            <span class="font-normal">@choice('Seguidor|Seguidores', $totalFollowers)</span>
        </button>
    </div>

    <div class="text-gray-800 text-sm mb-3 font-bold">
        <!-- Modal toggle -->
        <button data-modal-target="followings" data-modal-toggle="followings" type="button">
            {{ $totalFollowings }}
            <span class="font-normal">Siguiendo</span>
        </button>
    </div>

    <p class="text-gray-800 text-sm mb-3 font-bold">
        {{ $user->posts->count() }}
        <span class="font-normal">@choice('Publicación|Publicaciones', $user->posts->count())</span>
    </p>

    @auth()
        @if ($user->id !== auth()->user()->id)
            @if (!$isFollower)
                <button wire:click="follow"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer  font-bold px-3 py-1 text-white rounded-lg text-sm">
                    Seguir
                </button>
            @else
                <button wire:click="unfollow"
                    class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer  font-bold px-3 py-1 text-white rounded-lg text-sm">
                    Dejar de Seguir
                </button>
            @endif
        @endif
    @endauth

    @livewire('show-followers', ['users' => $followers, 'idModal' => 'followers', 'profile' => $user])
    @livewire('show-followers', ['users' => $followings, 'idModal' => 'followings', 'profile' => $user])
</div>
