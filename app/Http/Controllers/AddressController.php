<?php

namespace App\Http\Controllers;

use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }

    public function show(Address $address)
    {
        return $address;
    }


    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json();
    }
}
