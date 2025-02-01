<?php

namespace App\Http\Controllers;

use App\Models\angkut;
use Illuminate\Http\Request;

class AngkutController extends Controller
{
    public function index()
    {
        $data = angkut::paginate(20);
        return view('aldo_tms/pages/angkut/angkut', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required',
            'sopir_nama'   => 'required',
            'sopir_nik'    => 'required',
            'sopir_tlp'    => 'required',
            'transporter'  => 'required',
            'nopol_mobil'  => 'required',
            'customer'     => 'required',
            'tgl_sj'       => 'required',
            'no_sj'        => 'required',
            'nama_barang'  => 'required',
            'keterangan'   => 'required',
            'foto_sim'     => 'required|image|mimes:jpg,png,jpeg',
            'foto_stnk'    => 'required|image|mimes:jpg,png,jpeg',
            'foto_dokumen' => 'required|image|mimes:jpg,png,jpeg',
            'safety_check' => 'required|boolean',
            'empty_in'     => 'required|boolean',
        ]);

        //image upload
        $image_sim =  $request->file('foto_sim')->getClientOriginalName();
        $path_sim = $request->file('foto_sim')->storeAS('public/img', $image_sim);
        $image_stnk =  $request->file('foto_stnk')->getClientOriginalName();
        $path_stnk = $request->file('foto_stnk')->storeAS('public/img', $image_stnk);

        Angkut::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'sopir_nama'   => $request->sopir_nama,
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'transporter'  => $request->transporter,
            'nopol_mobil'  => $request->nopol_mobil,
            'customer'     => $request->customer,
            'tgl_sj'       => $request->tgl_sj,
            'no_sj'        => $request->no_sj,
            'nama_barang'  => $request->nama_barang,
            'keterangan'   => $request->keterangan,
            'foto_sim'     => $path_sim,
            'foto_stnk'    => $path_stnk,
            'safety_check' => $request->safety_check,
            'empty_in'     => $request->empty_in,
        ]);

        return redirect()
            ->route('angkut.index')
            ->with(['Success' => 'Data has been added']);
    }
}
