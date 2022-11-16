@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Maklumat Tandan" />
    <div class="container mt-5">
        <form action="{{ route('pi.t.update', $tandan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row justify-content-center">
                <div class="col-xl-8 mb-4">
                    <div class="row align-items-center">
                        <div class="col-xl-3 text-end">
                            <label for="">No Daftar</label>
                        </div>
                        <div class="col-xl-6">
                            <input type="text" class="form-control border-danger" value="{{ $tandan->no_daftar }}">
                        </div>
                        <div class="col-xl-3">
                            <button class="btn btn-danger">Kemaskini
                                <span data-feather="check-circle"></span>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-xl-10">
                    <div class="row mt-5">


                        <div class="col-xl-5">
                            <div class="row align-items-center">
                                <div class="col-4 mb-3">
                                    <label for="">Nombor Pokok</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <select name="pokok_id" class="form-select">
                                        <option selected disabled hidden> Sila Pilih</option>
                                        @foreach ($pokoks as $pokok)
                                            <option {{ $pokok->id == $tandan->pokok_id ? 'selected' : '' }}
                                                value="{{ $pokok->id }}">{{ $pokok->no_pokok }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Daftar</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input type="date" class="form-control" name="tarikh_daftar"
                                        value="{{ $tandan->tarikh_daftar }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Umur Tandan</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input type="text" class="form-control" name="umur" value="{{ $tandan->umur }}">
                                </div>

                                <div class="col-12 mt-5">
                                    <strong class="bg-danger p-2 text-white mb-0"
                                        style="border-top-right-radius: 5px;">Balut</strong>
                                    <hr class="bg-danger border-2 border-top border-danger" style="margin-top:7px">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Balut</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="date" class="form-control" name="b_tarikh"
                                        value="{{ $tandan->bagging->tarikh ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="b_petugas"
                                        value="{{ $tandan->bagging->petugas ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="b_pengesah"
                                        value="{{ $tandan->bagging->pengesah ?? '' }}">
                                </div>

                                <div class="col-12 mt-5">
                                    <strong class="bg-danger p-2 text-white mb-0"
                                        style="border-top-right-radius: 5px;">Pendebungaan Terkawal</strong>
                                    <hr class="bg-danger border-2 border-top border-danger" style="margin-top:7px">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Pendebungaan Terkawal</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="date" class="form-control" name="p_tarikh"
                                        value="{{ $tandan->cp->tarikh ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="p_petugas"
                                        value="{{ $tandan->cp->petugas ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="p_pengesah"
                                        value="{{ $tandan->cp->pengesah ?? '' }}">
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-2"> </div>

                        <div class="col-xl-5">
                            <div class="row align-items-center">

                                <div class="col-12">
                                    <strong class="bg-danger p-2 text-white mb-0"
                                        style="border-top-right-radius: 5px;">Kawalan Kualiti</strong>
                                    <hr class="bg-danger border-2 border-top border-danger" style="margin-top:7px">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Kawalan Kualiti</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="date" class="form-control" name="k_tarikh"
                                        value="{{ $tandan->kualiti->tarikh ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="k_petugas"
                                        value="{{ $tandan->kualiti->petugas ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="k_pengesah"
                                        value="{{ $tandan->kualiti->pengesah ?? '' }}">
                                </div>

                                <div class="col-12 mt-5">
                                    <strong class="bg-danger p-2 text-white mb-0"
                                        style="border-top-right-radius: 5px;">Tuai</strong>
                                    <hr class="bg-danger border-2 border-top border-danger" style="margin-top:7px">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Penuaian</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="date" class="form-control" name="t_tarikh"
                                        value="{{ $tandan->tuai->tarikh ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="t_petugas"
                                        value="{{ $tandan->tuai->petugas ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control" name="t_pengesah"
                                        value="{{ $tandan->tuai->pengesah ?? '' }}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
