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
        <div class="table-responsive text-nowrap">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Transaksi</th>
                        <th>Tgl Masuk</th>
                        <th>Sopir</th>
                        <th>NIK</th>
                        <th>Tlp</th>
                        <th>Transporter</th>
                        <th>Plat Mobil</th>
                        <th>Customer</th>
                        <th>Tanggal SJ</th>
                        <th>No. SJ</th>
                        <th>Barang</th>
                        <th>Ket. Masuk</th>
                        <th>Ket. Keluar</th>
                        <th>SIM</th>
                        <th>STNK</th>
                        <th>Dokumen</th>
                        <th>Safety Check</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Mulai Muat</th>
                        <th>Akhir Muat</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $key => $item)

                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->kode_trans }} </td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }} </td>
                        <td>{{ $item->sopir_nama }} </td>
                        <td>{{ $item->sopir_nik }} </td>
                        <td>{{ $item->sopir_tlp }} </td>
                        <td>{{ $item->transporter }} </td>
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
                            <p>No image available</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->foto_stnk))
                            <a href="{{ asset('storage/' . $item->foto_stnk) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_stnk) }}" alt="Foto STNK"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image available</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->foto_dokumen))
                            <a href="{{ asset('storage/' . $item->foto_dokumen) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_dokumen) }}" alt="Foto DOKUMEN"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image available</p>
                            @endif
                        </td>
                        <td>{{ $item->safety_check ? 'Lengkap' : 'Tidak Lengkap' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i:s') }} </td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_out)->format('d-m-Y H:i:s') }} </td>
                        <td>{{ $item->muat_start }} </td>
                        <td>{{ $item->muat_stop }} </td>
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