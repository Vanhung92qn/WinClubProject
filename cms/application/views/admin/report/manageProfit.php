<title>Quản Lý Lợi Nhuận</title>
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
        <form class="list_filter form">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>


                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <td style="">
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/manageProfit') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
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
                        <h4 id="" style="color: #e72929;margin-left: 10px">Lợi nhuận = Tổng quỹ + Tổng phế + Lợi nhuận bắn cá - Chi phí (VNĐ)</h4>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                <thead>
                                    <tr style="height: 20px;">
                                        <td><a href="<?php echo admin_url('report/managejackpot') ?>">Rút quỹ</a></td>
                                        <td><a href="<?php echo admin_url('report/managejackpot') ?>">Nạp quỹ</a></td>
                                        <td><a href="<?php echo admin_url('report/managejackpot') ?>">Tổng quỹ</a></td>
                                        <td>Tổng phế trong game</td>
                                        <td>Lợi nhuận bắn cá</td>
                                        <td><a href="<?php echo admin_url('report/detailChiphi') ?>">Chi phí</a></td>
                                        <td>Lợi nhuận</td>
                                    </tr>
                                </thead>
                                <tbody id="logrecharge">
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
        var fromDatetime = moment($("#fromDate").val(), 'YYYY-MM-DD');
        var toDatetime = moment($("#toDate").val(), 'YYYY-MM-DD');
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        $("#spinner").show();
        $('#logaction').html("");
        let toDate = moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        let fromDate = moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        let te = moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/manageProfitAjax') ?>",
            data: {
                toDate,
                fromDate,
                ts: moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD'),
                te
            },

            dataType: 'json',
            success: function(res) {
                $("#spinner").hide();
                $("#resultsearch").html("");
                let {
                    fund,
                    napFund,
                    rutFund,
                    fee,
                    chi,
                    profitFish
                } = res;
                result = resulttotalrecharge(fund, napFund, rutFund, fee, profitFish, chi);
                $('#logrecharge').html(result);

            },
            error: function() {
                $("#spinner").hide();
                $('#widget').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000

        })
    });

    function resulttotalrecharge(fund, depositFund, withdrawFund, fee, profitFish, chi) {
        if (fund === null || fee === null || chi === null || profitFish === null) {
            total = null;
        } else {
            total = fund + fee + profitFish - chi;
        }
        var rs = "";
        rs += "<tr>";
        rs += "<td style='color: #7a6fbe'>" + `${withdrawFund !== null ? commaSeparateNumber(withdrawFund) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${depositFund !== null ? commaSeparateNumber(depositFund) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${fund !== null ? commaSeparateNumber(fund) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${fee !== null ? commaSeparateNumber(fee) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${profitFish !== null ? commaSeparateNumber(profitFish) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${chi !== null ? commaSeparateNumber(chi) : 'Lỗi'} ` + "</td>";
        rs += "<td style='color: #7a6fbe'>" + `${total !== null ? commaSeparateNumber(total) : 'Lỗi'} ` + "</td>";
        rs += "</tr>";
        return rs;
    }

    $(document).ready(function() {
        var result = "";
        $("#spinner").show();
        let toDate = moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        let fromDate = moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        let te = moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/manageProfitAjax') ?>",
            data: {
                toDate,
                fromDate,
                ts: moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD'),
                te
            },

            dataType: 'json',
            success: function(res) {
                $("#spinner").hide();
                $("#resultsearch").html("");
                let {
                    fund,
                    napFund,
                    rutFund,
                    fee,
                    chi,
                    profitFish
                } = res;
                result = resulttotalrecharge(fund, napFund, rutFund, fee, profitFish, chi);
                $('#logrecharge').html(result);

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
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>