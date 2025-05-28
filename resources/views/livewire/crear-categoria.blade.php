<div>
    <button wire:click="$set('openCrear', true)"
        class="p-2 rounded-xl upper text-white font-bold bg-blue-400 hover:bg-blue-600">
        <i class="fas fa-add mr-1"></i>NUEVA
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Nueva Categoria
        </x-slot>
        <x-slot name="content">

            <x-label value="Nombre" />
            <x-input type="text" placeholder="Nombre Categoria..." class="w-full" wire:model="cform.nombre" />
            <x-input-error for="cform.nombre" />

            <x-label value="Color" class="mt-4" />
            <x-input type="color" class="w-full" wire:model="cform.color" />
            <x-input-error for="cform.color" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="store()">
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </x-button>
                <x-button class="bg-red-500 hover:bg-red-600 mr-4" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>