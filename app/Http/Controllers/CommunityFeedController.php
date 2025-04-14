<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityFeed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Reviews;

class CommunityFeedController extends Controller
{
    public function Community(){
        return view('community', [
            'result' => Reviews::with('user')
            ->OrderBy('User_Posted_Time', 'DESC')
            ->get(),
        ]);
    }

    public function CommunityData(Request $req){
        if(Auth::Check()){
            $req->validate([
                'message' => 'required|min:5|max:300',
                'game' => 'required'
            ], [

                'message.required' => "Üzenetet kötelező megadni!",
                'message.min'       => "Az üzenet minimum 10 karakter legyen!",
                'message.max'       => "Maximum 300 karakter lehet az üzenet!",
                'game.required' => "Válassz ki egy játékot!"
            ]);
            $data = new Reviews;
            $data->Games_Review_User_Id = auth()->id();
            $data->Games_Review_User = auth()->user()->username;
            $data->Game_Review_Name = $req->input('game');
            $data->Games_Review_Text = $req->input('message');
            $data->Games_Review = $req->input('range');
            $data->User_Posted_Time = now();
            $data->save();

            return redirect('/community')->with('success', 'A posztja kikerült a nagy világba.');
        } else{
            return redirect('/community');
        }
    }






}
