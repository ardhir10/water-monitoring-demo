<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Controllers\Controller;
use App\TypeAsset;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TypeAssetController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Type Assets';
        $data['types'] = TypeAsset::all();
        return view('settings.assets.typeAsset.index', $data);
    }
    public function create()
    {
        $data['page_title'] = "Create Type";

        return view('settings.assets.typeAsset.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Type";
        $data['type'] = TypeAsset::find($id);
        return view('settings.assets.typeAsset.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        try {
            $type = new TypeAsset();
            $type->name = $request->input('name');
            $type->description = $request->input('description') ?? "N/A";
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/images/type');
                $image->move($destinationPath, $name);
                $type->image = $name;
            }
            $type->save();

            return redirect('settings/asset/type')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/type')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', "unique:type_asset,name,$id"]
        ]);

        try {
            $type = TypeAsset::findOrFail($id);
            $type->name = $request->input('name');
            $type->description = $request->input('description') ?? "N/A";
            if ($request->hasFile('image')) {
                // Check Image
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                // Delete Img
                if ($type->image) {
                    $image_path = public_path('backend/images/type/' . $type->image); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }

                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/images/type');
                $image->move($destinationPath, $name);
                $type->image = $name;
            }
            dd($type);
            $type->save();
            return redirect('settings/asset/type')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/type')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $type = TypeAsset::where('id', $id)->first();

            if ($type->image) {
                $image_path = public_path($type->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            Asset::where('type_id', $id)->update(['type_id' => null]);
            $type->delete();
        });

        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
