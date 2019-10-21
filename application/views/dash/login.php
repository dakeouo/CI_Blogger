<body onload="index()">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        <img src="<?php echo base_url("asset/default/logo.png"); ?>" height="30px" style="margin-bottom: 10px;">
                        <h3 class="panel-title">Blogger Admin System</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" id="msg-box" style="display: none;">
                            <?php echo $msg ?>
                        </div>
                        <form role="form" method="POST" action="<?php echo base_url("dash/login"); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="mode" value="0">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="login">
                            </fieldset>
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
