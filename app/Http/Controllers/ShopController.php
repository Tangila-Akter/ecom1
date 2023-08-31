<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Shop::all();
        return view('admin.pages.shop.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop;

        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->email = $request->email;
        $shop->description = $request->description;
        $shop->website = $request->website;
        // save image
        if ($request->hasFile('logo')) {
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = time() . '_' . 'logo' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('logo')->storeAs('shop/image', $filename, 'public');
            $shop->logo = '/storage/' . $path;
        }
        $shop->save();

        if ($shop) {
            // return a success response back
            return redirect()->back()->with('success', 'about created successfully');
        } else {
            // return a error response back
            return redirect()->route('about.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $shop=DB::table('shops')
        // ->leftJoin('shops', 'id', '=', 'products.shop_id')
        // ->get();
        return $shop;
        return view('admin.pages.shop.show',compact("shop")); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop=Shop::find($id);
        return view('admin.pages.shop.edit',compact("shop"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = shop::find($request->id);
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->email = $request->email;
        $shop->description = $request->description;
        $shop->website = $request->website;
        
        // delete old image and upload new image
        if ($request->hasFile('logo')) {
            $old_image = public_path($shop->logo);
            File::delete($old_image);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = time() . '_' . 'shop' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('image')->storeAs('shop/image', $filename, 'public');
            $shop->logo = '/storage/' . $path;
        }

        $shop->save();
        return redirect()->route('shop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        
        if (public_path($shop->logo)) {
            unlink(public_path($shop->logo));
        }
        $shop->delete();
        return redirect()->back();
    }
}
