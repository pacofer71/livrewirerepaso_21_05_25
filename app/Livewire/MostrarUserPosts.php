<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdatePost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MostrarUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public FormUpdatePost $uform;
    public bool $openUpdate=false;
    
    public string $campo='id', $orden='desc';
    public string $texto="";

    #[On('evtCrearPost')]
    public function render()
    {
        $categorias= Category::select('nombre', 'id')->orderBy('nombre')->get();
       
        $posts=Post::where('user_id', Auth::id())
        ->where(function($q){
            $q->where('titulo', 'like', "%".$this->texto."%")
            ->orWhere('contenido', 'like', "%".$this->texto."%")
            ->orWhere('estado', 'like', "%".$this->texto."%");
        })
        ->orderBy($this->campo, $this->orden)->paginate(5);
        return view('livewire.mostrar-user-posts', compact('posts', 'categorias'));
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

    //-------------
    public function confirmarBorrar(Post $post){
        $this->authorize('delete', $post);
        $this->dispatch('evtConfirmarBorrar', $post->id);
    }

    #[On('evtBorrarOk')]
    public function deletePost(Post $post){
        $this->authorize('delete', $post);
        //borraremos la imagen si no es 'noimage.png'
        if(basename($post->imagen)!='noimage.png'){
            Storage::delete($post->imagen);
        }
        $post->delete();
        $this->dispatch('mensaje', 'Post Eliminado');
    }

    //---------------------- Metodos para actualizar post
    public function edit(Post $post){
        $this->authorize('update', $post);
        $this->uform->setPost($post);
        $this->openUpdate=true;
    }

    public function update(){
        $this->authorize('update', $this->uform->post);
        $this->uform->formUpdate();
        $this->cancelar();
        $this->dispatch('mensaje', 'Post Editado.');
    }

    public function cancelar(){
        $this->openUpdate=false;
        $this->uform->formCancelar();

    }
}
