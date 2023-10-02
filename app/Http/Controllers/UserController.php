<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class UserController extends Controller
{
    public function fetchUserData(Request $request): View
    {

        $request->validate([
            'reg_no' => 'required',
            'password' => 'required'
        ]);

        $username = $request->reg_no;
        $password = $request->password;

        // Validate input
        if (!$username || !$password) {
            session()->flash('error', 'Username and password are required.');
            return view('auth.login')->withErrors(['error' => 'Username and password are required.']);
        }

        // Fetch data from the external endpoint
        $response = Http::timeout(70)->get('http://localhost:3000/login', [
            'username' => $username,
            'password' => $password
        ]);

        $data = $response->json();

        // Check if data was fetched successfully
        if ($response->failed()) {
            session()->flash('error', 'Failed to fetch data');
            return view('auth.login')->withErrors(['error' => 'Failed to fetch data']);
        }

        // Send data to another view
        return view('dashboard', ['data' => $data]);
    }
}

