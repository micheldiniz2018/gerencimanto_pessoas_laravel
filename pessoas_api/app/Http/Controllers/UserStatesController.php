<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserState;

use Exception;

class UserStatesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->only(['name']);

        try{
            $new_state = new UserState;
            $new_state->name = $fields['name'];
            $new_state->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Recorded',
                'error' => '', 
                'response' => ['new_state' => $new_state->name],
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
            $state = UserState::find($id);

            if(empty($state)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['state not found'], 
                    'response' => ['error' => ['state not found']],
                ],422);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Find',
                'error' => '', 
                'response' => ['state' => $state->toArray()],
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
        $state = UserState::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Success in Searching',
            'error' => '', 
            'response' => ['states' => $state->toArray()],
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->only(['name']);

        try{
            $state = UserState::find($id);

            if(empty($state)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['state not found'], 
                    'response' => ['error' => ['state not found']],
                ],422);
            }
            
            $state->name = $fields['name'];
            $state->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Update',
                'error' => '', 
                'response' => ['state_updated' => $state->toArray()],
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
            $state = UserState::find($id);

            if(empty($state)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['state not found'], 
                    'response' => ['error' => ['state not found']],
                ],422);
            }

            $state_name = $state->name;
            $state->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Success when Deleting',
                'error' => '', 
                'response' => ['state_deleted' => $state_name],
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
