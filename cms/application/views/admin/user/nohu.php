<div class="line"></div>
<?php if($role == true): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
        <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
        <script
            src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget" style="background-image: url('<?php echo public_url() ?>/news/images/phuonghoang.png'); background-size: cover;">
            <div class="formRow" style="min-height: 577px;">
                <div class="row">
                    <div class="col-sm-6"
                             style="color: #750b09;
                                font-weight: bold;
                                font-family: cursive;
                                    ">
                         <h3 class="js-loaihinhtitle" 
                            style="color: #750b09;
                                text-align: center;
                                font-weight: bold;
                                font-size: 40px;
                                font-family: cursive;
                                text-transform: uppercase;
                                    ">NỔ HŨ
                        </h3>
                        <div style="width: 100%;
                                    display: flex;
                                    border: 1px solid #900b01;
                                    border-radius: 5px;
                                    align-content: stretch;
                                    background: #ffffff73;
                                    flex-direction: column;
                                    padding: 30px 0;
                                    justify-content: center;
                                    box-shadow: 0 0 0 1px rgb(0 16 14 / 3%), 0 8px 16px -4px rgb(135 33 18)
                        ">
                            <form class="list_filter form" action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label style="color: #890409; font-size: 25px;">Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <select id="tenslot" style="width: 97%; font-size: 25px;">
                                                <option value="1">Kho báu tứ linh</option>
                                                <option value="2">Sơn tinh thủy tinh</option>
                                                <option value="3">Tây du ký</option>
                                                <option value="4">Thể Thao</option>
                                                <option value="5">Ăn Khế trả vàng</option>
                                                <option value="6">Kho tàng ngũ long</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label style="color: #890409; font-size: 25px;">Loại hình</label></div>
                                        <div class="col-sm-6">
                                            <select id="loaihinh" style="width: 97%; font-size: 25px;">
                                                <option value="1">Nổ hũ</option>
                                                <option value="2">Thắng lớn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label style="color: #890409; font-size: 25px;">Nickname</label></div>
                                        <div class="col-sm-6"><input style="color: #890409; font-size: 25px;" class="form-control" id="nickname" placeholder="Nhập nick name" type="text" onblur="myFunction()"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" id="sethu" value="SET HŨ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>

                    <div class="col-sm-6">
                        <h3 style="color: #073c65;
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 40px;
                                    font-family: cursive;
                                    ">Bảng kết quả
                        </h3>
                        <div style="width: 100%;
                                    display: flex;
                                    border-radius: 5px;
                                    padding: 30px 0;
                                    align-content: stretch;
                                    flex-direction: column;
                                    justify-content: center;
                                    text-align: center;
                                    "
                        >
                            <div style="color: #073c65; font-size: 25px; font-family: cursive;">
                                <div id="tenslottitle">Kho báu tứ linh</div>
                                <div class="js-loaihinhtitle">Nổ hũ</div>
                                <div class="js-nicknametxt"></div>
                                <div style="text-align: center;">
                                    <div id="spinner" style="display:none;">
                                        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="formRow"></div>
            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #7a6fbe">Bạn cộng xu thành công</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal" aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="bsModal4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #7a6fbe">Bạn trừ xu thành công</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal" aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    $("#sethu").click(function () {
        if($("#nickname").val() == ""){
            $("#errorname").html("Bạn chưa nhập nick name");
            return false;
        }

        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/truxuajax')?>",
            data: {
                nickname: $("#nickname").val(),
                typeotp : $("#txttypeotp").val()
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result == 1){
                    $("#errorname").html("");
                    $("#nickname").val("");
                    $("#bsModal4").modal("show");
                }else if(result == 2){
                    $("#errorname").html("Set Thất bại");
                }else if(result == 4){
                    $("#errorname").html("OTP sai");
                }else if(result == 5){
                    $("#errorname").html("OTP hết hạn");
                }
                else if(result == 3){
                    $("#errorname").html("Nick name không đủ tiền");
                }
                else if(result == 6){
                    $("#errorname").html("Nick name không tồn tại");
                }
            }, error: function () {
                $("#spinner").hide();
                $("#errorname").html("Hệ thống quá tải. Vui long thử lại sau");
            },timeout : 20000
        });
    });
    function myFunction() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/SetNohu/checknickname") ?>",
            data: {
                nickname: $("#nickname").val()
            },
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if (res == -2) {
                    $("#errorname").html("Hệ thống gián đoạn");
                }
                else if (res == -1) {
                    $("#errorname").html("Nick name không tồn tại");
                }
                else if (res == 0) {
                    $("#errorname").html("Tài khoản thường");

                }
                else if (res == 1) {
                    $("#errorname").html("Tài khoản đại lý");
                }
                else if (res == 2) {
                    $("#errorname").html("Tài khoản đại lý");
                }
                else if (res == 100) {
                    $("#errorname").html("Tài khoản thường");
                }
            },error: function(){
                $("#errorname").html("Kết nối không ổn định.Vui lòng thử lại sau");
                },
            timeout:30000
        });
    }

    $("#nickname").keyup(function (e) {
        $(this).val(($(this).val()));
        $("#numchuyen").text($(this).val());
    });

    $("#nickname").keyup(function (e) {
        $(this).val(($(this).val()));
        $(".js-nicknametxt").text($(this).val());
    });

    $('#loaihinh').on('change', function () {
        console.log($(this).find('option').filter(':selected').text());
        $(".js-loaihinhtitle").text($(this).find('option').filter(':selected').text());
    });
    $('#tenslot').on('change', function () {
        console.log($(this).find('option').filter(':selected').text());
        $("#tenslottitle").text($(this).find('option').filter(':selected').text());
    });
</script>
