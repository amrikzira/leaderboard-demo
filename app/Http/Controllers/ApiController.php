<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ApiController extends Controller
{
    public function getAllPlayers()
    {
        $players = DB::table('players')->select('id', 'name', 'points')->orderBy('points', 'desc')->get();
        return response()->json($players, 200);
    }

    public function createPlayer(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'age' => 'required',
            'address' => 'required',
        );

        // Validations to check if request is valid according to above rules
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // If request is valid, then save the data
        $player = new Player;
        $player->name = $request->name;
        $player->age = $request->age;
        $player->address = $request->address;

        if ($player->save()) {
            return response()->json([
                "message" => "Player record created.",
            ], 201);
        } else {
            return response()->json([
                "message" => "Unable to create player record.",
            ], 500);
        }
    }

    public function getPlayer($id)
    {
        if (Player::where('id', $id)->exists()) {
            $player = Player::where('id', $id)->select('name', 'age', 'points', 'address')->get();
            return response()->json($player, 200);
        } else {
            return response()->json([
                "message" => "Player not found.",
            ], 404);
        }
    }

    public function updatePlayer(Request $request)
    {
        if (Player::where('id', $request->id)->exists()) {
            $player = Player::find($request->id);
            if ($request->operationType == 'inc' or $request->operationType == 'dec') {

                $updateResults = $request->operationType == 'inc' ? DB::table('players')->where('id', '=', $request->id)->increment('points') : DB::table('players')->where('id', '=', $request->id)->decrement('points');

                if ($updateResults) {
                    return response()->json([
                        "message" => "Player record updated successfully.",
                    ], 200);
                } else {
                    return response()->json([
                        "message" => "Unable to update player record.",
                    ], 500);
                }
            } else {
                return response()->json([
                    "message" => "Incorrect operation type passed.",
                ], 400);
            }
        } else {
            return response()->json([
                "message" => "Player not found.",
            ], 404);
        }
    }

    public function deletePlayer(Request $request)
    {
        if (Player::where('id', $request->id)->exists()) {
            $player = Player::find($request->id);
            $player->delete();

            return response()->json([
                "message" => "Player has been deleted.",
            ], 202);
        } else {
            return response()->json([
                "message" => "Player not found.",
            ], 404);
        }
    }
}
