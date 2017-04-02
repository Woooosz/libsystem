<?php
session_start();
if ($_SESSION['rdept'] != "管理员") {
	Header("HTTP/1.1 303 See Other");
	Header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<?php require_once '../../frame/header.php';?>
<script src="/libsystem/js/student.js"></script>
</head>
<?php require_once '../../frame/welcome.php';?>
<div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
<?php include ("../left_frame.php");?>
            <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">模糊查询</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal">
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_rno">学号</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_rno" type="text" value="">
                                            <label class="control-label" for="query_rno" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_rname">姓名</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_rname" type="text" value="">
                                            <label class="control-label" for="query_rname" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <button type="button" class="btn btn-primary" id="btn_query" onclick="query()">查询</button>
                                        <button type="button" class="btn btn-primary" id="btn_add" onclick="showAdd()">添加</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>密码</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addModalLabel">添加</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_add">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_sno"><label class="text-danger">*&nbsp;</label>学号</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_sno" type="text" value="" placeholder="添加后无法更改">
                                        <label class="control-label" for="add_sno"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="add_sname"><label class="text-danger">*&nbsp;</label>姓名</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_sname" type="text" value="">
                                        <label class="control-label" for="add_sname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_password"><label class="text-danger">*&nbsp;</label>密码</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_password" type="text" value="">
                                        <label class="control-label" for="add_password"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="add_type"><label class="text-danger">*&nbsp;</label>身份</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_type" type="text" value="">
                                        <label class="control-label" for="add_type"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="add_mail"><label class="text-danger">*&nbsp;</label>邮箱</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_mail" type="text" value="">
                                        <label class="control-label" for="add_mail"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="add_phone"><label class="text-danger">*&nbsp;</label>手机</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_phone" type="text" value="">
                                        <label class="control-label" for="add_phone"></label>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_add_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_add_save" onclick="add()">保存</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateModalLabel">修改</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_update">
                            <input type="hidden" id="update_id">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_sno"><label class="text-danger">*&nbsp;</label>学号</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_sno" type="text" value="" disabled>
                                        <label class="control-label" for="update_sno"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_sname"><label class="text-danger">*&nbsp;</label>姓名</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_sname" type="text" value="">
                                        <label class="control-label" for="update_sname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_password"><label class="text-danger">*&nbsp;</label>密码</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_password" type="text" value="">
                                        <label class="control-label" for="update_password"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_booknum"><label class="text-danger">*&nbsp;</label>当前借阅数量</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_booknum" type="text" value=""disabled>
                                        <label class="control-label" for="update_booknum"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_type"><label class="text-danger">*&nbsp;</label>身份</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_type" type="text" value="">
                                        <label class="control-label" for="update_type"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_mail"><label class="text-danger">*&nbsp;</label>邮箱</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_mail" type="text" value="">
                                        <label class="control-label" for="update_mail"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_phone"><label class="text-danger">*&nbsp;</label>手机</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_phone" type="text" value="">
                                        <label class="control-label" for="update_phone"></label>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_update_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_update_save" onclick="update()">保存</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">删除</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            确认删除此数据？
                            <input type="hidden" id="delete_id"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_delete_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_delete" onclick="del()">删除</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="infoModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" id="div_info"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_info_close" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>