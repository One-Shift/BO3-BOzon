<div class="changelog"></div>
<script type="text/javascript">
    $.get(
        "http://nexus-pt.github.io/BO3/?v={c2r-version}&sv={c2r-sub-version}",
        function( data ) {
            $(".changelog").html( data );
        }
    );
</script>
