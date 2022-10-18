@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Petugas" sub2="" />


    <h4 class="text-center">JUMLAH PETUGAS</h4>
    <h1 class="text-center text-danger fw-bold">{{ count($users) }}</h1>


    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row">
                <div class="col-2">
                    <p class="fw-bold">No. Kakitangan</p>
                </div>
                <div class="col-8 mt-1">
                    <input type="text" name="search" id="search" class="form-control">
                </div>
                <div class="col-2 px-0 mt-1">
                    <button class="btn btn-sm btn-danger" id="btnSearch">Cari
                        <span data-feather="search"></span>
                    </button>
                    <button class="btn btn-sm btn-link">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </button>
                </div>
            </div>
        </div>



        <div class="col-10 mt-5">
            <div class="text-end mb-3">
                <a href="{{ route('pp.create') }}" class="btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div id="tableExample2"
                        data-list='{"valueNames":["bil","kakitangan","pekerja"],"page":5,"pagination":true}'>
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th class="sort" data-sort="bil">Bil</th>
                                        <th class="sort" data-sort="kakitangan">No. Kakitangan</th>
                                        <th class="sort" data-sort="pekerja">Nama Pekerja</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($users as $user)
                                        <tr style="border-bottom:#fff">
                                            <td class="bil">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="kakitangan">
                                                {{ $user->no_kakitangan }}
                                            </td>
                                            <td class="pekerja">
                                                {{ $user->nama }}
                                            </td>
                                            <td>
                                                <button class=" btn btn-sm btn-danger">
                                                    <span data-feather="trash-2" style="width:15px;"></span>
                                                </button>
                                                <a href="{{ route('pp.edit', $user->id) }}"
                                                    class="ms-2 btn btn-sm btn-danger">
                                                    <span data-feather="edit" style="width:15px;"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous"
                                data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                            <ul class="pagination mb-0"></ul>
                            <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next"
                                data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#btnSearch').click(function() {
                $data = $('#search').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('pp.index') }}",
                    data: $data,
                    dataType: "string",
                    success: function(response) {

                    }
                });
            });

        });
    </script>
@endsection
