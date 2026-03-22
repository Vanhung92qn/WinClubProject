<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role === null): ?>
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
                <h6 style="color: #7b0000;">Lịch sử Rút Tiền bằng Thẻ Điện thoại</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/cashoutbycardmanual') ?>" method="post">
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
                                <select id="select_status" name="select_status"
                                        style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="">Chọn</option>
                                    <option value="success"
                                        <?php if ($this->input->post('select_status') == "1") {
                                            echo "selected";
                                        } ?>>Thành công
                                    </option>
                                    <option value="pending"
                                        <?php if ($this->input->post('select_status') == "0") {
                                            echo "selected";
                                        } ?>>Đang xử lý
                                    </option>
                                    <option value="error"
                                        <?php if ($this->input->post('select_status') == "3") {
                                            echo "selected";
                                        } ?>>Rút tiền thất bại
                                    </option>
                                    <option value="reject"
                                        <?php if ($this->input->post('select_status') == "2") {
                                            echo "selected";
                                        } ?>>Từ chối
                                    </option>

                                </select>
                            </td>
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Loại thẻ:</label></td>
                            <td class="">
                                <select id="select_bank" name="select_bank"
                                        style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="">Chọn</option>
                                    <option value="MSB"
                                        <?php if ($this->input->post('select_bank') == "MSB") {
                                            echo "selected";
                                        } ?>>Maritime
                                    </option>
                                    <option value="BIDV"
                                        <?php if ($this->input->post('select_bank') == "BIDV") {
                                            echo "selected";
                                        } ?>>BIDV
                                    </option>
                                    <option value="VietinBank"
                                        <?php if ($this->input->post('select_bank') == "VietinBank") {
                                            echo "selected";
                                        } ?>>
                                        VietinBank
                                    </option>
                                    <option value="VietcomBank"
                                        <?php if ($this->input->post('select_bank') == "VietcomBank") {
                                            echo "selected";
                                        } ?>>
                                        VietcomBank
                                    </option>
                                </select>
                            </td>

                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Số bản ghi:</label></td>
                            <td><select id="max_item" name="max_item" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>

                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name">
                            </td>
                            <td><label style="margin-left: 32px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label>
                            </td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="magiaodich"
                                       value="<?php echo $this->input->post('magiaodich') ?>" name="magiaodich"></td>

                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/cashoutbycardmanual') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>

                    </table>

                </div>
            </form>
            <div class="formRow">
                <div class="row">
                    <div class="col-sm-2">
                        <h4>Tổng:<span style="font-size: 19px;color: #ff0081; font-weight: bold" id="summoney"></span>
                        </h4>
                    </div>
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-2">
                        <h5>Tổng giao dịch:<span style="color: #7a6fbe" id="sumrecord"></span></h5>
                    </div>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll"
                   style="background: #fffed9;">
                <thead style="height: 35px; background: #a51700;">
                <tr style="height: 35px;">
                    <td>STT</td>
                    <td>Mã giao dịch</td>
                    <td>Nick name</td>
                    <td>Nhà mạng</td>
                    <td>Số Pin</td>
                    <td style="width:100px;">Số seri</td>
                    <td>Mệnh giá</td>
                    <td>Trạng thái</td>
                    <td>Mô tả</td>

                    <td>Thời gian</td>
                    <td>Hành động</td>
                    <td>Người Duyệt</td>
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

    $('#max_item').on('change', function() {
        getlist();
    });

    function resultSearchTransction(stt, rid, nickName, telco, pin, seri, amount, status, message, strTime, userApprove) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + rid + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + nickName + "</td>";

        rs += "<td>" + telco + "</td>";
        if (pin == "" || seri == "") {
            rs += "<td> <input type=\"text\" class='form-control' id=\"pin" + rid + "\" placeholder=\"PIN\"> </td>";
            rs += "<td> <input type=\"text\" class='form-control' id=\"seri" + rid + "\" placeholder=\"Seri\"> </td>";
        } else {
            rs += "<td style='color: #8a0000;font-weight: bold;'>" + pin + "</td>";
            rs += "<td style='color: #8a0000;font-weight: bold;'>" + seri + "</td>";
        }

        rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(amount) + "</td>";
        rs += "<td id=" + rid + "_status" + ">" + getStatusText(status) + "</td>";
        rs += "<td>" + message + "</td>";

        rs += "<td>" + strTime + "</td>";
        if (status == 1) {
            rs += "<td id=" + rid + "_action" + ">  <span class='label label-danger'><a style='color: white;' href=\"javascript: reject(" + rid + ")\">Từ chối</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve(" + rid + ")\">Duyệt</a></span> </td>";

        } else {
            rs += "<td></td>"
        }
        // rs += "<td><a href='/admin/report/updatetrans?transId=" + rid + "'>Cập nhật<a></td>";
        rs += "<td id=" + rid + "_userApprove" + ">" + userApprove + "</td>";
        rs += "</tr>";
        return rs;
    }

    function getStatusText(status) {
        switch (status) {
            case "1":
                return "<span class='label label-warning'>Đang chờ xử lý</span>";
            case "100":
                return "<span class='label label-success'>Thành công </span>";
            case "2":
                return "<span class=\"label label-danger\">Từ chối </span>";
            default:
                return "Không xác định";
        }
    }

    function reject(tid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/approvecashoutbycardajax')?>",
            data: {
                transId: tid,
                type: 2
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    document.getElementById(tid + "_status").innerHTML = getStatusText("2");
                    document.getElementById(tid + "_action").innerHTML = "";
                    document.getElementById(tid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Từ chối thất bại!")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function approve(tid) {
        var pin = $("#pin" + tid).val();
        var seri = $("#seri" + tid).val();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/approvecashoutbycardajax')?>",
            data: {
                transId: tid,
                type: 100,
                pin: pin,
                seri: seri
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    document.getElementById(tid + "_status").innerHTML = getStatusText("100");
                    document.getElementById(tid + "_action").innerHTML = "";
                    document.getElementById(tid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại thẻ trong kho đã hết hoặc số dư ko đủ !")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function getlist() {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/cashoutbycardmanualajax')?>",
            data: {
                nickname: $("#filter_iname").val(),
                bank: $("#select_bank").val(),
                status: $("#select_status").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                pages: 1,
                maxItem: $("#max_item").val(),
                tranid: $("#magiaodich").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();

                if (result.ListTrans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    var totalPage = Math.ceil(result.totalTrans / 50);
                    var totalmoney = commaSeparateNumber(result.totalMoney);
                    var totalrecord = commaSeparateNumber(result.totalTrans);

                    $('#summoney').html(totalmoney);
                    $('#sumrecord').html(totalrecord);
                    stt = 1;
                    $.each(result.ListTrans, function (index, value) {
                        result += resultSearchTransction(
                            stt, value.Id, value.Username, value.telcoId, value.Pin, value.Seri, value.Amount, value.Status, "", value.CreatedAt, value.UserProve
                        );
                        stt++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/cashoutbycardmanualajax')?>",
                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        bank: $("#select_bank").val(),
                                        status: $("#select_status").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        pages: page,
                                        maxItem: $("#max_item").val(),
                                        tranid: $("#magiaodich").val()

                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.ListTrans, function (
                                            index, value) {
                                            result +=
                                                resultSearchTransction(
                                                    stt, value.Id, value.Username, value.telcoId, value.Pin, value.Seri, value.Amount, value.Status, "", value.CreatedAt, value.UserProve
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
    }

    $(document).ready(function () {
        getlist();
    });

    // window.addEventListener('Event_cashoutbycardmanual', function (e) {
    //     setTimeout(function(){
    //         window.location.href = "";
    //     }, 2000);
    // }, false);

    // Let us open a web socket
    var ex = [];
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbycardmanual"); // ket noi ws server
        itemSocket.onopen = function (event) {
            // itemSocket.send('This is a test');
        };
        itemSocket.onmessage = function (evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if("2"===(res["code"])){
                let value = res.reportResponses;
                var icon = '<i style="color: red;" class="fa fa-credit-card"></i>';
                $('#checkAll > tbody > tr:first').before(resultSearchTransction(icon, value.Id, value.Username, value.telcoId, value.Pin, value.Seri, value.Amount, value.Status, "", value.CreatedAt, value.UserProve));
            }
        };
        return itemSocket;
    }());
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>eventaction"); // ket noi ws server
        itemSocket.onopen = function (event) {
            // itemSocket.send('This is a test 2');
        };
        itemSocket.onmessage = function (evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if("2"===(res["code"])){
                //console.log(res);
                let value = res.reportResponses;
                if (value.Type == "CASH_OUT_CARD") {
                    var status = value.Status == 100 ? "100" : "2";
                    document.getElementById(value.Id + "_status").innerHTML = getStatusText(status);
                    document.getElementById(value.Id + "_action").innerHTML = "";
                    document.getElementById(value.Id + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                    // update number notify
                    var count7 = getCookie("count7");
                    count7 = (Number(count7) - 1) > 0 ? (Number(count7) - 1) : 0
                    setCookie("count7", count7, 1);
                    document.getElementById('notification7').setAttribute('data-count', count7);
                    getNotify();

                }
            }
        };
        return itemSocket;
    }());

    // setInterval(function () {
    //     window.location.href = "";
    // }, 60000);

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