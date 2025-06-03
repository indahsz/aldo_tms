<?php

namespace App\Http\Controllers;

use App\Models\Bongkar;
use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image; // Hapus jika tidak digunakan
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan User model di-import
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon

class BongkarController extends Controller
{
    public function index(Request $request)
    {
        $kodeTrans = generateKodeTransB(); // Generate the transaction code using the helper function
        $users = User::all(); // Fetch all users
        
        $query = Bongkar::query();
        $loggedInUser = Auth::user(); // Dapatkan pengguna yang sedang login

        // Filter berdasarkan departemen pengguna yang login
        if ($loggedInUser && !empty($loggedInUser->departement)) {
            $query->where('departement', $loggedInUser->departement);
        }
        // Opsional: Handle jika admin/superadmin yang bisa melihat semua
        // else if ($loggedInUser && $loggedInUser->hasRole('superadmin')) { /* jangan filter */ }
        // else { $query->whereRaw('1 = 0'); /* tidak menampilkan apa-apa jika user tanpa departemen */ }


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

        $data = $query->orderBy($sortField, $sortOrder)->paginate(50);

        return view('aldo_tms.pages.bongkar.bongkar', compact('data', 'kodeTrans', 'users', 'sortOrder', 'sortField'));
    }


    public function store(Request $request)
    {
        // Langkah 1: Normalisasi input waktu_in
        if ($request->has('waktu_in')) {
            $waktuInValue = $request->input('waktu_in');
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/', $waktuInValue)) {
                $request->merge(['waktu_in' => str_replace(' ', 'T', $waktuInValue)]);
            }
        }
        
        // dd($request->all()); // Untuk debug jika perlu

        // Langkah 2: Validasi
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

        $user = Auth::user();

        if (empty($user->departement)) {
            return redirect()->back()
                             ->withErrors(['departement' => 'Departemen pengguna tidak diatur. Data tidak dapat disimpan.'])
                             ->withInput();
        }

        $kodeTrans = generateKodeTransB();

        // Langkah 3: Simpan ke Database
        Bongkar::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'departement'  => $user->departement,
            'kode_trans'   => $kodeTrans,
            'sopir_nama'   => strtoupper($request->sopir_nama),
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'nopol_mobil'  => strtoupper($request->nopol_mobil),
            'supplier'     => strtoupper($request->supplier),
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

    // --- METHOD UPLOAD GAMBAR (Tambahkan penghapusan file lama) ---
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

        $folderPath = "upload/images/bongkar/sim/";

        if ($request->captured_image) {
            if ($bongkar->foto_sim) Storage::disk('public')->delete($bongkar->foto_sim); // Hapus lama
            $image = str_replace(['data:image/png;base64,', ' '], ['', '+'], $request->captured_image);
            $imageName = 'sim_' . time() . '_' . Str::random(10) . '.png';
            Storage::disk('public')->put($folderPath . $imageName, base64_decode($image));
            $bongkar->update(['foto_sim' => $folderPath . $imageName]);
        }

        if ($request->hasFile('foto_sim')) {
            if ($bongkar->foto_sim) Storage::disk('public')->delete($bongkar->foto_sim); // Hapus lama
            $file = $request->file('foto_sim');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folderPath, $fileName, 'public');
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
        if (!$bongkar) return redirect()->back()->with('error', 'Data not found!');
        $folderPath = "upload/images/bongkar/stnk/";

        if ($request->captured_image) {
            if ($bongkar->foto_stnk) Storage::disk('public')->delete($bongkar->foto_stnk);
            $image = str_replace(['data:image/png;base64,', ' '], ['', '+'], $request->captured_image);
            $imageName = 'stnk_' . time() . '_' . Str::random(10) . '.png';
            Storage::disk('public')->put($folderPath . $imageName, base64_decode($image));
            $bongkar->update(['foto_stnk' => $folderPath . $imageName]);
        }
        if ($request->hasFile('foto_stnk')) {
            if ($bongkar->foto_stnk) Storage::disk('public')->delete($bongkar->foto_stnk);
            $file = $request->file('foto_stnk');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folderPath, $fileName, 'public');
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
        if (!$bongkar) return redirect()->back()->with('error', 'Data not found!');
        $folderPath = "upload/images/bongkar/dokumen/dokumen_masuk/";

