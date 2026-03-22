<title>Rút Tiền Qua Momo</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
    <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
    <div class="widget">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6>Lịch sử chuyển khoản MoMo</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('report/cashoutbymomo') ?>" method="post">
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
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Trạng thái:</label></td>
                        <td class="">
                            <select id="select_status" name="select_status" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="">Chọn</option>
                                <option value="success" <?php if ($this->input->post('select_status') == "success") {
                                                            echo "selected";
                                                        } ?>>Thành công</option>
                                <option value="pending" <?php if ($this->input->post('select_status') == "pending") {
                                                            echo "selected";
                                                        } ?>>Chờ xử lý</option>
                                <option value="sending" <?php if ($this->input->post('select_status') == "sending") {
                                                            echo "selected";
                                                        } ?>>Cổng đang xử lý</option>
                                <option value="betMore" <?php if ($this->input->post('select_status') == "betMore") {
                                                            echo "selected";
                                                        } ?>>Cược thêm</option>
                                <option value="maintenance" <?php if ($this->input->post('select_status') == "maintenance") {
                                                            echo "selected";
                                                        } ?>>Bảo trì</option>
                                <option value="invalidAccount" <?php if ($this->input->post('select_status') == "invalidAccount") {
                                                            echo "selected";
                                                        } ?>>Sai TK</option>

                                <option value="error" <?php if ($this->input->post('select_status') == "error") {
                                                            echo "selected";
                                                        } ?>>Rút tiền thất bại</option>
                                <option value="reject" <?php if ($this->input->post('select_status') == "reject") {
                                                            echo "selected";
                                                        } ?>>Từ chối</option>

                            </select>
                        </td>

                    </tr>
                </table>
            </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>

                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>
                        <td><label style="margin-left: 32px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="magiaodich" value="<?php echo $this->input->post('magiaodich') ?>" name="magiaodich"></td>

                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/cashoutbymomo') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>

                </table>

            </div>
        </form>
        <div class="formRow">
            <div class="row">
                <div class="col-sm-2">
                    <h5>Tổng:<span style="color: #7a6fbe" id="summoney"></span></h5>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-sm-2">
                    <h5>Tổng giao dịch:<span style="color: #7a6fbe" id="sumrecord"></span></h5>
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Mã giao dịch</td>
                    <td>Nick name</td>
                    <td>Số điện thoại</td>
                    <td>Tên tài khoản</td>
                    <td>Tiền chuyển</td>
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
    <div class="modal fade" id="exampleModal1">
            <div class="modal-dialog" style="right: 0; left: 0; width: 30%; position: absolute; top: 30%;">
                <div class="modal-content" style="background: #7cffaa;">
                    <div class="modal-header" style="font-size: 15px; text-align: center; font-weight: bold; color: #d05600;">
                        Lý do hủy rút
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    Lựa chọn:
                                    <input hidden id="transId" value=""/>
                                </td>
                                <td>
                                <select class="selectpicker" id="action_status"> 
                                    <option value="invalidAccount">Sai TK</option>
                                    <option value="maintenance">Bảo trì</option>
                                    <option value="betMore">Cược thêm</option>
                                </select>
                                </td>
                            </tr>
                            
                            
                        </table>
                        <div style="margin-top: 20px; text-align: end">
                                    <input type="button"  value="Đóng" class="button blueB" data-dismiss="modal" style="margin-left: 20px">
                                
                                    <input type="button" id="confirm_reject" value="Xác nhận" class="button blueB"
                                    style="margin-left: 20px">
                              
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p style="color: #7a6fbe">Cập nhật trạng thái thành công</p>
                </div>
                <div class="modal-footer">
                    <input class="blueB logMeIn" type="button" value="Đóng" data-dismiss="modal" aria-hidden="true">
                </div>
            </div>
        </div>
    </div>
