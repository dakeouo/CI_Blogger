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
                    <div class="col-lg-6" style="margin-bottom: 10px;">
                        <div class="alert alert-danger" id="msg-box" style="display: none;">
                            <?php echo $msg ?>
                        </div>
                        <form role="form" method="POST" action="<?php echo base_url("dash/changePasswd"); ?>">
                            <div style="margin-bottom: 10px;"><input class="form-control" type="password" placeholder="請輸入舊密碼" name="old_passwd"></div>
                            <div style="margin-bottom: 10px;"><input class="form-control" type="password" placeholder="請輸入新密碼" name="new_passwd"></div>
                            <div style="margin-bottom: 10px;"><input class="form-control" type="password" placeholder="再次輸入新密碼" name="confirm_passwd"></div>
                            <button type="submit" class="btn btn-primary">更新密碼</button>
                        </form>
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