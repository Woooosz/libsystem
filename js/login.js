$(function () {
    $('#login_submit').click(function () {
        var role = $("#role").val();
        if (!validLogin()) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/libsystem/login/index.php',
            cache: false,
            data: {
                username: $.trim($("#username").val()),
                password: $.trim($("#password").val()),
            },
            success: function (data) {
                if (data == 1) {
                    window.location.href = "/libsystem/student";
                } else if (data == 9){//管理员
                    window.location.href = "/libsystem/admin";
                } else if (data == 0) {
                    showInfo("登录失败，请重试");
                } else if (data == -1) {
                    showInfo("账号不存在");
                } else if (data == -2) {
                    showInfo("密码错误");
                } else {
                    showInfo("登录失败，请重试");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showInfo("登录失败，请重试");
            }
        });
    });

    var alert = $('.alert');
    var formWidth = $('.bootstrap-admin-login-form').innerWidth();
    var alertPadding = parseInt($('.alert').css('padding'));
    if (isNaN(alertPadding)) {
        alertPadding = parseInt($(alert).css('padding-left'));
    }
    $('.alert').width(formWidth - 2 * alertPadding);
});

function validLogin() {
    var flag = true;

    var username = $.trim($("#username").val());
    if (username == "") {
        $('#username').parent().addClass("has-error");
        $('#username').next().text("请输入账号");
        $("#username").next().show();
        flag = false;
    } else if (username.length > 20) {
        $("#username").parent().addClass("has-error");
        $("#username").next().text("账号长度不能大于20");
        $("#username").next().show();
        flag = false;
    } else {
        $('#username').parent().removeClass("has-error");
        $('#username').next().text("");
        $("#username").next().hide();
    }

    var password = $.trim($("#password").val());
    if (password == "") {
        $('#password').parent().addClass("has-error");
        $('#password').next().text("请输入密码");
        $("#password").next().show();
        flag = false;
    } else if (password.length > 20) {
        $("#password").parent().addClass("has-error");
        $("#password").next().text("密码长度不能大于20");
        $("#password").next().show();
        flag = false;
    } else {
        $('#password').parent().removeClass("has-error");
        $('#password').next().text("");
        $("#password").next().hide();
    }
    return flag;
}


function isEmail(str){
       var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
       return reg.test(str);
}
function isPhone(str){ 
    var reg = /^1[34578]\d{9}$/;
    return reg.test(str);
}

function validReg() {
    var flag = true;

    var add_bno = $.trim($("#add_bno").val());
    if (add_bno == "") {
        $("#add_bno").parent().parent().addClass("has-error");
        $("#add_bno").next().text("请输入用户编号");
        flag = false;
    } else if (add_bno.length > 10) {
        $("#add_bno").parent().parent().addClass("has-error");
        $("#add_bno").next().text("用户编码长度不能大于10");
        flag = false;
    } else {
        $("#add_bno").parent().parent().removeClass("has-error");
        $("#add_bno").next().text("");
    }

    var add_bname = $.trim($("#add_bname").val());
    if (add_bname == "") {
        $("#add_bname").parent().parent().addClass("has-error");
        $("#add_bname").next().text("请输入读者姓名");
        flag = false;
    } else if (add_bname.length > 10) {
        $("#add_bname").parent().parent().addClass("has-error");
        $("#add_bname").next().text("读者姓名长度不能大于10");
        flag = false;
    } else {
        $("#add_bname").parent().parent().removeClass("has-error");
        $("#add_bname").next().text("");
    }


    var add_password= $.trim($("#add_password").val());
    if (add_password == "") {
        $("#add_password").parent().parent().addClass("has-error");
        $("#add_password").next().text("请输入密码");
        flag = false;
    } else if (add_password.length > 16) {
        $("#add_password").parent().parent().addClass("has-error");
        $("#add_password").next().text("密码长度不能大于16");
        flag = false;
    } else {
        $("#add_password").parent().parent().removeClass("has-error");
        $("#add_password").next().text("");
    }
    //OK
    var add_email= $.trim($("#add_email").val());
    if (add_email == "") {
        $("#add_email").parent().parent().addClass("has-error");
        $("#add_email").next().text("请输入邮箱");
        flag = false;
    } else if (!isEmail(add_email)) {
        $("#add_email").parent().parent().addClass("has-error");
        $("#add_email").next().text("邮箱地址不合法");
        flag = false;
    } else {
        $("#add_email").parent().parent().removeClass("has-error");
        $("#add_email").next().text("");
    }

    var add_phone= $.trim($("#add_phone").val());
    if (add_email == "") {
        $("#add_phone").parent().parent().addClass("has-error");
        $("#add_phone").next().text("请输入邮箱");
        flag = false;
    } else if (!isPhone(add_phone)) {
        $("#add_phone").parent().parent().addClass("has-error");
        $("#add_phone").next().text("手机号不合法");
        flag = false;
    } else {
        $("#add_phone").parent().parent().removeClass("has-error");
        $("#add_phone").next().text("");
    }
    var add_tid = $.trim($("#add_tid").val());
    if (add_tid == "") {
        $("#add_tid").parent().parent().addClass("has-error");
        $("#add_tid").next().text("请选择所属部门");
        flag = false;
    } else {
        $("#add_tid").parent().parent().removeClass("has-error");
        $("#add_tid").next().text("");
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

function showInfo(msg) {
    $("#div_info").text(msg);
    $("#modal_info").modal('show');
}

function reg() {
    if (!validReg()) {
        return;
    }
    jQuery.ajax({
        type: 'POST',
        url: '/libsystem/login/register.php',
        cache: false,
        data: {
            bno: $.trim($("#add_bno").val()),
            name: $.trim($("#add_bname").val()),
            password: $.trim($("#add_password").val()),
            email: $.trim($("#add_email").val()),
            phone: $.trim($("#add_phone").val()),
            department: $.trim($("#add_tid").val())        
        },
        success: function (data) {
            if (data == 1) {
                $('#modal_add').modal('hide');
                showInfo("操作成功");
            } else if (data == 0) {
                showInfo("操作失败，请重试");
            } else if (data == -1) {
                showInfo("此用户编号已存在，请重新输入");
            } else {
                showInfo("操作失败，请重试");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showInfo("操作失败，请重试");
        }
    });
}
