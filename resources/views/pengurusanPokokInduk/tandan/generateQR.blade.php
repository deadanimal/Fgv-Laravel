@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Daftar Tandan" />
    <div class="container">
        <div class="col-12 text-center">
            <form action="{{ route('downloadmanyQR') }}" method="post">
                @csrf
                <button class="btn btn-danger my-3" type="submit">Download PDF</button>
                <div class="card-group">

                    @foreach ($pokoks as $pokok)
                        <div class="card overflow-hidden">
                            <div class="card-img-top py-4">
                                {!! QrCode::size(100)->generate(URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id)) !!}
                            </div>
                        </div>
                        <input type="hidden" name="pokoks[]" value="{{ $pokok }}">
                    @endforeach

                </div>

            </form>

        </div>
    </div>
@endsection
