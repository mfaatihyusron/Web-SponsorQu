<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Contract\Database;

class HomeController extends Controller
{
    
    //
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function index(){
        return view('firebase.home.index');
    }
    public function posting(){
        return view('firebase.home.posting');
    }

    public function addPost(Request $request,$uid)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'imagepost' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Mendapatkan file gambar dari formulir
        $imageFile = $request->file('imagepost');
    
        // Generate a unique filename to avoid collisions
        $filename = time() . '.' . $imageFile->getClientOriginalExtension();
    
        // Simpan gambar di penyimpanan internal Laravel
        Storage::disk('local')->put('public/images/' . $filename, file_get_contents($imageFile));
    
        // Dapatkan URL gambar internal Laravel
        $imageUrl = Storage::url('public/images/' . $filename);
    
        // Menyimpan data postingan ke Firebase Realtime Database
        // Sesuaikan dengan struktur database Anda
        $postData = [
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'image_url' => $imageUrl,
            'uploader' => $uid,
        ];
    
        // Menyimpan data ke Firebase Realtime Database
        $this->database->getReference('posts')->push($postData);
    
        return redirect('home')->with('status', 'Post added successfully');
    }
    
}
