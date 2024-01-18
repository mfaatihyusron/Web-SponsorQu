<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Auth;



class AdminController extends Controller
{
    //admin account =email: admin@gmail.com | pass:password
    public function __construct(Database $database,Auth $auth)
    {
        $this->auth=$auth;
        $this->database = $database;
    }

    public function index(){
        $data = [
            "jumlah_user"=> $this->database->getReference('users')->getSnapshot()->numChildren(),
            "jumlah_partnerships"=> $this->database->getReference('partnerships')->getSnapshot()->numChildren(),
            "jumlah_post"=> $this->database->getReference('posts')->getSnapshot()->numChildren(),
            "jumlah_mail"=> $this->database->getReference('mail')->getSnapshot()->numChildren(),
        ];
        return view('firebase.admin.index', compact('data'));
    }
    public function users(){
        $users = $this->database->getReference('users')->getValue();
        return view('firebase.admin.users', compact('users'));
    }
    public function edit($id){
        $key = $id;
        //fetch data with spesific key id
        $editdata = $this->database->getReference('users')->getChild($key)->getValue();
        if($editdata){
            return view('firebase.admin.edit',compact('editdata','key'));
        }else{
            return redirect('users')->with('status','Id Not Found');
        }
    }
    public function update(Request $request,$id){
        $key = $id;
        $validatedData = $request->validate([
            'name' => 'required|min:4', 
            'instansi' => 'required',
            'telp' => 'required|numeric|digits_between:4,15',
            'role' => 'required|in:umkm,organisasi,admin,perusahaan',
        ]);
        $updateData = [
            'name' => $validatedData['name'],
            'telp' => $validatedData['telp'],
            'instansi' => $validatedData['instansi'],
            'role' => $validatedData['role'],   

        ];
        $res_update = $this->database->getReference('users/'.$key)->update($updateData);
        if($res_update){
            return redirect('users')->with('status','User Updated Successifully');
        }else{
            return redirect('users')->with('status','User Not Updated, theres a problem');
        }
    }
    public function destroy($id){
        $key = $id;
        $deleted=$this->database->getReference('users/'.$key)->remove();
        if($deleted){
            return redirect('users')->with('status','User Deleted Successifully');
        }else{
            return redirect('users')->with('status','User not Deleted, theres a problem');
        }
    }
}
