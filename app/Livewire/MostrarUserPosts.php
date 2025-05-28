<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MostrarUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo='id', $orden='desc';
    public string $texto="";

    public function render()
    {
        $posts=Post::where('user_id', Auth::id())
        ->where(function($q){
            $q->where('titulo', 'like', "%".$this->texto."%")
            ->orWhere('contenido', 'like', "%".$this->texto."%")
            ->orWhere('estado', 'like', "%".$this->texto."%");
        })
        ->orderBy($this->campo, $this->orden)->paginate(5);
        return view('livewire.mostrar-user-posts', compact('posts'));
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    public function updatingTexto(){
        $this->resetPage();
    }

    public function cambiarEstado(Post $post){
        $this->authorize('update', $post);

        $estado=($post->estado=='Publicado') ? 'Borrador' : 'Publicado';
        $post->update(compact('estado'));
        $this->dispatch('mensaje', "Se cambio el estado del post");
    }
}
