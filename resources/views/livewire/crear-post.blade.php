<div>
    <button wire:click="$set('openCrear', true)"
        class="p-2 rounded-xl upper text-white font-bold bg-blue-400 hover:bg-blue-600">
        <i class="fas fa-add mr-1"></i>NUEVO
    </button>
    <x-dialog-modal maxWidth='4xl' wire:model='openCrear'>
        <x-slot name="title">
            Crear Post
        </x-slot>
        <x-slot name="content">
            <div class="mb-2">
                <x-label value="Título del Post" />
                <x-input type="text" placeholder="Título..." class="w-full" wire:model="cform.titulo" />
                <x-input-error for="cform.titulo" />
            </div>
            <div class="mb-2">
                <x-label value="Contenido del Post" />
                <textarea rows='6' class="w-full rounded-lg" placeholder="Contenido..." wire:model="cform.contenido"></textarea>
                <x-input-error for="cform.contenido" />
            </div>
            <div class="mb-2">
                <x-label value="Categoria del Post" />
                <select class="w-full rounded-lg" wire:model="cform.category_id">
                    <option>Seleccione una categoría</option>
                    @foreach ($categorias as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="cform.category_id" />
            </div>
            <div class="mb-2">
                <x-label value="Estado del Post" />
                <div class="flex">
                    <div class="flex items-center me-4">
                        <input id="pub" wire:model="cform.estado" type="radio" value="Publicado" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="pub" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Publicado</label>
                    </div>
                     <div class="flex items-center me-4">
                        <input id="borr" type="radio" wire:model="cform.estado" value="Borrador" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="borr" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Borrador</label>
                    </div>
                </div>
                <x-input-error for="cform.estado" />
            </div>
            <x-label value="Imagen del Post" />
            <div class="w-full relative h-80 rounded-lg p-1 bg-slate-200">
                <input type="file" accept="image/*" class="hidden" id="cimagen" wire:model="cform.imagen" />
                <label for="cimagen" class="absolute bottom-2 end-2 -2 p-2 bg-black text-white font-bold cursor-pointer rounded-lg">
                    <i class="fas fa-upload mr-2"></i>SUBIR
                </label>
                @if($cform->imagen)
                <img src="{{$cform->imagen->temporaryUrl()}}" class="w-full h-full rounded-lg bg-center bg-no-repeat bg-cover" />
                @endif
            </div>
            <x-input-error for="cform.imagen" />


        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="store" wire:loading.attr='hidden'>
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </x-button>
                <x-button class="bg-red-500 hover:bg-red-600 mr-4" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>