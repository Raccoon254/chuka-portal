<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(): View
    {
        $user = auth()->user();
        if (!$user->profileComplete()) {
            session()->flash('error', 'Your profile is incomplete. Please complete your profile to access all features.');

        }
        return view('dashboard');
    }

}
