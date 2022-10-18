<div class="input-group">
    <input class="form-control datetimepicker border-danger border-right-0" type="text" placeholder="SILA PILIH"
        data-options='{"disableMobile":true}' aria-describedby="{{ $id }}" />

    <button class="btn border-danger border-left-0" id="{{ $id }}"><span
            class="far fa-calendar-alt text-danger"></button>
</div>
<script>
    $("#{{ $id }}").click(function() {
        $(this).siblings("input").trigger("click");
    });
</script>
