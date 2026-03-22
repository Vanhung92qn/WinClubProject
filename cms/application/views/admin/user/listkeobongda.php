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
                <h6 style="color: #7b0000;">Danh Sách Trận Đấu</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('user/listkeobongda') ?>" method="post">
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
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Trạng thái:</label>
                            </td>
                            <td class="">
                                <select id="select_bank" name="select_bank"
                                        style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="">Chọn</option>
                                    <option value="MSB"
                                        <?php if ($this->input->post('select_bank') == "MSB") {
                                            echo "selected";
                                        } ?>>Mở cược
                                    </option>
                                    <option value="BIDV"
                                        <?php if ($this->input->post('select_bank') == "BIDV") {
                                            echo "selected";
                                        } ?>>Đã xong
                                    </option>
                                    <option value="VietinBank"
                                        <?php if ($this->input->post('select_bank') == "VietinBank") {
                                            echo "selected";
                                        } ?>>
                                        Đóng cược
                                    </option>

                                </select>
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
                                       id="session"
                                       value="<?php echo $this->input->post('magiaodich') ?>" name="magiaodich"></td>

                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('user/listkeobongda') ?>'; "
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
                    <td>phiên</td>
                    <td>Đội A</td>
                    <td>Đội B</td>
                    <td>Tỉ số</td>
                    <td>Thời gian</td>
                    <td>Cược cả trận</td>
                    <td>Cược Tài xỉu</td>
                    <td>Cược hiệp 1</td>
                    <td>Chấp hiệp 2</td>
                    <td>Trạng thái</td>
                    <td>Hành Động</td>
                    <td>Cập nhật</td>
                </tr>
                </thead>
                <tbody id="logaction">
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


    function resultSearchTransction(stt, session, doiA, doiB, banthangDoiA, banthangDoiB, tilechapCatranDoiA,
                                    tilechapCatranDoiB, tilechapAntranDoiA, tilechapAntranDoiB,
                                    tilechapTaiXiuDoiA, tilechapTaiXiuDoiB, tileAnTaiXiuDoiA, tileAnTaiXiuDoiB,
                                    tilechapHiep1DoiA, tilechapHiep1DoiB, tileAnHiep1DoiA, tileAnHiep1DoiB,
                                    tilechapHiep2DoiA, tilechapHiep2DoiB, tileAnHiep2DoiA, tileAnHiep2DoiB,
                                    thoigian, trangthai, idTran
    ) {
        var rootUrl = '<?php echo admin_url("user/updatekeobongda?id=") ?>';
        var url = rootUrl + idTran + '&session=' + session + '&doiA=' + doiA + '&doiB=' + doiB + '&banThangDoiA=' + banthangDoiA + '&banThangDoiB=' + banthangDoiB + '&tiLeDoiAChapCaTran=' + tilechapCatranDoiA + '&tiLeDoiBChapCaTran=' + tilechapCatranDoiB + '&tileDoiAChapTaiXiu=' + tilechapTaiXiuDoiA + '&tileDoiBChapTaiXiu=' + tilechapTaiXiuDoiB + '&tileDoiAChapHiep1=' + tilechapHiep1DoiA + '&tileDoiBChapHiep1=' + tilechapHiep1DoiB + '&tileDoiAChapHiep2=' + tilechapHiep2DoiA + '&tileDoiBChapHiep2=' + tilechapHiep2DoiB + '&tileAnDoiACaTran=' + tilechapAntranDoiA + '&tileAnDoiBCaTran=' + tilechapAntranDoiB + '&tileAnDoiATaiXiu=' + tileAnTaiXiuDoiA + '&tileAnDoiBTaiXiu=' + tileAnTaiXiuDoiB + '&tileAnDoiAHiep1=' + tileAnHiep1DoiA + '&tileAnDoiBHiep1=' + tileAnHiep1DoiB + '&tileAnDoiAHiep2=' + tileAnHiep2DoiA + '&tileAnDoiBHiep2=' + tileAnHiep2DoiB + '&status=0&url=none' + '&thoiGianDa=' + thoigian;

        var rs = "";
        rs += "<tr>";
        rs += "<td rowspan=\"2\">" + stt + "</td>";
        rs += "<td rowspan=\"2\">" + session + "</td>";
        rs += "<td rowspan=\"2\" style='color: #297900;font-weight: bold;'>" + doiA + "</td>";
        rs += "<td rowspan=\"2\">" + doiB + "</td>";
        rs += "<td rowspan=\"2\">" + banthangDoiA + " - " + banthangDoiB + "</td>";
        rs += "<td rowspan=\"2\">" + thoigian + "</td>";
        rs += "<td>" + "chấp :" + tilechapCatranDoiA + " - tỉ lệ:" + tilechapAntranDoiA + "</td>";

        rs += "<td>" + "chấp :" + tilechapTaiXiuDoiA + " - tỉ lệ:" + tileAnTaiXiuDoiA + "</td>"

        rs += "<td>" + "chấp :" + tilechapHiep1DoiA + " - tỉ lệ:" + tileAnHiep1DoiA + "</td>"

        rs += "<td>" + "chấp :" + tilechapHiep2DoiA + " - tỉ lệ:" + tileAnHiep2DoiA + "</td>"

        rs += "<td rowspan=\"2\">" + getStatusText(trangthai) + "</td>";
        if (trangthai < 4) {
            rs += "<td rowspan=\"2\" ><span class='label label-warning' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: approve(" + idTran + ")\">Đóng đặt cược</a></span> </td>";
        } else {
            rs += "<td rowspan=\"2\" ><span class='label label-success' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: open(" + idTran + ")\">Mở cược</a></span></td>"
        }
        rs += "<td rowspan=\"2\" ><span class='label label-danger' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"" + url + "\" >' Sửa</a></span><span class='label label-warning' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: deleteKeo(" + idTran + ")\">Xóa</a></span> </td>"
        rs += "</tr>";
        rs += "<tr>"
        rs += "<td>" + "chấp :" + tilechapCatranDoiB + "  - tỉ lệ:" + tilechapAntranDoiB + "</td>"
        rs += "<td>" + "chấp :" + tilechapTaiXiuDoiB + "  - tỉ lệ:" + tileAnTaiXiuDoiB + "</td> "
        rs += "<td>" + "chấp :" + tilechapHiep1DoiB + "  - tỉ lệ:" + tileAnHiep1DoiB + "</td>  "
        rs += "<td>" + "chấp :" + tilechapHiep2DoiB + "  - tỉ lệ:" + tileAnHiep2DoiB + "</td>"
        return rs;
    }

    function approve(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/dongcuockeoajax')?>",
            data: {
                Id: rid,
                status: 4
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result != "") {
                    alert("Duyệt thành công!")
                    window.location.href = "";
                } else {
                    alert("Duyệt thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function deleteKeo(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/xoacuockeoajax')?>",
            data: {
                Id: rid
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result != "") {
                    alert("Duyệt thành công!")
                    window.location.href = "";
                } else {
                    alert("Duyệt thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function open(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/dongcuockeoajax')?>",
            data: {
                Id: rid,
                status: 0
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result != "") {
                    alert("Duyệt thành công!")
                    window.location.href = "";
                } else {
                    alert("Duyệt thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function getStatusText(status) {
        if (status < 4) {
            return "<span class='label label-success'>Đang mở đặt cược</span>";
        } else {
            return "<span class='label label-danger'>Đóng đặt cược </span>";
        }
    }

    $(document).ready(function () {
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
       var session = $("#session").val();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/listkeobongdaajax')?>",
            data: {
                session: session,
                frD: fromDatetime,
                todate: toDatetime,
                page: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();

                if (result.listTrans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");


                    stt = 1;
                    $.each(result.listTrans, function (index, value) {
                        result += resultSearchTransction(
                            stt, value.session, value.doiA, value.doiB,
                            value.banThangDoiA, value.banThangDoiB,
                            value.tiLeDoiAChapCaTran, value.tiLeDoiBChapCaTran, value.tileAnDoiACaTran, value.tileAnDoiBCaTran,
                            value.tileDoiAChapTaiXiu, value.tileDoiBChapTaiXiu, value.tileAnDoiATaiXiu, value.tileAnDoiBTaiXiu,
                            value.tileDoiAChapHiep1, value.tileDoiBChapHiep1, value.tileAnDoiAHiep1, value.tileAnDoiBHiep1,
                            value.tileDoiAChapHiep2, value.tileDoiBChapHiep2, value.tileAnDoiAHiep2, value.tileAnDoiBHiep2,
                            value.thoiGianDa, value.status, value.Id
                        );
                        stt++;
                    });
                   // $('#logaction').html(result);
                    let totalPage=100;
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('user/listkeobongdaajax')?>",
                                    data: {
                                        session: session,
                                        frD: fromDatetime,
                                        todate: toDatetime,
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.listTrans, function (
                                            index, value) {
                                            result += resultSearchTransction(
                                                stt, value.session, value.doiA, value.doiB,
                                                value.banThangDoiA, value.banThangDoiB,
                                                value.tiLeDoiAChapCaTran, value.tiLeDoiBChapCaTran, value.tileAnDoiACaTran, value.tileAnDoiBCaTran,
                                                value.tileDoiAChapTaiXiu, value.tileDoiBChapTaiXiu, value.tileAnDoiATaiXiu, value.tileAnDoiBTaiXiu,
                                                value.tileDoiAChapHiep1, value.tileDoiBChapHiep1, value.tileAnDoiAHiep1, value.tileAnDoiBHiep1,
                                                value.tileDoiAChapHiep2, value.tileDoiBChapHiep2, value.tileAnDoiAHiep2, value.tileAnDoiBHiep2,
                                                value.thoiGianDa, value.status, value.Id
                                            );
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

    });


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
</script>
