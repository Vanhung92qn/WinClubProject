<!-- head -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Quản lý đại lý</h5>
        </div>
        <div class="horControlB menu_action">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <?php if($admin_info->Status == "A"): ?>
            <div class="title">
                <h6>Thêm mới admin đại lý</h6>
            </div>
            <form id="form" class="form" enctype="multipart/form-data" method="post" action="">

                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <label class="control-label" id="errorstatus" style="color: red"></label>
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <label for="inputEmail3" class="col-sm-1 control-label">Nick name:</label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="name" id="param_name"
                                   placeholder="Nhập nick name">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" value="Tìm kiếm" name="submit"
                                   class="button blueB" id="searchnickname">
                        </div>
                    </div>
                </div>


            </form>
            <div id="info_user" style="display: none">
                <input type="hidden" name="username" id="username"
                       value="">
                <input type="hidden" name="nickname" id="nickname"
                       value="">
                <input type="hidden" name="iduser" id="iduser"
                       value="">

                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <label for="inputEmail3" class="col-sm-2 control-label">
                            Tên đăng nhập:
                            <label for="inputEmail3" class="control-label" style="color: #7a6fbe" id="lblusername"></label>
                        </label>
                        <label class="col-sm-1">Chức năng:</label>
                        <div class="col-sm-2">
                            <select for="inputEmail3" id="selectchucnang">
                                <option value="A">Tài khoản admin</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="button" value="Set admin đại lý" class="button blueB" id="setadmin">
                        </div>
                    </div>
                </div>

            </div>
            <style>.spinner {
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
                }</style>
            <div class="container" style="margin-right:20px;">
                <div id="spinner" class="spinner" style="display:none;">
                    <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
                </div>
            </div>
        <?php else : ?>
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>

        <?php endif ?>
    </div>
</div>

<script>
    $("#searchnickname").click(function () {
        if ($("#param_name").val() == "") {
            $("#errorstatus").css("display", "block");
            $("#info_user").css("display", "none")
            $("#errorstatus").html("Bạn chưa nhập nick name");
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('agency/getinfoajax')?>",
            data: {
                nickname: $("#param_name").val()
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.user != null) {
                    $("#info_user").css("display", "block");
                    $("#errorstatus").html("");
                    $("#lblusername").html(result.user.username);
                    $("#lblnickname").html(result.user.nickname);
                    $("#username").val(result.user.username);
                    $("#nickname").val(result.user.nickname);
                    $("#iduser").val(result.user.id);
                } else if (result.user == null) {
                    $("#errorstatus").html("Nick name đã được đăng ký hoặc không tồn tại");
                    $("#info_user").css("display", "none")
                }
            }
        })

    });

    $("#setadmin").click(function () {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin/addadminajax')?>",
            dataType: 'json',
            data: {
                nickname: $("#nickname").val()
            },
            success: function (res) {
                if (res.errorCode == 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo admin_url(); ?>" + "/agency/addadmin",
                        dataType: 'json',
                        data: {
                            username: $("#username").val(),
                            nickname: $("#nickname").val(),
                            iduser : $("#iduser").val(),
                            chucnang: $("#selectchucnang").val()
                        },
                        success: function (response) {
                            if (response == 2) {
                                var baseurl = "<?php echo admin_url('agency/add') ?>";
                                window.location.href = baseurl;
                            }else if(response == 0){
                                $("#errorstatus").html("Tài khoản đã tồn tại");
                            }
                        }
                    });
                } else if (res.errorCode == 1001) {
                    $("#errorstatus").html("Bạn thêm không thành công");
                }
            }
        });
    });
</script>
