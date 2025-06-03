<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdatePost extends Form
{
    public ?Post $post = null;
    public string $titulo = "";

    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido = "";

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado = "";

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id = 0;

    public function rules()
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:150', 'unique:posts,titulo,' . $this->post->id]
        ];
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->titulo = $post->titulo;
        $this->category_id = $post->category_id;
        $this->contenido = $post->contenido;
        $this->estado = $post->estado;
    }

    public function formUpdate()
    {
        $datosPost = $this->validate();
        $imagenVieja = $this->post->imagen;
        $datosPost['imagen'] = $this->imagen?->store('images/posts') ?? $imagenVieja;
        $this->post->update($datosPost);
        //vamos a ver si borramos o no la imagen anterior
        if ($this->imagen && basename($imagenVieja) != 'noimage.png') {
            Storage::delete($imagenVieja);
        }
    }
    public function formCancelar()
    {
        $this->resetValidation();
        $this->reset();
    }
}
