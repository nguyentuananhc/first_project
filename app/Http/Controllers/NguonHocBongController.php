<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Player;
use Illuminate\Http\Request;

class NguonHocBongController extends Controller
{
    private $player;

    public function __construct(Player $player){
        $this->player = $player;
    }

    public function getUser($id){
        return Player::find($id);
    }

    public function login(Request $request){
        $credentials = $request->only('phone_number', 'name');
        $player = Player::where('phone_number', '=', $credentials['phone_number'])->first();
        if ($player === null) {
            $player = $this->player->create([
                'name' => $credentials['name'],
                'phone_number' => $credentials['phone_number'],
                'score' => 0,
                'voucher_id' => 4,
            ]);
            return response()->json([
                'status'=> 200,
                'message'=> 'Login successfully',
                'data'=>$player
            ]);
        }
        return response()->json([
            'status'=> 200,
            'message'=> 'Login successfully',
            'data'=>$player
        ]);
    }

    public function updateScore(Request $request){
        $credentials = $request->only('id', 'score');

        $score = $credentials['score'];
        $voucher_id = 4;

        if ($score >=0 && $score <=199) {
            $voucher_id=1;
        } elseif ($score >=200 && $score <=249) {
            $voucher_id=2;
        } elseif ($score >=250 && $score <=300) {
            $voucher_id=3;
        }else {
            $voucher_id=3;
        }
        $player = Player::where('id', '=', $credentials['id'])->first();
        if ($player === null) {
            return response()->json([
                'status'=> 401,
                'message'=> 'Invalid User ID',
            ]);
        }
        Player::where('id', $credentials['id'])
          ->update([
              'score' => $credentials['score'],
              'voucher_id' => $voucher_id,
          ]);


        return response()->json([
            'status'=> 200,
            'message'=> 'Update Score successfully',
            'data'=>$player
        ]);
    }
}