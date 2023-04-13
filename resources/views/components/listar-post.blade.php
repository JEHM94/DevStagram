{{-- Forelse ejecuta el foreach y si no hay ningún array ejecuta el empty --}}
{{-- @forelse ($posts as $post)
    @empty
    @endforelse --}}
@if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-5">
        @foreach ($posts as $post)
            <div class="bg-white">
                <a href="{{ route('posts.show', [$post->user, $post]) }}">
                    <img class="rounded-lg rounded-b-none" src="{{ asset('uploads') . '/' . $post->imagen }}"
                        alt="Imagen del Post {{ $post->titulo }}">

                    <div class="p-3 text-gray-600">
                        <p class="text-black font-bold">
                            {{ $post->user->username }}
                        </p>

                        <p>
                            {{ $post->titulo }}
                        </p>
                </a>

                <div class="flex justify-between items-center">
                    @livewire('like-post', ['post' => $post])

                    <a href="{{ route('posts.show', [$post->user, $post]) }}">
                        @livewire('total-comentarios', ['post' => $post])
                    </a>

                </div>

            </div>

    </div>
@endforeach
</div>

<div class="my-10">
    {{ $posts->links('pagination::tailwind') }}
</div>
@else
<p class="text-gray-600  text-sm text-center ">No hay ninguna publicación</p>
@endif
