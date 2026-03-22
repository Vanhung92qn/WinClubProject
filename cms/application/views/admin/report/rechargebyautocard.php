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
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #82d1ff; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #001f0f;">Lịch sử nạp You auto thẻ</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('report/rechargebyautocard') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon">
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
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Trạng thái:</label></td>
                        <td><select id="select_status" name="select_status"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="">Chọn</option>
                                <option value="100" <?php if($this->input->post('select_status') == "100" ){echo "selected";} ?>>Thành công</option>
                                <option value="1" <?php if($this->input->post('select_status') == "1" ){echo "selected";} ?>>Chờ duyệt</option>
                                <option value="2" <?php if($this->input->post('select_status') == "2" ){echo "selected";} ?>>Từ chối</option>
                            </select>
                        </td>

                    </tr>

                </table>

            </div>

            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nhà mạng:</label></td>
                        <td><select id="sendFrom" name="sendFrom"
                                   style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                            <option value="">Chọn</option>
                            <option value="VT"   <?php if($this->input->post('sendFrom') == "VT" ){echo "selected";} ?>>Viettel</option>
                            <option value="Mobi"  <?php if($this->input->post('sendFrom') == "Mobi" ){echo "selected";} ?>>Mobi</option>
                            <option value="Vina"   <?php if($this->input->post('sendFrom') == "Vina" ){echo "selected";} ?>>Vina</option>
                        </select>
                        </td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Số bản ghi:</label></td>
                        <td><select id="max_item" name="max_item" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </td>
<!--                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                                   id="sendFrom"  value="--><?php //echo $this->input->post('sendFrom') ?><!--" name="sendFrom"></td>-->

                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txtvinplay" value="<?php echo $this->input->post('txtvinplay') ?>" name="txtvinplay"></td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 50px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('report/rechargebyautocard') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow"> <h4>Tổng:      <span style="font-size: 19px;color: #ff0081; font-weight: bold;" id="summoney"></span></h4></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll" style="background: #e0ffff;">
            <thead style="height: 35px; background: #3368ff;">
            <tr style="height: 35px;">
                <td>STT</td>
                <td>Nickname</td>
                <td>Tiền</td>
                <td>SĐT nhận</td>

                <td>Gửi từ</td>

                <td>Mã giao dịch</td>
                <td>Thời gian</td>
                <td>Trạng thái</td>
                <td>Mô tả</td>
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
    td{
        word-break: break-all;
    }
    thead{
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
    function resultSearchTransction(stt,tid, nickname, money, pin, seri,ip, status,description,time,updatetime, userApprove) {
        var rs = "";

        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + nickname + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(money) + "</td>";
        rs += "<td>" + seri + "</td>";
        rs += "<td>" + pin + "</td>";

        rs += "<td>" + tid + "</td>";
        rs += "<td>" + time + "</td>";
        rs += "<td  id=" + tid + "_status" + ">" + getStatusText(status) + "</td>";
        rs += "<td>" + description + "</td>";
        rs += "<td>" + updatetime + "</td>";
        if(status == 1){
            // sai // rs += "<td>  <span class='label label-danger'><a style='color: white;' href=\"javascript: reject("+tid+")\">Từ chối</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve("+tid+")\">Duyệt</a></span> </td>";

            rs += "<td id=" + tid + "_action" + " style='display: flex;justify-content: center;align-items: center;'><span class='label label-danger' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: reject(" + "`" + tid + "`" + ")\">Từ chối</a></span><span class='label label-success' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: approve(" + "`" + tid + "`" + ")\">Duyệt</a></span> </td>";

        }else{
            rs += "<td></td>"
        }
        rs += "<td id=" + tid + "_userApprove" + ">" + userApprove + "</td>";
        rs += "</tr>";
        return rs;
    }
    function reject(tid){
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatedepositautoCard')?>",
            data: {
                transId: tid,
                type: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result.success){
                    //alert("Từ chối thành công!");
                    //window.location.href = "";
                    document.getElementById(tid + "_status").innerHTML = getStatusText(2);
                    document.getElementById(tid + "_action").innerHTML = "";
                    document.getElementById(tid + "_userApprove").innerHTML = "Chính Tôi";
                }else{
                    alert("Từ chối thất bại!")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },timeout : 20000
        })
    }
    function approve(tid){
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/updatedepositautoCard')?>",
            data: {
                transId: tid,
                type: 0
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result.success){
                    //alert("Duyệt thành công!")
                    //window.location.href = "";
                    document.getElementById(tid + "_status").innerHTML = getStatusText(100);
                    document.getElementById(tid + "_action").innerHTML = "";
                    document.getElementById(tid + "_userApprove").innerHTML = "Chính Tôi";
                }else{
                    alert("Duyệt thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },timeout : 20000
        })
    }
    function getStatusText(status){
        switch(status){
            case 1:
                return "<span class='label label-warning'>Đang chờ xử lý</span>";
            case 100:
                return "<span class='label label-success'>Thành công </span>";
            case 2:
                return "<span class=\"label label-danger\">Từ chối </span>";
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
            url: "<?php echo admin_url('report/rechargebyautocardajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                txtvinplay: $("#txtvinplay").val(),
                sendFrom: $("#sendFrom").val(),
                bank: $("#select_bank").val(),
                status:  $("#select_status").val(),
                toDate:   $("#toDate").val(),
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
                        result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.pin, value.seri, value.provider, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove);
                        stt++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage>0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/rechargebyautocardajax')?>",

                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        txtvinplay: $("#txtvinplay").val(),
                                        sendFrom: $("#sendFrom").val(),
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
                                            result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.pin, value.seri, value.provider, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                                    },timeout : 20000
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
            },timeout : 20000
        })
    }

    $(document).ready(function () {
        getlist();
    });

    // window.addEventListener('Event_rechargebyautocard', function (e) {
    //     setTimeout(function(){
    //         window.location.href = "";
    //     }, 2000);
    // }, false);

    var ex = [];
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyautocard"); // ket noi ws server
        itemSocket.onopen = function (event) {
            
        };
        itemSocket.onmessage = function (evt) {
        var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if("2"===(res["code"])){
                let value = res.reportResponses;
                var icon = '<i style="color: red;" class="fa fa-university"></i>';
                $('#checkAll > tbody > tr:first').before(resultSearchTransction(icon, value.Id, value.Nickname, value.Amount, value.pin, value.seri, value.provider, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove));
            }
           
        };
        return itemSocket;
    }());
    // ex.push(function(){
    //     var itemSocket = new WebSocket("<?php // echo web_socket() ?>eventaction"); // ket noi ws server
    //     itemSocket.onopen = function (event) {
    //         // itemSocket.send('This is a test 2');
    //     };
    //     itemSocket.onmessage = function (evt) {
    //         var received_msg = evt.data;
    //         var res = JSON.parse(received_msg);
    //         if("2"===(res["code"])){
    //             let value = res.reportResponses;
    //             if (value.Type == "DEPOSIT_AUTO_CARD") {
    //                 var status = value.Status == 100 ? "success" : "reject";
    //                 document.getElementById(value.Id + "_status").innerHTML = getStatusText(status);
    //                 document.getElementById(value.Id + "_action").innerHTML = "";
    //                 document.getElementById(value.Id + "_userApprove").innerHTML = document.getElementById("adminUserName").textContent;
    //             }
    //         }
    //     };
    //     return itemSocket;
    // }());

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