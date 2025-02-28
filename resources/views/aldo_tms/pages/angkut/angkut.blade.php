@extends('aldo_tms.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Angkut Barang</h4>
    <button type="button" class="mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        + Angkutan Masuk
    </button>

    <!-- Tabel Angkut -->
    <div class="card">
        <!-- <h5 class="card-header">Hoverable rows</h5> -->

        <div class="table-responsive text-nowrap">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Transaksi</th>
                        <th>Tgl Masuk</th>
                        <th>Sopir</th>
                        <th>NIK</th>
                        <th>Tlp</th>
                        <th>Transporter</th>
                        <th>Armada</th>
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
                        <th>Muatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $key => $item)

                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->kode_trans }} </td>
                        <td>{{ $item->tgl_masuk ? \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $item->sopir_nama }} </td>
                        <td>{{ $item->sopir_nik }} </td>
                        <td>{{ $item->sopir_tlp }} </td>
                        <td>{{ $item->transporter }} </td>
                        <td>{{ $item->armada }} </td>
                        <td>{{ $item->nopol_mobil }} </td>
                        <td>{{ $item->customer }} </td>
                        <td>{{ $item->tgl_sj ? \Carbon\Carbon::parse($item->tgl_sj)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $item->no_sj }} </td>
                        <td>{{ $item->nama_barang }} </td>
                        <td>{{ $item->ket_in }} </td>
                        <td>{{ $item->ket_out }} </td>
                        <td>
                            <button type="button" class="btn btn-primary upload-sim-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-sim" data-id="{{ $item->id }}">
                                +
                            </button>
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
                            <button type="button" class="btn btn-primary upload-stnk-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-stnk" data-id="{{ $item->id }}">
                                +
                            </button>
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
                            <button type="button" class="btn btn-primary upload-dokumen-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-dokumen" data-id="{{ $item->id }}">
                                +
                            </button>
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
                        <td>{{ $item->waktu_in ? \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $item->waktu_out ? \Carbon\Carbon::parse($item->waktu_out)->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $item->muat_start ? \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i') : '-' }} </td>
                        <td>{{ $item->muat_stop ? \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i') : '-' }} </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#muat-start{{ $item->id }}">
                                    <i class="bx bx-play me-1"></i> Mulai
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update-muat-start')

                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#muat-done{{ $item->id }}">
                                    <i class="bx bx-check me-1"></i> Selesai
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update-muat-done')

                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#update-data{{ $item->id }}">
                                    <i class="bx bx-edit-alt me-1"></i> Update
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update')

                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-data{{ $item->id }}">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </button>

                                @include('aldo_tms.pages.angkut.modals.delete')

                            </div>
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
@include('aldo_tms.pages.angkut.modals.upload-sim')
@include('aldo_tms.pages.angkut.modals.upload-stnk')
@include('aldo_tms.pages.angkut.modals.upload-dokumen')
@include('aldo_tms.pages.angkut.modals.tambah')
@endsection