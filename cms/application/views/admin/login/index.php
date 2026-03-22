<html>

<head>
    <?php $this->load->view('admin/head'); ?>
    <link href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>

    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.md5.js" type="text/javascript"></script>
</head>

<body class="nobg loginPage" style="min-height:100%;">
    <div class="bg-login"></div>
    <!-- Main content wrapper -->
    <div style="top:45%;" class="loginWrapper">
        <div class="login-logo">
            <a href="#"><img src="../public/admin/images/bg2.png" style="width: 60px;
margin-right: 10px;" alt=""><b>Admin</b></a>
        </div>
        <input type="hidden" id="username">
        <input type="hidden" id="nickname">
        <input type="hidden" id="iduser">

        <div style="height:auto; margin:auto;" id="admin_login" class="widget">
            <div class="title">
                <span>Đăng nhập</span>
            </div>
            <br />
            <form method="post" action="" id="form" class="form">

                <div class="formRow">
                    <input type="text" id="param_username" name="username" class="loginInput"
                        placeholder="Tên đăng nhập">
                    <br />
                    <input type="password" id="param_password" name="password" class="loginInput"
                        placeholder="Mật khẩu">
                </div>
                <div class="loginControl">
                    <div style="color:red;font-weight:bold;text-align:center" id="validate-text">
                        <?php if (isset($message) && $message): ?><?php echo $message ?><?php endif; ?></div>
                    <input type="hidden" value="1" name="submit">
                    <input type="button" class="dredB logMeIn" value="Đăng nhập" id="login" style="margin-top: 10px;
						margin: 10px auto 0;
						display: block;
						float: none;">

                    <div class="clear"></div>
                </div>

            </form>
            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="mySmallModalLabel">Nhập OTP</h4>
                        </div>
                        <div class="modal-body" style="height: 100px">

                            <input class="form-control" type="text" id="odplogin" placeholder="Nhập OTP">
                            <input type="button" class="blueB logMeIn pull-right" style="margin-top: 10px"
                                value="Đăng nhập" id="loginodp">
                        </div>
                        <div class="modal-footer">
                           
                        </div>
                    </div>
                </div>
            </div>
            <style>
            .spinner {
                position: fixed;
                top: 50%;
                left: 50%;
                margin-left: -50px;
                /* half width of the spinner gif */
                margin-top: -50px;
                /* half height of the spinner gif */
                text-align: center;
                z-index: 1234;
                overflow: auto;
                width: 100px;
                /* width of the spinner gif */
                height: 102px;
                /*hight of the spinner gif +2px to fix IE8 issue */
            }
            </style>
            <div id="spinner" class="spinner" style="display:none;">
                <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
            </div>
        </div>
    </div>
    </div>

</body>

