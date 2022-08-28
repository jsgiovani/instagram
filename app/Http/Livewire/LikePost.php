<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLike;
    public $likes;


    public function mount($post)
    {
        $this->isLike = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }



    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where("user_id", $this->post->user_id)->delete();
            $this->likes = $this->post->likes->count() - 1 ;

            $this->isLike = false;

        } else {
            $this->post->likes()->create([
                "user_id" => auth()->user()->id
            ]);
            $this->isLike = true;
            $this->likes = $this->post->likes->count() + 1 ;
        }
    }



    public function render()
    {
        return view('livewire.like-post');
    }
}
