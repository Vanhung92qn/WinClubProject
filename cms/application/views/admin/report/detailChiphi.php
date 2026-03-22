<title>Quản Lý Chi Phí</title>

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

        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
        <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.table2excel.js"></script>
        <div class="widget">
            <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
            <div class="title">
                <h6>Chi tiết chi phí</h6>
            </div>
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
                        </tr>
                    </table>
                </div>
                <div class="formRow">

                    <table>
                        <tr>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Chi:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="expense" value="" name="expense"></td>
                            <td><label style="margin-left: 27px;margin-bottom:-2px;width: 100px">Phân loại:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="type" value="" name="type"></td>

                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 123px">
                            </td>
                            <td>
                                <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/detailChiphi') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <!-- <td>
                            <input type="button" id="exportexel" value="Xuất Exel" class="button blueB"
                                style="margin-left: 20px">
                        </td> -->
                            <td>
                                <input type="button" id="add_chi" value="Thêm Chi phí" class="button blueB" style="margin-left: 20px">
                            </td>
                        </tr>

                    </table>

                </div>

                <div class="formRow">
                </div>
            </form>
            <div class="formRow"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                    <tr style="height: 20px;">
                        <td>STT</td>
                        <td>Phân loại</td>
                        <td>Chi</td>
                        <td>Số tiền</td>
                        <td>Thời gian</td>
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
</style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
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
    $("#add_chi").click(function() {
        window.location.href = "<?php echo admin_url('report/addChiPhi') ?>"
    })


    $("#exportexel").click(function() {
        $("#checkAll").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "listtranfer",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    });

    function resultSearchTransction(stt, name, type, amount, time) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + type + "</td>";
        rs += "<td>" + name + "</td>";
        rs += "<td>" + commaSeparateNumber(amount) + "</td>";
        rs += "<td>" + time + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/detailChiphiAjax') ?>",
            data: {
                expense: $("#expense").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                page: 1,
                pageSize: 10,
                type: $("#type").val()
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    var totalPage = result.total / result.pageSize + 1;
                    stt = 1;
                    $.each(result.transactions, function(index, value) {
                        result += resultSearchTransction(stt, value.expense, value.type,
                            value.amount, value.createdTime);
                        stt++;

                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function(event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/detailChiphiAjax') ?>",
                                    data: {
                                        expense: $("#expense").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        page,
                                        pageSize: 10,
                                        type: $("#type").val()
                                    },
                                    dataType: 'json',
                                    success: function(result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.transactions, function(
                                            index, value) {
                                            result += resultSearchTransction(stt, value.expense, value.type,
                                                value.amount, value.createdTime);
                                            stt++;

                                        });
                                        $('#logaction').html(result);
                                    },
                                    error: function() {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html(
                                            "Hệ thống quá tải. Vui lòng thử lại sau!"
                                        );
                                    },
                                    timeout: 3 * 60 * 1000
                                });
                            }
                            oldPage = page;
                        }
                    });
                }
            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 3 * 60 * 1000
        })
        $("#search_tran").click(function() {
            var fromDatetime = $("#fromDate").val();
            var toDatetime = $("#toDate").val();
            if (fromDatetime > toDatetime) {
                alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
                return false;
            }
            $("#spinner").show();
            $('#logaction').html("");
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('report/detailChiphiAjax') ?>",
                data: {
                    expense: $("#expense").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    page: 1,
                    pageSize: 10,
                    type: $("#type").val()
                },

                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Không tìm thấy kết quả");
                    } else {
                        $("#resultsearch").html("");
                        var totalPage = result.total / result.pageSize + 1;
                        stt = 1;
                        $.each(result.transactions, function(index, value) {
                            result += resultSearchTransction(stt, value.expense, value.type,
                                value.amount, value.createdTime);
                            stt++;

                        });
                        $('#logaction').html(result);
                        $('#pagination-demo').twbsPagination({
                            totalPages: totalPage,
                            visiblePages: 5,
                            onPageClick: function(event, page) {
                                if (oldPage > 0) {
                                    $("#spinner").show();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo admin_url('report/detailChiphiAjax') ?>",
                                        data: {
                                            expense: $("#expense").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            page,
                                            pageSize: 10,
                                            type: $("#type").val()
                                        },
                                        dataType: 'json',
                                        success: function(result) {
                                            $("#resultsearch").html("");
                                            $("#spinner").hide();
                                            stt = 1;
                                            $.each(result.transactions, function(
                                                index, value) {
                                                result += resultSearchTransction(stt, value.expense, value.type,
                                                    value.amount, value.createdTime);
                                                stt++;

                                            });
                                            $('#logaction').html(result);
                                        },
                                        error: function() {
                                            $("#spinner").hide();
                                            $('#logaction').html("");
                                            $("#resultsearch").html(
                                                "Hệ thống quá tải. Vui lòng thử lại sau!"
                                            );
                                        },
                                        timeout: 3 * 60 * 1000
                                    });
                                }
                                oldPage = page;
                            }
                        });
                    }
                },
                error: function() {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                },
                timeout: 3 * 60 * 1000
            })
        });
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