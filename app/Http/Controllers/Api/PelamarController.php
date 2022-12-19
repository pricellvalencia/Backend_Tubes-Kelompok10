<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Pelamar;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelamar = Pelamar::all();
        if (count($pelamar) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pelamar
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
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'tglLahir' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'pendidikan' => 'required',
        ]);
        // $storeData = new Product();
        if ($validate->fails())
            return response(['message' => $validate->errors()->first()], 400);

        $pelamar = Pelamar::create($storeData);
        return response([
            'message' => 'Tambah pelamar Mobil Berhasil',
            'data' => $pelamar
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
        $pelamar = Pelamar::find($id);

        if (!is_null($pelamar)) {
            return response([
                'message' => 'Berhasil Mendapatkan Data pelamar',
                'data' => $pelamar
            ], 200);
        }

        return response([
            'message' => 'Data Pelamar Tidak Ditemukan',
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
        $pelamar = Pelamar::find($id);
        if (is_null($pelamar)) {
            return response([
                'message' => 'Data Pelamar Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'tglLahir' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'pendidikan' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pelamar->nama = $updateData['nama'];
        $pelamar->jeniskelamin = $updateData['jeniskelamin'];
        $pelamar->tglLahir = $updateData['tglLahir'];
        $pelamar->alamat = $updateData['alamat'];
        $pelamar->email = $updateData['email'];
        $pelamar->pendidikan = $updateData['pendidikan'];

        if ($pelamar->save()) {
            return response([
                'message' => 'Data Pelamar Mobil Berhasil diUpdate',
                'data' => $pelamar
            ], 200);
        }

        return response([
            'message' => 'Data Pelamar Gagal diUpdate',
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
        $pelamar = Pelamar::find($id);

        if (is_null($pelamar)) {
            return response([
                'message' => 'Data Pelamar Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if ($pelamar->delete()) {
            return response([
                'message' => 'Hapus Data Pelamar Berhasil',
                'data' => $pelamar
            ], 200);
        }

        return response([
            'message' => 'Hapus Data Pelamar Tidak Berhasil',
            'data' => null
        ], 400);
    }
}
