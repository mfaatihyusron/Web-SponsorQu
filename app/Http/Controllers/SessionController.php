<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth;
// use Illuminate\Support\Facades\Auth as AuthLaravel;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Session;


class SessionController extends Controller
{
    // 
    public function __construct(Database $database,Auth $auth)
    {
        $this->auth=$auth;
        $this->database = $database;
        $this->tablename = 'users';
    }

    public function index(){
        return view('firebase.session.index');
    }

    public function registerform(){
        return view('firebase.session.register');
    }
    public function register(Request $request){
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        Session::flash('instansi',$request->instansi);
        Session::flash('telp',$request->telp);
        $validatedData = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',    
            'password' => 'required|min:8',
            'instansi' => 'required',
            'telp' => 'required|numeric|digits_between:4,15',
            'role' => 'required|in:umkm,organisasi,admin,perusahaan',
        ]);
        $reference = $this->database->getReference('users');
        $checkuser = $reference->orderByChild('email')->equalTo($validatedData['email'])->getSnapshot();
        
        if(!isset($checkuser->getValue()[key($checkuser->getValue())]['email'])){
            $user = [
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'name' => $validatedData['name'],
                'telp' => $validatedData['telp'],
                'instansi' => $validatedData['instansi'],
                'role' => $validatedData['role'],            
            ];
            $postRef = $this->database->getReference($this->tablename)->push($user); 
            // Daftarkan pengguna di Firebase Authentication
            $this->auth->createUserWithEmailAndPassword($validatedData['email'], $validatedData['password']);
            return redirect('/')->with('status','Registered'); 
        }else{
            return redirect()->back()->with('status','Email or Phone number already used');
        }
        // Jika pendaftaran berhasil, tindakkan sesuai keinginan Anda. Misalnya, redirect ke halaman beranda.
    }

    public function login(Request $request){
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Authenticate user using Firebase Authentication
        try {
            $user = $this->auth->signInWithEmailAndPassword($credentials['email'], $credentials['password']);
            
            $reference = $this->database->getReference('users');
            $checkuser = $reference->orderByChild('email')->equalTo($credentials['email'])->getValue();
            
            // Jika autentikasi berhasil, Anda bisa menentukan langkah-langkah selanjutnya
            // Misalnya, Anda dapat menyimpan data pengguna ke sesi atau mengarahkan mereka ke halaman tertentu.
            $userData = [
                'name' => $checkuser [key($checkuser)]['name'],
                'email' => $checkuser [key($checkuser)]['email'],
                'role' => $checkuser [key($checkuser)]['role'],
                'instansi' => $checkuser [key($checkuser)]['instansi'],
                'telp' => $checkuser [key($checkuser)]['telp'],
                'uid' => key($checkuser),
                // Tambahkan data pengguna lainnya yang ingin Anda simpan di sesi
            ];
            
            // Simpan data pengguna ke sesi
            session(['user' => $userData]);
            
            return redirect('/home')->with('status', 'Login successful');
            //Note: Tinggal buat logout, sama belajar middleware
        } catch (\Exception $e) {
            // Jika terjadi kesalahan autentikasi, tangani di sini.
            // Misalnya, tampilkan pesan kesalahan atau arahkan pengguna kembali ke halaman login.
            return redirect()->back()->with('status', 'Invalid email or password');
        }
    }

    public function logout()
    {
        // Hapus data pengguna dari sesi
        session()->forget('user');

        // Lakukan langkah-langkah logout lainnya jika diperlukan

        // Redirect ke halaman tertentu setelah logout
        return redirect('/')->with('status', 'Logout successful');
    }
}
