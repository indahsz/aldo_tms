<?php

namespace App\Http\Controllers;

use App\Models\Angkut;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AngkutController extends Controller
{
    public function index(Request $request)
    {
        $kodeTrans = generateKodeTrans(); // Generate the transaction code using the helper function
        $users = User::all(); // Fetch all user
        $query = Angkut::query();

        //search function more detailed
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_trans', 'LIKE', "%$search%")
                    ->orWhere('transporter', 'LIKE', "%$search%")
                    ->orWhere('sopir_nama', 'LIKE', "%$search%")
                    ->orWhere('customer', 'LIKE', "%$search%")
                    ->orWhere('no_sj', 'LIKE', "%$search%")
                    ->orWhere('armada', 'LIKE', "%$search%");
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

        return view('aldo_tms.pages.angkut.angkut', compact('data', 'kodeTrans', 'users', 'sortOrder', 'sortField'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required|date',
            'kode_trans'   => 'required',
            'departement'  => 'required',
            'sopir_nama'   => 'required',
            'sopir_nik'    => 'required',
            'sopir_tlp'    => 'required',
            'transporter'  => 'required',
            'armada'       => 'required',
            'nopol_mobil'  => 'required',
            'ket_in'       => 'required',
            'safety_check' => 'required',
            'empty_in'     => 'required|',
            'waktu_in'     => 'required'
        ]);

        // Get the currently logged-in user
        $user = Auth::user();

        // Generate kode_trans
        $kodeTrans = generateKodeTrans();

        // Save data to database
        Angkut::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'departement'  => $user->departement,
            'kode_trans'   => $kodeTrans,
            'sopir_nama'   => $request->sopir_nama,
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'transporter'  => $request->transporter,
            'armada'       => $request->armada,
            'nopol_mobil'  => $request->nopol_mobil,
            'ket_in'       => $request->ket_in,
            'safety_check' => $request->safety_check,
            'empty_in'     => $request->empty_in,
            'waktu_in'     => $request->waktu_in,
            'user_created' => $user->name, 
        ]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been added']);
    }


    public function uploadSim(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_sim' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $angkut = Angkut::find($id);

        if (!$angkut) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'sim_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/angkut/sim/$imageName", base64_decode($image));

            $angkut->update(['foto_sim' => "upload/images/angkut/sim/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_sim')) {
            $file = $request->file('foto_sim');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/angkut/sim', $fileName, 'public');

            $angkut->update(['foto_sim' => $path]);
        }

        return redirect()->back()->with('success', 'SIM updated successfully!');
    }

    public function uploadStnk(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_stnk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $angkut = Angkut::find($id);

        if (!$angkut) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'stnk_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/angkut/stnk/$imageName", base64_decode($image));

            $angkut->update(['foto_stnk' => "upload/images/angkut/stnk/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_stnk')) {
            $file = $request->file('foto_stnk');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/angkut/stnk', $fileName, 'public');

            $angkut->update(['foto_stnk' => $path]);
        }

        return redirect()->back()->with('success', 'STNK updated successfully!');
    }

    public function uploadDokumen(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_dokumen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $angkut = Angkut::find($id);

        if (!$angkut) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Handle camera-captured image (Base64)
        if ($request->captured_image) {
            $image = str_replace('data:image/png;base64,', '', $request->captured_image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'dokumen_' . time() . '_' . Str::random(10) . '.png';

            Storage::disk('public')->put("upload/images/angkut/dokumen/$imageName", base64_decode($image));

            $angkut->update(['foto_dokumen' => "upload/images/angkut/dokumen/$imageName"]);
        }

        // Handle file upload
        if ($request->hasFile('foto_dokumen')) {
            $file = $request->file('foto_dokumen');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/angkut/dokumen', $fileName, 'public');

            $angkut->update(['foto_dokumen' => $path]);
        }

        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer'     => 'required',
            'tgl_sj'       => 'required|date',
            'no_sj'        => 'required',
            'nama_barang'  => 'required',
        ]);

        $angkut = Angkut::findOrFail($id);
        $userName = Auth::user()->name; // Get logged-in user's name

        $angkut->update(array_merge($request->all(), [
            'user_updated' => $userName, // Save name of the person who updated
        ]));


        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }

    public function muatStart(Request $request, $id)
    {
        $this->validate($request, [
            'muat_start' => 'required',
        ]);

        $angkut = Angkut::findOrFail($id);
        $angkut->update(['muat_start' => $request->muat_start]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }

    public function muatDone(Request $request, $id)
    {
        $this->validate($request, [
            'muat_stop' => 'required',
        ]);

        $angkut = Angkut::findOrFail($id);
        $angkut->update(['muat_stop' => $request->muat_stop]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }


    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $angkut = Angkut::findOrFail($id);

        // Hapus data
        $angkut->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('angkut.index')->with(['success' => 'Data has been deleted']);
    }
}
