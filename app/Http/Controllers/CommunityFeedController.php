<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityFeed;

class CommunityFeedController extends Controller
{
    public function Community(){
        return view('community', [
            'result' => CommunityFeed::OrderBy('User_Posted_Time', 'DESC')
            ->get(),
        ]);
    }

    public function CommunityData(Request $req){
        if(Auth::Check()){
            $req->validate([
                'nev' => 'required',
                'email' => 'required|email|unique:user,email',
                'message' => 'required|min:10|max:300'
            ],
            [
                'nev.required' => "A nevét kötelező megadni!",
                'email.required' => "Emailt kötelező megadni!",
                'email.email'   => "Valid email címet adjon meg!",
                'email.unique' => "Ez az email már foglalt!",
                'message.required' => "Üzenetet kötelező megadni!",
                'message.min'       => "Az üzenet minimum 10 karakter legyen!",
                'message.max'       => "Maximum 300 karakter lehet az üzenet!"
            ]);
            $data = new communityFeed;
            $data->User_Name = $req->nev;
            $data->User_Email = $req->email;
            $data->User_Message = $req->message;
            $data->Save();
            return redirect('/community')->with('success', 'A posztja kikerült a nagy világba.');
        } else{
            return redirect('/community')->withErrors(['sv', 'Ha szerente posztolni akkor '], ['link', 'jelentkezzen be '], ['sv2', 'vagy'], ['link2', ' regisztráljon!'] );
        }
    }

}
