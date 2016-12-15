var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/admin/borrow/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "sno": $("#borrow_sno").val(),
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
                    //var days = (new Date()).minus(new Date(c.rdate));
                    //return days > 0 ? days : "";
                    return c.timeout;
                }
            }
        ]
    });
});

function borrowBook() {
    if (!validBorrow()) {
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '/admin/borrow/save.php',
        cache: false,
        data: {
            bno: $.trim($("#borrow_bno").val()),
            sno: $.trim($("#borrow_sno").val()) 
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

function validBorrow() {
    var flag = true;

    var borrow_sno = $.trim($("#borrow_sno").val());
    if (borrow_sno == "") {
        $("#borrow_sno").parent().parent().addClass("has-error");
        $("#borrow_sno").next().text("请输入学号");
        $("#borrow_sno").next().show();
        flag = false;
    } else if (borrow_sno.length > 20) {
        $("#borrow_sno").parent().parent().addClass("has-error");
        $("#borrow_sno").next().text("学号长度不能大于20");
        $("#borrow_sno").next().show();
        flag = false;
    } else {
        $("#borrow_sno").parent().parent().removeClass("has-error");
        $("#borrow_sno").next().text("");
        $("#borrow_sno").next().hide();
    }

    var borrow_bno = $.trim($("#borrow_bno").val());
    if (borrow_bno == "") {
        $("#borrow_bno").parent().parent().addClass("has-error");
        $("#borrow_bno").next().text("请输入图书编号");
        $("#borrow_bno").next().show();
        flag = false;
    } else if (borrow_bno.length > 20) {
        $("#borrow_bno").parent().parent().addClass("has-error");
        $("#borrow_bno").next().text("图书编号长度不能大于20");
        $("#borrow_bno").next().show();
        flag = false;
    } else {
        $("#borrow_bno").parent().parent().removeClass("has-error");
        $("#borrow_bno").next().text("");
        $("#borrow_bno").next().hide();
    }

    return flag;
}

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}