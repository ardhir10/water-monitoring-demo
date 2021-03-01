<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asset;
use App\LocationAsset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LocationAssetController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Location Assets';
        $data['locations'] = LocationAsset::all();
        return view('settings.assets.locationAsset.index', $data);
    }
    public function create()
    {
        $data['page_title'] = "Create Location";

        return view('settings.assets.locationAsset.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Location";
        $data['locations'] = LocationAsset::find($id);
        return view('settings.assets.locationAsset.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'country' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'min:5'],
            'postal_code' => ['required','numeric'],
            'longtitude' => ['nullable', 'numeric'],
            'latitude' => ['nullable', 'numeric'],

        ]);


        try {
            $location = new LocationAsset();
            $location->country = $request->input('country');
            $location->province = $request->input('province');
            $location->city = $request->input('city');
            $location->address = $request->input('address');
            $location->postal_code = $request->input('postal_code');
            $location->longtitude = $request->input('longtitude');
            $location->latitude = $request->input('latitude');

            $location->save();

            return redirect('settings/asset/location')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/location')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'country' => ['required', "unique:location_asset,country,$id"],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'min:5'],
            'postal_code' => ['required','numeric'],
            'longtitude' => ['nullable', 'numeric'],
            'latitude' => ['nullable', 'numeric'],
        ]);

        try {
            $location = LocationAsset::findOrFail($id);
            $location->country = $request->input('country');
            $location->province = $request->input('province');
            $location->city = $request->input('city');
            $location->address = $request->input('address');
            $location->postal_code = $request->input('postal_code');
            $location->longtitude = $request->input('longtitude');
            $location->latitude = $request->input('latitude');
            $location->save();
            return redirect('settings/asset/location')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/location')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $data['page_title'] = 'Detail Location';
        $data['location'] = LocationAsset::findOrFail($id);
        return view('settings.assets.locationAsset.show', $data);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            Asset::where('location_id', $id)->update(['location_id' => null]);
            LocationAsset::where('id', $id)->delete();
        });

        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
