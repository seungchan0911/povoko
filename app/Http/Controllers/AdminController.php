<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'password' => 'required'
        ]);

        $admin = Admin::first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.index')->with('success', 'success!');
        }
        
        return back()->withErrors(['password' => 'password x']);
    }
    
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin')->with('success', 'success!.');
    }
}