<title>Khóa Tài Khoản</title>
<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php if ($admin_info->Status == "A" || $admin_info->Status == "W" || $admin_info->Status == "S" || $admin_info->Status == "D") : ?>
        <table>
            <tr>
                <td>
                    <div class="widget">
                        <!-- <h3><button onclick="goBack()" class="button blueB">Go Back</button></h3> -->
                        <div class="title">
                            <h4>Khóa tài khoản </h4>
                        </div>
                        <span style="color: #7a6fbe; margin-right: 10px">Nhập nickname</span><input id="nickname" value="<?php echo $nickname ?>">
                        <input type="hidden" id="status" value="<?php echo $status ?>">
                        <input type="hidden" id="daochuoi" value="<?php echo $daochuoi ?>">
                        <input type="hidden" id="txtaction" value="">

                        <!-- <div id="list_role">
                <div class="formRow">
                    <div class="row">
                        <label class="col-sm-1" style="width: 154px"> Cấm login</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="0">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chuyển tiền</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="3">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi sâm</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="8">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi ba cây</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="9">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi binh</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="10">
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">

                        <label class="col-sm-1" style="width: 154px"> Cấm đổi thưởng</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="1">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Login sandbox</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="2">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi tlmn</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="11">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi tá lả</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="12">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi liêng</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="13">
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi xì tố</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="14">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi xóc xóc</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="15">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi bài cào</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="16">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi poker</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="17">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi xi dzach</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="23">
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi xóc đĩa</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="24">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi caro</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="25">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi cờ tướng</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="26">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi cờ vua</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="27">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi PokerTour</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="28">
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi Cờ Úp</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="29">
                        </div>
                        <label class="col-sm-1" style="width: 154px"> Cấm chơi Hàm Cá Mập</label>

                        <div class="col-sm-1">
                            <input type="checkbox" name="role" value="30">
                        </div>
                    </div>
                </div>

            </div> -->
                        <div class="formRow">
                            <div class="row">
                                <label class="col-sm-1" style="width: 154px">Lý do khóa</label>

                                <div class="col-sm-2" style="width: 154px">
                                    <input type="text" id="txtlydo" class="form-control" placeholder="Nhập lý do khóa">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-1"><input type="button" id="lockuser" value="Cập nhật" class="button blueB">
                                </div>
                            </div>

                        </div>
                        <div class="formRow">
                        </div>


                    </div>
                </td>
                <td>
                    <div class="widget">
                        <!-- <h3><button onclick="goBack()" class="button blueB">Go Back</button></h3> -->
                        <div class="title">
                            <h4>Mở khóa tài khoản </h4>
                        </div>
                        <span style="color: #7a6fbe; margin-right: 10px">Nhập nickname</span><input id="opennickname" value="">


                        <div class="formRow">
                            <div class="row">
                                <label class="col-sm-1" style="width: 154px">Lý do mở</label>

                                <div class="col-sm-2" style="width: 154px">
                                    <input type="text" id="txtlydoopen" class="form-control" placeholder="Nhập lý do mở">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-1"><input type="button" id="openuser" value="Cập nhật" class="button blueB">
                                </div>
                            </div>
                        </div>
                        <div class="formRow">
                        </div>


                    </div>
                </td>
            </tr>
        </table <?php else : ?> <div class="widget">
        <div class="title">
            <h4>Bạn không được phân quyền</h4>
        </div>
