<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);
        
        Feedback::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
}

