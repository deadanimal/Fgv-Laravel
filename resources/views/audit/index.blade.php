@extends('layouts.base')
@section('content')
    <x-header main="Jejak Audit" sub="Audit" sub2="" />


    <div class="row justify-content-center mt-4">
        <div class="col-10">
            <div class="row">
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th>Bil</th>
                                        <th>No. Kakitangan</th>
                                        <th>Tindakan</th>
                                        <th>Keterangan</th>
                                        <th>Tarikh Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($logs as $log)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $log->causer->no_kakitangan }}
                                            </td>
                                            <td>
                                                {{ $log->event }}
                                            </td>
                                            <td>
                                                {{ $log->description }}
                                            </td>
                                            <td>
                                                {{ $log->updated_at->format('d/m/Y') }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
