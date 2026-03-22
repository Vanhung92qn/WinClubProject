<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<style>
    .table-result-lottery {
        border-right: none
    }

    .table-result-lottery td.prize {
        width: 70px
    }

    .table-result-lottery td {
        text-align: center !important;
        padding: 0px !important
    }

    .table-result-lottery td.results span {
        display: inline-block;
        padding-top: 8px;
        padding-bottom: 8px;
        border-right: 1px solid #cccccc;
        font-size: 22px;
        font-weight: bold
    }

    .table-result-lottery td.results span[data-prize="1"] {
        color: #c63c2c
    }

    .table-result-lottery td.results span[data-prize="9"] {
        color: #c63c2c
    }

    .table-result-lottery td.results span.special-prize {
        color: #c63c2c
    }

    .table-result-lottery td.results span.wrap-text {
        white-space: initial
    }

    .table-result-lottery td.results .quantity-of-number {
        display: grid
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="1"] {
        grid-template-columns: minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="2"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="6"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="3"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="4"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="7"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="9"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    @media only screen and (max-width: 991px) {
        .table-result-lottery td.results span {
            font-size: 15px
        }
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }
    table.tbldata {
        border-collapse: collapse;
        color: #000000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px
    }

    table.tbldata tbody tr:hover {
        background: #ffffcf none repeat scroll 0 0
    }

    .tbldata {
        background: #fff none repeat scroll 0 0;
        border-right: 1px solid #cccccc;
        border-top: 1px solid #dedede;
        margin: 0 0 0px;
        width: 100%
    }

    .tbldata th {
        background-color: #e6e6e6;
        border-left: 1px solid #cccccc;
        color: #000000;
        font-weight: bold;
        padding: 8px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 1px solid #dedede
    }

    .tbldata tbody tr.odd {
        background-color: #f5f5f5
    }

    .tbldata tr.center {
        padding: 15px;
        width: 5px
    }

    .tbldata tr td {
        border-left: 1px solid #cccccc;
        color: #000000;
        padding: 8px 8px;
        text-align: left;
        vertical-align: middle;
        cursor: pointer
    }

    .tbldata tr .center {
        padding: 10px;
        width: 5px
    }

    .tbldata tr.active {
        background-color: #ffffcf
    }

    .tbldata tr.unCompleted td {
        color: #c63c2c
    }

    .tbldata thead th {
        border-left: 1px solid #cccccc;
        color: #fff;
        vertical-align: middle;
        background-color: #919696;
        font-weight: bold;
        font-size: 15px;
        padding: 10px 6px;
        white-space: nowrap;
        position: relative;
        text-align: center;
        z-index: 9
    }

    .tbldata thead th[sort=true] {
        cursor: pointer;
        padding-right: 22px
    }

    .tbldata thead td {
        background-color: #000;
        font-weight: bold;
        padding: 10px 6px;
        text-align: center
    }

    .tbldata thead th.header {
        font-weight: bold;
        padding: 6px;
        text-align: left
    }

    .tbldata td {
        border-bottom: 1px solid #cccccc;
        white-space: nowrap
    }

    .tbldata input {
        margin: 5px;
        padding: 5px;
    }

    .tbldata tr td {
        border-left: 1px solid #cccccc;
        color: #000000;
        padding: 8px 8px;
        text-align: left;
        vertical-align: middle;
        cursor: pointer
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="1"] {
        grid-template-columns: minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="2"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="6"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="3"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="4"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="7"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    .table-result-lottery td.results .quantity-of-number[data-quantity="9"] {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr)
    }

    @media only screen and (max-width: 991px) {
        .table-result-lottery td.results span {
            font-size: 15px
        }
    }
    .prize{
        font-weight: bold;
    }
    tr .item{
        font-weight: bold;
    }

</style>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"  media="screen" />
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6>Cập nhật kết quả lô đề theo từng nhà đài</h6>
        </div>
        <form class="list_filter form" >
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">phiên :</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="phien" name="phien" value="<?php echo $start_time ?>"> <span class="input-group-addon">
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
                        <td class="item" style="">
                            <input type="button" id="search_tran" value="Tính toán giải" class="button blueB"
                                   style="margin-left: 50px">
                        </td>
                        <td class="item">
                            <input type="button"
                                    id="tra_giai"
                                   value="Trả giải cho người chơi" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow"> <h5>Tổng:      <span style="color: #7a6fbe" id="summoney"></span></h5></div>
        <table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered" width="100%" cellspacing="0" id="example">
            <thead>
            <tr style="height: 20px;">
                <td>STT</td>
                <td>Nickname</td>
                <td>Phiên</td>
                <td>Game mod</td>
                <td>Số đặt</td>
                <td>Nhà đài</td>
                <td>Số tiền đặt cược</td>
                <td>payrate</td>
                <td>Số tiền thắng giải</td>
                <td>thời gian đặt cược</td>
                <td>Trả thường (0 :chưa /1 :đã trả)</td>
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
    }</style>
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
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });

    $("#tra_giai").click(function () {


        var phien = $("#phien").val();
        var date = phien.split("-");
        var sessionLoto = date[0]+date[1]+date[2];
        console.log(sessionLoto);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loto/tragiaiketquaAjax')?>",
            data :{
                msession :parseInt(sessionLoto)
            },
            dataType: 'json',
            success: function(result) {
                alert("Trả gải thành công !");
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('loto/tinhtoanhketquaAjax')?>",
                    data :{
                        msession :sessionLoto
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#spinner").hide();

                        if (result.ListTrans == "") {
                            $('#pagination-demo').css("display", "none");
                            $("#resultsearch").html("Không tìm thấy kết quả");
                        } else {
                            $('#example').DataTable({
                                destroy: true,
                                searching: true,
                                data: parsingData(result.ListTrans),
                                columns: [
                                    { data: 'id' },
                                    { data: 'username' },
                                    { data: 'session' },
                                    { data: 'gameMode' },
                                    { data: 'number' },
                                    { data: 'channel' },
                                    { data: 'pay' },
                                    { data: 'payRate' },
                                    { data: 'win' },
                                    { data: 'timePlay' },
                                    { data: 'status' }
                                ],
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


            },
            error: function() {
                alert("Trả thưởng lỗi , vui lòng liên hệ IT");
            },
            timeout: 20000
        })

    })


    $("#search_tran").click(function () {
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        var phien = $("#phien").val();
        var date = phien.split("-");
        var sessionLoto = date[0]+date[1]+date[2];
        console.log(sessionLoto);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loto/tinhtoanhketquaAjax')?>",
            data :{
                msession :sessionLoto
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();

                if (result.ListTrans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $('#example').DataTable({
                        destroy: true,
                        searching: true,
                        data: parsingData(result.ListTrans),
                        columns: [
                            { data: 'id' },
                            { data: 'username' },
                            { data: 'session' },
                            { data: 'gameMode' },
                            { data: 'number' },
                            { data: 'channel' },
                            { data: 'pay' },
                            { data: 'payRate' },
                            { data: 'win' },
                            { data: 'timePlay' },
                            { data: 'status' }
                        ],
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

    $(document).ready( function() {
        var phien = $("#phien").val();
        var date = phien.split("-");
        var sessionLoto = date[0]+date[1]+date[2];
        console.log(sessionLoto);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loto/tinhtoanhketquaAjax')?>",
            data :{
                msession :sessionLoto
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();

                if (result.ListTrans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $('#example').DataTable({
                        destroy: true,
                        searching: true,
                        data: parsingData(result.ListTrans),
                        columns: [
                            { data: 'id' },
                            { data: 'username' },
                            { data: 'session' },
                            { data: 'gameMode' },
                            { data: 'number' },
                            { data: 'channel' },
                            { data: 'pay' },
                            { data: 'payRate' },
                            { data: 'win' },
                            { data: 'timePlay' },
                            { data: 'status' }
                        ],
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




    function parsingData(data){
        if(data==null) return [];

        for( let i = 0 ; i <data.length ;i++){
            console.log(data);
            data[i]["channel"] = getChannelText(data[i]["channel"]);
        }
        return data;
    }

    function getChannelText(nhadai){
        switch(nhadai){
            case 1:
                return "Miền bắc";
            case 4:
                return "Đak lak";
            case 5:
                return "Quảng nam";
            case 19:
                return "Bạc liêu";
            case 21:
                return "Vũng Tàu";
            default:
                return "Không xác định " + nhadai;
        }
    }
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>