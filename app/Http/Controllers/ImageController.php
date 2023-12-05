<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $image = Image::when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(5);

        return view('image.index', compact('image'));
    }

    public function create()
    {
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $request->validate([
            //
        ]);

        Image::create($request->all());

        return redirect()->route('image.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view('image.show',compact('image'));
    }

    public function edit(Image $image)
    {
        return view('image.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $request->validate([
            //
        ]);

        $image->update($request->all());

        return redirect()->route('image.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return redirect()->route('image.index')->with('success','Data berhasil dihapus.');
    }
}
