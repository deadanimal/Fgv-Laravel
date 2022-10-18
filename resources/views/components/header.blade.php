<style>
    .main-color {
        color: #40131c;
    }
</style>

<div class="row justify-content-center">
    <div class="col-10">
        <h3 class=" mt-5 fw-bold main-color">{{ $main }}</h3>
        <h4 class="main-color">{{ $sub }}
            @if ($sub2 !== '')
                > {{ $sub2 }}
            @endif
        </h4>

        <hr style="height: 2px;opacity:100%;main-color">
    </div>
</div>
