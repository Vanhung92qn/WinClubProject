<title>Tiền Nạp/Rút Theo Kênh</title>

<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
<script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role == false) : ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        <form class="list_filter form" action="<?php echo admin_url('marketing/rechargevnd') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>


                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('marketing/rechargevnd') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <div class="widget">
            <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
            <div id="widget">
                <input type="hidden" value="<?php echo $admin_info->Status ?>" id="status">
                <div class="formRow">
                    <div class="row">
                        <h4 id="" style="color: #e72929;margin-left: 10px">Tiền nạp theo kênh (VNĐ)</h4>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                <thead>
                                    <tr style="height: 20px;">
                                        <td>Nạp qua thẻ</td>
                                        <td>Nạp qua MoMo</td>
                                        <td>Nạp qua ngân hàng</td>
                                        <td>Tổng tiền</td>
                                    </tr>
                                </thead>
                                <tbody id="logrecharge">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="widget">
                <div class="formRow">
                    <div class="row">
                        <h4 id="" style="color: #e72929;margin-left: 10px">Tiền rút theo kênh (VNĐ)</h4>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="checkAll2" class="table table-bordered" style="table-layout: fixed">
                                <thead>
                                    <tr style="height: 20px;">
                                        <td>Khách yêu cầu <br>rút qua MoMo</td>
                                        <td>Thực rút qua momo</td>
                                        <td>Khách yêu cầu <br>rút qua ngân hàng</td>
                                        <td>Thực rút qua ngân hàng</td>
                                        <td>Admin từ chối => Hoàn tiền rút</td>
                                        <td>Tổng tiền</td>
                                    </tr>
                                </thead>
                                <tbody id="logrefund">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<style>
    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }

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
<script>
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    });
    $("#search_tran").click(function() {

    });

    function resulttotalrecharge(rechargecard, rechargemomo, rechargebank, total) {
        var rs = "";
        rs += "<tr>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(rechargecard) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(rechargemomo) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(rechargebank) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(total) + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resulttotalrefund(refundmomo, refundbank, refunderror, realCashoutByMomo, realCashoutByBank, total) {
        var rs = "";
        rs += "<tr>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(refundmomo) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(realCashoutByMomo) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(refundbank) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(realCashoutByBank) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(refunderror) + "</td>";
        rs += "<td style='color: #7a6fbe'>" + commaSeparateNumber(total) + "</td>";
        rs += "</tr>";
        return rs;
    }

    $(document).ready(function() {
        var result10 = "";
        var result11 = "";
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('marketing/rechargevndajax') ?>",
            data: {
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val()
            },

            dataType: 'json',
            success: function(res) {
                $("#spinner").hide();
                var total1 = 0;
                var total2 = 0;
                var total3 = 0;
                var total4 = 0;
                var total5 = 0;
                var total6 = 0;
                var total7 = 0;
                var total8 = 0;
                var total = 0;
                if ($.isEmptyObject(res.vinInUser)) {
                    result10 = resulttotalrecharge(0, 0, 0, 0);
                    $('#logrecharge').html(result10);
                    $('#logrefund').html(result11);
                } else {
                    if (res.vinInUser.RechargeByCard) {
                        total1 = res.vinInUser.RechargeByCard;
                    }
                    if (res.vinInUser.RechargeByMomo) {
                        total2 = res.vinInUser.RechargeByMomo;
                    }
                    if (res.vinInUser.RechargeByBank) {
                        total3 = res.vinInUser.RechargeByBank;
                    }
                    if (res.vinOutUser.CashOutByBank) {
                        total4 = res.vinOutUser.CashOutByBank;
                    }
                    if (res.vinOutUser.CashOutByMomo) {
                        total5 = res.vinOutUser.CashOutByMomo;
                    }
                    if (res.vinOutUser.RefundRechargeError) {
                        total6 = res.vinOutUser.RefundRechargeError;
                    }
                    if (res.vinOutUser.realCashoutByBank) {
                        total7 = res.vinOutUser.realCashoutByBank;
                    }
                    if (res.vinOutUser.realCashoutByMomo) {
                        total8 = res.vinOutUser.realCashoutByMomo;
                    }
                }
                total = total1 + total2 + total3;
                totalrefund = total8 + total7;
                result10 = resulttotalrecharge(total1, total2, total3, total);
                result11 = resulttotalrefund(total5, total4, total6, total8, total7, totalrefund);
                $('#logrecharge').html(result10);
                $('#logrefund').html(result11);

            },
            error: function() {
                $("#spinner").hide();
                $('#widget').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000

        })
    });
</script>
<script>
    function commaSeparateNumber(val) {
        if (val == undefined) {
            return 0;
        }
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>