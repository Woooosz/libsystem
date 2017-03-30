var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/libsystem/student/borrowInfo/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "bno": $("#query_bno").val(),
                    "bname": $("#query_bname").val()
                };
            }
        },
        "columns": [
            {"data": "bno"},
            {"data": "bname"},
            {"data": "author"},
            {"data": "price"},
            {"data": "sno"},
            {"data": "sname"},
            {"data": null},
            {"data": null}
        ],
        columnDefs: [
            {
                targets: 6,
                render: function (a, b, c, d) {
                    return (new Date(c.bdate)).format('yyyy-MM-dd');
                }
            },
            {
                targets: 7,
                render: function (a, b, c, d) {
                    return (new Date(c.rdate)).format('yyyy-MM-dd');
                }
            }
        ]
    });
});

function query() {
    table.ajax.reload();
}