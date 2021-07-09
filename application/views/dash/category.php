<body onload="index()">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><?php echo $title; ?></h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <div class="alert alert-danger" id="msg-box" style="display: none;">
                            <?php echo $msg ?>
                        </div>
                        <div class="col-lg-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">類別管理</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div style="margin-bottom: 10px; display: inline-flex;">
                                    <button type='button' class='btn btn-success' data-toggle="modal" data-target="#new-cate">新增類別</button>
                                    <input class="form-control" style="margin-left: 10px;" placeholder="搜尋..." id="category-search">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="category-main-table" style="font-size: 1.1em;">
                                        <thead style="">
                                            <tr>
                                                <td width="50px">編號</td>
                                                <td>名稱</td>
                                                <td width="70px">文章數</td>
                                                <td width="50px">檢視</td>
                                                <td width="50px">修改</td>
                                                <td width="50px">刪除</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($category == -1){
                                            echo '<tr><td colspan="6">目前無資料</td></tr>';
                                        }else{
                                            $cid = 0;
                                            foreach($category as $row) {
                                                echo '<tr>';
                                                echo '<td>'.$row->id.'</td>';
                                                echo '<td style=\'text-align:left\'>'.$row->name.'</td>';
                                                echo '<td>'.$row->times.'</td>';
                                                echo "<td><button type='button' style=\"padding:4px 10px;\" class='btn btn-primary' onclick=\"location.href='".base_url("dash/category/view/").$row->id."'\">檢視</button></td>";
                                                echo "<td>";
                                                echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-warning'  data-toggle=\"modal\" data-target=\"#myModal".$cid."\">修改</button>";
                                                echo "<div class=\"modal fade\" id=\"myModal".$cid."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\"><div class=\"modal-dialog\" role=\"document\"><div class=\"modal-content\"><div class=\"modal-header\"><h4 class=\"modal-title\" id=\"myModalLabel\">修改類別(".$row->id.")</h4></div><form role=\"form\" method=\"POST\" action=\"".base_url("dash/category/edit")."\"><div class=\"modal-body\"><input type=\"hidden\" name=\"id\" value=\"".$row->id."\"><input class=\"form-control\" placeholder=\"".$row->name."\" name=\"name\" required></div><div class=\"modal-footer\"><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">關閉</button><input type=\"submit\" class=\"btn btn-primary\" value=\"更新\"></div></form></div></div></div>";
                                                echo "</td>";
                                                echo "<td>";
                                                echo "<button type=\"button\" style=\"padding:4px 10px;\" class=\"btn btn-danger\" onclick=\"location.href='".base_url("dash/category/delete/").$row->id."'\">刪除</button>";
                                                echo "</td>";
                                                echo '</tr>';
                                                $cid++;
                                            }
                                        } 
                                        ?>
                                        </tbody> 
                                    </table>
                                    <span id='table_page'></span>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <div class="col-lg-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">標籤</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div style="margin-bottom: 10px; display: inline-flex;">
                                    <input class="form-control" placeholder="搜尋..." id="tag-search">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tag-main-table" style="font-size: 1.1em;">
                                        <thead style="">
                                            <tr>
                                                <td>名稱</td>
                                                <td width="70px">文章數</td>
                                                <td width="50px">檢視</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($tag == -1){
                                            echo '<tr><td colspan="3">目前無資料</td></tr>';
                                        }else{
                                            $tid = 0;
                                            foreach($tag as $row) {
                                                echo '<tr>';
                                                echo '<td style=\'text-align:left\'>'.$row->name.'</td>';
                                                echo '<td>'.$row->times.'</td>';
                                                echo "<td><button type='button' style=\"padding:4px 10px;\" class='btn btn-primary' onclick=\"location.href='".base_url("dash/category/tagView/".$row->name)."'\">檢視</button></td>";
                                                $tid++;
                                            }
                                        } 
                                        ?>
                                        </tbody> 
                                    </table>
                                    <span id='table_page1'></span>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="new-cate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">新增類別</h4>
                    </div>
                    <form role="form" method="POST" action="<?php echo base_url("dash/category"); ?>">
                    <div class="modal-body">
                        <input class="form-control" placeholder="類別名稱" name="name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button><input type="submit" class="btn btn-success" value="新增">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function index(){
            var msg = document.getElementById('msg-box').innerHTML;
            if(msg == -1) document.getElementById('msg-box').style.display = "none";
            else document.getElementById('msg-box').style.display = "block";
        }
    </script>
    <script>
    $(document).ready(function() {
        $("#category-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#category-main-table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#category-main-table').tablepage($("#table_page"), 10);
        $("#tag-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tag-main-table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#tag-main-table').tablepage($("#table_page1"), 10);
    });
    </script>