<title>Reset Password</title>
<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<?php if($role == false): ?>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <div class="widget">
            <div class="title">
                <h6>Reset Password</h6>
            </div>
            <form class="list_filter form" action="" method="">
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2"><label id="errorname" style="color: #e72929;"></label></div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-2"><label>Nhập nickname</label></div>
                        <div class="col-sm-2"><input class="form-control" id="filter_iname" placeholder="Nhập nick name" type="text"></div>
                        <div class="col-sm-1">
                            <input type="button" id="search_tran" value="Reset password" class="button blueB">
                        </div>
                    </div>

                </div>
            </form>
            <div class="formRow"></div>
            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #7a6fbe">Bạn thay đổi mật khẩu thành công</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal"
                                   aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
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
<script>

    $("#search_tran").click(function () {
        if($("#filter_iname").val() == ""){
            alert("Bạn chưa nhập nick name");
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/resetpwajax')?>",
            data: {
                nickname: $("#filter_iname").val()
            },

            dataType: 'json',
            success: function (result) {
                if(result == 0){
                    $("#errorname").html("");
                    $("#filter_iname").val("");
                    $("#bsModal3").modal("show");
                    $("#spinner").hide();

                }else{
                    $("#errorname").html("Nickname không tồn tại");
                    $("#spinner").hide();
                }
            }
        });
    });

</script>
