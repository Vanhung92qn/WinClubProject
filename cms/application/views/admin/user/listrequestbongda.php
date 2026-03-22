<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role == false): ?>
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
                <h6 style="color: #7b0000;">Danh Sách cược bóng đá</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('user/listrequestbongda') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>">
                                    <span
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
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>">
                                    <span
                                            class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>

                            <td><label style="margin-left: 32px;margin-bottom:-2px;width: 100px">Phiên:</label>
                            </td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="phien"
                                       value="<?php echo $this->input->post('magiaodich') ?>" name="magiaodich"></td>

                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('user/listrequestbongda') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <td>
                                <button id="btnExport" class="basic" style="margin-left: 20px"> EXPORT</button>
                            </td>
                        </tr>

                    </table>

                </div>
            </form>
            
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll"
                   style="background: #fffed9;">
                <thead style="height: 35px; background: #a51700;">
                <tr style="height: 35px;">
                    <td>STT</td>
                    <td>Phiên</td>
                    <td>id</td>
                    <td>Nick name</td>
                    <td>Cửa đặt</td>
                    <td>Thời gian đặt</td>
                    <td>Tỉ lệ ăn</td>
                    <td>Tỉ lệ chấp</td>
                    <td>Đội A</td>
                    <td>Đội B</td>
                    <td>Tỉ số</td>
                    <td>Tiền thắng</td>
                    <td>Tiền đặt</td>
                    <td>Trạng thái</td>
                    <td>Trả thưởng</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>


            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="exportExel"
                   style="display: none;">
                <thead>
                <tr>
                    <td>STT</td>
                    <td>Phiên</td>
                    <td>id</td>
                    <td>Nick name</td>
                    <td>Cửa đặt</td>
                    <td>Thời gian đặt</td>
                    <td>Tỉ lệ ăn</td>
                    <td>Tỉ lệ chấp</td>
                    <td>Đội A</td>
                    <td>Đội B</td>
                    <td>Tỉ số</td>
                    <td>Tiền thắng</td>
                    <td>Tiền đặt</td>
                    <td>Trạng thái</td>
                    <td>Trả thưởng</td>
                </tr>
                </thead>
                <tbody id="logactionExel">
                </tbody>
            </table>
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
</style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>

