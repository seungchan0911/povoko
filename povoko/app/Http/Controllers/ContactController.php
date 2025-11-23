<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request) {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'success!');
    }

    public function view(Request $request) {
        $contacts = Contact::latest()->paginate(15);
        
        return view('admin.contact', compact('contacts'));
    }

    public function delete($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'deleted.');
    }
}
