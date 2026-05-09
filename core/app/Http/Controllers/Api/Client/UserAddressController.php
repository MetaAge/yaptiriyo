<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('sanctum')->id();
        $addresses = UserAddress::with(['country', 'state', 'city'])
            ->where('user_id', $user_id)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'addresses' => $addresses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'address_details' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'is_default' => 'nullable|boolean',
        ]);

        $user_id = Auth::guard('sanctum')->id();

        if ($request->is_default) {
            UserAddress::where('user_id', $user_id)->update(['is_default' => false]);
        }

        $address = UserAddress::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'address_details' => $request->address_details,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'is_default' => $request->is_default ?? false,
        ]);

        return response()->json([
            'msg' => __('Address added successfully'),
            'address' => $address,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'address_details' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'is_default' => 'nullable|boolean',
        ]);

        $user_id = Auth::guard('sanctum')->id();
        $address = UserAddress::where('user_id', $user_id)->findOrFail($id);

        if ($request->is_default) {
            UserAddress::where('user_id', $user_id)->update(['is_default' => false]);
        }

        $address->update([
            'name' => $request->name,
            'address_details' => $request->address_details,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'is_default' => $request->is_default ?? false,
        ]);

        return response()->json([
            'msg' => __('Address updated successfully'),
            'address' => $address,
        ]);
    }

    public function destroy($id)
    {
        $user_id = Auth::guard('sanctum')->id();
        $address = UserAddress::where('user_id', $user_id)->findOrFail($id);
        $address->delete();

        return response()->json([
            'msg' => __('Address deleted successfully'),
        ]);
    }

    public function make_default($id)
    {
        $user_id = Auth::guard('sanctum')->id();
        UserAddress::where('user_id', $user_id)->update(['is_default' => false]);
        
        $address = UserAddress::where('user_id', $user_id)->findOrFail($id);
        $address->update(['is_default' => true]);

        return response()->json([
            'msg' => __('Default address updated'),
        ]);
    }
}
