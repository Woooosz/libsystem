var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/library/student/book/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "bno": $('#query_bno').val(),
                    "bname": $('#query_bname').val()
                };
            }
        },
        "columns": [
            {"data": "bno"},
            {"data": "bname"},
            {"data": "tname"},
            {"data": "author"},
            {"data": "price"},
            {"data": "total"},
            {"data": "remain"},
            {"data": "cdate"},
            {"data": null}
        ],
        columnDefs: [
            {
                targets: 7,
                render: function (a, b, c, d) {
                    return (new Date(c.cdate)).format('yyyy-MM-dd');
                }
            },
            {
                targets: 8,
                render: function (a, b, c, d) {
                    return "<button type='button' class='btn btn-xs btn-success' id='btn_detail' onclick='showDetail(\"" + c.id + "\")'>查看</button>&nbsp";
                }
            }
        ]
    });
});

function query() {
    table.ajax.reload();
}

function showDetail(id) {
    jQuery.ajax({
        type: 'POST',
        url: '/library/student/book/findById.php',
        cache: false,
        data: {id: id},
        success: function (data) {
            $("#detail_bno").val(data.bno);
            $("#detail_bname").val(data.bname);
            $("#detail_author").val(data.author);
            $("#detail_price").val(data.price);
            $("#detail_total").val(data.total);
            $("#detail_remain").val(data.remain);
            $("#detail_brief").val(data.brief);
            $("#detail_tid").val(data.tid);
            $('#modal_detail').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}