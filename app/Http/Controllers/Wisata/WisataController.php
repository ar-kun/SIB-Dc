<?php

namespace App\Http\Controllers\Wisata;

use App\Http\Controllers\Controller;
use App\Http\Resources\WisataCollection;
use App\Models\Wisata\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\WisataResource;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wisata = Wisata::paginate(10);
        return new WisataCollection($wisata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subject' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['subject_id'] = $request->subject;
        $validatedData['slug'] = Str::slug($request->title, '-');
        Wisata::create($validatedData);

        return $validatedData;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Wisata $wisata)
    {
        return new WisataResource($wisata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wisata $wisata)
    {

        // update data
        $wisata->update([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject,
            'slug' => Str::slug($request->title, '-'),
        ]);

        return new WisataResource($wisata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisata)
    {
        // destroy data
        // $wisata->delete();
        // return response()->json([
        //     'message' => 'Wisata deleted successfully'
        // ], 200);

        // delete data
        $wisata->delete();
        return response()->json([
            'message' => 'Wisata deleted successfully'
        ], 200);
    }
}