@extends('layouts.base')
@section('content')
    <style>
        * {
            box-sizing: border-box
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
    </style>

    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="Maklumat Tugas" />
    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row">
                <div class="col-xl-5">

                    @if ($type == '2')
                        <div class="slideshow-container">

                            <!-- Full-width images with number and caption text -->
                            @foreach ($tugasan->gambar as $g)
                                <div class="mySlides">
                                    <div class="numbertext">{{ $loop->iteration }} / {{ count($tugasan->gambar) }}</div>
                                    <img src="{{ url($g) }}" style="width:100%" class="img-fluid">
                                </div>
                            @endforeach

                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                        <br>

                        <!-- The dots/circles -->
                        <div style="text-align:center">
                            @foreach ($tugasan->gambar as $g)
                                <span class="dot" onclick="currentSlide({{ $loop->iteration }})"></span>
                            @endforeach
                        </div>
                    @else
                        <img src="{{ url('/storage/' . $tugasan->url_gambar ?? '/test-image/test1.png') }}"
                            class="img-fluid">
                    @endif
                </div>

                <div class="col-xl-1"></div>

                <div class="col-xl-6">
                    {{-- <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Status</label>
                        </div>
                        <div class="col-8">
                            @if ($tugasan->status == 'sah')
                                <input type="text" class="form-control border-success" value="Disahkan" readonly>
                            @elseif($tugasan->status == 'rosak')
                                <input type="text" class="form-control border-danger" value="Rosak" readonly>
                            @endif
                        </div>
                    </div> --}}

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Aktiviti Kerja</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->jenis }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Daftar</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->tandan->no_daftar ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Pokok</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->pokok->no_pokok ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh @switch($type)
                                    @case(1)
                                        Balut
                                    @break

                                    @case(2)
                                        CP
                                    @break

                                    @case(3)
                                        QC
                                    @break

                                    @case(4)
                                        Tuai
                                    @break

                                    @default
                                @endswitch
                            </label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->created_at->format('d/m/Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama @switch($type)
                                    @case(1)
                                        Pembalut
                                    @break

                                    @case(4)
                                        Penuai
                                    @break

                                    @default
                                        Petugas
                                @endswitch
                            </label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->petugas->nama ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama Penyelia</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->pengesah->nama ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh Pengesahan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control"
                                value="{{ $tugasan->updated_at->format('d/m/Y') ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="text-center">
                            <a class="btn btn-danger" href="{{ route('tugasan.index') }}">Kembali</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
@endsection
