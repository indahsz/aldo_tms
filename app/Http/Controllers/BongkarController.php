<?php

namespace App\Http\Controllers;

use App\Models\bongkar;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class BongkarController extends Controller
{
    public function index()
    {
        $data = bongkar::paginate(20);
        $users = User::all(); // Fetch all users
        return view('aldo_tms/pages/bongkar/bongkar', compact('data', 'users'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required|date',
            'kode_trans'   => 'required',
            'sopir_nama'   => 'required',
            'sopir_nik'    => 'required',
            'sopir_tlp'    => 'required',
            'nopol_mobil'  => 'required',
            'supplier'     => 'required',
            'no_sj'        => 'required',
            'tgl_sj'       => 'required|date',
            'nama_barang'  => 'required',
            'ket_in'       => 'required',
            'empty_in'     => 'required',
            'waktu_in'     => 'required'
        ]);

        // Simpan data ke database
        Bongkar::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'kode_trans'   => $request->kode_trans,
            'sopir_nama'   => $request->sopir_nama,
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'nopol_mobil'  => $request->nopol_mobil,
            'supplier'     => $request->supplier,
            'no_sj'        => $request->no_sj,
            'tgl_sj'       => $request->tgl_sj,
            'nama_barang'  => $request->nama_barang,
            'ket_in'       => $request->ket_in,
            'safety_check' => $request->safety_check,
            'empty_in'     => $request->empty_in,
            'waktu_in'     => $request->waktu_in
        ]);

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been added']);
    }

    public function uploadSim(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_sim' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bongkar = Bongkar::find($id);

        if (!$bongkar) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'sim_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/sim/$imageName", base64_decode($image));

            $bongkar->update(['foto_sim' => "upload/images/sim/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_sim')) {
            $file = $request->file('foto_sim');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/sim', $fileName, 'public');

            $bongkar->update(['foto_sim' => $path]);
        }

        return redirect()->back()->with('success', 'SIM updated successfully!');
    }

    public function uploadStnk(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_stnk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bongkar = Bongkar::find($id);

        if (!$bongkar) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'stnk_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/stnk/$imageName", base64_decode($image));

            $bongkar->update(['foto_stnk' => "upload/images/stnk/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_stnk')) {
            $file = $request->file('foto_stnk');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/stnk', $fileName, 'public');

            $bongkar->update(['foto_stnk' => $path]);
        }

        return redirect()->back()->with('success', 'STNK updated successfully!');
    }

    public function uploadDokumen(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_dokumen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bongkar = Bongkar::find($id);

        if (!$bongkar) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = str_replace('data:image/png;base64,', '', $request->captured_image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'dokumen_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/dokumen/$imageName", base64_decode($image));

            $bongkar->update(['foto_dokumen' => "upload/images/dokumen/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_dokumen')) {
            $file = $request->file('foto_dokumen');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/dokumen', $fileName, 'public');

            $bongkar->update(['foto_dokumen' => $path]);
        }

        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, []);

        // search id 
        $bongkar = Bongkar::findOrFail($id);


        // Update data
        $bongkar->update($request->all());;

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $bongkar = Bongkar::findOrFail($id);

        // Hapus data
        $bongkar->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('bongkar.index')->with(['success' => 'Data has been deleted']);
    }
}
