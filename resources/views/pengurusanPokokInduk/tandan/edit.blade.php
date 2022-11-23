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
                                    <select name="pokok_id" class="form-select js-choice" size="1"
                                        data-options='{"removeItemButton":true,"placeholder":true}'>
                                        @if ($tandan->pokok_i == null)
                                            <option value="">Pilih No Pokok...</option>
                                        @endif
                                        @foreach ($pokoks as $pokok)
                                            <option {{ $pokok->id == $tandan->pokok_id ? 'selected' : '' }}
                                                value="{{ $pokok->id }}">{{ $pokok->progeny }}{{ $pokok->no_pokok }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Tarikh Daftar</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <div class="input-group">
                                        <input class="form-control datetimepicker border-right-0" type="text"
                                            placeholder="SILA PILIH" data-options='{"disableMobile":true}'
                                            aria-describedby="date" value="{{ $tandan->tarikh_daftar }}"
                                            name="tarikh_daftar" required />
                                        <button type="button" class="btn border-secondary border-left-0"
                                            id="date"><span class="far fa-calendar-alt"></button>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Umur Tandan</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input type="number" class="form-control" name="umur" value="{{ $tandan->umur }}">
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
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['bagging']['tarikh'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['bagging']['petugas'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['bagging']['pengesah'] ?? '' }}">
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
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['cp']['tarikh'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['cp']['petugas'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['cp']['pengesah'] ?? '' }}">
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
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['qc']['tarikh'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['qc']['petugas'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['qc']['pengesah'] ?? '' }}">
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
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['harvest']['tarikh'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Petugas</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['harvest']['petugas'] ?? '' }}">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="">Nama Pengesah</label>
                                </div>
                                <div class="col-8 mb-3">
                                    <input readonly type="text" class="form-control"
                                        value="{{ $nama['harvest']['pengesah'] ?? '' }}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $("#date").click(function() {
            $(this).siblings("input").trigger("click");
        });
    </script>
@endsection
