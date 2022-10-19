@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Daftar Tandan" />
    <div class="container mb-10 mt-5">
        <form action="{{ route('pi.t.update', $tandan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="row align-items-center">

                        <div class="col-xl-4 mb-3">
                            <strong> Tarikh. Daftar </strong>
                        </div>
                        <div class="col-xl-8 mb-3">
                            <x-custom-date-input name="tarikh_daftar" />
                        </div>

                        <div class="col-xl-4">
                            <strong> Muat Naik Fail</strong>
                        </div>
                        <div class="col-xl-8">
                            <input type="file" name="file" class="form-control border-danger" required>
                        </div>
                        <input type="hidden" name="create2" value="1">
                        <div class="text-center mt-5">
                            <button type="submit" class="ms-3 btn btn-danger">Muat Naik
                                <span class="text-white" data-feather="upload-cloud"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
