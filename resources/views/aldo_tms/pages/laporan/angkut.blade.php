@extends('aldo_tms.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan Data /</span> Angkut Barang</h4>
    <!-- Tabel Angkut -->
    <div class="card">
        <!-- <h5 class="card-header">Hoverable rows</h5> -->

        <form method="GET" action="{{ route('laporanAngkut.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="from_date" class="col-form-label">Dari Tanggal</label>
                    <input type="date" id="from_date" name="from_date" class="form-control"
                        value="{{ request('from_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="to_date" class="col-form-label">Sampai Tanggal</label>
                    <input type="date" id="to_date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>
                <div class="col-md-4 mt-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('laporanAngkut.export', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-success">Export Excel</a>
                </div>
            </div>
        </form>
        <div class="table-responsive">

            <table class="table table-hover" style="text-align: center; font-size: 13px; width:100%;">
                <thead>
                    <tr>
                        <th class="text-nowrap">No.</th>
                        <th class="text-nowrap">No. Tiket</th>
                        <th class="text-nowrap">Tgl Masuk</th>
                        <th class="text-nowrap">Dept</th>
                        <th class="text-nowrap">Sopir</th>
                        <th class="text-nowrap">NIK</th>
                        <th class="text-nowrap">Tlp</th>
                        <th class="text-nowrap">Transporter</th>
                        <th class="text-nowrap">Armada</th>
                        <th class="text-nowrap">Jenis</th>
                        <th class="text-nowrap">Plat Mobil</th>
                        <th class="text-nowrap">Customer</th>
                        <th class="text-nowrap">Tanggal SJ</th>
                        <th class="text-nowrap">No. SJ</th>
                        <th class="text-nowrap">Barang</th>
                        <th class="text-wrap">Ket. Masuk</th>
                        <th class="text-wrap">Ket. Keluar</th>
                        <th class="text-nowrap">SIM</th>
                        <th class="text-nowrap">STNK</th>
                        <th class="text-nowrap">Dok. Masuk</th>
                        <th class="text-nowrap">Dok. Keluar</th>
                        <th class="text-nowrap">Safety Check</th>
                        <th class="text-nowrap">Waktu Masuk</th>
                        <th class="text-nowrap">Waktu Keluar</th>
                        <th class="text-nowrap">Waktu Progress</th>
                        <th class="text-nowrap">Mulai Muat</th>
                        <th class="text-nowrap">Selesai Muat</th>
                        <th class="text-nowrap">Waktu Proses</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $key => $item)

                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->kode_trans }} </td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d F Y') }} </td>
                        <td>{{ $item->departement }} </td>
                        <td>{{ $item->sopir_nama }} </td>
                        <td>{{ $item->sopir_nik }} </td>
                        <td>{{ $item->sopir_tlp }} </td>
                        <td>{{ $item->transporter }} </td>
                        <td>{{ $item->armada }} </td>
                        <td>{{ $item->jenis_mobil }} </td>
                        <td>{{ $item->nopol_mobil }} </td>
                        <td>{{ $item->customer }} </td>
                        <td>{{ $item->tgl_sj }} </td>
                        <td>{{ $item->no_sj }} </td>
                        <td>{{ $item->nama_barang }} </td>
                        <td>{{ $item->ket_in }} </td>
                        <td>{{ $item->ket_out }} </td>
                        <td>
                            @if (!empty($item->foto_sim))
                            <a href="{{ asset('storage/' . $item->foto_sim) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_sim) }}" alt="Foto SIM"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->foto_stnk))
                            <a href="{{ asset('storage/' . $item->foto_stnk) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_stnk) }}" alt="Foto STNK"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->foto_dokumen))
                            <a href="{{ asset('storage/' . $item->foto_dokumen) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_dokumen) }}" alt="Foto DOKUMEN"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->foto_dokumen))
                            <a href="{{ asset('storage/' . $item->foto_dokumen_k) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_dokumen_k) }}" alt="Foto DOKUMEN"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image</p>
                            @endif
                        </td>
                        <td>{{ $item->safety_check ? 'Lengkap' : 'Tidak Lengkap' }}</td>
                        <td>
                            {{ $item->waktu_in ? \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i:s') : '-' }}
                        </td>
                        <td>
                            {{ $item->waktu_out ? \Carbon\Carbon::parse($item->waktu_out)->format('d-m-Y H:i:s') : '-' }}
                        </td>
                        <td>
                            @if ($item->waktu_out)
                            @php
                            $diffInMinutes = \Carbon\Carbon::parse($item->waktu_in)->diffInMinutes(\Carbon\Carbon::parse($item->waktu_out));
                            $hours = floor($diffInMinutes / 60);
                            $minutes = $diffInMinutes % 60;
                            @endphp
                            {{ $hours }} hours {{ $minutes }} minutes
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $item->muat_start }} </td>
                        <td>{{ $item->muat_stop }} </td>
                        <td>
                            @if ($item->muat_stop)
                            @php
                            $diffInMinutes = \Carbon\Carbon::parse($item->muat_start)->diffInMinutes(\Carbon\Carbon::parse($item->muat_stop));
                            $hours = floor($diffInMinutes / 60);
                            $minutes = $diffInMinutes % 60;
                            @endphp
                            {{ $hours }} hours {{ $minutes }} minutes
                            @else
                            -
                            @endif
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $data->links() }}
        </div>
    </div>
    <!--/ Hoverable Table rows -->
</div>
@endsection