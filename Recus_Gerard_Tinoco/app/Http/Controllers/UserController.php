<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;

use App\Events\NewMessageNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data["user_id"] = Auth::user()->id;

        $user = User::find($id);

        if($user->is_admin == 1){
            return view('admin',$data);
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function send(Request $request)
    {

        $message = new Message;

        $message->setAttribute('from', Auth::user()->id);

        $message->setAttribute('to', $request->input("to"));

        $message->setAttribute('message', $request->input("message"));

        $message->save();

        // want to broadcast NewMessageNotification event

        event(new NewMessageNotification($message));

        return "sms enviado...";

        // ...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('UserEdit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {     
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'nullable|string|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'pass_confirm' => 'same:password',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        User::findOrFail($id)->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => 'images/'.time().'.'.$request->file->extension()
        ]);

        $ImgName = time().'.'.$request->file->extension();

        $request->file->move(public_path('images'), $ImgName);

        return redirect()->to('dashboard')->with('success','Campos editados correctamente!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
