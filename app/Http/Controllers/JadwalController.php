<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table("tbl_nilai")
            ->select("setup_kelas.nama_kelas", "data_siswa.nama_siswa","tbl_nilai.nilai")
            ->join("data_siswa", "data_siswa.id_siswa", "tbl_nilai.id_siswa")
            ->join("setup_kelas", "setup_kelas.id_kelas", "tbl_nilai.id_kelas");
        if ($request->has("search")){
            $query->where("setup_kelas.nama_kelas", "LIKE", "%$request->search%")
            ->orWhere("data_siswa.nama_siswa", "LIKE", "%$request->search%");
        }

        $select_join = $query->get();

        return view("index-0007", compact('select_join'));
    }
}