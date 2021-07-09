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
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="flot-heading">作者照片</div>
                            <div class="panel-body"  style="text-align: center;">
                                <img src="<?php echo base_url("asset/default/users/".$userphoto); ?>" style="width: 70%; max-width: 300px;" id="author-img"><br />
                                <label style="font-size: 1.2em;"><?php echo $username; ?></label><br />
                                <label style="font-size: 1em; padding-bottom: 0.2em; font-weight: 400;"><?php echo $userslogan; ?></label><br />
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#upload-img">修改</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="flot-heading">外部連結</div>
                            <div class="panel-body">
                                <div class="col-sm-offset-11" style="margin-bottom: 10px;"><button type="button" class="btn btn-warning" onclick="location.href='<?php echo base_url("dash/author/link") ?>'">修改</button></div>
                                <?php
                                if($app == -1){
                                    echo '<div class="col-lg-12">目前無資料</div>';
                                }else{
                                    foreach($app as $row){
                                        echo '<div class="col-lg-6 author-link">';
                                        echo '<i class="'.$row->icon_front.' '.$row->icon_id.'"></i>';
                                        echo '<b>&nbsp;'.$row->app.'&nbsp;</b>';
                                        if(!$row->link) echo '<label class="null">Your&nbsp;'.$row->app.'&nbsp;link</label><br />';
                                        else echo '<label>'.$row->link.'</b></label><br />';
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="flot-heading" style="margin-bottom: 10px;">關於我內容</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="col-sm-offset-11"><button type="button" class="btn btn-warning" onclick="location.href='<?php echo base_url("dash/author/info") ?>'">修改</button></div>
                                <div style="width: 100%;"><?php include_once $this->config->item('content_url').$this->config->item('about_file').".html"; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="upload-img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">上傳照片</h4>
                    </div>
                    <form role="form" method="POST" action="<?php echo base_url("dash/author/upload"); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4" style="text-align: center;">
                                <input type="file" style="margin-bottom: 10px;" id="img-works-item" accept="image/gif, image/jpeg, image/png" name="author-img" />
                                <img src="<?php echo base_url("asset/default/users/".$userphoto); ?>" style="width: 80%" id="preview-works-img">
                            </div>
                            <div class="col-lg-8">
                                <label>作者姓名</label>
                                <input class="form-control" placeholder="作者姓名" name="author-name" value="<?php echo $username; ?>" required>
                                <br />
                                <label>Slogan</label>
                                <input class="form-control" placeholder="Slogan" name="author-slogan" value="<?php echo $userslogan; ?>" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button><input type="submit" class="btn btn-primary" value="修改">
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
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview-works-img").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img-works-item").change(function(){readURL(this);}); //當檔案改變後，做一些事
    </script>