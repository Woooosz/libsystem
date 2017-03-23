var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/libsystem/admin/return/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "sno": $("#return_sno").val()
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
            {"data": "fine"},
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
                    //return c.fine;
                    return c.fine;
                }
            }
        ]
    });
});

function returnBook() {
    if (!validReturn()) {
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '/libsystem/admin/return/save.php',
        cache: false,
        data: {
            bno: $.trim($("#return_bno").val()),
            sno: $.trim($("#return_sno").val())
        },
        success: function (data) {
            if (data == 1) {
                showInfo("操作成功")
                table.ajax.reload();
            } else if (data == 0) {
                showInfo("操作失败，请重试")
            } else if (data == -1) {
                showInfo("此学号不存在")
            } else if (data == -2) {
                showInfo("此图书编号不存在")
            } else if (data == -3) {
                showInfo("您未借阅此书")
            } else {
                showInfo("操作失败，请重试")
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试")
        }
    });
}

function validReturn() {
    var flag = true;

    var return_sno = $.trim($("#return_sno").val());
    if (return_sno == "") {
        $("#return_sno").parent().parent().addClass("has-error");
        $("#return_sno").next().text("请输入学号");
        $("#return_sno").next().show();
        flag = false;
    } else if (return_sno.length > 20) {
        $("#return_sno").parent().parent().addClass("has-error");
        $("#return_sno").next().text("学号长度不能大于20");
        $("#return_sno").next().show();
        flag = false;
    } else {
        $("#return_sno").parent().parent().removeClass("has-error");
        $("#return_sno").next().text("");
        $("#return_sno").next().hide();
    }

    var return_bno = $.trim($("#return_bno").val());
    if (return_bno == "") {
        $("#return_bno").parent().parent().addClass("has-error");
        $("#return_bno").next().text("请输入图书编号");
        $("#return_bno").next().show();
        flag = false;
    } else if (return_bno.length > 20) {
        $("#return_bno").parent().parent().addClass("has-error");
        $("#return_bno").next().text("图书编号长度不能大于20");
        $("#return_bno").next().show();
        flag = false;
    } else {
        $("#return_bno").parent().parent().removeClass("has-error");
        $("#return_bno").next().text("");
        $("#return_bno").next().hide();
    }

    return flag;
}

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}