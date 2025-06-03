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
                        <p @class([ 'cursor-pointer text-white font-bold p-2 rounded-xl text-center' , 'bg-red-500'=>$item->estado=='Borrador',
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
                        <button wire:click="edit({{$item->id}})" class="mr-2">
                            <i class="fas fa-edit text-green-500 text-xl"></i>
                        </button>
                        <button wire:click="confirmarBorrar({{$item->id}})">
                            <i class="fas fa-trash text-red-500 text-xl"></i>
                        </button>
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
    <!-- -------------------------------------- Ventana Modal Para Actualizar el post --------------------- -->
    @if($uform->post)
    <x-dialog-modal maxWidth='4xl' wire:model='openUpdate'>
        <x-slot name="title">
            Editar Post
        </x-slot>
        <x-slot name="content">
            <div class="mb-2">
                <x-label value="Título del Post" />
                <x-input type="text" placeholder="Título..." class="w-full" wire:model="uform.titulo" />
                <x-input-error for="uform.titulo" />
            </div>
            <div class="mb-2">
                <x-label value="Contenido del Post" />
                <textarea rows='6' class="w-full rounded-lg" placeholder="Contenido..." wire:model="uform.contenido"></textarea>
                <x-input-error for="uform.contenido" />
            </div>
            <div class="mb-2">
                <x-label value="Categoria del Post" />
                <select class="w-full rounded-lg" wire:model="uform.category_id">
                    <option>Seleccione una categoría</option>
                    @foreach ($categorias as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="uform.category_id" />
            </div>
            <div class="mb-2">
                <x-label value="Estado del Post" />
                <div class="flex">
                    <div class="flex items-center me-4">
                        <input id="pub" wire:model="uform.estado" type="radio" value="Publicado" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="pub" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Publicado</label>
                    </div>
                    <div class="flex items-center me-4">
                        <input id="borr" type="radio" wire:model="uform.estado" value="Borrador" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="borr" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Borrador</label>
                    </div>
                </div>
                <x-input-error for="uform.estado" />
            </div>
            <x-label value="Imagen del Post" />
            <div class="w-full relative h-80 rounded-lg p-1 bg-slate-200">
                <input type="file" accept="image/*" class="hidden" id="uimagen" wire:model="uform.imagen" />
                <label for="uimagen" class="absolute bottom-2 end-2 -2 p-2 bg-black text-white font-bold cursor-pointer rounded-lg">
                    <i class="fas fa-upload mr-2"></i>SUBIR
                </label>
                @if($uform->imagen)
                <img src="{{$uform->imagen->temporaryUrl()}}" class="w-full h-full rounded-lg bg-center bg-no-repeat bg-cover" />
                @else
                <img src="{{Storage::url($uform->post->imagen)}}" class="w-full h-full rounded-lg bg-center bg-no-repeat bg-cover" />
                @endif
            </div>
            <x-input-error for="uform.imagen" />


        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="update" wire:loading.attr='hidden'>
                    <i class="fas fa-save mr-2"></i>EDITAR
                </x-button>
                <x-button class="bg-red-500 hover:bg-red-600 mr-4" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
    <!---------------------------------------------------- -->
</x-mios.base>