@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Daftar Tandan" />

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        Tarikh Daftar
                    </div>
                    <div class="col-xl-8">
                        <x-custom-date-input id="1" name="tarikh" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