        if ($request->captured_image) {
            if ($bongkar->foto_dokumen) Storage::disk('public')->delete($bongkar->foto_dokumen);
            $image = str_replace(['data:image/png;base64,', ' '], ['', '+'], $request->captured_image);
            $imageName = 'dokumen_msk_' . time() . '_' . Str::random(10) . '.png';
            Storage::disk('public')->put($folderPath . $imageName, base64_decode($image));
            $bongkar->update(['foto_dokumen' => $folderPath . $imageName]);
        }
        if ($request->hasFile('foto_dokumen')) {
            if ($bongkar->foto_dokumen) Storage::disk('public')->delete($bongkar->foto_dokumen);
            $file = $request->file('foto_dokumen');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folderPath, $fileName, 'public');
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
        if (!$bongkar) return redirect()->back()->with('error', 'Data not found!');
        $folderPath = "upload/images/bongkar/dokumen/dokumen_keluar/";

        if ($request->captured_image) {
            if ($bongkar->foto_dokumen_k) Storage::disk('public')->delete($bongkar->foto_dokumen_k);
            $image = str_replace(['data:image/png;base64,', ' '], ['', '+'], $request->captured_image);
            $imageName = 'dokumen_kel_' . time() . '_' . Str::random(10) . '.png';
            Storage::disk('public')->put($folderPath . $imageName, base64_decode($image));
            $bongkar->update(['foto_dokumen_k' => $folderPath . $imageName]);
        }
        if ($request->hasFile('foto_dokumen_k')) {
            if ($bongkar->foto_dokumen_k) Storage::disk('public')->delete($bongkar->foto_dokumen_k);
            $file = $request->file('foto_dokumen_k');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folderPath, $fileName, 'public');
            $bongkar->update(['foto_dokumen_k' => $path]);
        }
        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        // Normalisasi waktu_out jika ada di request dan perlu format T
        if ($request->has('waktu_out')) {
            $waktuOutValue = $request->input('waktu_out');
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/', $waktuOutValue)) {
                $request->merge(['waktu_out' => str_replace(' ', 'T', $waktuOutValue)]);
            }
        }

        $this->validate($request, [
            'empty_out'     => 'required|string|not_in:-',
            'ket_out'       => 'required|string',
            'waktu_out'     => 'required|date_format:Y-m-d\TH:i',
            // Tambahkan validasi lain jika ada field yang bisa diupdate di sini
        ]);

        $bongkar = Bongkar::findOrFail($id);
        $userName = Auth::user()->name;

        $updateData = $request->only(['empty_out', 'ket_out']); // Field yang diizinkan untuk diupdate
        $updateData['waktu_out'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_out)->format('Y-m-d H:i:s');
        $updateData['user_updated'] = $userName;
        
        // Jika ada field lain yang boleh diupdate dari form utama (misal: supplier, no_sj, dll)
        // $updateData['supplier'] = strtoupper($request->supplier);
        // $updateData['no_sj'] = $request->no_sj;

        $bongkar->update($updateData);

        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function bongkarStart(Request $request, $id)
    {
        if ($request->has('bongkar_start')) {
            $value = $request->input('bongkar_start');
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/', $value)) {
                $request->merge(['bongkar_start' => str_replace(' ', 'T', $value)]);
            }
        }
        $this->validate($request, [
            'bongkar_start' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $bongkar = Bongkar::findOrFail($id);
        $bongkar->update([
            'bongkar_start' => Carbon::createFromFormat('Y-m-d\TH:i', $request->bongkar_start)->format('Y-m-d H:i:s')
        ]);
        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function bongkarDone(Request $request, $id)
    {
         if ($request->has('bongkar_stop')) {
            $value = $request->input('bongkar_stop');
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/', $value)) {
                $request->merge(['bongkar_stop' => str_replace(' ', 'T', $value)]);
            }
        }
        $this->validate($request, [
            'bongkar_stop' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $bongkar = Bongkar::findOrFail($id);
        $bongkar->update([
            'bongkar_stop' => Carbon::createFromFormat('Y-m-d\TH:i', $request->bongkar_stop)->format('Y-m-d H:i:s')
        ]);
        return redirect()->route('bongkar.index')->with(['success' => 'Data has been updated']);
    }

    public function destroy($id)
    {
        $bongkar = Bongkar::findOrFail($id);

        // Hapus file terkait jika ada sebelum menghapus record dari DB
        $pathsToDelete = ['foto_sim', 'foto_stnk', 'foto_dokumen', 'foto_dokumen_k'];
        foreach ($pathsToDelete as $field) {
            if ($bongkar->$field) {
                Storage::disk('public')->delete($bongkar->$field);
            }
        }
        
        $bongkar->delete();
        return redirect()->route('bongkar.index')->with(['success' => 'Data has been deleted']);
    }
}