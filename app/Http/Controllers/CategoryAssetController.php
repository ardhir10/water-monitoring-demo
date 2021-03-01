<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asset;
use App\CategoryAsset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryAssetController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Category Assets';
        $data['categorys'] = CategoryAsset::all();
        return view('settings.assets.categoryAsset.index', $data);
    }
    public function create()
    {
        $data['page_title'] = "Create Category";

        return view('settings.assets.categoryAsset.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Category";
        $data['categorys'] = CategoryAsset::find($id);
        return view('settings.assets.categoryAsset.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required','string'],
            'description' => ['nullable'],
        ]);


        try {
            $category = new CategoryAsset();
            $category->name = $request->input('name');
            $category->description = $request->input('description') ?? "N/A";
            $category->save();

            return redirect('settings/asset/category')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {

            return redirect('settings/asset/category')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required','string', "unique:category_asset,name,$id"],
            'description' => ['nullable', 'min:5'],
        ]);

        try {
            $category = CategoryAsset::findOrFail($id);
            $category->name = $request->input('name');
            $category->description = $request->input('description') ?? "N/A";
            $category->save();
            return redirect('settings/asset/category')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/category')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            Asset::where('category_id', $id)->update(['category_id' => null]);
            CategoryAsset::where('id', $id)->delete();
        });

        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
