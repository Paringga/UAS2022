<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::get();

        if (count($transaksi) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'data berhasil ditunjukan',
                'data' => $transaksi
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'belum ada data yang tersedia'
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
        $validator = Validator::make($request->all(), [
            'id_transaksi' => ['required','numeric'],
            'id_tamu' => ['required','numeric'],
            'no_kamar' => ['required','numeric'],
            'tipe_kamar' => ['required','string','max:255'],
            'kode_pembayaran' => ['required','numeric'],
            'tanggal_pemesanan' => ['required','string','max:255','date_format:Y-m-d'],
            //'tanggal_pembayaran' => ['required','string','max:255','date_format:Y-m-d'],
            'tanggal_cekout' => ['required','string','max:255','date_format:Y-m-d'],
            //'metode_pembayaran' => ['required','string','max:255'],
            'total_harga' => ['required','numeric']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'data tidak valid dengan validasi kita',
                'data' => $validator->errors()
            ], 422);
        }

        $transaksi = Transaksi::create($validator->getData());

        return response()->json([
            'success' => 201,
            'message' => 'Data berhasil disimpan',
            'data' => $transaksi
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
        $transaksi = transaksi::find($id);

        if ($transaksi) {
            return response()->json([
                'status' => 200,
                'data' => $transaksi
            ], 200);
        }
        
        return response()->json([
            'status' => 404,
            'message' => 'id atas' .$id . 'tidak ditemukan'
        ], 404);
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
        $validator = Validator::make($request->all(), [
            'id_transaksi' => ['nullable','numeric'],
            'id_tamu' => ['nullable','numeric'],
            'no_kamar' => ['nullable','numeric'],
            'tipe_kamar' => ['nullable','string','max:255'],
            'kode_pembayaran' => ['nullable','numeric'],
            'tanggal_pemesanan' => ['nullable','string','max:255','date_format:Y-m-d'],
           //'tanggal_pembayaran' => ['nullable','string','max:255','date_format:Y-m-d'],
            'tanggal_cekout' => ['nullable','string','max:255','date_format:Y-m-d'],
           // 'metode_pembayaran' => ['nullable','string','max:255'],
            'total_harga' => ['nullable','numeric']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'data tidak valid dengan validasi',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $transaksi = transaksi::find($id);
            $transaksi->update($validator->getData());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'server error',
                'data' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 202,
            'message' => 'data berhasil di ubah',
            'data' => $transaksi
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();

        $transaksi = Transaksi::get();

        if (count($transaksi) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'data berhasil ditunjukan',
                'data' => $transaksi
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'data berhasil di hapus',
            'data' => 'belum ada data yang tersedia'
        ]);
    }
}
