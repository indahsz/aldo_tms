<?php

namespace App\Http\Controllers;

use App\Models\bongkar;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BongkarController extends Controller
{
    public function index()
    {
        $data = bongkar::paginate(20);
        return view('aldo_tms/pages/bongkar/bongkar', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required|date',
            'sopir_nama'   => 'required',
            'sopir_nik'    => 'required',
            'sopir_tlp'    => 'required',
            'nopol_mobil'  => 'required',
            'supplier'     => 'required',
            'tgl_sj'       => 'required|date',
            'no_sj'        => 'required',
            'nama_barang'  => 'required',
            'keterangan'   => 'required',
            'foto_sim'     => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_stnk'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'empty_in'     => 'required|boolean',
        ]);

        $path_sim = null;
        $path_stnk = null;

        if ($request->foto_sim) {
            $imageData = base64_decode($request->foto_sim);
            $fileName = 'sim_' . time() . '.jpg';
            file_put_contents(storage_path('app/public/img/' . $fileName), $imageData);
            $path_sim = 'public/img/' . $fileName;
        }

        if ($request->foto_stnk) {
            $imageData = base64_decode($request->foto_stnk);
            $fileName = 'stnk_' . time() . '.jpg';
            file_put_contents(storage_path('app/public/img/' . $fileName), $imageData);
            $path_stnk = 'public/img/' . $fileName;
        }

        // Simpan data ke database
        bongkar::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'sopir_nama'   => $request->sopir_nama,
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'nopol_mobil'  => $request->nopol_mobil,
            'supplier'     => $request->supplier,
            'tgl_sj'       => $request->tgl_sj,
            'no_sj'        => $request->no_sj,
            'nama_barang'  => $request->nama_barang,
            'keterangan'   => $request->keterangan,
            'foto_sim'     => $path_sim,
            'foto_stnk'    => $path_stnk,
            'empty_in'     => $request->empty_in,
        ]);

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been added']);
    }
}
