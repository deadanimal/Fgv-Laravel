<div class="input-group">
    <input class="form-control datetimepicker border-danger border-right-0" type="text" placeholder="SILA PILIH"
        data-options='{"disableMobile":true}' aria-describedby="date" name="{{ $name }}" />

    <button type="button" class="date-btn btn border-danger border-left-0"><span
            class="far fa-calendar-alt text-danger"></button>
</div>
<script>
    $(".date-btn").click(function() {
        $(this).siblings("input").trigger("click");
        // $("#form").trigger("click");
    });
</script>
