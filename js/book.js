var table;
$(function () {
    table = $('#data_list').DataTable({
        "ajax": {
            "url": "/library/admin/book/list.php",
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
            {"data": null},
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
                    return "<button type='button' class='btn btn-xs btn-success' id='btn_detail' onclick='showDetail(\"" + c.id + "\")'>查看</button>&nbsp" +
                        "<button type='button' class='btn btn-xs btn-warning' id='btn_edit' onclick='showUpdate(\"" + c.id + "\")'>修改</button>&nbsp" +
                        "<button type='button' class='btn btn-xs btn-danger' id='btn_edit' onclick='showDel(\"" + c.id + "\")'>删除</button>";
                }
            }
        ],
    });
});

function query() {
    table.ajax.reload();
}

function showDetail(id) {
    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/book/findById.php',
        cache: false,
        data: {id: id},
        success: function (data) {
            var datas=eval("("+data+")");
            $("#detail_bno").val(datas.bno);
            $("#detail_bname").val(datas.bname);
            $("#detail_author").val(datas.author);
            $("#detail_price").val(datas.price);
            $("#detail_total").val(datas.total);
            $("#detail_remain").val(datas.remain);
            $("#detail_brief").val(datas.brief);
            $("#detail_tid").val(datas.tid);
            $('#modal_detail').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
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
        url: '/library/admin/book/save.php',
        cache: false,
        data: {
            bno: $.trim($("#add_bno").val()),
            bname: $.trim($("#add_bname").val()),
            author: $.trim($("#add_author").val()),
            price: $.trim($("#add_price").val()),
            total: $.trim($("#add_total").val()),
            remain: $.trim($("#add_total").val()),
            date: $.trim($("#add_date").val()),
            brief: $.trim($("#add_brief").val()),
            tid: $("#add_tid").val()           
        },
        success: function (data) {
            if (data == 1) {
                $('#modal_add').modal('hide');
                showInfo("操作成功");
                table.ajax.reload();
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == -1) {
                showInfo("此图书编码已存在，请重新输入");
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
        url: '/library/admin/book/findById.php',
        cache: false,
        data: {id: id},
        success: function (data) {
            var datas=eval("("+data+")");
            $("#update_id").val(id);
            $("#update_bno").val(datas.bno);
            $("#update_bname").val(datas.bname);
            $("#update_author").val(datas.author);
            $("#update_price").val(datas.price);
            $("#update_total").val(datas.total);
            $("#update_remain").val(datas.remain);
            $("#update_brief").val(datas.brief);
            $("#update_tid").val(datas.tid);
            $('#modal_update').modal('show');
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
        url: '/library/admin/book/update.php',
        cache: false,
        data: {
            id: $.trim($("#update_id").val()),
            bname: $.trim($("#update_bname").val()),
            author: $.trim($("#update_author").val()),
            price: $.trim($("#update_price").val()),
            total: $.trim($("#detail_total").val()),
            remain: $.trim($("#update_remain").val()),
            brief: $.trim($("#update_brief").val()),
            tid: $("#update_tid").val()
        },
        success: function (data) {
            if (data) {
                $('#modal_update').modal('hide');
                showInfo("操作成功");
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

function showDel(id) {
    $('#modal_delete').modal('show');
    $('#delete_id').val(id);
}

function del() {
    jQuery.ajax({
        type: 'POST',
        url: '/library/admin/book/delete.php',
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

    var add_bno = $.trim($("#add_bno").val());
    if (add_bno == "") {
        $("#add_bno").parent().parent().addClass("has-error");
        $("#add_bno").next().text("请输入图书编码");
        flag = false;
    } else if (add_bno.length > 20) {
        $("#add_bno").parent().parent().addClass("has-error");
        $("#add_bno").next().text("图书编码长度不能大于20");
        flag = false;
    } else {
        $("#add_bno").parent().parent().removeClass("has-error");
        $("#add_bno").next().text("");
    }

    var add_bname = $.trim($("#add_bname").val());
    if (add_bname == "") {
        $("#add_bname").parent().parent().addClass("has-error");
        $("#add_bname").next().text("请输入图书名称");
        flag = false;
    } else if (add_bname.length > 100) {
        $("#add_bname").parent().parent().addClass("has-error");
        $("#add_bname").next().text("图书名称长度不能大于100");
        flag = false;
    } else {
        $("#add_bname").parent().parent().removeClass("has-error");
        $("#add_bname").next().text("");
    }

    var add_tid = $.trim($("#add_tid").val());
    if (add_tid == "") {
        $("#add_tid").parent().parent().addClass("has-error");
        $("#add_tid").next().text("请选择图书分类");
        flag = false;
    } else {
        $("#add_tid").parent().parent().removeClass("has-error");
        $("#add_tid").next().text("");
    }

    var add_author = $.trim($("#add_author").val());
    if (add_author == "") {
        $("#add_author").parent().parent().addClass("has-error");
        $("#add_author").next().text("请输入作者");
        flag = false;
    } else if (add_author.length > 50) {
        $("#add_author").parent().parent().addClass("has-error");
        $("#add_author").next().text("作者长度不能大于50");
        flag = false;
    } else {
        $("#add_author").parent().parent().removeClass("has-error");
        $("#add_author").next().text("");
    }

    var add_price = $.trim($("#add_price").val());
    if (add_price == "") {
        $("#add_price").parent().parent().addClass("has-error");
        $("#add_price").next().text("请输入价格");
        flag = false;
    } else if (add_price.length > 6) {
        $("#add_price").parent().parent().addClass("has-error");
        $("#add_price").next().text("价格长度不能大于6");
        flag = false;
    } else if (!add_price.match(/^[0-9]+(.[0-9]{1,2})?$/)) {
        $("#add_price").parent().parent().addClass("has-error");
        $("#add_price").next().text("请输入数字");
        flag = false;
    } else {
        $("#add_price").parent().parent().removeClass("has-error");
        $("#add_price").next().text("");
    }

    var add_total = $.trim($("#add_total").val());
    if (add_total == "") {
        $("#add_total").parent().parent().addClass("has-error");
        $("#add_total").next().text("请输入数量");
        flag = false;
    } else if (add_total.length > 4) {
        $("#add_total").parent().parent().addClass("has-error");
        $("#add_total").next().text("数量长度不能大于4");
        flag = false;

    } else if (!add_total.match(/^(0|[1-9][0-9]*)$/)) {
        $("#add_total").parent().parent().addClass("has-error");
        $("#add_total").next().text("请输入数字");
        flag = false;
    } else {
        $("#add_total").parent().parent().removeClass("has-error");
        $("#add_total").next().text("");
    }

    var add_brief = $.trim($("#add_brief").val());
    if (add_brief.length > 500) {
        $("#add_brief").parent().parent().addClass("has-error");
        $("#add_brief").next().text("简介长度不能大于500");
        flag = false;
    } else {
        $("#add_brief").parent().parent().removeClass("has-error");
        $("#add_brief").next().text("");
    }

    return flag;
}

function validUpdate() {
    var flag = true;

    var update_bname = $.trim($("#update_bname").val());
    if (update_bname == "") {
        $("#update_bname").parent().parent().addClass("has-error");
        $("#update_bname").next().text("请输入图书名称");
        flag = false;
    } else if (update_bname.length > 100) {
        $("#update_bname").parent().parent().addClass("has-error");
        $("#update_bname").next().text("图书名称长度不能大于100");
        flag = false;
    } else {
        $("#update_bname").parent().parent().removeClass("has-error");
        $("#update_bname").next().text("");
    }

    var update_tid = $.trim($("#update_tid").val());
    if (update_tid == "") {
        $("#update_tid").parent().parent().addClass("has-error");
        $("#update_tid").next().text("请选择图书分类");
        flag = false;
    } else {
        $("#update_tid").parent().parent().removeClass("has-error");
        $("#update_tid").next().text("");
    }

    var update_author = $.trim($("#update_author").val());
    if (update_author == "") {
        $("#update_author").parent().parent().addClass("has-error");
        $("#update_author").next().text("请输入作者");
        flag = false;
    } else if (update_author.length > 50) {
        $("#update_author").parent().parent().addClass("has-error");
        $("#update_author").next().text("作者长度不能大于50");
        flag = false;
    } else {
        $("#update_author").parent().parent().removeClass("has-error");
        $("#update_author").next().text("");
    }

    var update_price = $.trim($("#update_price").val());
    if (update_price == "") {
        $("#update_price").parent().parent().addClass("has-error");
        $("#update_price").next().text("请输入价格");
        flag = false;
    } else if (update_price.length > 6) {
        $("#update_price").parent().parent().addClass("has-error");
        $("#update_price").next().text("价格长度不能大于6");
        flag = false;
    } else if (!update_price.match(/^[0-9]+(.[0-9]{1,2})?$/)) {
        $("#update_price").parent().parent().addClass("has-error");
        $("#update_price").next().text("请输入数字");
        flag = false;
    } else {
        $("#update_price").parent().parent().removeClass("has-error");
        $("#update_price").next().text("");
    }

    var update_remain = $.trim($("#update_remain").val());
    if (update_remain == "") {
        $("#update_remain").parent().parent().addClass("has-error");
        $("#update_remain").next().text("请输入在库数量");
        flag = false;
    } else if (update_remain.length > 4) {
        $("#update_remain").parent().parent().addClass("has-error");
        $("#update_remain").next().text("在库数量长度不能大于4");
        flag = false;
    } else if (!update_remain.match(/^(0|[1-9][0-9]*)$/)) {
        $("#update_remain").parent().parent().addClass("has-error");
        $("#update_remain").next().text("请输入数字");
        flag = false;
    } else {
        $("#update_remain").parent().parent().removeClass("has-error");
        $("#update_remain").next().text("");
    }

    var update_brief = $.trim($("#update_brief").val());
    if (update_brief.length > 500) {
        $("#update_brief").parent().parent().addClass("has-error");
        $("#update_brief").next().text("简介长度不能大于500");
        flag = false;
    } else {
        $("#update_brief").parent().parent().removeClass("has-error");
        $("#update_brief").next().text("");
    }

    return flag;
}

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}