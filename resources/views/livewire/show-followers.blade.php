<div>
    <!-- Small Modal -->
    <div id="{{ $idModal }}" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-gray-100 rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-300">
                    <h3 class="text-xl font-bold text-gray-600 ">
                        {{ $idModal === 'followers' ? 'Seguidores' : 'Siguiendo' }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="{{ $idModal }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 ">
                    @forelse ($users as $user)
                        <div class="flex items-center gap-3">
                            <a href="{{ route('posts.index', ['user' => $user]) }}">
                                <img src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}"
                                    class="h-12 rounded-full" alt="Imagen del usuario {{ $user->username }}">
                            </a>

                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <a href="{{ route('posts.index', ['user' => $user]) }}">
                                        <p class="font-bold capitalize">
                                            {{ $user->username }}
                                        </p>
                                    </a>

                                    <p class="text-gray-500">
                                        {{ $user->name }}
                                    </p>
                                </div>

                                {{-- <div>
                                    @auth()
                                        @if ($user->id !== auth()->user()->id)
                                            @php
                                                $this->isFollowing[$user->username] = $user->isFollower(auth()->user());
                                            @endphp
                                            @if (!$this->isFollowing[$user->username])
                                                <button wire:click="follow({{ $user }})"
                                                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer  font-bold px-3 py-1 text-white rounded-lg text-sm">
                                                    Seguir
                                                </button>
                                            @else
                                                <button wire:click="unfollow({{ $user }})"
                                                    class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer  font-bold px-3 py-1 text-white rounded-lg text-sm">
                                                    Dejar de Seguir
                                                </button>
                                            @endif
                                        @endif
                                    @endauth
                                </div> --}}
                            </div>
                        </div>

                    @empty
                        <p class="text-gray-500">
                            {{ $idModal === 'followers' ? 'Este usuario aún no posee seguidores :(' : 'Este usuario aún no sigue a nadie :(' }}
                        </p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

</div>
