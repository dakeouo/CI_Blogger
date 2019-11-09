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
                                    <button type='button' class='btn btn-default' onclick="<?php echo "location.href='".base_url("dash/category")."'";?>">返回</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tag-main-table" style="font-size: 1.1em;">
                                        <thead style="">
                                            <tr>
                                                <td>類別</td>
                                                <td width="auto">標題</td>
                                                <td width="150px">修改日期</td>
                                                <td width="150px">發布日期</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($article == -1){
                                            echo '<tr><td colspan="5">目前無資料</td></tr>';
                                        }else{
                                            foreach($article as $row) {
                                                echo "<tr>";
                                                echo "<td>".$row->category."</td>";
                                                echo "<td style='text-align:left'>".$row->title;
                                                if(!$row->status) echo '&nbsp;<span style="color: white; background-color: #666; padding: 0 5px; border-radius: 5px;">草稿</span>';
                                                echo "</td>";
                                                echo '<td>';
                                                if(!$row->editTime) echo "無";
                                                else echo $row->editTime;
                                                echo '</td>';
                                                echo '<td>';
                                                if(!$row->publishTime) echo "無";
                                                else echo $row->publishTime;
                                                echo '</td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                        </tbody> 
                                    </table>
                                </div>
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