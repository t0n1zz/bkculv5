<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Select/js/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.html5.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );
    });
    // $(document).ready(function() {
    //     $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
    //         $($.fn.dataTable.tables(true)).DataTable()
    //               .columns.adjust()
    //               .responsive.recalc();
    //     } );
    // } );
</script>