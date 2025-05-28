<x-mios.base>
    <div class="flex justify-between w-full mb-2">
        <div class="w-1/2">
            <x-input type="search" placeholder="Buscar..." wire:model.live="texto" class="w-full" />
        </div>
        <div>
            @livewire('crear-post')
        </div>
    </div>
    @if($posts->count())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        <i class="fas fa-sort mr-1"></i>TITULO
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('contenido')">
                        <i class="fas fa-sort mr-1"></i>CONTENIDO
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                        <i class="fas fa-sort mr-1"></i>ESTADO
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('category_id')">
                        <i class="fas fa-sort mr-1"></i>CATEGORIA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ACCIONES
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{Storage::url($item->imagen)}}" class="w-16 md:w-32 max-w-full max-h-full" alt="Imagen del post">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item->titulo}}
                    </td>
                    <td class="px-6 py-4 italic">
                        {{$item->contenido}}
                    </td>
                    <td class="px-6 py-4 font-semibold">
                        <p @class([ 
                            'cursor-pointer text-white font-bold p-2 rounded-xl text-center' , 'bg-red-500'=>$item->estado=='Borrador',
                            'bg-green-500'=>$item->estado=='Publicado',
                            ]) wire:click="cambiarEstado({{$item->id}})">
                            {{$item->estado}}
                        </p>
                    </td>
                    <td class="px-6 py-4 font-semibold">
                        <p class="text-white font-bold p-2 rounded-xl text-center" style="background-color:{{$item->category->color}}">
                            {{$item->category->nombre}}
                        </p>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{$posts->links()}}
    </div>
    @else
    <x-mios.alerta>
        No se encontró ningún post o aún no ha publicado ninguno.
    </x-mios.alerta>
    @endif
</x-mios.base>