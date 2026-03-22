<?php if ($role == false) : ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else : ?>
    <section class="content-header">
        <h1>
            Tạo sự kiện
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group successful">
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <label class="control-label col-sm-2" id="successgift" style="color: #00a65a"></label>
                            </div>
                        </div>
                        <div class="form-group successful">
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <label class="control-label col-sm-2" id="errorgift" style="color: red"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Tên sự kiện:</label>

                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="eventName" />

                                </div>
                                <label class="col-sm-2" id="errorph" style="color: red"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label id="labelvin" class="col-sm-1 control-label">Ngày bắt đầu:</label>
                                <div class="col-sm-2 input-group date" style="padding-inline: 15px" id="datetimepicker1">
                                    <input type="text" id="fromDate" style="width: 100%; line-height: 2.5" name="fromDate" value="<?php echo $start_time; ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Ngày kết thúc:</label>

                                <div class="col-sm-2 input-group date" style="padding-inline: 15px" id="datetimepicker2">
                                    <input type="text" id="toDate" style="width: 100%; line-height: 2.5" name="toDate" value="<?php echo $end_time; ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <label class="col-sm-2" id="errormg" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Tỷ lệ:</label>

                                <div class="col-sm-2">
                                    <select id="rate">
                                        <option value="10">10%</option>
                                        <option value="20" selected>20%</option>
                                        <option value="50">50%</option>
                                        <option value="100">100%</option>
                                    </select>
                                </div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-1"><input type="submit" value="Tạo sự kiện" name="submit" class="btn btn-primary pull-left" id="create_code"></div>
                                <div class="col-sm-1"><input type="reset" value="Reset" name="submit" class="btn btn-primary pull-left" id="reset" onclick="window.location.href = '<?php echo admin_url('event/add') ?>'; ">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
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
<script>
    $(".successful").click(function() {
        $(".successful").hide();
    });
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    function createCode(newType) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('event/createEventAjax') ?>",
            data: {
                eventName: $("#eventName").val(),
                rate: $("#rate").val(),
                fromDate: $("#fromDate").val(),
                toDate: $("#toDate").val(),
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (!result.success) {
                    alert(`Bạn tạo sự kiện thất bại lý do: ${result.errorCode}`);
                } else {
                    alert("Bạn tạo sự kiện thành công");
                    $("#errorgift").html("");
                    window.location.href = '<?php echo admin_url('event/index') ?>';
                }
                $("#errorph").html("");
                $("#errorsl").html("");
            }
        })
    }
    $("#create_code").click(function() {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        if($("#eventName").val() == "") {
            $("#errorph").html("Bạn phải nhập tên sự kiện");
            $("#errorsl").html("");
            return false;
        }
        if ($("#rate").val() <= 0 ) {
            $("#errorsl").html("Bạn phải nhập tỷ lệ lớn hơn 0");
            $("#errorph").html("");
            return false;
        }

        $("#spinner").show();
        createCode();

    });
    $(document).ready(function() {
       
    });
</script>