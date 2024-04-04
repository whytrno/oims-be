@extends('layouts.dashboard')

@section('title', 'Master Data | Users')
@section('dashboard-content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">Data Users</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td class="text-sm font-weight-normal">{{$loop->iteration}}</td>
                                <td class="text-sm font-weight-normal">{{$d->profile->nama}}</td>
                                <td class="text-sm font-weight-normal">{{$d->profile->no_hp}}</td>
                                <td class="text-sm font-weight-normal">{{$d->email}}</td>
                                <td class="text-sm font-weight-normal">{{$d->role->name}}</td>
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
