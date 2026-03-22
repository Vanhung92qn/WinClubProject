<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if($role === null): ?>
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
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #ffd6d6; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #b82516;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #7b0000;">Lịch sử đua top tài xỉu</h6>
        </div>

        <div Class="Content-table">

            <div class="Content-table-item list_filter form">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                    style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span
                                        class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                    class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span
                                        class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>

                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 50px">
                            </td>
                        </tr>
                        
                    </table>
                    <p style='color: #0096a5; font-weight: bold;'>Chú thích: Ấn tìm kiếm để hiển thị kết quả</p>
                </div>
                <h1 style="text-align: center; color: #00656f; font-weight: bold;">ĐUA TOP THEO NGÀY</h1>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAllDay" style="background: #e0ffff; max-height: 365px; overflow-y: scroll; width: 80%;margin: 0 auto;">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>NickName</td>
                        <td>Tổng cược</td>
                        <!-- <td>Trạng thái</td> -->
                        <td>Phần thưởng</td>
                        <td>Hành động</td>
                        <!-- <td>Người duyệt</td> -->
                    </tr>
                    </thead>
                    <tbody id="logactionbyday">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->

            <div class="Content-table-item list_filter form" style='margin-top: 57px;'>

                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                    style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker3">
                                    <input type="text" id="fromDate2" name="fromDate2" value="<?php echo $start_time2 ?>"> <span
                                        class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                    class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker4">
                                    <input type="text" id="toDate2" name="toDate2" value="<?php echo $end_time2 ?>"> <span
                                        class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                            <td style="">
                                <input type="submit" id="search_tran2" value="Tìm kiếm" class="button blueB" style="margin-left: 50px">
                            </td>
                        </tr>
                    </table>
                    <p style='color: #0096a5; font-weight: bold;'>Chú thích: Ấn tìm kiếm để hiển thị kết quả</p>
                </div>


                <h1 style="text-align: center; color: #a51700; font-weight: bold;">ĐUA TOP THEO THÁNG</h1>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAllMonth" style="background: #fffed9; max-height: 800px; overflow-y: scroll; width: 80%;margin: 0 auto;">
                    <thead style="height: 35px; background: #a51700;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>NickName</td>
                            <td>Tổng cược</td>
                            <!-- <td>Trạng thái</td> -->
                            <td>Phần thưởng</td>
                            <td>Hành động</td>
                            <!-- <td>Người duyệt</td> -->
                        </tr>
                    </thead>
                    <tbody id="logactionbymonth">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->

        </div><!-- Content-table -->

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
.sTable thead td {
    border-bottom: 1px solid #cbcbcb;
    border-left: 1px solid #cbcbcb;
    font-size: 15px;
    color: #ffffff;
    padding: 10px 4px 2px 4px;
}
table.myTable a {
    cursor: pointer;
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
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });

    $('#datetimepicker3').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('#datetimepicker4').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});

$("#search_tran").click(function() {
    var fromDatetime = $("#fromDate").val();
    var toDatetime = $("#toDate").val();
    if (fromDatetime > toDatetime) {
        alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
        return false;
    }
    getlistvinhdanhbyday();
});

$("#search_tran2").click(function() {
    var fromDatetime2 = $("#fromDate2").val();
    var toDatetime2 = $("#toDate2").val();
    if (fromDatetime2 > toDatetime2) {
        alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
        return false;
    }
    getlistvinhdanhbymonth();
});

function resultSearchTransctionByDay(stt, value) {
    var status = 'pending';
    var bonus = 0;
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + stt + "</td>";
    rs += "<td style='color: #297900;font-weight: bold;'>" + value.username + "</td>";
    rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(value.money) + "</td>";
    // rs += "<td>" + getStatusText(status) + "</td>";
    switch (stt) {
        case 1: 
            bonus = 20000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 2:
            bonus = 10000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 3:
            bonus = 5000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 4:
            bonus = 3000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        default:
            bonus = 1000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
    }
    
    if (status == 'pending') {
        rs += "<td><span class='label label-success'><a style='color: white;' onclick=\"approve('" + bonus + "','" + value.username + "','ngày')\">Trả thưởng</a></span> </td>";

    } else {
        rs += "<td></td>"
    }
    // rs += "<td></td>";
    rs += "</tr>";
    return rs;
}

