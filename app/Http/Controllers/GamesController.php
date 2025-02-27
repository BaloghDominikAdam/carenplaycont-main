<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\game_mode;

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
}
