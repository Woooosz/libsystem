var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/library/admin/bookType/list.php",
            "type": "POST",
            "data": function (d) {
                return {
                    "tname": $('#query_tname').val()
                };
            }
        },
        "columns": [
            {"data": "tname"},
            {"data": null}
        ],
        columnDefs: [
            {
                targets: 1,
                render: function (a, b, c, d) {
                    return "<button type='button' class='btn btn-xs btn-warning' id='btn_edit' onclick='showUpdate(\"" + c.id + "\")'>修改</button>&nbsp" +
                        "<button type='button' class='btn btn-xs btn-danger' id='btn_edit' onclick='showDel(\"" + c.id + "\")'>删除</button>";
                }
            }
        ],
    });
});

function query() {
    table.ajax.reload();
}

function showAdd() {
    $('#modal_add').modal('show');
}

function add() {
    if (!validAdd()) {
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/bookType/save.php',
        cache: false,
        data: {
            tname: $.trim($("#add_tname").val())
        },
        success: function (data) {
            if (data == 1) {
                $('#modal_add').modal('hide');
                showInfo("操作成功");
                table.ajax.reload();
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == -1) {
                showInfo("分类名称已存在，请重新输入");
            } else {
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function showUpdate(id) {
    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/bookType/findById.php',
        cache: false,
        data: {id: id},
        success: function (data) {
            var datas=eval("("+data+")");
            $("#update_id").val(id);
            $("#update_tname").val(datas.tname);
            $("#modal_update").modal("show");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function update() {
    if (!validUpdate()) {
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/bookType/update.php',
        cache: false,
        data: {
            id: $.trim($("#update_id").val()),
            tname: $.trim($("#update_tname").val())
        },
        success: function (data) {
            if (data == 1) {
                $('#modal_update').modal('hide');
                showInfo("操作成功");
                table.ajax.reload();
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == -1) {
                showInfo("分类名称已存在，请重新输入");
            } else {
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function showDel(id) {
    $('#modal_delete').modal('show');
    $('#delete_id').val(id);
}

function del() {
    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/bookType/delete.php',
        cache: false,
        data: {
            id: $('#delete_id').val()
        },
        success: function (data) {
            if (data) {
                $('#modal_delete').modal('hide');
                table.ajax.reload();
            } else {
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function validAdd() {
    var flag = true;

    var add_tname = $.trim($("#add_tname").val());
    if (update_tname == "") {
        $("#update_tname").parent().parent().addClass("has-error");
        $("#update_tname").next().text("请输入分类名称");
        flag = false;
    } else if (update_tname.length > 20) {
        $("#update_tname").parent().parent().addClass("has-error");
        $("#update_tname").next().text("分类名称长度不能大于20");
        flag = false;
    } else {
        $("#update_tname").parent().parent().removeClass("has-error");
        $("#update_tname").next().text("");
    }

    return flag;
}

function validUpdate() {
    var flag = true;

    var update_tname = $.trim($("#update_tname").val());
    if (update_tname == "") {
        $("#update_tname").parent().parent().addClass("has-error");
        $("#update_tname").next().text("请输入分类名称");
        flag = false;
    } else if (update_tname.length > 20) {
        $("#update_tname").parent().parent().addClass("has-error");
        $("#update_tname").next().text("分类名称长度不能大于20");
        flag = false;
    } else {
        $("#update_tname").parent().parent().removeClass("has-error");
        $("#update_tname").next().text("");
    }

    return flag;
}

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}