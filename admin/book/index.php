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
<script src="/libsystem/js/book.js"></script>
</head>
<body class="bootstrap-admin-with-small-navbar">
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
                                <div class="text-muted bootstrap-admin-box-title">查询</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal">
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_bno">图书编号</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_bno" type="text" value="">
                                            <label class="control-label" for="query_bno" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_bname">图书名称</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_bname" type="text" value="">
                                            <label class="control-label" for="query_bname" style="display: none;"></label>
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
                                <th>图书编号</th>
                                <th>图书名称</th>
                                <th>分类</th>
                                <th>作者</th>
                                <th>价格</th>
                                <th>总数量</th>
                                <th>在馆数量</th>
                                <th>上架时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="detailModalLabel">查看</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_detail">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_bno">图书编号</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_bno" type="text" value="" disabled>
                                        <label class="control-label" for="detail_bno"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_bname">图书名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_bname" type="text" value="" disabled>
                                        <label class="control-label" for="detail_bname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_tid">图书分类</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="detail_tid" disabled>
                                            <option value="">请选择</option>
<?php
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$conn->sql = "SELECT * FROM type";
$res       = $conn->fetch_res();
for ($i = 0; $i < count($res); ++$i) {
	echo "<option value=\"".$res[$i]['typeid']."\">".$res[$i]['btype']."</option>";
}
?>
</select>
                                        <label class="control-label" for="detail_tid"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_author">作者</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_author" type="text" value="" disabled>
                                        <label class="control-label" for="detail_author"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_price">价格</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_price" type="text" value="" disabled>
                                        <label class="control-label" for="detail_price"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_total">数量</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_total" type="text" value="" disabled>
                                        <label class="control-label" for="detail_total"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_remain">在馆数量</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="detail_remain" type="text" value="" disabled>
                                        <label class="control-label" for="detail_remain"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="detail_brief">简介</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5" id="detail_brief" placeholder="500字以内" disabled></textarea>
                                        <label class="control-label" for="detail_brief"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_detail_close" data-dismiss="modal">关闭</button>
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
                                    <label class="col-lg-3 control-label" for="add_bno"><label class="text-danger">*&nbsp;</label>图书编号</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_bno" type="text" value="">
                                        <label class="control-label" for="add_bno"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="add_bname"><label class="text-danger">*&nbsp;</label>图书名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_bname" type="text" value="">
                                        <label class="control-label" for="add_bname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_tid"><label class="text-danger">*&nbsp;</label>图书分类</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="add_tid">
                                            <option value="">请选择</option>
<?php
for ($i = 0; $i < count($res); ++$i) {
	echo "<option value=\"".$res[$i]['typeid']."\">".$res[$i]['btype']."</option>";
}
?>
</select>
                                        <label class="control-label" for="add_tid"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_author"><label class="text-danger">*&nbsp;</label>作者</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_author" type="text" value="">
                                        <label class="control-label" for="add_author"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_price"><label class="text-danger">*&nbsp;</label>价格</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_price" type="text" value="">
                                        <label class="control-label" for="add_price"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_total"><label class="text-danger">*&nbsp;</label>数量</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_total" type="text" value="">
                                        <label class="control-label" for="add_total"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_date"><label class="text-danger">*&nbsp;</label>入库时间</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_date" type="text" value="" placeholder="格式'YYYY-MM-DD'缺省为当前日期">
                                        <label class="control-label" for="add_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_brief">简介(选填)</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5" id="add_brief" placeholder="500字以内"></textarea>
                                        <label class="control-label" for="add_brief"></label>
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
                                    <label class="col-lg-3 control-label" for="update_bno"><label class="text-danger">*&nbsp;</label>图书编号</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_bno" type="text" value="" disabled>
                                        <label class="control-label" for="update_bno"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_bname"><label class="text-danger">*&nbsp;</label>图书名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_bname" type="text" value="">
                                        <label class="control-label" for="update_bname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_tid"><label class="text-danger">*&nbsp;</label>图书分类</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="update_tid">
                                            <option value="">请选择</option>
<?php
for ($i = 0; $i < count($res); ++$i) {
	echo "<option value=\"".$res[$i]['typeid']."\">".$res[$i]['btype']."</option>";
}
?>
                                        </select>
                                        <label class="control-label" for="update_tid"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_author"><label class="text-danger">*&nbsp;</label>作者</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_author" type="text" value="">
                                        <label class="control-label" for="update_author"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_price"><label class="text-danger">*&nbsp;</label>价格</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_price" type="text" value="">
                                        <label class="control-label" for="update_price"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_remain"><label class="text-danger">*&nbsp;</label>在馆数量</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_remain" type="text" value="">
                                        <label class="control-label" for="update_remain"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_brief">简介</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5" id="update_brief" placeholder="500字以内"></textarea>
                                        <label class="control-label" for="update_brief"></label>
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