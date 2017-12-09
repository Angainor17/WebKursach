<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function getView()
    {
        $user = Auth::user();

        return view(
            "client.account",
            [
                "trainingSchedule" => $user->trainingSchedule,
                "age" => $user->age,
                "gender" => $user->gender,
                "weight" => $user->weight,
                "trainingType" => $user->trainingType,
                "bodyType" => $user->body_type,
                "name" => $user->name,
                "email" => $user->email,
            ]
        );
    }

    public function refreshData(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->weight = $request->weight;
        $user->email = $request->email;
        $user->trainingType = $request->trainingType;
        $user->trainingSchedule = $request->trainingSchedule;
        $user->body_type = $request->bodyType;
        $user->age = $request->age;

        $user->save();
    }
}
