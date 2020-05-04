<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    //fungsi index digunakan untuk menampilkan semua data mahasiswa
    public function index()
    {
        $data = Mahasiswa::all();

        //cek data apakah kosong atau tidak
        if (count($data) > 0) {
            $res['message'] = "Success";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Data is Empty";
            return response($data);
        }
    }

    public function getId($id)
    {
        $data = Mahasiswa::where('id', $id)->get();

        //cek jika data ditemukan
        if (count($data) > 0) {
            $res['message'] = "Success";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Data is Empty";
            return response($data);
        }
    }

    public function create(Request $request)
    {
        $mhs = new Mahasiswa();
        $mhs->nama = $request->nama;
        $mhs->nim = $request->nim;
        $mhs->email = $request->email;
        $mhs->jurusan = $request->jurusan;

        if ($mhs->save()) {
            $res['message'] = "Data has been added";
            $res['value'] = "$mhs";
            return response($res);
        }
    }

    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $mhs = Mahasiswa::find($id);
        $mhs->nama = $nama;
        $mhs->nim = $nim;
        $mhs->email = $email;
        $mhs->jurusan = $jurusan;

        if ($mhs->save()) {
            $res['message'] = "Data has been updated";
            $res['value'] = "$mhs";
            return response($res);
        } else {
            $res['message'] = "Data failed to changed";
            return response($res);
        }
    }

    public function delete($id)
    {
        $mhs = Mahasiswa::where('id', $id);

        if ($mhs->delete()) {
            $res['message'] = "Data has been deleted";
            return response($res);
        } else {
            $res['message'] = "Gagal";
            return response($res);
        }
    }
}
