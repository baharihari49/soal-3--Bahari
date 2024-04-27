<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("home.index", [
            'dataProducts' => Products::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'code' => 'required|string',
             'name' => 'required|string|min:3|max:255',
             'category' => 'required|string',
             'stok' => 'required|integer',
             'price' => 'required|numeric',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);

         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
         }

         // Validasi berhasil, lanjutkan dengan proses penyimpanan data
         $imageName = $request->file('image')->store('public/images');

         // Simpan data ke dalam database
         Products::create([
             'code' => $request->code,
             'name' => $request->name,
             'category' => $request->category,
             'stok' => $request->stok,
             'price' => $request->price,
             'image' => basename($imageName),
             'user_id' => Auth::id()
         ]);

         return redirect('/');
     }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view("home.components.show", [
            'data' => Products::where("user_id", Auth::id())->where('id', $id)->get()[0]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
{
    $validator = Validator::make(Request()->all(), [
        'name' => 'required|string|min:3|max:255',
        'category' => 'required|string',
        'stok' => 'required|integer',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        dd($validator->errors()->all(), Request()->all());
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Dapatkan data produk yang sesuai dengan ID
    $product = Products::findOrFail($id);

    // Periksa apakah ada permintaan untuk memperbarui bidang 'code'
    if (Request()->has('code')) {
        $product->code = Request()->code;
    }

    // Periksa apakah ada permintaan untuk memperbarui bidang 'image'
    if (Request()->hasFile('image')) {
        // Hapus gambar lama jika ada sebelum menyimpan gambar baru
        Storage::delete('public/images/' . $product->image);

        // Simpan gambar baru
        $imageName = time() . '.' . Request()->file('image')->getClientOriginalExtension();
        Request()->file('image')->storeAs('public/images', $imageName);

        $product->image = $imageName;

    }

    // Update data produk (termasuk bidang lainnya)
    $product->name = Request()->name;
    $product->category = Request()->category;
    $product->stok = Request()->stok;
    $product->price = Request()->price;
    $product->save();

    return redirect('/'); // Redirect to product list page
}



    public function destroy($id)
    {
        // Hapus data produk
        Products::destroy($id);

        return redirect('/');
        // Redirect atau response sesuai kebutuhan Anda
    }

}
