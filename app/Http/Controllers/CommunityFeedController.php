<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityFeed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityFeedController extends Controller
{
    public function Community(){
        return view('community', [
            'result' => CommunityFeed::with('user')
            ->OrderBy('User_Posted_Time', 'DESC')
            ->get(),
        ]);
    }

    public function CommunityData(Request $req){
        if(Auth::Check()){
            $req->validate([
                'message' => 'required|min:10|max:300'
            ], [

                'message.required' => "Üzenetet kötelező megadni!",
                'message.min'       => "Az üzenet minimum 10 karakter legyen!",
                'message.max'       => "Maximum 300 karakter lehet az üzenet!"
            ]);
            $data = new communityFeed;
            $data->User_Id = Auth::user()->User_id;
            $data->User_Name = Auth::user()->username;
            $data->User_Email = Auth::user()->email;
            $data->User_Message = $req->message;
            $data->User_Posted_Time = now()->addHour();;
            $data->save();
            return redirect('/community')->with('success', 'A posztja kikerült a nagy világba.');
        } else{
            return redirect('/community');
        }
    }
    public function showProfile(User $user)
    {
        return view('profil.show', compact('user'));
    }





}
