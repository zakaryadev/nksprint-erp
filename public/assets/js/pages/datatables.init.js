$(document).ready(function () {
    $("#datatable").DataTable(),
        $("#datatable-decomission")
            .DataTable({
                lengthChange: !1,
                buttons: ["excel", "colvis"],
                pageLength: 5,
            })
            .buttons()
            .container()
            .appendTo("#datatable-decomission_wrapper .col-md-6:eq(0)"),
        $("#datatable-buttons")
            .DataTable({
                lengthChange: !1,
                buttons: ["excel", "colvis"],
                pageLength: 5,
            })
            .buttons()
            .container()
            .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
        $(".dataTables_length select").addClass("form-select form-select-sm");
});
