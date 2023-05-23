<div>
    @auth
        <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
        @if (session('mensaje'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white uppercase font-bold">
                {{ session('mensaje') }}
            </div>
        @endif

        <form wire:submit.prevent="submitForm"  method="POST">
            @csrf
            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                Añade un comentario
            </label>
            <textarea
                wire:model.defer="comentario"
                id="comentario" 
                name="comentario" 
                placeholder="Agrega un comentario"
                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
            @error('comentario')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 m-1 text-center">{{ $message }}</p>
            @enderror
            <input type="submit" value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    @endauth

    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
        @if ($comentarios)
            @foreach ($comentarios as $com)
                <div class="p-5 border-gray-300 border-b">
                    <a href="{{ route('posts.index', $com->user) }}" class="font-bold ">
                        {{ $com->user->username }} </a>
                    <p>{{ $com->comentario }}</p>
                    <p class="text-sm text-gray-500">{{ $com->created_at->diffForHumans() }}</p>

                </div>
            @endforeach
        @else
            <p class="p-10 text-center">No Hay Comentarios Aún</p>
        @endif
    </div>
</div>
