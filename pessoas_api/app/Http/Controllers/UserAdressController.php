<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\UserAddress;

use Exception;

class UserAdressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->only(['street','district','postal_code','number','user_city_id','user_state_id','user_id']);

        try{
            $new_address = new UserAddress;
            $new_address->street = $fields['street'];
            $new_address->district = $fields['district'];
            $new_address->postal_code = $fields['postal_code'];
            $new_address->number = $fields['number'];
            $new_address->user_city_id = $fields['user_city_id'];
            $new_address->user_state_id = $fields['user_state_id'];
            $new_address->user_id = $fields['user_id'];
            $new_address->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Recorded',
                'error' => '', 
                'response' => ['new_address' => $new_address->street],
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
            $adress = UserAddress::with(['user','city','state'])->find($id);

            if(empty($adress)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['adress not found'], 
                    'response' => ['error' => ['Adress not found']],
                ],422);
            }
            
            $adress_name = $adress->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Find',
                'error' => '', 
                'response' => ['user' => $adress_name],
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
        $adresses = UserAddress::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Success in Searching',
            'error' => '', 
            'response' => ['users' => $adresses->toArray()],
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->only(['street','district','postal_code','number','user_city_id','user_state_id','user_id']);

        try{
            $adress = UserAddress::find($id);

            if(empty($adress)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['adress not found'], 
                    'response' => ['error' => ['adress not found']],
                ],422);
            }

            $adress->street = $fields['street'];
            $adress->district = $fields['district'];
            $adress->postal_code = $fields['postal_code'];
            $adress->number = $fields['number'];
            $adress->user_city_id = $fields['user_city_id'];
            $adress->user_state_id = $fields['user_state_id'];
            $adress->user_id = $fields['user_id'];
            $adress->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Success to Update',
                'error' => '', 
                'response' => ['adress_updated' => $adress->toArray()],
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
            $adress = UserAddress::find($id);

            if(empty($adress)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error when Searching',
                    'error' => ['user not found'], 
                    'response' => ['error' => ['user not found']],
                ],422);
            }
            
            $adress_name = $adress->street;
            $adress->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Success when Deleting',
                'error' => '', 
                'response' => ['adress_deleted' => $adress_name],
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
