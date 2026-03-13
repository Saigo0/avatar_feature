<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function edit(){
        $avatar = Avatar::firstOrCreate(
            ['user_id' => 1],
            ['features' => [
                'skin_color' => '#fcd5ce',
                'hair_style' => 'curly',
                'shirt_color' => '#000000'
            ]]
        );
        return view('avatar.edit', compact('avatar'));
    }

    public function update(Request $request){
        $avatar = Avatar::where('user_id', Auth::id());
        $avatar->features = $request->input('features');
        $avatar->save();

        return response()->json(['message' => 'Avatar atualizado!']);
    }
}
