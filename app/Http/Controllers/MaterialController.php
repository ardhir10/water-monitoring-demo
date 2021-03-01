<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;
use App\TypeAsset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Material';
        $data['materials'] = Material::all();
        return view('settings.assets.material.index', $data);
    }
    public function create()
    {
        $data['page_title'] = "Create Asset";
        $data['materials'] = Material::all();
        $data['types'] = TypeAsset::all();

        return view('settings.assets.material.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Asset";
        $data['materials'] = Material::findOrFail($id);
        $data['types'] = TypeAsset::all();

        return view('settings.assets.material.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string'],
            'purchase_at' => ['required'],
            'purchase_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['nullable'],
            'model' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'type_id' => [],

        ]);

        try {
            $material = new Material();
            $material->name = $request->input('name');
            $material->purchase_at = $request->input('purchase_at');
            $material->purchase_price = $request->input('purchase_price');
            $material->description = $request->input('description') ?? "";
            $material->model = $request->input('model');
            $material->brand = $request->input('brand');
            $material->type_id = $request->input('type_id');

            $material->save();

            return redirect('settings/asset/material')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/material')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:material,name,'.$id],
            'purchase_at' => ['required'],
            'purchase_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['nullable', 'min:5'],
            'model' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'type_id' => [],
        ]);

        try {
            $material = Material::findOrFail($id);
            $material->name = $request->input('name');
            $material->purchase_at = $request->input('purchase_at');
            $material->purchase_price = $request->input('purchase_price');
            $material->description = $request->input('description') ?? "";
            $material->model = $request->input('model');
            $material->brand = $request->input('brand');
            $material->type_id = $request->input('type_id');

            $material->save();

            return redirect('settings/asset/material')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('settings/asset/material')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    // public function show($id)
    // {
    //     $data['page_title'] = 'Detail Asset';
    //     $data['materials'] = Material::findOrFail($id);
    //     return view('settings.assets.show', $data);
    // }

    

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            Material::where('id', $id)->delete();
        });
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
