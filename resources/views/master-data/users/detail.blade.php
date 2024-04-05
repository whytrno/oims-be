@extends('layouts.dashboard')

@section('title', 'Master Data | Users')

@section('dashboard-content')
    <div class="mb-5">
        <form method="POST" action="{{route('users.update', $data->id)}}" class="mt-4" enctype="multipart/form-data">
            @csrf

            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                        <div onclick="clickImageInput()" class="cursor-pointer avatar avatar-xl position-relative">
                            <img id="profile-image"
                                 src="{{asset($data->profile->foto ? 'storage/'.$data->profile->foto: 'img/team-3.jpg')}}"
                                 alt="bruce"
                                 class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <input type="file" name="foto" accept="image/*" style="display: none" id="profile-image-input">
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ucfirst($data->profile->nama)}}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ucfirst($data->role->name)}}
                            </p>
                        </div>
                    </div>
                    {{--                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">--}}
                    {{--                        <label class="form-check-label mb-0">--}}
                    {{--                            <small id="profileVisibility">--}}
                    {{--                                Ubah status--}}
                    {{--                            </small>--}}
                    {{--                        </label>--}}
                    {{--                        <div class="form-check form-switch ms-2">--}}
                    {{--                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked--}}
                    {{--                                   onchange="visible()">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>

            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Informasi</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <x-input name="nama" title="Nama" placeholder="Alec" type="text"
                                 value="{{ $data->profile->nama }}"/>
                        <x-input name="no_hp" title="No Hp" placeholder="08511111111" type="number"
                                 value="{{ $data->profile->no_hp }}"/>
                    </div>
                    <div class="row mt-4">
                        <x-input name="nik" title="NIK" placeholder="1111111111111111" type="number"
                                 value="{{ $data->profile->nik }}"/>
                        <x-input name="tempat_lahir" title="Tempat Lahir" placeholder="Surabaya" type="text"
                                 value="{{ $data->profile->tempat_lahir }}"/>
                    </div>
                    <div class="row mt-4">
                        <x-input name="tgl_lahir" title="Tanggal Lahir" placeholder="22-05-1996" type="date"
                                 value="{{ $data->profile->tgl_lahir }}"/>
                        <x-input name="alamat_ktp" title="Alamat KTP" placeholder="Surabaya" type="text"
                                 value="{{ $data->profile->alamat_ktp }}"/>
                    </div>
                    <div class="row mt-4">
                        <x-input name="domisili" title="Domisili" placeholder="Surabaya" type="text"
                                 value="{{ $data->profile->domisili }}"/>
                        @php
                            $agamaOptions = ["islam" => "Islam", "kristen" => "Kristen", "katolik" => "Katolik", "hindu" => "Hindu", "budha" => "Budha", "konghucu" => "Konghucu"];
                        @endphp
                        <x-select label="Agama" name="agama" :options="$agamaOptions"
                                  :selected="$data->profile->agama"/>
                    </div>
                    <div class="row mt-4">
                        @php
                            $statusPernikahanOptions = ["belum menikah" => "Belum Menikah", "menikah" => "Menikah", "cerai" => "Cerai"];
                        @endphp
                        <x-select label="Status Pernikahan" name="status_pernikahan" :options="$statusPernikahanOptions"
                                  :selected="$data->profile->status_pernikahan"/>
                        <x-input name="kontak_darurat" title="Kontak Darurat" placeholder="085111111111" type="number"
                                 value="{{ $data->profile->kontak_darurat }}"/>
                    </div>
                    <div class="row mt-4">
                        <x-input name="mcu" title="MCU" placeholder="085111111111" type="number"
                                 value="{{ $data->profile->mcu }}"/>
                        <x-input name="no_rek_bca" title="No. Rek. BCA" placeholder="085111111111" type="number"
                                 value="{{ $data->profile->no_rek_bca }}"/>
                    </div>
                    <div class="row mt-4">
                        @php
                            $pendidikanOptions = ["sd" => "SD", "smp" => "SMP", "sma" => "SMA", "d3" => "D3", "s1" => "S1", "s2" => "S2", "s3" => "S3"];
                        @endphp
                        <x-select label="Pendidikan Terakhir" name="pendidikan_terakhir" :options="$pendidikanOptions"
                                  :selected="$data->profile->pendidikan_terakhir"/>
                        <x-input name="tgl_bergabung" title="Tanggal Bergabung" placeholder="22-05-1996" type="date"
                                 value="{{ $data->profile->tgl_bergabung }}"/>
                    </div>
                    <div class="row mt-4">
                        <x-input name="nrp" title="NRP" placeholder="085111111111" type="number"
                                 value="{{ $data->profile->nrp }}"/>
                        <x-input name="no_kontrak" title="No. Kontrak" placeholder="085111111111" type="number"
                                 value="{{ $data->profile->no_kontrak }}"/>
                    </div>
                    <div class="row mt-4">
                        @php
                            $statusKontrakOptions = ["aktif" => "Aktif", "tidak aktif" => "Tidak Aktif"];
                        @endphp
                        <x-select label="Status Kontrak" name="status_kontrak" :options="$statusKontrakOptions"
                                  :selected="$data->profile->status_kontrak"/>
                        <x-input name="lokasi_site" title="Lokasi Site" placeholder="Surabaya" type="text"
                                 value="{{ $data->profile->lokasi_site }}"/>
                    </div>
                    <button class="btn bg-gradient-success mt-4" type="submit" name="button">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function clickImageInput() {
            document.getElementById('profile-image-input').click();
        }

        document.getElementById('profile-image-input').addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var imgElement = document.getElementById('profile-image');
                    imgElement.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
