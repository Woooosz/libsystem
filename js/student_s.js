var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/libsystem/student/book/list.php",
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
                    return "<button type='button' class='btn btn-xs btn-warning' id='btn_rent' onclick='borrowBook(\"" + c.id + "\")'>借阅</button>&nbsp" + "<button type='button' class='btn btn-xs btn-success' id='btn_detail' onclick='showDetail(\"" + c.id + "\")'>查看</button>";
                }
            }
        ]
    });
});

function query() {
    table.ajax.reload();
}

function borrowBook(id) {
    jQuery.ajax({
        type: 'POST',
        url: '/libsystem/admin/borrow/save.php',
        cache: false,
        data: {
            bno: id,
            sno: -1 
        },
        success: function (data) {
            if (data == 1) {
                showInfo("操作成功");
                table.ajax.reload();
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == -1) {
                showInfo("此学号不存在");
            } else if (data == -2) {
                showInfo("此图书编号不存在");
            } else if (data == -3) {
                showInfo("此图书在馆数量不足");
            } else if (data == -4) {
                showInfo("您已经借阅此书，不能重复借阅");
            } else if (data == -5) {
                showInfo("您的借阅图书已达上限");
            }else{
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function showDetail(id) {
    jQuery.ajax({
        type: 'POST',
        url: '/libsystem/student/book/findById.php',
        cache: false,
        data: {id: id},
        success: function (data) {
            var data=eval("("+data+")");
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
function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}