@extends('layouts.dashboard')

@section('title', 'Master Data | Users')
@section('dashboard-content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Karyawan</h5>
                    <a href="{{ route('users.export') }}" class="btn btn-success">Export</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Lokasi Site</th>
                                @if (Auth::user()->role_id === 1)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="text-sm font-weight-normal">{{ $loop->iteration }}</td>
                                    <td class="" style="width: 100px;">
                                        <img src="{{ asset($d->profile->foto !== null ? 'storage/' . $d->profile->foto : 'img/team-3.jpg') }}"
                                            alt="" class=""
                                            style="height: 100px; width: 100px; object-fit: contain;">
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        <a href="{{ route('users.detail', $d->id) }}"
                                            class="text-decoration-underline">{{ ucfirst($d->profile->nama) }}</a>
                                    </td>
                                    <td class="text-sm font-weight-normal">{{ $d->profile->nik ?? '-' }}</td>
                                    <td class="text-sm font-weight-normal">{{ $d->profile->ttl ?? '-' }}</td>
                                    <td class="text-sm font-weight-normal">{{ $d->profile->alamat_ktp ?? '-' }}</td>
                                    <td class="text-sm font-weight-normal">{{ $d->profile->lokasi_site ?? '-' }}</td>

                                    @if (Auth::user()->role_id === 1)
                                        <td class="">
                                            <a href="{{ route('users.detail', $d->id) }}"
                                                class="text-secondary font-weight-bold text-sm" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.delete', $d->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-secondary font-weight-bold text-sm"
                                                    style="margin-left: 5px;" data-toggle="tooltip"
                                                    data-original-title="Delete user">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endpush
