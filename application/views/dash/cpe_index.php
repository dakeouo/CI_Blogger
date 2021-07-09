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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="artice-main-table" style="font-size: 1.1em;">
                                        <thead style="">
                                            <tr>
                                                <td width="30px">No.</td>
                                                <td style="min-width: 20em; width: auto;">題目</td>
                                                <td width="150px">題號</td>
                                                <td width="150px">完成日期</td>
                                                <td width="50px">預覽</td>
                                                <td width="50px">上傳</td>
                                                <td width="50px">刪除</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                                        if($CPE_list == -1){
                                            echo '<tr><td colspan="7">目前無資料</td></tr>';
                                        }else{
                                            foreach($CPE_list as $row) {
                                                echo '<tr>';
                                                echo '<td>'.$row->no.'</td>';
                                                echo '<td style="text-align: left;">['.$row->category.']'.$row->topic.'</td>';
                                                echo '<td>UVA'.$row->uva.'</td>';
                                                echo '<td>';
                                                if(!$row->finishTime) echo "無";
                                                else echo $row->finishTime;
                                                echo '</td>';
                                                if(!$row->finishTime){
                                                    echo "<td><button type='button' style=\"padding:4px 10px;\" class='btn btn-primary disabled' onclick=\"location.href='#'\">預覽</button></td>";
                                                }else{
                                                    echo "<td><button type='button' style=\"padding:4px 10px;\" class='btn btn-primary' onclick=\"location.href='".base_url("dash/cpe/preview/".$row->uva)."'\">預覽</button></td>";
                                                }
                                                echo "<td>";
                                                if($row->finishTime){
                                                    echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-warning disabled' onclick=\"location.href='#'\">上傳</button>";
                                                }else{
                                                    echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-warning'  data-toggle=\"modal\" data-target=\"#myModal".$row->no."\">上傳</button>";
                                                    echo "<div class=\"modal fade\" id=\"myModal".$row->no."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\"><div class=\"modal-dialog\" role=\"document\"><div class=\"modal-content\"><div class=\"modal-header\"><h4 class=\"modal-title\" id=\"myModalLabel\">上傳程式碼</h4></div><form role=\"form\" method=\"POST\" action=\"".base_url("dash/cpe/upload")."\"  enctype=\"multipart/form-data\" style=\"text-align:left;\"><div class=\"modal-body\"><label>題號：UVA".$row->uva."</label><br /><label>題目：[".$row->category.']'.$row->topic."</label><br /><input type=\"file\" style=\"margin-bottom: 10px;\" accept=\".c,.cpp\" name=\"upload_code\" /><input type=\"hidden\"  name=\"uva\" value=\"".$row->uva."\" /></div><div class=\"modal-footer\"><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">關閉</button><input type=\"submit\" class=\"btn btn-warning\" value=\"上傳\"></div></form></div></div></div>";
                                                }
                                                echo "</td>";
                                                echo "<td>";
                                                if(!$row->finishTime){
                                                    echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-danger disabled' onclick=\"location.href='#'\">刪除</button>";
                                                }else{
                                                    echo "<button type='button' style=\"padding:4px 10px;\" class='btn btn-danger' onclick=\"location.href='".base_url("dash/cpe/delete/".$row->uva)."'\">刪除</button>";
                                                }
                                                echo "</td>";
                                                echo "</tr>"; 
                                            }
                                        }
                                        ?>
                                        </tbody> 
                                    </table>
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