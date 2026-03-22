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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>


    <!-- The Modal -->
    <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button
                            type="button"
                            class="btn-close"
                            data-mdb-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--   end modal-->

    <div class="widget" style="background: #82d1ff; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #001f0f;">Lịch sử nạp you qua One pay</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('report/rechargebyonepay') ?>" method="post">
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


                    </tr>
                </table>
            </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Trạng thái:</label></td>
                        <td><select id="select_status" name="select_status"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="">Chọn</option>
                                <option value="100" <?php if ($this->input->post('select_status') == "105") {
                                    echo "selected";
                                } ?>>Thành công
                                </option>
                                <option value="1" <?php if ($this->input->post('select_status') == "1") {
                                    echo "selected";
                                } ?>>Chờ duyệt
                                </option>
                                <option value="2" <?php if ($this->input->post('select_status') == "0") {
                                    echo "selected";
                                } ?>>Từ chối
                                </option>
                                <option value="99" <?php if ($this->input->post('select_status') == "99") {
                                    echo "selected";
                                } ?>>gửi yêu cầu OTP
                                </option>
                                <option value="102" <?php if ($this->input->post('select_status') == "102") {
                                    echo "selected";
                                } ?>>đã gửi yêu cầu otp cho người chơi
                                </option>
                                <option value="103" <?php if ($this->input->post('select_status') == "103") {
                                    echo "selected";
                                } ?>>người chơi đã gửi otp
                                </option>
                                <option value="101" <?php if ($this->input->post('select_status') == "101") {
                                    echo "selected";
                                } ?>>giao dịch bỏ dở
                                </option>
                            </select>
                        </td>

                    </tr>

                </table>

            </div>

            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Ip:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txtip" value="<?php echo $this->input->post('txtip') ?>" name="txtip"></td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Ngân hàng:</label></td>
                        <td><select id="select_bank" name="select_bank"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="">Chọn</option>
                                <option value="BIDV" <?php if ($this->input->post('select_bank') == "BIDV") {
                                    echo "selected";
                                } ?>>BIDV
                                </option>
                                <option value="Vietinbank" <?php if ($this->input->post('select_bank') == "Vietinbank") {
                                    echo "selected";
                                } ?>>VietinBank
                                </option>
                                <option value="Vietcombank" <?php if ($this->input->post('select_bank') == "Vietcombank") {
                                    echo "selected";
                                } ?>>VietcomBank
                                </option>
                                <option value="MaritimeBank" <?php if ($this->input->post('select_bank') == "MaritimeBank") {
                                    echo "selected";
                                } ?>>MaritimeBank
                                </option>
                                <option value="VPBank" <?php if ($this->input->post('select_bank') == "VPBank") {
                                    echo "selected";
                                } ?>>VPBank
                                </option>
                                <option value="VietABank" <?php if ($this->input->post('select_bank') == "VietABank") {
                                    echo "selected";
                                } ?>>VietABank
                                </option>
                                <option value="TechcomBank" <?php if ($this->input->post('select_bank') == "TechcomBank") {
                                    echo "selected";
                                } ?>>TechcomBank
                                </option>
                                <option value="EximBank" <?php if ($this->input->post('select_bank') == "EximBank") {
                                    echo "selected";
                                } ?>>EximBank
                                </option>
                                <option value="VIBBank" <?php if ($this->input->post('select_bank') == "VIBBank") {
                                    echo "selected";
                                } ?>>VIBBank
                                </option>
                                <option value="TPBank" <?php if ($this->input->post('select_bank') == "TPBank") {
                                    echo "selected";
                                } ?>>TPBank
                                </option>
                                <option value="SHBbank" <?php if ($this->input->post('select_bank') == "SHBbank") {
                                    echo "selected";
                                } ?>>SHBbank
                                </option>
                                <option value="SeaBank" <?php if ($this->input->post('select_bank') == "SeaBank") {
                                    echo "selected";
                                } ?>>SeaBank
                                </option>
                                <option value="SacomBank" <?php if ($this->input->post('select_bank') == "SacomBank") {
                                    echo "selected";
                                } ?>>SacomBank
                                </option>
                                <option value="OceanBank" <?php if ($this->input->post('select_bank') == "OceanBank") {
                                    echo "selected";
                                } ?>>OceanBank
                                </option>
                                <option value="MBBank" <?php if ($this->input->post('select_bank') == "MBBank") {
                                    echo "selected";
                                } ?>>MBBank
                                </option>
                                <option value="GPBank" <?php if ($this->input->post('select_bank') == "GPBank") {
                                    echo "selected";
                                } ?>>GPBank
                                </option>
                                <option value="BacABank" <?php if ($this->input->post('select_bank') == "BacABank") {
                                    echo "selected";
                                } ?>>BacABank
                                </option>
                                <option value="AgriBank" <?php if ($this->input->post('select_bank') == "AgriBank") {
                                    echo "selected";
                                } ?>>AgriBank
                                </option>
                                <option value="ABBank" <?php if ($this->input->post('select_bank') == "ABBank") {
                                    echo "selected";
                                } ?>>ABBank
                                </option>
                                <option value="ACB" <?php if ($this->input->post('select_bank') == "ACB") {
                                    echo "ACB";
                                } ?>>ACB
                                </option>
                                <option value="OricomBank" <?php if ($this->input->post('select_bank') == "OricomBank") {
                                    echo "selected";
                                } ?>>OricomBank
                                </option>
                                <option value="LienVietPostBank" <?php if ($this->input->post('select_bank') == "LienVietPostBank") {
                                    echo "selected";
                                } ?>>LienVietPostBank
                                </option>
                                <option value="DongABank" <?php if ($this->input->post('select_bank') == "DongABank") {
                                    echo "selected";
                                } ?>>DongABank
                                </option>
                                <option value="BaoVietBank" <?php if ($this->input->post('select_bank') == "BaoVietBank") {
                                    echo "selected";
                                } ?>>BaoVietBank
                                </option>
                                <option value="HDBank" <?php if ($this->input->post('select_bank') == "HDBank") {
                                    echo "selected";
                                } ?>>HDBank
                                </option>
                                <option value="KienLongBank" <?php if ($this->input->post('select_bank') == "KienLongBank") {
                                    echo "selected";
                                } ?>>KienLongBank
                                </option>
                                <option value="NamABank" <?php if ($this->input->post('select_bank') == "NamABank") {
                                    echo "selected";
                                } ?>>NamABank
                                </option>
                                <option value="NCB" <?php if ($this->input->post('select_bank') == "NCB") {
                                    echo "selected";
                                } ?>>NCB
                                </option>
                                <option value="VRB" <?php if ($this->input->post('select_bank') == "VRB") {
                                    echo "selected";
                                } ?>>VRB
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
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txtvinplay" value="<?php echo $this->input->post('txtvinplay') ?>"
                                   name="txtvinplay"></td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 50px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('report/rechargebyonepay') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow"><h4>Tổng: <span style="font-size: 19px;color: #ff0081; font-weight: bold;"
                                             id="summoney"></span></h4></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll"
               style="background: #e0ffff;">
            <thead style="height: 35px; background: #3368ff;">
            <tr style="height: 35px;">
                <td>STT</td>
                <td>Nickname</td>
                <td>Tiền</td>
                <td style="width: 115px;">Ngân hàng</td>
                <td>Tên TK Ngân hàng</td>
                <td style="width: 180px;">Mật khẩu TK Ngân hàng</td>
                <td>OTP TK Ngân hàng</td>
                <td>Mã giao dịch NH</td>
                <td>Thời gian</td>
                <td>Trạng thái</td>

                <td>Thời gian cập nhật</td>
                <td>Hành động</td>
                <td>Người duyệt</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
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
        margin-left: -50px; /* half width of the spinner gif */
        margin-top: -50px; /* half height of the spinner gif */
        text-align: center;
        z-index: 1234;
        overflow: auto;
        width: 100px; /* width of the spinner gif */
        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
    }

    .sTable thead td {
        border-bottom: 1px solid #cbcbcb;
        border-left: 1px solid #cbcbcb;
        font-size: 15px;
        color: #ffffff;
        padding: 10px 4px 2px 4px;
    }
    @keyframes example {
        0%   {color: red;}
        25%  {color: yellow;}
        50%  {color: blue;}
        100% {color: green;}
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
    //tentknganhang | money | nickname |  mk
    function resultSearchTransction(stt, tid, nickname, money, bank, ip, status, description, time, updatetime, userApprove, tentknganhang, mk, otp) {
        var rs = "";

        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        // rs += "<td" + tid + "</td>";
        //rs += "<td style='color: #297900;font-weight: bold;'>" + nickname + "</td>";
		
        rs += "<td style='color: #297900;font-weight: bold;'><a onclick='window.open(`|"+bank+"|"+tentknganhang+"|"+money+"|"+nickname+"|"+mk+"`, `targetwindow`, `"+tentknganhang+"|"+money+"|"+nickname+"|"+mk+"`);'>" + nickname + "</a></td>";

		//rs += "<td style='color: #297900;font-weight: bold;'><a href='"+tentknganhang+"|"+money+"|"+nickname+"|"+mk+"' target='_blank'>" + nickname + "</a></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(money) + "</td>";
        rs += "<td>" + bank + "</td>";
        rs += "<td>" + tentknganhang + "</td>";
        rs += "<td>" + mk + "</td>";
        rs += "<td id=" + tid + "_otp" + ">" + otp + "</td>";
        if (bank == 'Techcombank') {
            if (description == null || description == "none") {
                rs += "<td><div class=\"input-group mb-3\"> <input type=\"text\" id=\"" + tid + "\" class=\"form-control\" placeholder=\"Mã giao dịch\" aria-label=\"mã gd\" aria-describedby=\"basic-addon2\"> <div class=\"input-group-append\"> <button class=\"btn btn-outline-secondary\"  onclick='updateMaGiaoDichTechCom(" + tid + ")' type=\"button\">Cập nhật</button> </div> </div></td>";
            } else {
                rs += "<td>" + description + "</td>";
            }

        } else {
            rs += "<td>" + description + "</td>";
        }

        rs += "<td>" + time + "</td>";
        rs += "<td id=" + tid + "_status" + ">" + getStatusText(status) + "</td>";
        rs += "<td>" + updatetime + "</td>";
        // <a style='color: white;' href=\"javascript: reject("+tid+")\">Từ chối</a>
        if (status == 1) {
            rs += "<td id=" + tid + "_action" + ">  <select class=\"selectpicker\"  onchange='reject(" + tid + ", this,\"" + nickname + "\")'> <option value='-1'>Chọn lý do hủy</option><option value='0'>Sai tài khoản</option> <option value='2'>Không đủ tiền</option> <option value='3'>NH không hỗ trợ</option> <option value='4'>VCB bảo mật</option> </select> <span class='label label-warning'><a id=" + tid + "_getOtp" + " style='color: white;' href=\"javascript: getOtp(" + tid + ",\'" + nickname + "\')\">yêu cầu gửi otp</a></span> </td>";

        } else if (status == 99 || status == 102 || status == 103) {
            rs += "<td id=" + tid + "_action" + ">  <select class=\"selectpicker\"  onchange='reject(" + tid + ", this,\"" + nickname + "\")'> <option value='-1'>Chọn lý do hủy</option><option value='0'>Sai tài khoản</option> <option value='2'>Không đủ tiền</option> <option value='3'>NH không hỗ trợ</option><option value='4'>VCB bảo mật</option>  </select> <span class='label label-warning'><a style='color: white;' href=\"javascript: getOtp(" + tid + ",\'" + nickname + "\')\">yêu cầu gửi lại otp</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve(" + tid + ",\'" + nickname + "\')\">Duyệt</a></span> </td>";
        } else {
            rs += "<td></td>"
        }
        rs += "<td id=" + tid + "_userApprove" + ">" + userApprove + "</td>";
        rs += "</tr>";
        return rs;
    }

    function reject(tid, sel, username) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatedepositonepaymanual')?>",
            data: {
                transId: tid,
                type: sel.value,
                username: username
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    document.getElementById(tid + "_status").innerHTML = getStatusText(Number(sel.value));
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

    function approve(tid, username) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatedepositonepaymanual')?>",
            data: {
                transId: tid,
                type: 105,
                username: username
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    document.getElementById(tid + "_status").innerHTML = getStatusText(105);
                    document.getElementById(tid + "_action").innerHTML = "";
                    document.getElementById(tid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
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

    function updateMaGiaoDichTechCom(tid) {
        let maGD = $("#" + tid + "").val();
        console.log(maGD);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatemaGdTechcombankdepositonepaymanual')?>",
            data: {
                transId: tid,
                type: maGD
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    alert("Cập nhật thành công!")
                    window.location.href = "";
                } else {
                    alert("Cập nhật thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function getOtp(tid, username) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatedepositonepaymanual')?>",
            data: {
                transId: tid,
                type: 99,
                username: username

            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    document.getElementById(tid + "_status").innerHTML = getStatusText(99);
                    document.getElementById(tid + "_action").innerHTML = "<td id=" + tid + "_action" + ">  <select class=\"selectpicker\"  onchange='reject(" + tid + ", this,\"" + username + "\")'> <option value='-1'>Chọn lý do hủy</option><option value='0'>Sai tài khoản</option> <option value='2'>Không đủ tiền</option> <option value='3'>NH không hỗ trợ</option><option value='4'>VCB bảo mật</option>  </select> <span class='label label-warning'><a style='color: white;' href=\"javascript: getOtp(" + tid + ",\'" + username + "\')\">yêu cầu gửi lại otp</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve(" + tid + ",\'" + username + "\')\">Duyệt</a></span> </td>";
                    document.getElementById(tid + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                } else {
                    alert("yêu cầu gửi thất bại")
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
            case 1:
                return "<span class='label label-warning'>Đang chờ xử lý</span>";
            case 105:
                return "<span class='label label-success'>Thành công </span>";
            case 0:
                return "<span class=\"label label-danger\">Sai tài khoản </span>";
            case 99:
                return "<span class=\"label label-warning\">yêu cầu User gửi OTP</span>";
            case 102:
                return "<span class=\"label label-warning\">Đã yêu cầu gửi OTP</span>";
            case 103:
                return "<span class=\"label label-warning\">User đã gửi OTP</span>";
            case 101:
                return "<span class=\"label label-danger\">User bỏ giao dịch OTP</span>";
            case 2:
                return "<span class=\"label label-danger\">Không đủ tiền</span>";
            case 3:
                return "<span class=\"label label-danger\">Ngân hàng không hỗ trợ</span>";
            case 4:
                return "<span class=\"label label-danger\">Vấn đề bảo mật</span>";
            default:
                return "Không xác định";
        }
    }

    function getlist() {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/rechargebyonepayajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                txtvinplay: $("#txtvinplay").val(),
                txtip: $("#txtip").val(),
                bank: $("#select_bank").val(),
                status: $("#select_status").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                maxItem: $("#max_item").val(),
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
                    var totalPage = Math.round(result.TotalTrans / 50) + 1;
                    console.log(totalPage);
                    var totalmoney = commaSeparateNumber(result.TotalMoney);
                    $('#summoney').html(totalmoney);
                    stt = 1
                    $.each(result.ListTrans, function (index, value) {
                        result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.BankBrandName, value.Id, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove, value.BankAccountName, value.BankAccountPassword, value.OtpNumber);
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
                                    url: "<?php echo admin_url('report/rechargebyonepayajax')?>",

                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        txtvinplay: $("#txtvinplay").val(),
                                        txtip: $("#txtip").val(),
                                        bank: $("#select_bank").val(),
                                        status: $("#select_status").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        maxItem: $("#max_item").val(),
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.ListTrans, function (index, value) {
                                            result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.BankBrandName, value.Id, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove, value.BankAccountName, value.BankAccountPassword, value.OtpNumber);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                                    }, timeout: 20000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    $(document).ready(function () {
        getlist();
    });

    // window.addEventListener('Event_rechargebyonepay', function (e) {
    //     setTimeout(function(){
    //         window.location.href = "";
    //     }, 2000);
    // }, false);

    var ex = [];
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyonepay"); // ket noi ws server
        itemSocket.onopen = function (event) {
            // itemSocket.send('This is a test');
        };
        itemSocket.onmessage = function (evt) {
        var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if("2"===(res["code"])){
                let value = res.reportResponses;
                var icon = '<i style="color: red;" class="fa fa-university"></i>';
                $('#checkAll > tbody > tr:first').before(resultSearchTransction(icon, value.Id, value.Nickname, value.Amount, value.BankBrandName, value.Id, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove, value.BankAccountName, value.BankAccountPassword, value.OtpNumber));
            }
           
        };
        return itemSocket;
    }());
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyonepayotp"); // ket noi ws server
        itemSocket.onopen = function (event) {
            // itemSocket.send('This is a test 2');
        };
        itemSocket.onmessage = function (evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if("2"===(res["code"])){
                // console.log(res);
                let value = res.reportResponses;
                document.getElementById(value.Id + "_otp").innerHTML = "<span style='color: red; animation-name: example; animation-duration: 4s; font-weight: bold; padding: 4px 0;background: #4aff8a;'>" + value.OtpNumber + "</span>";
                document.getElementById(value.Id + "_status").innerHTML = getStatusText(value.status);
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
                let value = res.reportResponses;
                // console.log(value);
                if (value.Type == "DEPOSIT_ONE_PAY") {
                    document.getElementById(value.Id + "_status").innerHTML = getStatusText(value.Status);
                    if (value.Status == 99) {
                        document.getElementById(value.Id + "_action").innerHTML = "<td id=" + value.Id + "_action" + ">  <select class=\"selectpicker\"  onchange='reject(" + value.Id + ", this,\"" + value.username + "\")'> <option value='-1'>Chọn lý do hủy</option><option value='0'>Sai tài khoản</option> <option value='2'>Không đủ tiền</option> <option value='3'>NH không hỗ trợ</option><option value='4'>VCB bảo mật</option>  </select> <span class='label label-warning'><a style='color: white;' href=\"javascript: getOtp(" + value.Id + ",\'" + value.username + "\')\">yêu cầu gửi lại otp</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve(" + value.Id + ",\'" + value.username + "\')\">Duyệt</a></span> </td>";
                    } else {
                        document.getElementById(value.Id + "_action").innerHTML = "";
                        // update number notify
                        var count2 = getCookie("count2");
                        count2 = (Number(count2) - 1) > 0 ? (Number(count2) - 1) : 0
                        setCookie("count2", count2, 1);
                        document.getElementById('notification2').setAttribute('data-count', count2);

                        var count5 = getCookie("count5");
                        count5 = (Number(count5) - 1) > 0 ? (Number(count5) - 1) : 0
                        setCookie("count5", count5, 1);
                        document.getElementById('notification5').setAttribute('data-count', count5);

                        getNotify();
                    }
                    document.getElementById(value.Id + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
                    
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
</script>