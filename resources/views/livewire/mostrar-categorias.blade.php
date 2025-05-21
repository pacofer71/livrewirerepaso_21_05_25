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
                   Acciones
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-mios.base>