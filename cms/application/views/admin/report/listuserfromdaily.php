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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #82d1ff; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #001f0f;">Thống kê tiền nạp và tiền rút của user theo đại lý</h6>
        </div>
        <form class="list_filter form" action="" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Đại lý:</label></td>
                        <td>

                        <!-- <select class="form-control select" id="filter_iname" name="filter_iname" style="border: 2px solid #d77e02; border-radius: 12px;">
                            <option value="">Chọn</option>
                            <?php // foreach ($listdaily as $row): ?>
                                <option value="<?php // echo $row->nickname?>"><?php // echo $row->nickname ?></option>
                            <?php// endforeach; ?>
                        </select> -->

                        <!-- <select id="filter_iname" name="filter_iname">
                            <option value="tklocal123">tklocal123</option>
                            <option value="testdal02">testdal02</option>
                            <option value="testdaily1">testdaily1</option>
                            <option value="phuonganh668">phuonganh668</option>
                        </select> -->

                        <input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name">
                        </td>
                        
                        <td style="">
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 50px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/listuserfromdaily') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" style="background: #e0ffff; margin-top: 15px; margin-bottom: 12px;">
            <thead style="height: 35px; background: #3368ff;">
            <tr>
                <td style="width: 50%;">Tổng Nạp Các User</td>
                <td style="width: 50%;">Tổng Rút Các User</td>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;font-size: 30px; color: #f00; font-weight: bold;"><span id="totalIn"></span></td>
                    <td style="text-align: center;font-size: 30px; color: #f00; font-weight: bold;"><span id="totalOut"></span></td>
                </tr>
            </tbody>
        </table>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll" style="background: #e0ffff;">
            <thead style="height: 35px; background: #3368ff;">
            <tr style="height: 35px;">
                <td>STT</td>
                <td>Nickname</td>
                <td>Tổng Nạp</td>
                <td>Tổng Rút</td>
                <td>Nạp - Rút</td>
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
        searchTrans();
    });

    $('#filter_iname').on('change', function() {
        searchTrans();
    });

    $(document).ready(function () {
        listTranfer();
    });

    function searchTrans(stt, value) {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        listTranfer();
    }

    function resultSearchTransction(stt, value) {
        var rs = "";
        if ((value.TotalInUser + value.totalOutUser) < 0) {
            rs += "<tr style='background: #ffdbdb;'>";
        } else {
            rs += "<tr style='background: #c1ffcf;'>";
        }
        rs += "<td>" + stt + "</td>";
        rs += "<td style='color: #001fff;font-weight: bold;'>" + value.NickName + "</td>";
        rs += "<td style='color: #0028ec;font-weight: bold;'>" + commaSeparateNumber(value.TotalInUser) + "</td>";
        rs += "<td style='color: #530054;font-weight: bold;'>" + commaSeparateNumber(value.totalOutUser) + "</td>";
        rs += "<td style='color: #001fff;font-weight: bold;'>" + commaSeparateNumber(value.TotalInUser + value.totalOutUser) + "</td>";
        rs += "</tr>";
        return rs;
    }


    function listTranfer() {
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/listuserfromdailyajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                codeDaily: renderKeyByNickname($("#filter_iname").val()),
                fromDate: $("#fromDate").val(),
                toDate:   $("#toDate").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                console.log(result);
                if (result.ListUser == "" || result.ListUser == null) {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $('#logaction').html("");
                    $('#totalIn').html("0");
                    $('#totalOut').html("0");
                } else {
                    $("#resultsearch").html("");
                    var totalIn = commaSeparateNumber(result.TotalIn);
                    $('#totalIn').html(totalIn);
                    var totalOut = commaSeparateNumber(result.TotalOut);
                    $('#totalOut').html(totalOut);
                    stt = 1
                    if(result.ListUser == null) return;
                    $.each(result.ListUser, function (index, value) {
                        result += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(result);

                    // var table = $('#checkAll').DataTable({
                    //     "ordering": true,
                    //     "searching": true,
                    //     "paging": false,
                    //     "draw": false
                    // });
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },timeout : 200000
        })
    }



</script>

<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function renderKeyByNickname(nickName) {
        // txt to decimal
        var decimal=[];
        if( nickName.length==0 ) return;
        for(i=0; i<nickName.length; i++) {
            decimal[i] = nickName.charCodeAt(i);
        }

        // decimal to hex
        var hex = '';
        var h;
        var del = ''; // del: {",space, , ,0x}
        var hexprefix = '';
        for(var i = 0; i<decimal.length; i++) {
            h = decimal[i].toString(16);
            if( h.length==1 ) h = '0' + h;
            hex += hexprefix+h.toUpperCase();
            if(i < decimal.length-1) {
                hex+=del;
            }
        }

        // hex to Checksum
        var x=[];
        if( hex.length==0 ) return;
        hex = hex.toUpperCase();
        hex = hex.match(/[0-9|A-F]{2}/g);
        if( !hex ) return;
        var sum=0;
        for(i=0; i<hex.length; i++) {
            x[i] = parseInt(hex[i],16);
            sum+=x[i];
        }
        var size=6;
        var range=65536;
        sum%=range;
        sum = sum.toString(16).toUpperCase();
        sum = "000000000" + sum;
        sum = sum.substr(sum.length-size);
        return sum;
    }
</script>