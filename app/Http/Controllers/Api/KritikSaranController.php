<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\KritikSaran;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kritikSaran = KritikSaran::all();
        if (count($kritikSaran) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kritikSaran
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
            'judul' => 'required',
            'content' => 'required|max:255',
        ]);
        // $storeData = new Product();
        if ($validate->fails())
            return response(['message' => $validate->errors()->first()], 400);

        $kritikSaran = KritikSaran::create($storeData);
        return response([
            'message' => 'Tambah Kritik Saran Berhasil',
            'data' => $kritikSaran
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
        $kritikSaran = KritikSaran::find($id);

        if (!is_null($kritikSaran)) {
            return response([
                'message' => 'Berhasil Mendapatkan Data Kritik Saran',
                'data' => $kritikSaran
            ], 200);
        }

        return response([
            'message' => 'Kritik Saran Tidak Ditemukan',
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
        $kritikSaran = KritikSaran::find($id);
        if (is_null($kritikSaran)) {
            return response([
                'message' => 'Kritik Saran Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'judul' => 'required',
            'content' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $kritikSaran->judul = $updateData['judul'];
        $kritikSaran->content = $updateData['content'];

        if ($kritikSaran->save()) {
            return response([
                'message' => 'Data Kritik Saran Berhasil diUpdate',
                'data' => $kritikSaran
            ], 200);
        }

        return response([
            'message' => 'Data Kritik Saran Gagal diUpdate',
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
        $kritikSaran = KritikSaran::find($id);

        if (is_null($kritikSaran)) {
            return response([
                'message' => 'Kritik Saran Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if ($kritikSaran->delete()) {
            return response([
                'message' => 'Hapus Data Kritik Saran Berhasil',
                'data' => $kritikSaran
            ], 200);
        }

        return response([
            'message' => 'Hapus Data Kritik Saran Tidak Berhasil',
            'data' => null
        ], 400);
    }
}