</div>
<?php endif; ?>
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
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var position = getpositiontostring('1', $("#daochuoi").val()).join(',');
        var res = position.split(",");
        $.each($("input[name='role']"), function() {
            for (var i = 0; i < res.length; i++) {
                if ($(this).val() == res[i]) {
                    $(this).attr('checked', 'checked');
                }
            }
        });
    });
    $("#lockuser").click(function() {
        var lst_role = ['0'];
        var lst_role_txt = [];
        var lst_role1 = [];
        const nickname = $("#nickname").val();
        if (!nickname) {
            alert("Bạn chưa nhập nickname");
            return false;
        }

        $.each($("input[name='role']:checked"), function() {
            lst_role.push($(this).val());
            lst_role_txt.push(getlockuser($(this).val()));
        });

        $.each($("input:checkbox:not(:checked)"), function() {
            lst_role1.push($(this).val());
        });
        if ($("#txtlydo").val() == "") {
            alert("Bạn chưa nhập lý do khóa");
            return false;
        }
        if (lst_role.length > 0) {
            $("#txtaction").val(lst_role_txt.join(','));
            updateStatusUser(lst_role.join(','), 1, nickname)
            var statuslock = 1;
        } else {
            var statuslock = 0;
        }

        if (lst_role1.length > 0) {
            updateStatusUser(lst_role1.join(','), 0, nickname)
        }

        $.ajax({
            url: "<?php echo admin_url('usergame/loglockuser') ?>",
            type: "POST",
            data: {
                txtlydo: $("#txtlydo").val(),
                nickname: $("#nickname").val(),
                txtaction: $("#txtaction").val(),
                statuslock: statuslock
            },
            dataType: "json"

        });


    });
    $("#openuser").click(function() {
        if ($("#txtlydoopen").val() == "") {
            alert("Bạn chưa nhập lý do mở khóa");
            return false;
        }
        const nickname = $("#opennickname").val();
        if (!nickname) {
            alert("Bạn chưa nhập nickname");
            return false;
        }
        var statuslock = 0;
        updateStatusUser(9, 0, nickname)

        $.ajax({
            url: "<?php echo admin_url('usergame/loglockuser') ?>",
            type: "POST",
            data: {
                txtlydo: $("#txtlydoopen").val(),
                nickname,
                txtaction: 'Mở Login',
                statuslock: statuslock
            },
            dataType: "json"

        });


    });

    function updateStatusUser(action, type, nickname) {
        var request = $.ajax({
            url: "<?php echo admin_url('usergame/lockuserajax') ?>",
            type: "POST",
            data: {
                nickname,
                action: action,
                type: type
            },
            dataType: "json",
            success: function(result) {
                $.ajax({
                    url: "<?php echo admin_url('usergame/messlockuser') ?>",
                    type: "POST",
                    data: {
                        username: nickname,
                    },
                    dataType: "json"

                });
            }

        });

        request.done((function(nickname) {
            return function(msg) {
                // Create a form dynamically
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "<?php echo admin_url('actionadmin'); ?>");

                // Create an input element for the username
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "nickname");
                input.setAttribute("value", nickname); // nickname is captured from the closure

                // Append the input to the form
                form.appendChild(input);

                // Append the form to the document body
                document.body.appendChild(form);

                // Submit the form
                form.submit();
            };
        })(nickname)); // Pass nickname to the closure
    }

    function getpositiontostring(substring, string) {
        var a = [],
            i = -1;
        while ((i = string.indexOf(substring, i + 1)) >= 0) a.push(i);
        return a;
    }

    function getlockuser(count) {
        var strresult = "";
        switch (count) {
            case "0":
                strresult = " Cấm Login";
                break;
            case "1":
                strresult = "Cấm Đổi thưởng";
                break;
            case "2":
                strresult = "Login sandbox";
                break;
            case "3":
                strresult = "Cấm Chuyển tiền";
                break;
            case "8":
                strresult = "Cấm Chơi sâm";
                break;
            case "9":
                strresult = "Cấm Chơi ba cây";
                break;
            case "10":
                strresult = "Cấm Chơi binh";
                break;
            case "11":
                strresult = "Cấm Chơi tlmn";
                break;
            case "12":
                strresult = "Cấm Chơi tá lả";
                break;
            case "13":
                strresult = "Cấm Chơi liêng";
                break;
            case "14":
                strresult = "Cấm Chơi xì tố";
                break;
            case "15":
                strresult = "Cấm Chơi xóc xóc";
                break;
            case "16":
                strresult = "Cấm Chơi bài cào";
                break;
            case "17":
                strresult = "Cấm Chơi poker";
                break;
            case "23":
                strresult = "Cấm Chơi xì dzach";
                break;
            case "24":
                strresult = "Cấm Chơi xóc đĩa";
                break;
            case "25":
                strresult = "Cấm Chơi caro";
                break;
            case "26":
                strresult = "Cấm Chơi cờ tướng";
                break;
            case "27":
                strresult = "Cấm Chơi cờ vua";
                break;
            case "28":
                strresult = "Cấm Chơi PokerTour";
                break;
            case "29":
                strresult = "Cấm Chơi Cờ úp";
                break;
            case "30":
                strresult = "Cấm Chơi Hàm Cá Mập";
                break;
        }
        return strresult;
    }

    function goBack() {
        window.history.back();
    }
</script>