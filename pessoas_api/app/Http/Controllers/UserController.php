<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Exception;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->only(['name','email','password']);

        try{
            $new_user = new User;
            $new_user->name = $fields['name'];
            $new_user->email = $fields['email'];
            $new_user->password = Hash::make($fields['password']);
            $new_user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Recorded',
                'error' => '', 
                'response' => ['new_user' => $new_user->name],
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error when Recording',
                'error' => $e->getMessage(), 
                'response' => ['error' => $e->getMessage()],
            ],422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::with(['adresses'])->find($id);

            if(empty($user)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['user not found'], 
                    'response' => ['error' => ['user not found']],
                ],422);
            }
            
            $user_name = $user->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Find',
                'error' => '', 
                'response' => ['user' => $user_name],
            ],200);
            
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error when Searching',
                'error' => $e->getMessage(), 
                'response' => ['error' => $e->getMessage()],
            ],422);
        }
        
    }

    /**
     * Display the all resource.
     */
    public function showAll()
    {
        $user = User::with(['adresses'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success in Searching',
            'error' => '', 
            'response' => ['users' => $user->toArray()],
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->only(['name','email','password']);

        try{
            $user = User::find($id);

            if(empty($user)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['user not found'], 
                    'response' => ['error' => ['user not found']],
                ],422);
            }

            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->password = Hash::make($fields['password']);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Update',
                'error' => '', 
                'response' => ['user_updated' => $user->toArray()],
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error when Updating',
                'error' => $e->getMessage(), 
                'response' => ['error' => $e->getMessage()],
            ],422);
        }
    }

    /**
     * Remove the specified resource from storage with soft delete.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);

            if(empty($user)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['user not found'], 
                    'response' => ['error' => ['user not found']],
                ],422);
            }

            $user_name = $user->name;
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Success when Deleting',
                'error' => '', 
                'response' => ['user_deleted' => $user_name],
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error when Deleting',
                'error' => $e->getMessage(), 
                'response' => ['error' => $e->getMessage()],
            ],422);
        }
    }
}