</html>
<script>
$('#param_password').keyup(function(e) {
    var enterKey = 13;
    if (e.which == enterKey) {
        if ($("#param_password").val() == "" && $("#param_username").val() == "") {
            $("#validate-text").html("Bạn chưa nhập tên đăng nhập và mật khẩu");
            return false;
        }
        if ($("#param_username").val() == "") {
            $("#validate-text").html("Bạn chưa nhập tên đăng nhập");
            return false;
        }
        if ($("#param_password").val() == "") {
            $("#validate-text").html("Bạn chưa nhập mật khẩu");
            return false;
        }
        $("#spinner").show();

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('login/loginODP')?>",
            data: {
                username: $("#param_username").val(),
                password: $.md5($("#param_password").val())
            },
            dataType: 'json',
            success: function(res) {
                $("#spinner").hide();
                //alert(res);
                if (res == 1) {
                    var baseurl = "<?php print admin_url(); ?>";
                    window.location.href = baseurl;
                } else if (res == 2) {
                    $("#validate-text").html("Tài khoản không phải là admin hoặc đại lý");
                } else if (res == 3) {
                    $("#validate-text").html("Hệ thống gián đoạn ");
                } else if (res == 4) {
                    $("#validate-text").html("Tên đăng nhập không tồn tại");
                } else if (res == 5) {
                    $("#validate-text").html("Mật khẩu không chính xác");
                } else if (res == 6) {
                    $("#validate-text").html("Tài khoản bị khóa");
                } else if (res == 7) {
                    $("#validate-text").html("Hệ thống bảo trì");
                } else if (res == 8) {
                    $("#validate-text").html("Tài khoản chưa cập nhật nickname");
                } else if (res == 9) {
                    $("#validate-text").html("Tài khoản chưa đăng ký OTP");
                }
            },
            error: function() {
                $("#spinner").hide();
                alert("Hệ thống gián đoạn ");
            }
        });
    }
});
$("#login").click(function() {
    if ($("#param_password").val() == "" && $("#param_username").val() == "") {
        $("#validate-text").html("Bạn chưa nhập tên đăng nhập và mật khẩu");
        return false;
    }
    if ($("#param_username").val() == "") {
        $("#validate-text").html("Bạn chưa nhập tên đăng nhập");
        return false;
    }
    if ($("#param_password").val() == "") {
        $("#validate-text").html("Bạn chưa nhập mật khẩu");
        return false;
    }
    $("#spinner").show();
    
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('login/loginODP')?>",
        data: {
            username: $("#param_username").val(),
            password: $.md5($("#param_password").val())
        },
        dataType: 'json',
        success: function(res) {
            $("#spinner").hide();
            if (res == 1) {
                window.location.href = "<?php print admin_url(); ?>";
            } else if (res == 2) {
                $("#validate-text").html("Tài khoản không phải là admin hoặc đại lý");
            } else if (res == 3) {
                $("#validate-text").html("Hệ thống gián đoạn");
            } else if (res == 4) {
                $("#validate-text").html("Tên đăng nhập không tồn tại");
            } else if (res == 5) {
                $("#validate-text").html("Mật khẩu không chính xác");
            } else if (res == 6) {
                $("#validate-text").html("Tài khoản bị khóa");
            } else if (res == 7) {
                $("#validate-text").html("Hệ thống bảo trì");
            } else if (res == 8) {
                $("#validate-text").html("Tài khoản chưa cập nhật nickname");
            } else if (res == 9) {
                $("#validate-text").html("Tài khoản chưa đăng ký OTP");
            }
            else if (res == 10) {
                $("#bsModal3").modal("show");
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr);
            $("#spinner").hide();
            alert("Hệ thống gián đoạn");
        }
    });
})

$("#getodp").click(function() {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8081/api?c=131&nn=" + $("#nickname").val(),
        crossDomain: true,
        contentType: "application/x-www-form-urlencoded",
        async: false,
        dataType: 'json',
        processData: false,
        cache: false,
        success: function(result) {
            if (result == 0) {
                alert("Bạn lấy mã odp thành công")
            } else if (result == 1) {
                alert("Lỗi hệ thống")
            } else if (result == 2) {
                alert("Nickname không tồn tại")
            } else if (result == 4) {
                alert("Bạn chưa đăng ký bảo mật trên trang win123.club")
            } else if (result == 5) {
                alert("Bạn đã lấy odp rồi, gửi tin nhắn để lấy lại")
            }

        }
    });
});
$("#getreodp").click(function() {
    alert("Mời bạn soạn tin nhắn OZZ ODP gửi 8041 để lấy lại ODP")
})

$("#loginodp").click(function() {
    if ($("#odplogin").val() == "") {
        alert("Bạn chưa nhập ODP");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('login/loginODP')?>",
        data: {
            username: $("#param_username").val(),
            password: $.md5($("#param_password").val()),
            otp: $("#odplogin").val(),

        },
        dataType: 'json',
        success: function(res) {
            if (res == 1) {
                window.location.href = "<?php print admin_url(); ?>";
            } else if (res == 2) {
                alert("Tài khoản không phải là admin hoặc đại lý");
            } else if (res == 3) {
                alert("Hệ thống gián đoạn");
            } else if (res == 4) {
                alert("Tên đăng nhập không tồn tại");
            } else if (res == 5) {
                alert("Mật khẩu không chính xác");
            } else if (res == 6) {
                alert("Tài khoản bị khóa");
            } else if (res == 7) {
                alert("Hệ thống bảo trì");
            } else if (res == 8) {
                alert("Tài khoản chưa cập nhật nickname");
            } else if (res == 9) {
                alert("Tài khoản chưa đăng ký OTP");
            }
            else if (res == 11) {
                alert("Sai OTP");
            }
        }

    });
})
</script>