</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });

    function createXLSXTableDemo() {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        var fileName = 'Report_dat_cuoc_bong_da_from_' + fromDatetime + '_to_' + toDatetime;
        var table = document.getElementById('checkAll');
        var wb = XLSX.utils.table_to_book(table, {sheet: "YOU88"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    }

    $("#btnExport").click(function (e) {
       e.preventDefault()
       var fromDatetime = $("#fromDate").val();
       var toDatetime = $("#toDate").val();
       if (fromDatetime > toDatetime) {
           alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
           return false;
       }
       createXLSXTableDemo();
    });


    function resultSearchTransction(stt, session, id, nickName, datcua, tilean, tileChap, doiA, doiB, tiso, tienthnag, tienDat, trangthai, thoigian) {
        var rs = "";
        var idBonus = id + '_bonus';
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + session + "</td>";
        rs += "<td>" + id + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + nickName + "</td>";
        rs += "<td>" + getCuaDat(datcua) + "</td>";
        rs += "<td>" + thoigian + "</td>";
        rs += "<td>" + tilean + "</td>";
        rs += "<td style='color: #8a0000;font-weight: bold;'>" + tileChap + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + doiA + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + doiB + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + tiso + "</td>";
        if (tienthnag > 0) {
            rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(tienthnag) + "</td>";
        } else {
            rs += "<td style='color: #0008ff;font-weight: bold;'><input type='text' id='" + idBonus + "' value='0'></td>";
        }

        rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(tienDat) + "</td>";
        rs += "<td>" + getStatusText(trangthai) + "</td>";
        if (Number(trangthai) == 0) {
            rs += "<td style='display: flex;justify-content: center;align-items: center;'><span class='label label-success'><a style='color: white;' onclick=\"approve('" + idBonus + "','" + nickName + "','" + session + "','" + id + "')\">Trả thưởng</a></span> </td>";
        } else {
            rs += "<td></td>";
        }

        rs += "</tr>";
        return rs;
    }

    function approve(idBonus, nickname, session, id) {
        var moenyWin = $('#' + idBonus).val();
        if (!checkInp(idBonus)) {
            return false;
        }

        if (Number(moenyWin) <= 0) {
            alert("Tiền trả thưởng không được âm hoặc bằng 0!");
            return false;
        }

        var confirmApprove = confirm("Bạn có chắc chắn trả thưởng?");
        if (confirmApprove != true) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/trathuongbongdaajax')?>",
            data: {
                nickname: nickname,
                moenyWin: moenyWin,
                idTran: null,
                id: id,
                session: session
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result == 1){
                        $("#resultsearch").html("Bạn trả thưởng thành công!");
                        $("#resultsearch").css({
                            "color": "#227300",
                            "margin-left": "10px",
                            "font-weight": "bold"
                        });
                        window.location.href = "";
                        //listrequestbongda();
                    }else if(result == 0){
                        alert("Bạn trả thưởng thất bại")
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

    function getCuaDat(status) {
        switch (status) {
            case 1:
                return "<span class='label label-success'>Cửa trên cả trận</span>";
            case 3:
                return "<span class='label label-success'>Tài </span>";
            case 5:
                return "<span class=\"label label-success\">Cửa trên Hiệp 1</span>";
            case 7:
                return "<span class=\"label label-success\">Cửa trên Hiệp 2</span>";
            case 2:
                return "<span class='label label-success'>Cửa Dưới cả trận</span>";
            case 4:
                return "<span class='label label-success'>Xỉu </span>";
            case 6:
                return "<span class=\"label label-success\">Cửa Dưới Hiệp 1</span>";
            case 8:
                return "<span class=\"label label-success\">Cửa Dưới Hiệp 2</span>";
            default:
                return "Không xác định";
        }
    }

    function getStatusText(status) {
        switch (status) {
            case 0:
                return "<span class='label label-warning'>Đang chờ</span>";
            case 1:
                return "<span class='label label-success'>Đã trả thưởng</span>";

            default:
                return "Không xác định";
        }
    }

    function listrequestbongda() {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        var today = new Date();
        var dd = String(today.getDate());
        var mm = String(today.getMonth() + 1); //January is 0!
        var yyyy = today.getFullYear();
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (parseInt(mm) < 10) mm = "0" + mm;
        if (parseInt(dd) < 10) dd = "0" + dd;
        //  let session = dd + mm + yyyy; phien
        var session = $("#phien").val();
          if(!session || session === ''){
              session = dd + mm + yyyy;
          }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/listrequestbongdaajax')?>",
            data: {
                session: session,
                toDate: toDatetime,
                fromDate: fromDatetime,
                pages: 1

            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();

                if (result.ListTrans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");

                    stt = 1;
                    $.each(result.listTrans, function (index, value) {
                        // console.log(value);
                        if (value.keoBongDa != null) {
                            result += resultSearchTransction(
                            stt, value.keoBongDa.session, value.userBetBongDa.id, value.userBetBongDa.nickname, value.userBetBongDa.betType, value.userBetBongDa.tiLeAn,
                            value.userBetBongDa.chapTrai, value.keoBongDa.doiA, value.keoBongDa.doiB, (value.keoBongDa.banThangDoiA + " - " + value.keoBongDa.banThangDoiB), value.userBetBongDa.moneyWin, value.userBetBongDa.moneyBet, value.userBetBongDa.result
                            , value.userBetBongDa.CreatedAt);
                        }
                        stt++;
                    });
                    let totalPage = 100;
                    $('#logaction').html(result);

                    var table = $('#checkAll').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });
                   

                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('user/listrequestbongdaajax')?>",
                                    data: {
                                        session: session,
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.listTrans, function (
                                            index, value) {
                                            if (value.keoBongDa != null) {
                                                result += resultSearchTransction(
                                                stt, value.keoBongDa.session, value.userBetBongDa.id, value.userBetBongDa.nickname, value.userBetBongDa.betType, value.userBetBongDa.tiLeAn,
                                                value.userBetBongDa.chapTrai, value.keoBongDa.doiA, value.keoBongDa.doiB, (value.keoBongDa.banThangDoiA + " - " + value.keoBongDa.banThangDoiB), value.userBetBongDa.moneyWin, value.userBetBongDa.moneyBet, value.userBetBongDa.result, value.userBetBongDa.CreatedAt);
                                            }
                                            stt++;
                                        });
                                        $('#logaction').html(result);

                                    },
                                    error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html(
                                            "Hệ thống quá tải. Vui lòng thử lại sau!"
                                        );
                                    },
                                    timeout: 20000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }

            },
            error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }


    $(document).ready(function () {
        listrequestbongda();
    });

    // setInterval(function () {
    //     window.location.href = "";
    // }, 120000);
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function convertTime(time) {
        var a = new Date(time);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
        return time;
    }

    function checkInp(idBonus) {
        var moenyWin = $('#' + idBonus).val();
        if (isNaN(moenyWin)) {
            alert("Bạn phải nhập số!");
            return false;
        }
        return true;
    }
</script>
