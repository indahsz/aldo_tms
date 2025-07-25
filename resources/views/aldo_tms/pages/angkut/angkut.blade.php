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

        <form method="GET" action="{{ route('angkut.index') }}" class="mb-4">
            <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..."
                    aria-describedby="basic-addon-search31" value="{{ request('search') }}" />

                <input type="date" name="date_from" value="{{ request('date_from') }}">
                <input type="date" name="date_to" value="{{ request('date_to') }}">

                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="table-responsive">

            <table class="table table-hover table-striped wrap" style="font-size: 13px; width:100%;">
                <thead>
                    <tr style="text-align: center">
                        <th class="text-nowrap">No.</th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'kode_trans', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">No.
                                Tiket</a></th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'tgl_masuk', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Tgl
                                Masuk</a></th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'departement', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Dept</a>
                        </th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'sopir_nama', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Sopir</a>
                        </th>
                        <th class="text-nowrap">NIK</th>
                        <th class="text-nowrap">Tlp</th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'transporter', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Transporter
                        </th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'armada', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Armada
                        </th>
                        <th class="text-nowrap">Jenis</th>
                        <th class="text-nowrap">Plat Mobil</th>
                        <th class="text-nowrap"><a
                                href="{{ route('angkut.index', ['sort_field' => 'customer', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Customer
                        </th>
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
                        <th class="text-wrap">Muatan</th>
                        <th class="text-wrap">Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->kode_trans }} </td>
                        <td>{{ $item->tgl_masuk ? \Carbon\Carbon::parse($item->tgl_masuk)->format('d F Y') : '-' }}</td>
                        <td style="text-align: center;">{{ $item->departement }} </td>
                        <td>{{ $item->sopir_nama }} </td>
                        <td>{{ $item->sopir_nik }} </td>
                        <td>{{ $item->sopir_tlp }} </td>
                        <td>{{ $item->transporter }} </td>
                        <td>{{ $item->armada }} </td>
                        <td>{{ $item->jenis_mobil }} </td>
                        <td>{{ $item->nopol_mobil }} </td>
                        <td>{{ $item->customer }} </td>
                        <td>{{ $item->tgl_sj ? \Carbon\Carbon::parse($item->tgl_sj)->format('d F Y') : '-' }}</td>
                        <td>{{ $item->no_sj }} </td>
                        <td>{{ $item->nama_barang }} </td>
                        <td>{{ $item->ket_in }} </td>
                        <td>{{ $item->ket_out }} </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary upload-sim-btn" data-bs-toggle="modal"
                             data-bs-target="#upload-sim" data-id="{{ $item->id }}">
                                <i class="bx bx-upload"></i>
                            </button>
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
                            <button type="button" class="btn btn-primary px-2 py-1 upload-stnk-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-stnk" data-id="{{ $item->id }}">
                                <i class="bx bx-upload"></i>
                            </button>
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
                            <button type="button" class="btn btn-primary px-2 py-1 upload-dokumen-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-dokumen" data-id="{{ $item->id }}">
                                <i class="bx bx-upload"></i>
                            </button>
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
                            <button type="button" class="btn btn-primary px-2 py-1 upload-dokumen-k-btn" data-bs-toggle="modal"
                                data-bs-target="#upload-dokumen-k" data-id="{{ $item->id }}">
                                <i class="bx bx-upload"></i>
                            </button>
                            @if (!empty($item->foto_dokumen_k))
                            <a href="{{ asset('storage/' . $item->foto_dokumen_k) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->foto_dokumen_k) }}" alt="Foto DOKUMEN"
                                    width="50" height="50" class="rounded img-thumbnail">
                            </a>
                            @else
                            <p>No image</p>
                            @endif
                        </td>
                        <td>{{ $item->safety_check ? 'Lengkap' : 'Tidak Lengkap' }}</td>
                        <td>{{ $item->waktu_in ? \Carbon\Carbon::parse($item->waktu_in)->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td>{{ $item->waktu_out ? \Carbon\Carbon::parse($item->waktu_out)->format('d-m-Y H:i') : '-' }}
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
                        <td>{{ $item->muat_start ? \Carbon\Carbon::parse($item->muat_start)->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td>{{ $item->muat_stop ? \Carbon\Carbon::parse($item->muat_stop)->format('d-m-Y H:i') : '-' }}
                        </td>
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
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#muat-start{{ $item->id }}">
                                    <i class="bx bx-play me-1"></i> Mulai
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update-muat-start')

                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#muat-done{{ $item->id }}">
                                    <i class="bx bx-check me-1"></i> Selesai
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update-muat-done')

                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#update-data{{ $item->id }}">
                                    <i class="bx bx-edit-alt me-1"></i> Update
                                </button>

                                @include('aldo_tms.pages.angkut.modals.update')

                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-data{{ $item->id }}">
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
@include('aldo_tms.pages.angkut.modals.upload-dokumen-k')
@include('aldo_tms.pages.angkut.modals.tambah')
@endsection