function resultSearchTransctionByMonth(stt, value) {
    var status = 'pending';
    var bonus = 0;
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + stt + "</td>";
    rs += "<td style='color: #297900;font-weight: bold;'>" + value.username + "</td>";
    rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(value.money) + "</td>";
    // rs += "<td>" + getStatusText(status) + "</td>";
    switch (stt) {
        case 1:
            bonus = 400000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 2:
            bonus = 150000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 3:
            bonus = 80000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 4:
            bonus = 30000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 5:
            bonus = 15000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
            bonus = 5000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
        default:
            bonus = 2000000;
            rs += "<td style='color: #ff00d4;font-weight: bold;'>" + commaSeparateNumber(bonus) + "</td>";
            break;
    }
    if (status == 'pending') {
        rs += "<td><span class='label label-success'><a style='color: white;' onclick=\"approve('" + bonus + "','" + value.username + "','tháng')\">Trả thưởng</a></span> </td>";
    } else {
        rs += "<td></td>"
    }
    // rs += "<td></td>";
    rs += "</tr>";
    return rs;
}

function approve(bonus, nickname, type) {
    var confirmApprove = confirm("Bạn có chắc chắn trả thưởng?");
    if (confirmApprove != true) {
        // alert('Hủy bỏ trả thưởng!')
        return false;
    }
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('user/congtienajax')?>",
        data: {
            nickname: nickname,
            tienchuyen: bonus,
            money_type: 'vin',
            reasonchuyen: 'Trả thưởng vinh danh tài xỉu ' + type,
            maotpcong: null,
            otpselectcong:  0,
            actionname :  'Admin',
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            console.log(result);
            if(result == 1){
                    alert("Bạn trả thưởng thành công");
                }else if(result == 2){
                    alert("Bạn trả thưởng thất bại")
                }else if(result == 5){
                    alert("Mã OTP hết hạn")
                }else if(result == 3){
                    alert("Tài khoản  không đủ tiền")
                }else if(result == 6){
                    alert("Tài khoản  không tồn tại")
                } else {
                    alert("Lỗi trả thưởng không xác định")
                }

        }, error: function () {
            $("#spinner").hide();
            $('#logaction').html("");
            $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
        }, timeout: 20000
    })
}

function getStatusText(status) {
    switch (status) {
        case 'pending':
            return "<span class='label label-warning'>Chưa trả thưởng</span>";
        case 'success':
            return "<span class='label label-success'>Đã trả thưởng</span>";
        case 'reject':
            return "<span class=\"label label-danger\">Không trả thưởng</span>";
        case 'error':
            return "<span class=\"label label-default\">Trả thưởng thất bại </span>";
        default:
            return "Không xác định";
    }
}

function getlistvinhdanhbyday() {
    var result = "";
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('user/getlistvinhdanhAjax')?>",
        data: {
            fromDate: $("#fromDate").val(),
            toDate: $("#toDate").val(),
            limitNumber: 10,
        },
        dataType: 'json',
        success: function(result) {
            $("#spinner").hide();
            if (result.success) {
                if (result.topTX == "") {
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $("#logactionbyday").html("");
                } else {
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.topTX, function(index, value) {
                        result += resultSearchTransctionByDay(stt, value);
                        stt++;
                    });
                    $('#logactionbyday').html(result);
                }
            }
           

        },
        error: function() {
            $("#spinner").hide();
            $('#logactionbyday').html("");
            $("#resultsearch").html("Xin chờ trong giây nát!");
        },
        timeout: 20000
    })
}

function getlistvinhdanhbymonth() {
    var result = "";
    $("#spinner").show();
    
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('user/getlistvinhdanhAjax')?>",
        data: {
            fromDate: $("#fromDate2").val(),
            toDate: $("#toDate2").val(),
            limitNumber: 20
        },
        dataType: 'json',
        success: function(result) {
            $("#spinner").hide();
            if (result.success) {
                if (result.topTX == "") {
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $("#logactionbymonth").html("");
                } else {
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.topTX, function(index, value) {
                        result += resultSearchTransctionByMonth(stt, value);
                        stt++;
                    });
                    $('#logactionbymonth').html(result);
                }
            }
           

        },
        error: function() {
            $("#spinner").hide();
            $('#logactionbymonth').html("");
            $("#resultsearch").html("Xin chờ trong giây nát!");
        },
        timeout: 20000
    })
}

$(document).ready(function() {
    //getlistvinhdanhbyday();
    //getlistvinhdanhbymonth();
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