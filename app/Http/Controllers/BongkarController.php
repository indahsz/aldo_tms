<?php

namespace App\Http\Controllers;

use App\Models\Bongkar;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class BongkarController extends Controller
{
    public function index(Request $request)
    {
        $kodeTrans = generateKodeTransB(); // Generate the transaction code using the helper function
        $users = User::all(); // Fetch all users
        $query = Bongkar::query();

        //search function more detailed
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_trans', 'LIKE', "%$search%")
                    ->orWhere('supplier', 'LIKE', "%$search%")
                    ->orWhere('no_sj', 'LIKE', "%$search%");
            });
        }

        // Filter by date range
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('tgl_masuk', [$request->date_from, $request->date_to]);
        }

        //sorting
        $sortField = $request->get('sort_field', 'tgl_masuk'); //default sorting by 'tanggal_masuk'
        $sortOrder = $request->get('sort_order', 'desc'); //default descending;

        $data = $query->orderBy($sortField, $sortOrder)->paginate(10);

        return view('aldo_tms.pages.bongkar.bongkar', compact('data', 'kodeTrans', 'users', 'sortOrder', 'sortField'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required|date',
            'departement'  => 'required',
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

        // Get the currently logged-in user
        $user = Auth::user();

        // Generate kode_trans
        $kodeTrans = generateKodeTransB();

        // Simpan data ke database
        Bongkar::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'departement'  => $user->departement,
            'kode_trans'   => $kodeTrans,
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
            'waktu_in'     => $request->waktu_in,
            'user_created' => $user->name,
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
            $imageName = 'dokumen_msk_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/dokumen/dokumen_masuk/$imageName", base64_decode($image));

            $bongkar->update(['foto_dokumen' => "upload/images/dokumen/dokumen_masuk/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_dokumen')) {
            $file = $request->file('foto_dokumen');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/dokumen/dokumen_masuk/', $fileName, 'public');

            $bongkar->update(['foto_dokumen' => $path]);
        }

        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function uploadDokumenK(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_dokumen_k' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bongkar = Bongkar::find($id);

        if (!$bongkar) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = str_replace('data:image/png;base64,', '', $request->captured_image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'dokumen_kel_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/bongkar/dokumen/dokumen_keluar/$imageName", base64_decode($image));

            $bongkar->update(['foto_dokumen_k' => "upload/images/bongkar/dokumen/dokumen_keluar/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_dokumen_k')) {
            $file = $request->file('foto_dokumen_k');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/bongkar/dokumen/dokumen_keluar', $fileName, 'public');

            $bongkar->update(['foto_dokumen_k' => $path]);
        }

        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'empty_out'     => 'required',
            'ket_out'       => 'required',
            'waktu_out'     => 'required',
        ]);

        $bongkar = Bongkar::findOrFail($id);
        $userName = Auth::user()->name; // Get logged-in user's name

        $bongkar->update(array_merge($request->all(), [
            'user_updated' => $userName, // Save name of the person who updated
        ]));

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function bongkarStart(Request $request, $id)
    {
        $this->validate($request, [
            'bongkar_start' => 'required',
        ]);

        $bongkar = Bongkar::findOrFail($id);
        $bongkar->update(['bongkar_start' => $request->bongkar_start]);

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function bongkarDone(Request $request, $id)
    {
        $this->validate($request, [
            'bongkar_stop' => 'required',
        ]);

        $bongkar = Bongkar::findOrFail($id);
        $bongkar->update(['bongkar_stop' => $request->bongkar_stop]);

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
