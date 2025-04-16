<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\game_mode;
use App\Models\Player;
use App\Models\UserBadge;
use App\Models\TotalPoints;

class GamesController extends Controller
{


    public function gamesMode(){
        {
            return view('gamesMode');

        }
    }


    public function memorygame(){
        if(Auth::check()){
            return view('memorygame');

        }else{
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }
    }

    public function memorygameDATA(Request $request)
{

    if(Auth::check()){
        $user = Auth::user();

        $data = new Player();
        $data->User_Id = auth()->id();
        $data->Player_Username = $user->username;
        $data->Player_Points = $request->points;
        $data->Played_Game_Name = "Memória Játék";
        $data->save();

        $totalPoints = TotalPoints::firstOrNew(['User_Id' => auth()->id()]);

        $totalPoints->username = $user->username;
        $totalPoints->Total_Points += $request->points;
        $totalPoints->save();


        $requiredGames = ["Memória Játék", "Quiz Játék", "Wordle játék", "2048"];

        $count = Player::where('User_Id', auth()->id())
                     ->whereIn('Played_Game_Name', $requiredGames)
                     ->distinct('Played_Game_Name')
                     ->count();


                     if($count == 4){
                        $count == true;
                     }
                     else{
                        $count == false;
                     }

        $existingBadge = UserBadge::where('User_Id', auth()->id())
        ->where('Badges_Id', 5)
        ->exists();


        $letezobadge = UserBadge::where('User_Id', auth()->id())
                                ->where('Badges_Id', 2)
                                ->exists();

        if(!$letezobadge){
            $data = new UserBadge;
            $data->User_Id = auth()->id();
            $data->Badges_Id = 2;
            $data->Achieved_At = now();
            $data->Save();
            return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
        }
        elseif($count == true && $letezobadge && !$existingBadge) {
            $data = new UserBadge;
            $data->User_Id = auth()->id();
            $data->Badges_Id = 5;
            $data->Achieved_At = now();
            $data->Save();
            return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
        }

        else{
            return redirect('/profil')->with('success', 'Sikeresen lementetted a jatekodat!');
        }
    } else{
        return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');

    }






}



    public function quizgame(){

        if(Auth::check()){
            return view('quizgame', [
                'top'   => Player::select('Player_Username', 'Player_Points', 'users.user_profile_picture', 'users.User_Id')
                                ->join('users', 'users.User_Id', 'player.User_Id')
                                ->where('Played_Game_Name', 'Quiz Játék')
                                ->orderBy('Player_Points', 'DESC')
                                ->get()
                                ->map(function ($item, $key) {
                                    $item->position = $key + 1;
                                    return $item; }),
                'ownbest' => Player::select('Player_Points')
                                    ->where('User_Id', auth()->id())
                                    ->orderBy('Player_Points', 'DESC')
                                    ->limit(1)
                                    ->get()

            ]);
        } else{
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }

    }

    public function quizgameDATA(Request $request){

        if(Auth::check()){
            $user = Auth::user();

            $data = new Player();
            $data->User_Id = auth()->id();
            $data->Player_Username = $user->username;
            $data->Player_Points = $request->points;
            $data->Played_Game_Name = "Quiz Játék";
            $data->save();

            $totalPoints = TotalPoints::firstOrNew(['User_Id' => auth()->id()]);

            $totalPoints->username = $user->username;
            $totalPoints->Total_Points += $request->points;
            $totalPoints->save();

            $requiredGames = ["Memória Játék", "Quiz Játék", "Wordle játék", "2048"];

            $count = Player::where('User_Id', auth()->id())
                         ->whereIn('Played_Game_Name', $requiredGames)
                         ->distinct('Played_Game_Name')
                         ->count();


                         if($count == 4){
                            $count == true;
                         }
                         else{
                            $count == false;
                         }

            $existingBadge = UserBadge::where('User_Id', auth()->id())
            ->where('Badges_Id', 5)
            ->exists();


            $letezobadge = UserBadge::where('User_Id', auth()->id())
                                    ->where('Badges_Id', 2)
                                    ->exists();

            if(!$letezobadge){
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 2;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }
            elseif($count == true && $letezobadge && !$existingBadge) {
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 5;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }

            else{
                return redirect('/profil')->with('success', 'Sikeresen lementetted a jatekodat!');
            }
        } else {
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }

}


