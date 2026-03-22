<title>Tạo Giftcode</title>
<?php if ($role == false) : ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else : ?>
    <section class="content-header">
        <h1>
            Tạo Giftcode
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
                                <label class="col-sm-1 control-label">Loại Giftcode:</label>

                                <div class="col-sm-2">
                                    <select id="type" class="form-control">
                                        <option value="">Chọn</option>
                                        <?php foreach ($listtype as $key => $row) : ?>
                                            <option value="<?php echo $row->id ?>" <?php echo ($this->input->post("typegiftcode") == $row->id ? 'selected' : ''); ?>><?php echo $row->campaignName ?></option>
                                        <?php endforeach; ?>
                                        <option value="0">Tạo loại mới</option>
                                    </select>
                                </div>
                                <label class="col-sm-2" id="errorph" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group" id="newType" style="display: none">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Tên loại mới:</label>

                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nameNewType" />
                                </div>
                                <label class="col-sm-2" id="errorType" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label id="labelvin" class="col-sm-1 control-label">Mệnh giá</label>
                                <div class="col-sm-2" id="menhgiavin">
                                    <input type="number" class="form-control" id="roomvin" />

                                    <!-- <select name="menhgiavin" class="form-control" id="roomvin">
                                    <option value="10000">10K </option>
                                    <option value="20000">20K </option>
                                    <option value="50000">50K </option>
                                    <option value="100000">100K </option>
                                    <option value="200000">200K </option>
                                    <option value="500000">500K </option>
                                    <option value="1000000">1 Triệu </option>
                                    <option value="2000000">2 Triệu </option>
                                    <option value="3000000">3 Triệu </option>
                                    <option value="4000000">4 Triệu </option>
                                    <option value="5000000">5 Triệu </option>
                                </select> -->
                                </div>
                                <div id="menhgia"></div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Số lượng:</label>

                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="soluong">
                                </div>
                                <div id="amount"></div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Thời hạn:</label>

                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="expire" />

                                    <!-- <select name="expire" class="form-control" id="expire">
                                    <option value="7">7 ngày </option>
                                    <option value="10">10 ngày </option>
                                    <option value="15">15 ngày </option>
                                    <option value="30">30 ngày </option>
                                </select> -->
                                </div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-1 control-label">Độ dài:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="length" value="10">
                                </div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-1"><input type="submit" value="Tạo code" name="submit" class="btn btn-primary pull-left" id="create_code"></div>
                                <div class="col-sm-1"><input type="reset" value="Reset" name="submit" class="btn btn-primary pull-left" id="reset" onclick="window.location.href = '<?php echo admin_url('giftcode/adminadd') ?>'; ">
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

    function createCode(newType) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcode/adminaddajax') ?>",
            data: {
                money: $("#roomvin").val(),
                quantity: $("#soluong").val(),
                type: newType || $("#type").val(),
                length: $("#length").val(),
                expire: $("#expire").val()
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result == 1) {
                    alert("Bạn xuất giftcode thành công");
                    $("#errorgift").html("");
                    window.location.href = '<?php echo admin_url('giftcode/addcampain') ?>';
                } else if (result == 2) {
                    alert("Bạn xuất giftcode thất bại");
                    $("#successgift").html("");
                }
                $("#errorph").html("");
                $("#errorsl").html("");
            }
        })
    }
    $("#create_code").click(function() {
        if ($("#type").val() == "0" && $("nameNewType").val() == "") {
            $("#errorType").html("Bạn phải nhập loại giftcode");
            $("#errorph").html("");
            $("#errorsl").html("");
            return false;
        }

        if ($("#soluong").val() == "") {
            $("#errorsl").html("Bạn phải nhập số lượng giftcode");
            $("#errorph").html("");
            $("#errorType").html("");
            return false;
        } else if ($("#type").val() == "") {
            $("#errorph").html("Bạn phải chọn loại giftcode");
            $("#errorsl").html("");
            $("#errorType").html("");
            return false;
        }

        $("#spinner").show();
        if ($("#type").val() == "0") {
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/addtypeajax') ?>",
                data: {
                    typeName: $("#nameNewType").val().trim()
                },
                dataType: 'json',
                success: function(result) {
                    if (result == 0) {
                        $("#errorType").html("Tạo loại Giftcode mới không thành công");
                    } else {
                        const newType = result.find(item => item.campaignName === $("#nameNewType").val().trim());
                        newType && createCode(newType.id);
                        $("#spinner").hide();
                        $("#errorType").html("");
                    }
                }
            })
        } else {
            createCode()
        }

    });
    $(document).ready(function() {
        $('#soluong').on('paste', function(e) {
            let pastedData = e.originalEvent.clipboardData.getData('text');
            let money = parseInt(pastedData);
            if (isNaN(money) || money <= 0) {
                alert("Vui lòng nhập số lớn hơn 0");
                e.preventDefault();
            }
            
        });
        $("#roomvin").change(function(e) {
            const value = $(this).val();
            if (value) {
                $("#menhgia").html(commaSeparateNumber(value))
            }
        })
        $("#soluong").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
            
        });
        $("#soluong").change(function(e) {
            const value = $(this).val();
            $("#amount").html(commaSeparateNumber(value))
        })
        $('#type').change(function() {
            var val = $("#type option:selected").val();
            if (val == 0) {
                $("#newType").css("display", "block");
            } else {
                $("#newType").css("display", "none");
            }
        });
    });
</script>