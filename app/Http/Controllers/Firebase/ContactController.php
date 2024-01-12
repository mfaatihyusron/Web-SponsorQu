<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;



class ContactController extends Controller
{
    //
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'contacts';
    }

    public function index(){
        $contacts = $this->database->getReference('contacts')->getValue();
        return view('firebase.contact.index', compact('contacts'));
    }
    
    public function create(){
        return view('firebase.contact.create');
    }
    
    public function store(Request $request){
        $ref_tablename = 'contacts';
        //settring keyy dan value nya
        $postData = [
            'name'=> $request->name,
            'phone'=> $request->phone,
            'email'=> $request->email,

        ];

        //How to pUsh data
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if($postRef){
            return redirect('contacts')->with('status','Contact Added Successifully');
        }
        else{
            return redirect('contacts')->with('status','Contact Not Added');
        }
    }

    public function edit($id){
        $key = $id;
        //fetch data with spesific key id
        $editdata = $this->database->getReference('contacts')->getChild($key)->getValue();
        if($editdata){
            return view('firebase.contact.edit',compact('editdata','key'));
        }else{
            return redirect('contacts')->with('status','Id Not Found');
        }
    }

    public function update(Request $request, $id){
        $key = $id;
        $updateData = [
            'name'=> $request->name,
            'phone'=> $request->phone,
            'email'=> $request->email,

        ];
        $res_update = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($res_update){
            return redirect('contacts')->with('status','Contact Updated Successifully');
        }else{
            return redirect('contacts')->with('status','Contact Not Updated, theres a problem');
        }
    }

    public function destroy($id){
        $key = $id;
        $deleted=$this->database->getReference($this->tablename.'/'.$key)->remove();
        if($deleted){
            return redirect('contacts')->with('status','Contact Deleted Successifully');
        }else{
            return redirect('contacts')->with('status','Contact not Deleted, theres a problem');
        }
    }
}
