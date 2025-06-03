<?php

namespace App\Http\Controllers;

use App\Models\Angkut;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; // Pastikan ini digunakan atau hapus jika tidak
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import

class AngkutController extends Controller
{
    public function index(Request $request)
    {
        $kodeTrans = generateKodeTrans(); // Generate the transaction code using the helper function
        $users = User::all(); // Fetch all users (mungkin masih berguna untuk admin view atau dropdown tertentu)
        
        $query = Angkut::query();
        $loggedInUser = Auth::user(); // Dapatkan pengguna yang sedang login

        // Filter berdasarkan departemen pengguna yang login
        // Pastikan pengguna login dan memiliki informasi departemen
        if ($loggedInUser && !empty($loggedInUser->departement)) {
            $query->where('departement', $loggedInUser->departement);
        } else {
            // Jika pengguna tidak memiliki departemen (misalnya admin super),
            // Anda mungkin ingin menampilkan semua data atau tidak sama sekali.
            // Untuk saat ini, jika tidak ada departemen, mungkin tidak menampilkan data departemental.
            // Atau jika Anda ingin admin melihat semua, tambahkan kondisi:
            // if ($loggedInUser && !$loggedInUser->hasRole('superadmin') && !empty($loggedInUser->departement)) {
            //    $query->where('departement', $loggedInUser->departement);
            // }
            // Baris di bawah ini akan membuat query mengembalikan hasil kosong jika user tidak punya departemen
            // dan tidak ada role khusus yang di-handle.
            // $query->whereRaw('1 = 0'); // Opsional: jika user tanpa departemen tidak boleh lihat apa-apa
        }

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

        $data = $query->orderBy($sortField, $sortOrder)->paginate(50);

        return view('aldo_tms.pages.angkut.angkut', compact('data', 'kodeTrans', 'users', 'sortOrder', 'sortField'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required|date',
            // 'kode_trans'   => 'required', // kode_trans digenerate, jadi tidak perlu divalidasi dari input
            // 'departement'  => 'required', // departement diambil dari user, tidak dari input
            'sopir_nama'   => 'required',
            'sopir_nik'    => 'required',
            'sopir_tlp'    => 'required',
            'transporter'  => 'required',
            'armada'       => 'required',
            'jenis_mobil'  => 'required',
            'nopol_mobil'  => 'required',
            'ket_in'       => 'required',
            'safety_check' => 'required',
            'empty_in'     => 'required',
            'waktu_in'     => 'required|date_format:Y-m-d\TH:i', // Pastikan format waktu sesuai
        ]);

        // Get the currently logged-in user
        $user = Auth::user();

        // Generate kode_trans
        $kodeTrans = generateKodeTrans();

        // Save data to database
        Angkut::create([
            'tgl_masuk'    => $request->tgl_masuk,
            'departement'  => $user->departement, // Departemen diambil dari user yang login
            'kode_trans'   => $kodeTrans,
            'sopir_nama'   => strtoupper($request->sopir_nama),
            'sopir_nik'    => $request->sopir_nik,
            'sopir_tlp'    => $request->sopir_tlp,
            'transporter'  => $request->transporter,
            'armada'       => strtoupper($request->armada),
            'jenis_mobil'  => strtoupper($request->jenis_mobil),
            'nopol_mobil'  => strtoupper($request->nopol_mobil),
            'ket_in'       => $request->ket_in,
            'safety_check' => $request->safety_check,
            'empty_in'     => $request->empty_in,
            'waktu_in'     => $request->waktu_in,
            'user_created' => $user->name,
        ]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been added']);
    }

    // ... (sisa method lainnya tetap sama: uploadSim, uploadStnk, uploadDokumen, uploadDokumenK, update, muatStart, muatDone, destroy)
    // Pastikan method update juga mengambil user_updated dari Auth::user()->name
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer'    => 'required',
            'tgl_sj'      => 'required|date',
            'no_sj'       => 'required',
            'nama_barang' => 'required',
            // Anda mungkin ingin menambahkan validasi untuk field lainnya yang diupdate
            // 'ket_out'    => 'nullable',
            // 'waktu_out'  => 'nullable|date_format:Y-m-d\TH:i',
            // 'empty_out'  => 'nullable',
        ]);

        $angkut = Angkut::findOrFail($id);
        $userName = Auth::user()->name; // Get logged-in user's name

        // Siapkan data untuk diupdate
        $updateData = $request->only(['customer', 'tgl_sj', 'no_sj', 'nama_barang', 'ket_out', 'waktu_out', 'empty_out']);
        $updateData['user_updated'] = $userName;

        $angkut->update($updateData);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }

    // ... (method lainnya seperti uploadSim, uploadStnk, dst. tidak perlu diubah untuk fungsionalitas ini) ...
    
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
            // Hapus file lama jika ada dan file baru diupload
            if ($angkut->foto_sim) {
                Storage::disk('public')->delete($angkut->foto_sim);
            }
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
        
        if ($request->captured_image) {
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'stnk_' . time() . '_' . Str::random(10) . '.png';
            
            Storage::disk('public')->put("upload/images/angkut/stnk/$imageName", base64_decode($image));
            
            if ($angkut->foto_stnk) { // Hapus gambar lama jika ada
                Storage::disk('public')->delete($angkut->foto_stnk);
            }
            $angkut->update(['foto_stnk' => "upload/images/angkut/stnk/$imageName"]);
        }
        
        if ($request->hasFile('foto_stnk')) {
            if ($angkut->foto_stnk) {
                Storage::disk('public')->delete($angkut->foto_stnk);
            }
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
        
        if ($request->captured_image) {
            $image = str_replace('data:image/png;base64,', '', $request->captured_image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'dokumen_msk_' . time() . '_' . Str::random(10) . '.png';
            
            Storage::disk('public')->put("upload/images/angkut/dokumen/dokumen_masuk/$imageName", base64_decode($image));
            
            if ($angkut->foto_dokumen) { // Hapus gambar lama jika ada
                Storage::disk('public')->delete($angkut->foto_dokumen);
            }
            $angkut->update(['foto_dokumen' => "upload/images/angkut/dokumen/dokumen_masuk/$imageName"]);
        }
        
        if ($request->hasFile('foto_dokumen')) {
            if ($angkut->foto_dokumen) {
                Storage::disk('public')->delete($angkut->foto_dokumen);
            }
            $file = $request->file('foto_dokumen');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/angkut/dokumen/dokumen_masuk', $fileName, 'public');
            
            $angkut->update(['foto_dokumen' => $path]);
        }
        
        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }
    
    public function uploadDokumenK(Request $request, $id)
    {
        $request->validate([
            'captured_image' => 'nullable|string',
            'foto_dokumen_k' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $angkut = Angkut::find($id);
        
        if (!$angkut) {
            return redirect()->back()->with('error', 'Data not found!');
        }
        
        if ($request->captured_image) {
            $image = str_replace('data:image/png;base64,', '', $request->captured_image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'dokumen_kel_' . time() . '_' . Str::random(10) . '.png';
            
            Storage::disk('public')->put("upload/images/angkut/dokumen/dokumen_keluar/$imageName", base64_decode($image));
            
            if ($angkut->foto_dokumen_k) { // Hapus gambar lama jika ada
                Storage::disk('public')->delete($angkut->foto_dokumen_k);
            }
            $angkut->update(['foto_dokumen_k' => "upload/images/angkut/dokumen/dokumen_keluar/$imageName"]);
        }
        
        if ($request->hasFile('foto_dokumen_k')) {
            if ($angkut->foto_dokumen_k) {
                Storage::disk('public')->delete($angkut->foto_dokumen_k);
            }
            $file = $request->file('foto_dokumen_k');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload/images/angkut/dokumen/dokumen_keluar', $fileName, 'public');
            
            $angkut->update(['foto_dokumen_k' => $path]);
        }
        
        return redirect()->back()->with('success', 'Dokumen uploaded successfully!');
    }

    public function muatStart(Request $request, $id)
    {
        $this->validate($request, [
            'muat_start' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $angkut = Angkut::findOrFail($id);
        $angkut->update(['muat_start' => $request->muat_start]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }

    public function muatDone(Request $request, $id)
    {
        $this->validate($request, [
            'muat_stop' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $angkut = Angkut::findOrFail($id);
        $angkut->update(['muat_stop' => $request->muat_stop]);

        return redirect()->route('angkut.index')->with(['success' => 'Data has been updated']);
    }

    public function destroy($id)
    {
        $angkut = Angkut::findOrFail($id);

        // Hapus file terkait jika ada sebelum menghapus record dari DB
        if ($angkut->foto_sim) {
            Storage::disk('public')->delete($angkut->foto_sim);
        }
        if ($angkut->foto_stnk) {
            Storage::disk('public')->delete($angkut->foto_stnk);
        }
        if ($angkut->foto_dokumen) {
            Storage::disk('public')->delete($angkut->foto_dokumen);
        }
        if ($angkut->foto_dokumen_k) {
            Storage::disk('public')->delete($angkut->foto_dokumen_k);
        }
        
        $angkut->delete();
        return redirect()->route('angkut.index')->with(['success' => 'Data has been deleted']);
    }
}