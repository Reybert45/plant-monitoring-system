<table class="table-striped" id="reportTable">
    <tbody>
        <tr>
            <td>
                <a type="button" onclick="generatePDF($(this))" class="btn btn-primary m-4" data-date_from="{{ $date_from }}" data-date_to="{{ $date_to }}"><span class="fa fa-file-pdf"></span> Generate PDF Report</a>
            </td>
            <td>
                <a type="button" onclick="generateExcel($(this))" class="btn btn-success m-4" data-date_from="{{ $date_from }}" data-date_to="{{ $date_to }}"><span class="fa fa-file-excel"></span> Generate EXCEL Report</a>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    function generatePDF(btn) {
        var url = "{{ url('admin/report/generatePDF') }}?date_from="+btn.data('date_from')+"&date_to="+btn.data('date_to');
        window.open(url, "_blank");
    }
    function generateExcel(btn) {
        var url = "{{ url('admin/report/generateExcel') }}?date_from="+btn.data('date_from')+"&date_to="+btn.data('date_to');
        window.open(url, "_blank");
    }
</script>

