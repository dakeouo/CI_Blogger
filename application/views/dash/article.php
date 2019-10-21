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
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div style="margin-bottom: 10px; display: inline-flex;">
                                    <button type='button' class='btn btn-success' onclick="<?php echo "location.href='".base_url("dash/article/new")."'";?>">新增文章</button>
                                    <input class="form-control" style="margin-left: 10px;" placeholder="搜尋..." id="actice-search">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="artice-main-table" style="font-size: 1.1em;">
                                        <thead style="">
                                            <tr>
                                                <td>類別</td>
                                                <td style="min-width: 50%; width: auto;">標題</td>
                                                <td width="140px">發布日期</td>
                                                <td width="50px">預覽</td>
                                                <td width="50px">修改</td>
                                                <td width="50px">刪除</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                                        if($article == -1){
                                            echo '<tr><td colspan="7">目前無資料</td></tr>';
                                        }else{
                                            foreach($article as $row) {
                                                echo '<tr>';
                                                echo '<td>'.$row->category.'</td>';
                                                echo '<td style="text-align: left;">'.$row->title;
                                                if(!$row->status) echo '&nbsp;<span style="color: white; background-color: #666; padding: 0 5px; border-radius: 5px;">草稿</span>';
                                                echo '</td>';
                                                echo '<td>';
                                                if(!$row->publishTime) echo "無";
                                                else echo $row->publishTime;
                                                echo '</td>';
                                                echo "<td><button type='button' style=\"padding:4px 10px;\" class='btn btn-primary' onclick=\"\">預覽</button></td>";
                                                echo "<td>";
                                                echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-warning'onclick=\"location.href='".base_url("dash/article/edit/".$row->id)."'\">修改</button>";
                                                echo "</td>";
                                                echo "<td>";
                                                echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-danger' onclick=\"location.href='".base_url("dash/article/delete/".$row->id)."'\">刪除</button>";
                                                echo "</td>";
                                                echo "</tr>"; 
                                            }
                                        }
                                        ?>
                                        </tbody> 
                                    </table>
                                    <span id='table_page'></span>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
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
        $("#actice-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#artice-main-table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#artice-main-table').tablepage($("#table_page"), 10);
    });
    </script>