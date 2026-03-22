<title>Rút Tiền Qua Ngân Hàng</title>

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

        <div class="widget" style="background: #ffd6d6; border-radius: 15px;">
            <h4 id="resultsearch" style="color: #b82516;margin-left: 10px"></h4>
            <div class="title">
                <h6 style="color: #7b0000;">Lịch sử chuyển khoản ngân hàng</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/cashoutbybank') ?>" method="post">
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

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Số TK: </label>
                            </td>
                            <td class="item">
                                <div class="input-group">
                                    <input type="text" id="bankNumber" value="<?php echo $this->input->post('bankNumber') ?>" name="bankNumber">
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
                                    <option value="error" <?php if ($this->input->post('select_status') == "error") {
                                                                echo "selected";
                                                            } ?>>Rút tiền thất bại</option>
                                    <option value="reject" <?php if ($this->input->post('select_status') == "reject") {
                                                                echo "selected";
                                                            } ?>>Từ chối</option>

                                </select>
                            </td>
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Loại thẻ:</label></td>
                            <td class="">
                                <select id="select_bank" name="select_bank" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="">Chọn</option>
                                    <option value="MSB" <?php if ($this->input->post('select_bank') == "MSB") {
                                                            echo "selected";
                                                        } ?>>Maritime
                                    </option>
                                    <option value="BIDV" <?php if ($this->input->post('select_bank') == "BIDV") {
                                                                echo "selected";
                                                            } ?>>BIDV
                                    </option>
                                    <option value="VietinBank" <?php if ($this->input->post('select_bank') == "VietinBank") {
                                                                    echo "selected";
                                                                } ?>>
                                        VietinBank</option>
                                    <option value="VietcomBank" <?php if ($this->input->post('select_bank') == "VietcomBank") {
                                                                    echo "selected";
                                                                } ?>>
                                        VietcomBank</option>
                                </select>
                            </td>

                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Tùy chọn:</label></td>
                            <td class="">
                                <select id="auto_reload" name="auto_reload" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="auto" <?php if ($this->input->post('auto_reload') == "auto") {
                                                                echo "selected";
                                                            } ?>>auto reload
                                    </option>
                                    <option value="notauto" <?php if ($this->input->post('auto_reload') == "notauto") {
                                                                echo "selected";
                                                            } ?>>bỏ auto reload
                                    </option>

                                </select>
                            </td>

                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Số bản ghi:</label></td>
                            <td><select id="max_item" name="max_item" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="1000">1,000</option>
                                    <option value="10000">10,000</option>
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
                                <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/cashoutbybank') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <td>
                                <input type="button" id="exportexel" value="Xuất Exel" class="button blueB" style="margin-left: 20px">
                            </td>
                        </tr>

                    </table>

                </div>
            </form>
            <div class="formRow">
                <div class="row">
                    <div class="col-sm-2">
                        <h4>Tổng:<span style="font-size: 19px;color: #ff0081; font-weight: bold" id="summoney"></span></h4>
                    </div>
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-2">
                        <h5>Tổng giao dịch:<span style="color: #7a6fbe" id="sumrecord"></span></h5>
                    </div>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll" style="background: #fffed9;">
                <thead style="height: 35px; background: #a51700;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Nick name</td>
                        <td>Ngân hàng</td>
                        <td>Số Tài khoản</td>
                        <td style="width:180px;">Tên tài khoản</td>
                        <td>Tiền chuyển</td>
                        <td>Trạng thái</td>
                        <td>Mô tả</td>
                        <td style="width: 90px;">Thời gian</td>
                        <td>Hành động</td>
                        <td style="width: 53px;">Người Duyệt</td>
                    </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>


            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="exportExel" style="display: none;">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nick name</td>
                        <td>Ngân hàng</td>
                        <td>Số Tài khoản</td>
                        <td>Tên tài khoản</td>
                        <td>Tiền chuyển</td>
                        <td>Trạng thái</td>
                        <td>Mô tả</td>
                        <td>Thời gian</td>
                        <td>Hành động</td>
                        <td>Người Duyệt</td>
                    </tr>
                </thead>
                <tbody id="logactionExel">
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
                                    <option value='0'>Sai TK</option>
                                    <option value='2'>Bảo trì</option>
                                    <option value='3'>Cược thêm</option> 
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
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>

