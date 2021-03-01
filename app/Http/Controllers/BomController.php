<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bom;
use App\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BomController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Bill Of Material';
        // $data['materials'] = Material::all();
        $data['boms'] = Bom::all();
        return view('settings.assets.bom.index', $data);
    }
    public function create()
    {
        $data['page_title'] = "Create Boms";
        $data['materials'] = Material::all();

        return view('settings.assets.bom.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Boms";
        $data['boms'] = Bom::findOrFail($id);
        $data['materials'] = Material::all();

        return view('settings.assets.bom.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'bom_name' => ['required','string'],
            'description' => ['nullable', 'string'],

        ]);


        try {
            $bom = new Bom();
            $bom->bom_name = $request->input('bom_name');
            $bom->description = $request->input('description') ?? "N/A";
            $bom->save();
            $bom->materials()->attach($request->get('materials'));

            return redirect('settings/asset/bom')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('settings/asset/bom')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'bom_name' => ['required','string', "unique:bom,bom_name,$id"],
            'description' => ['nullable', 'string'],
        ]);

        try {
            $bom = Bom::findOrFail($id);
            $bom->bom_name = $request->input('bom_name');
            $bom->description = $request->input('description') ?? "N/A";
            $bom->save();
            $bom->materials()->sync($request->get('materials'));

            return redirect('settings/asset/bom')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/asset/bom')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $data['boms'] = Bom::findOrFail($id);
        return view('settings.assets.bom.show', $data);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $bom = Bom::findOrFail($id);
            $bom->materials()->detacch();
            $bom->delete();
        });
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
