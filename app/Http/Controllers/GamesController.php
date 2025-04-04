<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\game_mode;
use App\Models\Player;
use App\Models\UserBadge;

class GamesController extends Controller
{
    public function gamesMode(){
        if(Auth::check()){
            return view('gamesMode', [
                'solo'              => game_mode::select('Game_Mode')
                                    ->where('Game_Mode_Id', 1)
                                    ->first(),
                'solotext'          => game_mode::select('Game_Mode_Info')
                                    ->where('Game_Mode_Id', 1)
                                    ->first(),
                'multi'              => game_mode::select('Game_Mode')
                                    ->where('Game_Mode_Id', 2)
                                    ->first(),
                'multiinfo'          => game_mode::select('Game_Mode_Info')
                                    ->where('Game_Mode_Id', 2)
                                    ->first(),
            ]);



        }else{
            return view('login')->with('error', 'A kért oldal eléréshez jelentkezzen be!');
        }
    }

    public function solo(){
        return view('solo');
    }

    public function memorygame(){
        return view('memorygame');
    }

    public function memorygameDATA(Request $request)
{

    $user = Auth::user();

    $data = new Player();
    $data->User_Id = auth()->id();
    $data->Player_Username = $user->username;
    $data->Player_Points = $request->points;
    $data->Played_Game_Name = "Memória Játék";
    $data->save();

    $data = new UserBadge;
    $data->User_Id = auth()->id();
    $data->Badges_Id = 2;
    $data->Achieved_At = now();
    $data->Save();



    return redirect('/profil')->with('success', 'Sikeresen lementetted a jatekodat!');
}

}
