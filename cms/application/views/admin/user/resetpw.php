<title>Reset Password</title>
<?php if($role == false): ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else: ?>
    <section class="content-header">
        <h1 style="text-align: center;color: #009921; font-weight: bold;">
            Reset password
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <label class="col-sm-2  control-label" style="color: red" id="errorvin"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 control-label">Nick name:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="nickname" class="form-control" placeholder="Nhập nickname">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 control-label">PassWord:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="password" class="form-control" placeholder="Nhập password">
                                </div>
                            </div>
                        </div>
                        <?php if($this->session->userdata('isMobileSecure') == 1) { ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 control-label">OTP:</label>
                                <div class="col-sm-1">
                                    <select id="selectotp" class="form-control">
                                        <option value="0">SMS OTP</option>
                                        <option value="1">APP OTP</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="txtotp" placeholder="Nhập mã otp" class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-1">
                                    <input type="button" id="resetpw"
                                           value="Reset password" class="btn btn-primary pull-left">
                                </div>
                            </div>
                        </div>

                        <h6 style="text-align: center;font-size: 16px;margin-top: 100px;color: #00bb53;font-weight: bold;">ĐỔI MẬT KHẨU CẤP 2 (MÃ BẢO MẬT) </h6>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <label class="col-sm-4  control-label" style="color: red" id="errorvinc2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 control-label">Nick name:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="nicknamec2" class="form-control" placeholder="Nhập nickname">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 control-label">PassWord Cấp2:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="passwordc2" class="form-control" placeholder="Nhập password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-1">
                                    <input type="button" id="resetpwc2"
                                           value="Reset password" class="btn btn-primary pull-left">
                                </div>
                            </div>
                        </div>





                        <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: #0000ff">Bạn thay đổi mật khẩu thành công</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal"
                                               aria-hidden="true">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="spinner" class="spinner" style="display:none;">
                        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
                    </div>
                </div>
            </div>
    </section>
<?php endif; ?>
<style>
    .spinner {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -50px; /* half width of the spinner gif */
        margin-top: -50px; /* half height of the spinner gif */
        text-align: center;
        z-index: 1234;
        overflow: auto;
        width: 100px; /* width of the spinner gif */
        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
    }

</style>

<script>
$("#resetpw").click(function () {
    if ($("#nickname").val() == "") {
        $("#errorvin").html("Bạn chưa nhập nickname");
        return false;
    }
    else if ($("#txtotp").val() == "") {
        $("#errorvin").html("Bạn chưa nhập mã otp");
        return false;
    }

    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/user/resetpwajax')?>",
        data: {
            nickname: $("#nickname").val(),
            password: $("#password").val(),
            type : $("#selectotp").val(),
            otp :  $("#txtotp").val()
        },

        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            if(result == 0){
                $("#errorvin").html("");
                $("#nickname").val("");
                $("#password").val("");
                $("#txtotp").val("");
                $("#bsModal3").modal("show");

            }else if(result == 1035){
                $("#errorvin").html("Nickname không tồn tại");
            }
            else if(result == 1008){
                $("#errorvin").html("Mã otp sai");
            }
            else if(result == 1021){
                $("#errorvin").html("Mã otp hết hạn");
            }
            else if(result == 1001){
                $("#errorvin").html("Hệ thống gián đoạn");
            }
        }
    });

});

$("#resetpwc2").click(function () {
    if ($("#nicknamec2").val() == "") {
        $("#errorvinc2").html("Bạn chưa nhập nickname");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/user/resetpwCap2ajax')?>",
        data: {
            nickname: $("#nicknamec2").val(),
            code: $("#passwordc2").val(),
        },
        dataType: 'json',
        success: function (result) {
            if(result.errorCode == 1){
                $("#errorvinc2").html("");
                $("#nicknamec2").val("");
                $("#bsModal3").modal("show");
            }else if(result.errorCode == 2){
                $("#errorvinc2").html("Nickname không tồn tại");
            }
        }
    });

});

</script>