@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Daftar Tandan" />

    <div class="container my-10">
        <form action="{{ route('pi.t.store') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="row align-items-center">

                        <div class="col-xl-2 text-end">
                            <strong> No. Daftar </strong>
                        </div>
                        <div class="col-xl-7">
                            <input type="text" name="no_daftar" class="form-control border-danger" required>
                        </div>
                        <div class="col-xl-3">
                            <button class="btn btn-danger">Daftar <span data-feather="plus-circle"></span></button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
