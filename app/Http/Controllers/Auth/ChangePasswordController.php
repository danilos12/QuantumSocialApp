<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class ChangePasswordController extends Controller
{
    //
    public function updatePassword(Request $request)
    {        
        {                        
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|string|min:8',
            ]);
    
            // Check if the validation fails
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'stat' => 'danger', 'status' => 422]);
            }
          
            if (Auth::guard('web')->check()) {
                // Retrieve the authenticated user
                $user = Auth::user();
            } else {
                $user = Auth::guard('member')->user();
            }
                
            // Check if the old password matches the user's current password
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['message' => 'The provided old password is incorrect.', 'stat' => 'danger', 'status' => 422]);
            }

    
            // Update the user's password with the new password
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            // Return a success response
            return response()->json(['message' => 'Password changed successfully.', 'stat' => 'success', 'status' => 200]);
        }
    }
}
