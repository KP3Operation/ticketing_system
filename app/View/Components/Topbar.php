<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Topbar extends Component
{
    public $user;
    public $profile;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->profile = $this->user ? $this->user->profile : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topbar', [
            'users' => User::all(),
        ]);
    }
}
