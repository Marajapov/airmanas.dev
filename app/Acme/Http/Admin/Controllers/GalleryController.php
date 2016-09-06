<?php
namespace Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Model\Gallery\ModelName as Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        return view('Admin::gallery.index', [
            'galleries' => $galleries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flats = Flat::where('status','<>','deleted')->orderBy('id','desc')->list('name','id')->toArray();
        return view('Admin::gallery.create', [
            'gallery'  => new Gallery,
            'flats' => $flats,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $gallery = Gallery::create($request->except('q'));
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gallery)
    {
        return view('Admin::gallery.show', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('Admin::gallery.edit', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update($request->except('q'));
        return redirect()->route('admin.gallery.show', $gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Soft delete function
    public function softDelete(Request $request, $id)
    {
        $gallery = Gallery::where('id','=',$id)->first();
        $gallery->delete();
        return redirect()->route('admin.gallery.index');
    }
}
