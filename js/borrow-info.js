var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/libsystem/admin/borrowInfo/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "bno": $("#query_bno").val(),
                    "bname": $("#query_bname").val(),
                    "sno": $("#query_sno").val(),
                    "sname": $("#query_sname").val()
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
            {"data": "timeout"},
            {"data": null},
            {"data": null}
        ],
        columnDefs: [
            {
                targets: 6,
                render: function (a, b, c, d) {
                    //return (new Date(c.bdate)).format('yyyy-MM-dd');
                    return c.bdate;
                }
            },
            {
                targets: 7,
                render: function (a, b, c, d) {
                    //return (new Date(c.rdate)).format('yyyy-MM-dd');
                    return c.rdate;
                }
            },
            {
                targets: 8,
                render: function (a, b, c, d) {
                    return c.timeout;
                }
            }
        ]
    });
});

function query() {
    table.ajax.reload();
}