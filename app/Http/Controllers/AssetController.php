<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Asset;
use App\Calibration;
use App\CategoryAsset;
use App\TypeAsset;
use App\LocationAsset;
use App\Bom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AssetController extends Controller
{
    public function index()
    {
        //
        $data['page_title'] = 'Asset';
        $data['page_titles'] = 'Calibration';
        $data['assets'] = Asset::all();
        $data['calibrations'] = Calibration::all();
        return view('settings.assets.index', $data);
    }
    public function create(Request $request)
    {
        $data['page_title'] = "Create Asset";
        $data['categorys'] = CategoryAsset::all();
        $data['locations'] = LocationAsset::all();
        $data['types'] = TypeAsset::all();
        $data['assets'] = Asset::get();
        $data['boms'] = Bom::all();
        $number = $data['assets']->count();
        $data['code'] = $this->generateCode($number);
        $data['parent']= $request->get('parent') ?? null;

        while (Asset::where('code', $data['code'])->get()->count() > 0) {
           $data['code'] = $this->generateCode($number++);
        }

        return view('settings.assets.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Asset";
        $data['assets'] = Asset::findOrFail($id);
        $data['assetss'] = Asset::all();
        $data['categorys'] = CategoryAsset::all();
        $data['locations'] = LocationAsset::all();
        $data['types'] = TypeAsset::all();
        $data['boms'] = Bom::all();

        return view('settings.assets.edit', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'code' => ['required', 'string', 'unique:asset,code'],
            'name' => ['required', 'string'],
            'purchase_at' => ['required'],
            'purchase_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['nullable'],
            'status' => ['required', 'in:true,false'],
            'model' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand' => ['required', 'string'],
            'category_id' => ['required'],
            'asset_part_of' => ['nullable'],
            'location_id' => ['required'],
            'type_id' => ['required'],
            'filename.*' => ['mimes:pdf,word,docx,ppt,pptx,csv,xlsx,jpeg,png,jpg,gif,svg', 'max:15000'],

        ]);


        try {
            $calibration_name = [];
            $data['code'] = $request->input('code');
            $data['name'] = $request->input('name');
            $data['purchase_at'] = $request->input('purchase_at');
            $data['purchase_price'] = $request->input('purchase_price');
            $data['description'] = $request->input('description') ?? "N/A";
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/images/asset');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $data['status'] = $request->input('status');
            $data['model'] = $request->input('model');
            $data['brand'] = $request->input('brand');
            $data['category_id'] = $request->input('category_id');
            $data['asset_part_of'] = ($request->get('asset_part_of')== 0 ? null : $request->get('asset_part_of'));
            $data['location_id'] = $request->input('location_id');
            $data['type_id'] = $request->input('type_id');

            $asset = Asset::create($data);
            $asset->boms()->attach($request->get('boms'));

            // Check
            if ($request->hasFile('filename')) {
                foreach ($request->file('filename') as $file) {
                    $name = $file->getClientOriginalName();

                    //Check Duplicate
                    $i = 1;
                    while (file_exists('backend/images/Calibrations' . $name)) {
                        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $file->getClientOriginalExtension;
                        $i++;
                    }
                    $destinationPath = public_path('backend/images/Calibrations');
                    $file->move($destinationPath, $name);

                    // set Calibration data
                    $calibration_name[] = [
                        'filename' => $name,
                        'asset_id' => $asset->id
                    ];
                }
                $asset->Calibration()->insert($calibration_name);
            }

            return redirect('settings/asset')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('settings/asset')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'code' => ['required', 'string', 'unique:asset,code,'.$id],
            'name' => ['required', 'string'],
            'purchase_at' => ['required'],
            'purchase_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['nullable'],
            'status' => ['required', 'in:true,false'],
            'model' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'category_id' => ['required'],
            'asset_part_of' => ['nullable'],
            'location_id' => ['required'],
            'type_id' => ['required'],
            'filename.*' => ['mimes:pdf,word,docx,ppt,pptx,csv,xlsx,jpeg,png,jpg,gif,svg', 'max:15000'],
        ]);

        try {
            $asset = Asset::findOrFail($id);
            $calibration_name = [];
            $data['code'] = $request->input('code');
            $data['name'] = $request->input('name');
            $data['purchase_at'] = $request->input('purchase_at');
            $data['purchase_price'] = $request->input('purchase_price');
            $data['description'] = $request->input('description') ?? "N/A";

            if ($request->hasFile('image')) {

                // Check Image
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                // Delete Img
                if ($asset->image) {
                    $image_path = public_path('backend/images/asset/'.$asset->image); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }

                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/images/asset');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }

            $data['status'] = $request->input('status');
            $data['model'] = $request->input('model');
            $data['brand'] = $request->input('brand');
            $data['category_id'] = $request->input('category_id');
            $data['asset_part_of'] = $request->input('asset_part_of') ?? null;
            $data['location_id'] = $request->input('location_id');
            $data['type_id'] = $request->input('type_id');

            $asset->update($data);
            $asset->boms()->sync($request->get('boms'));

            if ($request->has('calibration_id')) {
                $ids = $request->get('calibration_id');
                $asset_deletes = Calibration::where('asset_id', $asset->id)->whereNotIn('id', $ids)->get();
                foreach ($asset_deletes as $asset_delete) {
                    $file_path = public_path('backend/images/Calibrations' . $asset_delete->filename);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $asset_delete->delete();
                }
            }

            // Check Calbration Name
            if ($request->hasFile('filename')) {
                $z = 0;
                foreach ($request->file('filename') as $file) {
                    $name = $file->getClientOriginalName();

                    //Check Duplicate
                    $i = 1;
                    while (file_exists('backend/images/Calibrations' . $name)) {
                        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $file->getClientOriginalExtension;
                        $i++;
                    }
                    $destinationPath = public_path('backend/images/Calibrations');
                    $file->move($destinationPath, $name);

                    // set Calibration Data
                    $calibration_name[] = [
                        'filename' => $name,
                        'asset_id' => $asset->id
                    ];
                    $z++;
                }
                $asset->Calibration()->insert($calibration_name);
            }


            return redirect('settings/asset')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('settings/asset')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $data['page_title'] = 'Detail Asset';
        $data['assets'] = Asset::findOrFail($id);
        return view('settings.assets.show', $data);
    }

    public function getTree()
    {
        $assets = Asset::get();
        $tree = array();

        foreach ($assets as $asset) {
            if (isset($asset->parent->id)) {
                $parent = $asset->parent->id;
            } else {
                $parent = "#";
            }

            $selected = false;
            $opened = false;
            // if($asset->id == 2){
            // $selected = true;
            // $opened = true;
            // }

            $tree[] = array(
                "id" => $asset->id,
                "parent" => $parent,
                "text" => $asset->name . " (" . (isset($asset->type->name) ? $asset->type->name : '') . " - " . (isset($asset->category->name) ? $asset->category->name : '') . ")",
                "icon" => asset("backend/images/asset/".$asset->image ?? ''),
                'a_attr' => array(
                    'show' => "asset/detail/" . $asset->id,
                    'edit' => "asset/" . $asset->id . '/edit',
                    'create'  => "asset/create?parent=".$asset->id
                ),
                "state" => array("selected" => $selected, "opened" => $opened)
            );
        }

        return json_encode($tree);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            // Delete Asset Calibration
            $asset_calibrations = Calibration::where('asset_id', $id)->get();
            foreach ($asset_calibrations as $asset_calibration) {
                $file_path = public_path('backend/images/Calibrations/'.$asset_calibration->filename);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
                $asset_calibration->delete();
            }

            // Update Child
            Asset::where('asset_part_of', $id)->update(['asset_part_of' => null]);

            // Delete Asset
            $asset = Asset::findOrFail($id);
            if ($asset->image) {
                $image_path = public_path($asset->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $asset->boms()->detach();
            $asset->delete();
        });

        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }


    public function generateCode($number)
    {
        $char = 'A';
        $number = $number;

        // For adjust a character
        if ($number >= 98) {
            $plus = 0;
            while ($number - 100 >= 0) {
                $plus++;
                $number -= 100;
            }
            $number++;
            // For make a code no more than 2 digits
            if (strlen($number) > 2) {
                $number--;
            }

            for ($z=0; $z < $plus; $z++) {
                $char++;
            }
        } else {
            $number++;
        }

        return "#$char".sprintf("%02s", $number);
    }
}


