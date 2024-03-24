<?php

namespace App\Http\Controllers;

use App\Models\UserCity;

use Illuminate\Http\Request;

use Exception;

class UserCitiesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->only(['name']);

        try{
            $new_city = new UserCity;
            $new_city->name = $fields['name'];
            $new_city->save();

            return response()->json([
                'status' => 'sucess',
                'message' => 'Successfully Recorded',
                'error' => '', 
                'response' => ['new_city' => $new_city->name],
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
            $city = UserCity::find($id);


            if(empty($city)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['city not found'], 
                    'response' => ['error' => ['city not found']],
                ],422);
            }

            return response()->json([
                'status' => 'sucess',
                'message' => 'Success to Find',
                'error' => '', 
                'response' => ['city' => $city->toArray()],
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
        $city = UserCity::all();

        return response()->json([
            'status' => 'sucess',
            'message' => 'Success in Searching',
            'error' => '', 
            'response' => ['cities' => $city->toArray()],
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->only(['name']);

        try{
            $city = UserCity::find($id);

            if(empty($city)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['city not found'], 
                    'response' => ['error' => ['city not found']],
                ],422);
            }

            $city->name = $fields['name'];
            $city->save();

            return response()->json([
                'status' => 'sucess',
                'message' => 'Success to Update',
                'error' => '', 
                'response' => ['city_updated' => $city->toArray()],
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $city = UserCity::find($id);

            if(empty($city)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['city not found'], 
                    'response' => ['error' => ['city not found']],
                ],422);
            }

            $city_name = $city->name;
            $city->delete();

            return response()->json([
                'status' => 'sucess',
                'message' => 'Success when Deleting',
                'error' => '', 
                'response' => ['city_deleted' => $city_name],
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
