<x-layouts.app>
    <x-mios.base>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach($posts as $item)
            <article
                @class([ "flex flex-col justify-between justify-items-center" , "h-96 w-full p-1 rounded-xl border-1 border-gray-400 bg-center bg-no-repeat bg-cover" , "lg:col-span-2"=>$loop->first,
                ])
                style="background-image:url({{Storage::url($item->imagen)}})">
                <p class="text-center text-xl font-bold text-white mix-blend-difference">{{$item->titulo}}</p>
                <div class="p-1 italic text-white bg-black/40 rounded-xl">
                    {{$item->contenido}}
                </div>
                <div class="flex justify-between w-full bg-black/40 p-4">
                    <div class="italic font-semibold p-1 rounded-xl" style="background-color:{{$item->category->color}}">
                        {{$item->category->nombre}}
                    </div>
                    <div class="italic font-semibold p-1 rounded-xl text-white">
                        {{$item->updated_at->format('d/m/Y H:i:s')}}
                    </div>
                </div>
                <div class="p-1">
                    <p class="font-bold text-white mix-blend-difference italic">
                        {{$item->user->email}}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-1">
            {{$posts->links()}}
        </div>
    </x-mios.base>
</x-layouts.app>