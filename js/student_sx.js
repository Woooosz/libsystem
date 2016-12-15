function update() {
    if (!validUpdate()) {
        return;
    }


    jQuery.ajax({
        type: 'POST',
        url: '/student/student/update.php',
        cache: false,
        data: {
                    idss: $.trim($("#update_sno").val()),
                    bname: $.trim($("#update_sname").val()),
                    password: $.trim($("#update_password").val()),
                    passwordNew: $.trim($("#update_password_new").val())
        },
        success: function (data) {
            if (data == 1) {
                showInfo("操作成功");
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == 1) {
                showInfo("此学号不存在");
            } else if (data == 2) {
                showInfo("原密码不正确");
            } else {
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}

function validUpdate() {
    var flag = true;

    var update_sname = $.trim($("#update_sname").val());
    if (update_sname == "") {
        $("#update_sname").parent().parent().addClass("has-error");
        $("#update_sname").next().text("请输入管理员名称");
        flag = false;
    } else if (update_sname.length > 50) {
        $("#update_sname").parent().parent().addClass("has-error");
        $("#update_sname").next().text("管理员名称长度不能大于50");
        flag = false;
    } else {
        $("#update_sname").parent().parent().removeClass("has-error");
        $("#update_sname").next().text("");
    }

    var update_password = $.trim($("#update_password").val());
    if (update_password == "") {
        $("#update_password").parent().parent().addClass("has-error");
        $("#update_password").next().text("请输入密码");
        flag = false;
    } else if (update_password.length > 20) {
        $("#update_password").parent().parent().addClass("has-error");
        $("#update_password").next().text("密码长度不能大于20");
        flag = false;
    } else {
        $("#update_password").parent().parent().removeClass("has-error");
        $("#update_password").next().text("");
    }

    var update_password_new = $.trim($("#update_password_new").val());
    if (update_password_new == "") {
        $("#update_password_new").parent().parent().addClass("has-error");
        $("#update_password_new").next().text("请输入新密码");
        flag = false;
    } else if (update_password_new.length > 20) {
        $("#update_password_new").parent().parent().addClass("has-error");
        $("#update_password_new").next().text("新密码长度不能大于20");
        flag = false;
    } else {
        $("#update_password_new").parent().parent().removeClass("has-error");
        $("#update_password_new").next().text("");
    }

    var update_password_confirm = $.trim($("#update_password_confirm").val());
    if (update_password_confirm == "") {
        $("#update_password_confirm").parent().parent().addClass("has-error");
        $("#update_password_confirm").next().text("请输入确认密码");
        flag = false;
    } else if (update_password_confirm.length > 20) {
        $("#update_password_confirm").parent().parent().addClass("has-error");
        $("#update_password_confirm").next().text("新密码长度不能大于20");
        flag = false;
    } else if (update_password_new != update_password_confirm) {
        $("#update_password_confirm").parent().parent().addClass("has-error");
        $("#update_password_confirm").next().text("确认密码与新密码不一致");
        flag = false;
    } else {
        $("#update_password_confirm").parent().parent().removeClass("has-error");
        $("#update_password_confirm").next().text("");
    }

    return flag;
}

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}