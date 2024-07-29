<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $data['getRecord']=User::getRecordUser();
        return view('backend.user.list',$data);
    }
    public function add()
    {
        return view('backend.user.add');
    }
    public function insert(Request $request)
    {
        request()->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users',
            'password'=> 'required'
        ]);
        $user = new User;
        $user->name= trim($request->name);
        $user->email= trim($request->email);
        $user->password= Hash::make($request->password);
        $user->status = trim($request->status);
        $user->save();
        return redirect('panel/user/list')->with('success', 'User Successfully Created');
    }
    public function edit($id)
    {
        $getRecord['getRecord'] = User::getSingle($id);
        return view('backend.user.edit' ,$getRecord);
      
    }
    public function update($id , Request $request)
    {
        request()->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users,email,'.$id,
            
        ]);
        $user = User::getSingle($id);
        $user->name= trim($request->name);
        $user->email= trim($request->email);
        if(!empty($request->password))
        {
            $user->password= Hash::make($request->password);
        }
        $user->status = trim($request->status);
        $user->save();
        return redirect('panel/user/list')->with('success', 'User Successfully updated');
    }
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('panel/user/list')->with('error', 'Admin Successfully Deleted');
    }
   
    
}
