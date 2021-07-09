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
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form role="form" method="POST" action="<?php echo base_url("dash/author/link") ?>">
                                    <div class="col-lg-12" style="margin-bottom: 10px;"><button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url("dash/author") ?>'">返回</button></div>
                                    <div class="col-sm-12">
                                    <?php
                                    if($app == -1) echo '目前無資料';
                                    else{
                                        foreach($app as $row){
                                            echo '<div class="input-group" style="margin-bottom: 5px;">';
                                            echo '<span class="input-group-addon">';
                                            echo '<i class="'.$row->icon_front.' '.$row->icon_id.'"></i>&nbsp;'.$row->app.'&nbsp;</span>';
                                            echo '<input type="text" class="form-control" name="link-input[]"';
                                            if($row->link) echo 'value="'.$row->link.'">';
                                            else echo 'placeholder="NULL" value="">';
                                            echo '<input type="hidden" name="link-type[]" value="'.$row->app.'">';
                                            echo '</div>';
                                        }
                                    }?>
                                    <div style="margin-top: 10px;"><button type="submit" class="btn btn-primary">更新內容</button></div>
                                    </div>
                                </form>
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