</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
        var fromDatetime = moment($("#fromDate").val(), 'YYYY-MM-DD HH:mm:ss');
        var toDatetime = moment($("#toDate").val(), 'YYYY-MM-DD HH:mm:ss');
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });

    $('#max_item').on('change', function() {
        getlist();
    });

    function createXLSXTableDemo() {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        var fileName = 'Report_cashoutbybank_from_' + fromDatetime + '_to_' + toDatetime;
        var table = document.getElementById('exportExel');
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "YOU88"
        });
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    }

   


    function resultSearchTransction(stt, rid, nickName, bank, accnh, nametknh, moneytran, status, message, strTime, userApprove, UpdatedAt) {
        var rs = "";


        if (UpdatedAt.split("|")[3] !== 'null' && UpdatedAt.split("|")[3] !== accnh) {
            rs += "<tr id=" + rid + "_row  style='background: #ffbaba;'>";
        } else {
            rs += "<tr id=" + rid + "_row>";
        }

        rs += "<td>" + stt + "</td>";

        rs += "<td style='color: #297900;font-weight: bold;'>" + nickName + "</td>";
        rs += "<td>" + bank + "</td>";
        rs += "<td>" + accnh + "</td>";
        rs += "<td style='color: #8a0000;font-weight: bold;'>" + nametknh + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(moneytran) + "</td>";
        rs += "<td id=" + rid + "_status" + ">" + getStatusText(status) + "</td>";
        rs += "<td>" + message + "</td>";
        const daytime = moment(strTime.split(" ")[0], 'YYYY-MM-DD').format('YYYY-MM-DD')
        rs += "<td>" + strTime.split(" ")[1] + "<br>" + daytime + "</td>";

        rs += updateAction(status, rid, nickName);
        rs += "<td id=" + rid + "_userApprove" + ">" + userApprove + "</td>";
        rs += "</tr>";
        return rs;
    }

    // Định nghĩa hàm confirmListApprove
    function confirmListApprove(rid, selectElement, nickName) {
        var confirmation = confirm("Bạn có chắc chắn muốn phê duyệt không?");
        if (confirmation) {
            listApprove(rid, selectElement, nickName);
        } else {
            // Reset lại giá trị của select nếu người dùng chọn "Hủy bỏ"
            selectElement.selectedIndex = 0;
        }
    }

    function listApprove(rid, sel, nickName) {
        if (confirm('Bạn có chắc không')) {
            console.log(sel.value);
            switch (sel.value) {
                case '1':
                    this.approve(rid);
                    break;
                case '2':
                    this.approve2(rid);
                    break;
                case '3':
                    this.approve3(rid);
                    break;
                case '4':
                    this.approve4(rid);
                    break;
                case '5':
                    this.approve5(rid);
                    break;
                case '6':
                    this.approve6(rid);
                    break;
                case '7':
                    this.approve7(rid);
                    break;
                case '8':
                    this.approve8(rid);
                    break;
                case '9':
                    this.approve9(rid);
                    break;
                case '10':
                    this.approve10(rid);
                    break;
                default:
                    // code block
            }
        }
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
        $('#exampleModal1').modal('hide');
        var confirmReject = confirm("Bạn có chắc chắn Huỷ không?");
        if (confirmReject != true) {
            return false;
        }
        document.getElementById(rid + "_action").outerHTML = updateAction("reject", rid, '');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax') ?>",
            data: {
                transId: rid,
                type: typeReject,
                status: 'reject',
                user: ''
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("reject");
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Từ chối thất bại!")
                }
            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function updateAction(status, rid, nickName) {
        var rs = '';
        if (status == 'pending') {
            rs += "<td id=" + rid + "_action" + " style='display: flex;justify-content: center;align-items: center;flex-wrap: wrap;'>";
            rs += "<span class='label label-primary' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: openReject(" + rid + ")\">Hủy</a></span>";
            rs += "<span class='label label-primary' style='padding: 8px;margin-left: 30px;'><a style='color: white;' href=\"javascript: approve(" + rid + ")\">Duyệt</a></span>";
            rs += "</td>";
        } else {
            rs += "<td id=" + rid + "_action" + " style='display: flex;justify-content: center;align-items: center;'></td>"
        }

        return rs;
    }

    function approve(rid) {
        var confirmApprove = confirm("Bạn có chắc chắn Duyệt không?");
        if (confirmApprove != true) {
            return false;
        }
        document.getElementById(rid + "_action").outerHTML = updateAction("sending", rid, 'Bank1');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank1'
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                //$('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve2(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax2') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank2'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank2');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve3(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax3') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank3'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank3');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve4(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax4') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank4'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank4');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve5(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax5') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank5'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank5');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve6(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax6') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank6'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank6');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve7(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax7') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank7'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank7');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve8(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax8') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank8'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank8');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve9(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax9') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank9'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank9');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approve10(rid) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax10') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'sending',
                user: 'Bank10'
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("sending");
                    document.getElementById(rid + "_action").html = updateAction("sending", rid, 'Bank10');
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function approveTay(rid) {
        var confirmApprove = confirm("Bạn có chắc chắn Duyệt tay không?");
        if (confirmApprove != true) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatetranajax') ?>",
            data: {
                transId: rid,
                type: 105,
                status: 'success',
                user: 'DUYET_TAY'

            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (result != "") {
                    document.getElementById(rid + "_status").innerHTML = getStatusText("success");
                    document.getElementById(rid + "_action").innerHTML = "";
                    document.getElementById(rid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("Duyệt thất bại")
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 20000
        })
    }

    function getStatusText(status) {
        switch (status) {
            case 'pending':
                return "<span class='label label-warning'>Chờ xử lý</span>";
            case 'success':
                return "<span class='label label-success'>Thành công</span>";
            case 'sending':
                return "<span class=\"label label-primary\">Cổng đang xử lý</span>";
            case 'reject':
                return "<span class=\"label label-danger\">Từ chối</span>";
            case 'outofmoney':
                return "<span class=\"label label-danger\">Cổng hết tiền</span>";
            case 'error':
                return "<span class=\"label label-default\">Thất bại </span>";
            default:
                return "Không xác định";
        }
    }

    function getlist() {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();

        var fromDatetime = moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD 00:00:00');
        var toDatetime = moment($("#toDate").val(), 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/cashoutbybankajax') ?>",
            data: {
                nickname: $("#filter_iname").val(),
                bank: $("#select_bank").val(),
                status: $("#select_status").val(),
                toDate: toDatetime,
                fromDate: fromDatetime,
                pages: 1,
                maxItem: $("#max_item").val(),
                tranid: $("#magiaodich").val(),
                bankNumber: $("#bankNumber").val()
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
                            stt, value.Id, value.Username, value.BankName, value.BankAccountNumber, value.BankAccountName, value.Amount, value.Status, "", value.CreatedAt, value.UserProve, value.UpdatedAt
                        );
                        stt++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function(event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();

                                var fromDatetime = moment($("#fromDate").val(), 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
                                var toDatetime = moment($("#toDate").val(), 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/cashoutbybankajax') ?>",
                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        bank: $("#select_bank").val(),
                                        status: $("#select_status").val(),
                                        toDate: toDatetime,
                                        fromDate: fromDatetime,
                                        pages: page,
                                        maxItem: $("#max_item").val(),
                                        tranid: $("#magiaodich").val(),
                                        bankNumber: $("#bankNumber").val()
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
                                                    stt, value.Id, value.Username, value.BankName, value.BankAccountNumber, value.BankAccountName, value.Amount, value.Status, "", value.CreatedAt, value.UserProve, value.UpdatedAt
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
    }

    $(document).ready(function() {
        getlist();
        $("#exportexel").click(function(e) {
            $("#checkAll").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "ListCashoutBank",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });

    // window.addEventListener('Event_cashoutbybank', function (e) {
    //     setTimeout(function(){
    //         window.location.href = "";
    //     }, 2000);
    // }, false);

    // Let us open a web socket
    var ex = [];
    ex.push(function() {
        var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbybank"); // ket noi ws server
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
                    $('#checkAll > tbody').append(resultSearchTransction(icon, value.Id, value.Username, value.BankName, value.BankAccountNumber, value.BankAccountName, value.Amount, value.Status, "", value.CreatedAt, value.UserProve, value.UpdatedAt));
                } else {
                    var row = $('#' + value.Id + '_row');
                    if (row.length === 0) {
                        $('#checkAll > tbody > tr:first').before(resultSearchTransction(icon, value.Id, value.Username, value.BankName, value.BankAccountNumber, value.BankAccountName, value.Amount, value.Status, "", value.CreatedAt, value.UserProve, value.UpdatedAt));
                    } else {
                        row[0].outerHTML = resultSearchTransction(icon, value.Id, value.Username, value.BankName, value.BankAccountNumber, value.BankAccountName, value.Amount, value.Status, "", value.CreatedAt, value.UserProve, value.UpdatedAt);
                    }
                }
            }
        };
        return itemSocket;
    }());

    ex.push(function() {
        var itemSocket = new WebSocket("<?php echo web_socket() ?>eventaction"); // ket noi ws server
        itemSocket.onopen = function(event) {
            // itemSocket.send('This is a test 2');
        };
        itemSocket.onmessage = function(evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if ("2" === (res["code"])) {
                let value = res.reportResponses;
                if (value.Type == "CASH_OUT_BANK") {
                    if (value.Status == 100) {
                        var status = "success";
                    } else if (value.Status == 102) {
                        var status = "sending";
                    } else if (value.Status == 3) {
                        var status = "outofmoney";
                    } else {
                        var status = "reject";
                    }
                    document.getElementById(value.Id + "_status").innerHTML = getStatusText(status);
                    document.getElementById(value.Id + "_action").innerHTML = "";
                    document.getElementById(value.Id + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                    // update number notify
                    var count6 = getCookie("count6");
                    count6 = (Number(count6) - 1) > 0 ? (Number(count6) - 1) : 0
                    setCookie("count6", count6, 1);
                    document.getElementById('notification6').setAttribute('data-count', count6);

                    getNotify();
                }
            }
        };
        return itemSocket;
    }());

    // if($("#auto_reload").val() == 'auto') {
    // 	setInterval(function () {
    // 	  window.location.href = "";
    // 	}, 60000);
    // }
</script>
<script>
    function commaSeparateNumber(val) {
        if (val !== undefined) {
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
            }
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