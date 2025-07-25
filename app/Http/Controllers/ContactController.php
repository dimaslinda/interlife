<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|min:10|max:13',
            'email' => 'required|email|max:255',
            'layanan' => 'nullable|string|max:255',
            'pesan' => 'nullable|string',
        ]);

        Mail::to('interlifefurniture@gmail.com')
            ->send(new ContactFormMail($validatedData));

        // Jika request adalah AJAX, kembalikan respons JSON
        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => 'Pesan Anda telah berhasil dikirim!']);
        }
        
        // Jika bukan AJAX, lakukan redirect seperti biasa
        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}