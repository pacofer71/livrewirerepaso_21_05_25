<x-mios.base>
    <div class="flex flex-row-reverse my-2">
        @livewire('crear-categoria')
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    NOMBRE
                </th>
                <th scope="col" class="px-6 py-3">
                    COLOR
                </th>
                <th scope="col" class="px-6 py-3">
                    ACCIONES
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$item->id}}
                </th>
                <td class="px-6 py-4 font-bold">
                    {{$item->nombre}}
                </td>
                <td class="px-6 py-4">
                    <p class="text-white font-bold p-2 rounded-xl text-center" style="background-color:{{$item->color}}">
                        {{$item->color}}
                    </p>
                </td>
                <td class="px-6 py-4">
                    <button class="mr-2" wire:click="edit({{$item->id}})">
                        <i class="fas fa-edit text-xl"></i>
                    </button>
                   <button wire:click="confirmarBorrar({{$item->id}})">
                    <i class="fas fa-trash text-xl"></i>
                   </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Ventana modal para actualizar una categoria --------------------------------------- -->
     <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            Editar Categoria
        </x-slot>
        <x-slot name="content">

            <x-label value="Nombre" />
            <x-input type="text" placeholder="Nombre Categoria..." class="w-full" wire:model="uform.nombre" />
            <x-input-error for="uform.nombre" />

            <x-label value="Color" class="mt-4" />
            <x-input type="color" class="w-full" wire:model="uform.color" />
            <x-input-error for="uform.color" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="update">
                    <i class="fas fa-save mr-2"></i>EDITAR
                </x-button>
                <x-button class="bg-red-500 hover:bg-red-600 mr-4" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>

</x-mios.base>