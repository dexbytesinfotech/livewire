<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Stores\Store;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Posts\Post;

class Policies extends Component
{
    public function render()
    {
        return view('livewire.auth.privacy-policy',[
            'post' => Post::where('slug','privacy-policy')->first()
        ]);
    }
}