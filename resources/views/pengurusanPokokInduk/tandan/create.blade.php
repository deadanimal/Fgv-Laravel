@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Daftar Tandan" />

    <div class="container my-10">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row ">
                    <div class="col-xl-2">
                        No. Daftar
                    </div>
                    <div class="col-xl-7">
                        <input type="text" name="" class="form-control border-danger">
                    </div>
                    <div class="col-xl-3">
                        <button class="btn btn-danger">Daftar <span data-feather="plus-circle"></span></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
