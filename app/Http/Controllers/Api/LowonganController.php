<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowongan = Lowongan::all();
        if (count($lowongan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $lowongan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
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
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'namaperusahaan' => 'required',
            'posisi' => 'required',
            'tanggalpenutupan' => 'required',
        ]);
        // $storeData = new Product();
        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $lowongan = Lowongan::create($storeData);
        return response([
            'message' => 'Tambah Lowongan Berhasil',
            'data' => $lowongan
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lowongan = Lowongan::find($id);

        if (!is_null($lowongan)) {
            return response([
                'message' => 'Berhasil Mendapatkan Data Lowongan',
                'data' => $lowongan
            ], 200);
        }

        return response([
            'message' => 'Data Lowongan Tidak Ditemukan',
            'data' => null
        ], 404);
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
        $lowongan = Lowongan::find($id);
        if (is_null($lowongan)) {
            return response([
                'message' => 'Data Lowongan Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'namaperusahaan' => 'required',
            'posisi' => 'required',
            'tanggalpenutupan' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $lowongan->namaperusahaan = $updateData['namaperusahaan'];
        $lowongan->posisi = $updateData['posisi'];
        $lowongan->tanggalpenutupan = $updateData['tanggalpenutupan'];


        if ($lowongan->save()) {
            return response([
                'message' => 'Data Lowongan Berhasil diUpdate',
                'data' => $lowongan
            ], 200);
        }

        return response([
            'message' => 'Data Lowongan Gagal diUpdate',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lowongan = Lowongan::find($id);

        if (is_null($lowongan)) {
            return response([
                'message' => 'Data Lowongan Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if ($lowongan->delete()) {
            return response([
                'message' => 'Hapus Data Lowongan Berhasil',
                'data' => $lowongan
            ], 200);
        }

        return response([
            'message' => 'Hapus Data Lowongan Tidak Berhasil',
            'data' => null
        ], 400);
    }
}
