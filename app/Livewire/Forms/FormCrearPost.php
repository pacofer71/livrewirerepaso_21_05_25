<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearPost extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:150', 'unique:posts,titulo'])]
    public string $titulo="";
    
    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido="";
    
    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";
    
    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id=0;

    public function formStore(){
        $datosPost=$this->validate();

        //si el usuario no ha subido una imagen ponemos una por defecto 'noimage.png'
        $datosPost['imagen'] = $this->imagen?->store('images/posts') ?? 'images/posts/noimage.png';
        
        //añadimos como usuario creador del post al usuario logeado
        $datosPost['user_id']=Auth::id();
        
        //creamos el post
        Post::create($datosPost);



    }
    public function formCancelar(){
        $this->resetValidation();
        $this->reset();
        
    }

}
