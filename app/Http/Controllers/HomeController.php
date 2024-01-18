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
        // Mendapatkan semua posts dari Firebase
        $posts = $this->database->getReference('posts')->getValue();

        // Filter posts untuk mendapatkan hanya yang memiliki uploader berbeda dari session user
        $filteredPosts = array_filter($posts, function ($post) {
            return $post['uploader'] != session("user")["uid"];
        });

        // Mendapatkan hanya data 'name' dan 'instansi' dari tabel 'users'
        $users = $this->database->getReference('users')->getValue();

        // Hanya menyimpan 'name' dan 'instansi' dari setiap user
        $filteredUsers = [];

        foreach ($users as $uid => $userData) {
            $filteredUsers[$uid] = [
                'name' => $userData['name'],
                'instansi' => $userData['instansi'],
                'role' => $userData['role'],
                'role_d' => ($userData['role'] == 'umkm') ? 'MSME' : (($userData['instansi'] == 'perusahaan') ? 'Company' : 'Organization'),
            ];
        }

        // Gabungkan data berdasarkan uid
        $joinedData = [];

        foreach ($filteredPosts as $post) {
            $uid = $post['uploader'];

            if (isset($filteredUsers[$uid])) {
                // Jika user dengan uid yang sesuai ditemukan
                $joinedData[] = array_merge($post, $filteredUsers[$uid]);
            }
        }

        //acak urutannya
        shuffle($joinedData);

        $posts = $this->database->getReference('posts')->getValue();
        $id=session("user")["uid"];
        // Filter posts yang memiliki uploader sama dengan $uid
        $filter = array_filter($posts, function ($post) use ($id) {
            return $post['uploader'] == $id;
        });

        // Hitung jumlah posting yang sesuai
        $jumlahPost = count($filter);
        // dd($joinedData);
        return view('firebase.home.index', compact('joinedData','jumlahPost'));
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
        $imageFile = $request->file('imagepost');
    
        // Generate a unique filename to avoid collisions
        $filename = time() . '.' . $imageFile->getClientOriginalExtension();
    
        // Simpan gambar di penyimpanan internal Laravel
        Storage::disk('local')->put('public/images/' . $filename, file_get_contents($imageFile));
    
        // Dapatkan URL gambar internal Laravel
        $imageUrl = Storage::url('public/images/' . $filename);
    
        // Menyimpan data postingan ke Firebase Realtime Database
        // Sesuaikan dengan struktur database Anda
        $uniqid = uniqid();
        $postData = [
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'type' => $request->input('type'),
            'image_url' => $imageUrl,
            'uploader' => $uid,
            'id'=>$uniqid,
        ];
    
        // Menyimpan data ke Firebase Realtime Database
        $this->database->getReference('posts')->push($postData);
    
        return redirect('home')->with('status', 'Post added successfully');
    }
    
    public function writeMail($uploader,$id_post){
        $postData = $this->database
        ->getReference('posts')
        ->orderByChild('id')
        ->equalTo($id_post)
        ->getValue();

        // Firebase mengembalikan data sebagai array, kita ambil nilai pertama
        $postData = reset($postData);
        
        $users= $this->database
        ->getReference('users')
        ->getChild($uploader);

        $uploaderData =[
            'name'=>$users->getChild('name')->getValue(),
            'instansi'=>$users->getChild('instansi')->getValue(),
        ];
        // dd($postData);


        return view('firebase.home.write-mail',compact('uploaderData','postData','uploader'));
    }
    
    public function sendMail(Request $request){
        $Data = [
            'id'=> uniqid(),
            'subject' => $request->subject,
            'message' => $request->message,
            'telp_sender' => $request->telp_sender,
            'email_sender' => $request->email_sender,
            'sender'=> $request->sender,
            'to'=> $request->to,
            'id_post'=> $request->id_post,
        ];
        $postRef = $this->database->getReference('mails')->push($Data);
        if($postRef){
            return redirect('home')->with('status','Mail sended Successifully');
        }
        else{
            return redirect('home')->with('status','Mail Not Sended');
        }
        // dd($Data);
    }
    public function mail(){
        $mails= $this->database->getReference('mails')->getValue();
        $filteredMails = array_filter($mails, function ($mail) {
            return $mail['to'] == session("user")["uid"];
        });

        return view('firebase.home.mail',compact('filteredMails'));

    }
    public function viewmail($id_mail){
        $mailData = $this->database
        ->getReference('mails')
        ->orderByChild('id')
        ->equalTo($id_mail)
        ->getValue();
        
        
        $postData= $this->database
        ->getReference('posts')
        ->orderByChild('id')
        ->equalTo($mailData [key($mailData)]['id_post'])
        ->getValue();
        $postData = reset($postData);
        $mailData = reset($mailData);   
        
        $users= $this->database
        ->getReference('users')
        ->getChild($mailData["sender"]);

        $sender =[
            'name'=>$users->getChild('name')->getValue(),
        ];

        return view('firebase.home.viewmail',compact('mailData','postData','sender'));
    }
}