<?php

namespace Premialabs\Foundation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function resetPassword(Request $request)
    {
        $curr_pwd = $request->input('current_pwd');
        $new_pwd = $request->input('new_pwd');
        try {

            $user = auth()->user();
            if (Hash::check($curr_pwd, $user->password)) {
                $user->password = bcrypt($new_pwd);
                $user->save();
                return response()->json(["status" => "success"], 200);
            }
            throw new Exception("Current password is invalid");
        } catch (Exception $e) {
            throw $e;
        }
    }
}