</div>

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
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function() {
        var toDatetime = moment($("#toDate").val());
        var fromDatetime = moment($("#fromDate").val());
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });

    function getStatusName(stt) {
        switch (stt) {
            case 'sending':
                return 'Đang xử lý';
            case 'pending':
                return 'Chờ xử lý';
            case 'error':
                return 'Lỗi';
            case 'success':
                return 'Thành công';
            case 'reject':
                return 'Từ chối';
            case 'betMore':
                return 'Cược thêm';
            case 'invalidAccount':
                return 'Sai tài khoản';
            case 'maintenance':
                return 'Bảo trì TK';
            default:
                return 'Lỗi';
        }
    }

    function resultSearchTransction(stt, rid, nickName, phoneNumber, accountName, moneytran, status, message, strTime, userApprove) {
        const createdAt = moment(strTime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss')
        var rs = "";
        rs += "<tr id='" + rid + "_row'>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + rid + "</td>";
        rs += "<td>" + nickName + "</td>";
        rs += "<td>" + phoneNumber + "</td>";
        rs += "<td>" + accountName + "</td>";
        rs += "<td>" + commaSeparateNumber(moneytran) + "</td>";
        rs += `<td tranid="${rid}">` + getStatusName(status) + "</td>";
        rs += "<td>" + message + "</td>";
        rs += "<td>" + createdAt + "</td>";
        if (status === 'pending') {
            rs += `<td actionid="${rid}">`;
            rs += "<span class='label label-primary' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: openReject(" + rid + ")\">Hủy</a></span>";
            rs += "<span class='label label-info' style='padding: 8px;margin-left: 30px;'><a style='color: white;' href=\"javascript: approveTay(" + rid + ")\">DUYỆT</a></span>";
            rs += "</td>";
        
        } else {
            rs += "<td></td>"
        }
        rs += "<td id=" + rid + "_userApprove" + ">" + userApprove + "</td>";
        rs += "</tr>";
        return rs;
    }
    function openReject(rid) {
        $('#transId').val(rid);
        $('#exampleModal1').modal('show');
    }
    
    $('#confirm_reject').click( function() {
        
        const rid = $('#transId').val();
        const typeReject = $('#action_status').val();
        reject(rid, typeReject);

    })
    function reject(rid, typeReject) {
        if (rid) {
            $('#exampleModal1').modal('hide');
            if (confirm("Bạn có chắc chắn muôn HỦY không?")) {
                const status = typeReject;
                console.log(status);
                console.log(rid);
                $("#spinner").show();

                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('report/updatetranmomoajax') ?>",
                    data: {
                        transId: rid,
                        status

                    },

                    dataType: 'json',
                    success: function(result) {

                        $("#spinner").hide();
                        if (result != "") {
                            $("#errorname").html("");
                            $("#filter_iname").val("");
                            $("#txtmoney").val("");
                            $("#txtreason").val("");
                            $("#txtotp").val("");
                            $("#numchuyen").html("");
                            $(`td[tranid=${rid}]`).html(getStatusName(status))
                            $(`td[actionid=${rid}]`).html("")
                        document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;

                        } else {
                            $("#errorname").html("Cập nhật thất bại!");
                        }
                    },
                    error: function() {
                        $("#spinner").hide();
                        $("#errorname").html("Hệ thống quá tải.  Vui long thử lại sau");
                    },
                    timeout: 20000
                });
            }
        } else {
            return false;
        }
    }
    function approveTay(rid) {
        if (rid) {
            if (confirm("Bạn có chắc chắn muốn DUYỆT không?")) {
                const status = 'sending';
                console.log(status);
                console.log(rid);
                $("#spinner").show();

                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('report/updatetranmomoajax') ?>",
                    data: {
                        transId: rid,
                        status

                    },

                    dataType: 'json',
                    success: function(result) {

                        $("#spinner").hide();
                        if (result != "") {
                            $("#errorname").html("");
                            $("#filter_iname").val("");
                            $("#txtmoney").val("");
                            $("#txtreason").val("");
                            $("#txtotp").val("");
                            $("#numchuyen").html("");
                            $(`td[tranid=${rid}]`).html(getStatusName(status))
                            $(`td[actionid=${rid}]`).html("")
                        } else {
                            $("#errorname").html("Cập nhật thất bại!");
                        }
                    },
                    error: function() {
                        $("#spinner").hide();
                        $("#errorname").html("Hệ thống quá tải.  Vui long thử lại sau");
                    },
                    timeout: 20000
                });
            }
        } else {
            return false;
        }
    }
    $(document).ready(function() {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        var toDate = moment($("#toDate").val(), 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        var fromDate = moment($("#fromDate").val(), 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/cashoutbymomoajax') ?>",
            data: {
                nickname: $("#filter_iname").val(),
                bank: $("#select_bank").val(),
                status: $("#select_status").val(),
                toDate,
                fromDate,
                pages: 1,
                tranid: $("#magiaodich").val()
            },

            dataType: 'json',
            success: function(result) {
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
                    $.each(result.ListTrans, function(index, value) {
                        result += resultSearchTransction(
                            stt, value.Id, value.Nickname, value.PhoneNumber, value.accountName, value.Amount, value.Status, "", value.CreatedAt, value.UserApprove
                        );
                        stt++;
                    });
                    $('#logaction').html(result);

                    const toDate = moment($("#toDate").val(), 'YYYY-MM-DD HH:mm:ss');
                    const fromDate = moment($("#fromDate").val(), 'YYYY-MM-DD HH:mm:ss');
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function(event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/cashoutbymomoajax') ?>",
                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        bank: $("#select_bank").val(),
                                        status: $("#select_status").val(),
                                        toDate,
                                        fromDate,
                                        pages: page,
                                        tranid: $("#magiaodich").val()

                                    },
                                    dataType: 'json',
                                    success: function(result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.ListTrans, function(
                                            index, value) {
                                            result +=
                                                resultSearchTransction(
                                                    stt, value.Id, value.Nickname, value.PhoneNumber, value.accountName, value.Amount, value.Status, "", value.CreatedAt, value.UserApprove
                                                );
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
                                    timeout: 20000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }

            },
            error: function() {
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

    var ex = [];
    ex.push(function() {
        var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbymomosunvin"); // ket noi ws server
        itemSocket.onopen = function(event) {
            // itemSocket.send('This is a test');
        };
        itemSocket.onmessage = function(evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            console.log(res);

            if ("2" === res["code"]) {
                let value = res.reportResponses;
                var icon = '<i style="color: red;" class="fa fa-university"></i>';
                var tbodyRows = $('#checkAll > tbody > tr');
                if (tbodyRows.length === 0) {
                    $('#checkAll > tbody').append(resultSearchTransction(icon, value.Id, value.Nickname, value.PhoneNumber, value.accountName, value.Amount, value.Status, value.Description, value.CreatedAt, value.UserApprove));
                } else {
                    var row = $('#' + value.Id + '_row');
                    if (row.length === 0) {
                        $('#checkAll > tbody > tr:first').before(resultSearchTransction(icon, value.Id, value.Nickname, value.PhoneNumber, value.accountName, value.Amount, value.Status, value.Description, value.CreatedAt, value.UserApprove));
                    } else {
                        row[0].outerHTML = resultSearchTransction(icon, value.Id, value.Nickname, value.PhoneNumber, value.accountName, value.Amount, value.Status, value.Description, value.CreatedAt, value.UserApprove);
                    }
                }
            }
        };
        return itemSocket;
    }());
</script>