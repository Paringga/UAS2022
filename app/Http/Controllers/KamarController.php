<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = Kamar::all();
        return $kamar; 

        return response()->json([
            "message" => "Load data success",
            "data" => $table
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table = Kamar::create([
            "no_kamar" => $request->no_kamar,
            "tipe_kamar" => $request->tipe_kamar,
            "harga" => $request->harga,
            "fasilitas" => $request->fasilitas
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Data berhasil disimpan',
            'data' => $table
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Kamar::create([
            "no_kamar" => $request->no_kamar,
            "tipe_kamar" => $request->tipe_kamar,
            "harga" => $request->harga,
            "fasilitas" => $request->fasilitas
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Data berhasil disimpan',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Kamar::find($id);
        if($table){
            return $table;        
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $kamar = kamar::find($id);
        if($kamar){
            $kamar->no_kamar = $request->no_kamar ? $request->no_kamar : $kamar->no_kamar;
            $kamar->tipe_kamar = $request->tipe_kamar ? $request->tipe_kamar : $kamar->tipe_kamar;
            $kamar->harga = $request->harga ? $request->harga : $kamar->harga;
            $kamar->fasilitas = $request->fasilitas ? $request->fasilitas : $kamar->fasilitas;
            $kamar->save();
            return response()->json([
                'status' => 200,
                'data' => $kamar
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Kamar::find($id);
        if($table){
            $table->delete();
            return ["message" => "Delete success"];
        }else{
            return ["message" => "Data not found"];
        }
    }
}
