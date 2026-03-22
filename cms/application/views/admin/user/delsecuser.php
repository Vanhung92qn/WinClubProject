<title>Hủy Bảo Mật</title>
<?php if($role == false): ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else: ?>
    <section class="content-header">
        <h1>
            Hủy bảo mật tài khoản
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
                                <label class="col-sm-1 control-label">Tên tài khoản:</label>
                                <input id="checknickname" type="hidden">
                                <div class="col-sm-2">
                                    <input type="text" id="nickname" class="form-control"  onblur="myFunction()">
                                </div>
                                <label id="lblnickname" style="color: blueviolet"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 control-label">Bảo mật:</label>

                                <div class="col-sm-2">
                                    <select id="type_security" class="form-control">
                                        <option value="11042">Telegram</option>
                                        <option value="11043">Điện thoại</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-1">
                                    <input type="button" id="huysecurity"
                                           value="Hủy bảo mật" class="btn btn-primary pull-left">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="spinner" class="spinner" style="display:none;">
                <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>"
                     alt="Loading"/>
            </div>

            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog"
                 aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #0000ff">Bạn hủy bảo mật thành công</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal"
                                   aria-hidden="true">
                        </div>
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
 

$("#huysecurity").click(function () {
    if ($("#nickname").val() == "") {
        $("#errorvin").html("Bạn chưa nhập nickname");
        return false;
    }
    else if($("#checknickname").val() == -1) {
        $("#errorvin").html("Nickname không tồn tại");
        return false;
    }
    else if($("#checknickname").val() == -2) {
        $("#errorvin").html("Hệ thống gián đoạn");
        return false;
    } 


        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url("user/huybaomat") ?>",
            data: {
                nickname: $("#nickname").val(),
                ac: $("#type_security").val(),
            },
            dataType: 'json',
            
            success: function (result) {
                $("#spinner").hide();
                $("#errorvin").html("");


                if (result == '0') {
                    $("#bsModal3").modal("show");
                    $("#errorvin").html("");
                }
                else if (result.errorCode == 1001) {
                    $("#errorvin").html("Hệ thống gián đoạn");
                }

            }
        })

});

$('#bsModal3').on('hidden.bs.modal', function () {
    window.location.href = '<?php echo admin_url("user/delsecuser") ?>';
});



function myFunction() {
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url("user/getnicknameajax") ?>",
        data: {
            nickname: $("#nickname").val()
        },
        dataType: 'json',
        success: function (res) {
            $("#checknickname").val(res);
            if (res == -2) {
                $("#lblnickname").text("Hệ thống gián đoạn");
                $("#errorvin").html("");
            }
            else if (res == -1) {
                $("#lblnickname").text("Nickname không tồn tại");
                $("#errorvin").html("");
            }
            else if (res == 0) {
                $("#lblnickname").text("Tài khoản thường");
                $("#errorvin").html("");
            }
            else if (res == 100) {
                $("#lblnickname").text("Tài khoản admin");
                $("#errorvin").html("");
            }
        }
    })
}
$(document).ready(function() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const nickname = urlParams.get('nickname');
    if(nickname) {
        $("#nickname").val(nickname);
        myFunction();
    }
    const type = urlParams.get('type');
    if(type == "phone") {
        $("#type_security option[value=11043]").attr("selected", "selected");
    }
 })
</script>