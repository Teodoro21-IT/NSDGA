<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Siguraduhin na ang Model mo ay 'User' o 'Account'
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
public function dashboard()
    {
        return view('admin.admin_dashboard');
    }


    public function index()
    {
        // Kinukuha lahat ng data para hindi mag-error ang table
        $accounts = User::all(); 
        return view('manage_accounts', compact('accounts'));
    }

    public function store(Request $request)
    {
        // Logic para sa pag-create ng account
        User::create([
            'user' => $request->user,
            'password' => Hash::make($request->pass),
            'role' => $request->role,
        ]);
        return back()->with('success', 'Account Created!');
    }

    public function destroy($id)
    {
        // Hanapin ang user gamit ang ID at burahin
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Account deleted successfully!');
    }

    public function students()
    {
        // for student record
        return view('admin.manage_students');
    }

    public function createEvent()
{
    return view('admin.create_event');
}

public function storeEvent(Request $request)
{
    $request->validate([
        'event_title' => 'required|string|max:255',
        'event_date' => 'required|date',
        'event_description' => 'required',
        'event_type' => 'required'
    ]);

    // logic to save to database (e.g., Event::create($request->all());)
    
    return back()->with('success', 'Event published successfully!');
}

public function settings()
{
    return view('admin.settings');
}

public function updateSettings(Request $request)
{
    // Dito mo i-sa-save ang settings sa database
    // Halimbawa: Setting::updateValue('school_name', $request->school_name);
    
    return back()->with('success', 'System configurations updated!');
}
}