    public function wordlegame(){

        if(Auth::check()){
            return view('wordlegame');
        }
         else {
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
         }


    }

    public function wordlegameDATA(Request $request){

        if(Auth::check()){
            $user = Auth::user();

            $data = new Player();
            $data->User_Id = auth()->id();
            $data->Player_Username = $user->username;
            $data->Player_Points = $request->points;
            $data->Played_Game_Name = "Wordle játék";
            $data->save();




            $totalPoints = TotalPoints::firstOrNew(['User_Id' => auth()->id()]);
            $totalPoints->username = $user->username;
            $totalPoints->Total_Points += $request->points;
            $totalPoints->save();





            $requiredGames = ["Memória Játék", "Quiz Játék", "Wordle játék", "2048"];

            $count = Player::where('User_Id', auth()->id())
                         ->whereIn('Played_Game_Name', $requiredGames)
                         ->distinct('Played_Game_Name')
                         ->count();


                         if($count == 4){
                            $count == true;
                         }
                         else{
                            $count == false;
                         }

            $existingBadge = UserBadge::where('User_Id', auth()->id())
            ->where('Badges_Id', 5)
            ->exists();


            $letezobadge = UserBadge::where('User_Id', auth()->id())
                                    ->where('Badges_Id', 2)
                                    ->exists();

            if(!$letezobadge){
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 2;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }
            elseif($count == true && $letezobadge && !$existingBadge) {
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 5;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }

            else{
                return redirect('/profil')->with('success', 'Sikeresen lementetted a jatekodat!');
            }
        } else{
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }

    }




    public function husznegyvennyolc(){

        if(Auth::check()){
            return view('husznegyvennyolc');

        } else{
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }
    }


    public function husznegyvennyolcDATA(Request $request){

        if(Auth::check()){
            $user = Auth::user();

            $data = new Player();
            $data->User_Id = auth()->id();
            $data->Player_Username = $user->username;
            $data->Player_Points = $request->score;
            $data->Played_Game_Name = "2048";
            $data->save();

            $totalPoints = TotalPoints::firstOrNew(['User_Id' => auth()->id()]);

            $totalPoints->username = $user->username;
            $totalPoints->Total_Points += $request->score;
            $totalPoints->save();

            $requiredGames = ["Memória Játék", "Quiz Játék", "Wordle játék", "2048"];

            $count = Player::where('User_Id', auth()->id())
                         ->whereIn('Played_Game_Name', $requiredGames)
                         ->distinct('Played_Game_Name')
                         ->count();


                         if($count == 4){
                            $count == true;
                         }
                         else{
                            $count == false;
                         }

            $existingBadge = UserBadge::where('User_Id', auth()->id())
            ->where('Badges_Id', 5)
            ->exists();


            $letezobadge = UserBadge::where('User_Id', auth()->id())
                                    ->where('Badges_Id', 2)
                                    ->exists();

            if(!$letezobadge){
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 2;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }
            elseif($count == true && $letezobadge && !$existingBadge) {
                $data = new UserBadge;
                $data->User_Id = auth()->id();
                $data->Badges_Id = 5;
                $data->Achieved_At = now();
                $data->Save();
                return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
            }

            else{
                return redirect('/profil')->with('success', 'Sikeresen lementetted a jatekodat!');
            }
        } else{
            return redirect('/login')->with('error', 'Az oldal eléréséhez be kell jelentkeznie!');
        }

    }


}
