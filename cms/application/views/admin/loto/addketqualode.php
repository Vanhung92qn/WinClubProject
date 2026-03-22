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
        <form class="list_filter form" action="<?php echo admin_url('loto/addketqualode') ?>" method="post">
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

                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nhà đài:</label></td>
                        <td><select id="select_chanel" name="select_chanel"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="1" <?php if($this->input->post('select_chanel') == "1" ){echo "selected";} ?>>Mien Bac</option>
                                <option value="4" <?php if($this->input->post('select_chanel') == "4" ){echo "selected";} ?>>Dak Lak</option>
                                <option value="5" <?php if($this->input->post('select_chanel') == "5" ){echo "selected";} ?>>Quang Nam</option>
                                <option value="19" <?php if($this->input->post('select_chanel') == "19" ){echo "selected";} ?>>Bac Lieu</option>
                                <option value="21" <?php if($this->input->post('select_chanel') == "21" ){echo "selected";} ?>>Vung Tau</option>
                            </select>

                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 200px">Thời gian quay giải :</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="thoigianquay" name="thoigianquay" value="<?php echo $start_time ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>


                        </td>


                    </tr>
                </table>
            </div>

            <div class="formRow">
                <table class="table-fixed tbldata table-result-lottery">
                    <thead>
                    <tr>
                        <th colspan="2" style="background-color: green;">Cập nhật kết quả sổ xố
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="item formLeft" class="prize" style="color: red; "><b>Đặc biệt</b></td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="1">
                                <input data-value="44219" class="number" data-prize="1" name="giaidacbiet"> </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item formLeft" class="prize">Giải nhất</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="1">
                                <input data-value="17263" class="number" data-prize="2" name="giainhat"> </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item formLeft" class="prize">Giải nhì</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="2">
                                <input data-value="51334" class="number" data-prize="3" name="giaihai">
                                <input data-value="63993" class="number" data-prize="3" name="giaihai"> </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item formLeft"  class="prize">Giải ba</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="6">
                                <input data-value="88090" class="number" data-prize="4" name="giaiba">
                                <input data-value="37457" class="number" data-prize="4" name="giaiba">
                                <input data-value="15226" class="number" data-prize="4" name="giaiba">
                                <input data-value="74880" class="number" data-prize="4" name="giaiba">
                                <input data-value="18603" class="number" data-prize="4" name="giaiba">
                                <input data-value="58173" class="number" data-prize="4" name="giaiba">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item" class="formLeft" class="prize">Giải tư</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="4">
                                <input data-value="8818" class="number" data-prize="5" name="giaibon">
                                <input data-value="7907" class="number" data-prize="5" name="giaibon">
                                <input data-value="7204" class="number" data-prize="5" name="giaibon">
                                <input data-value="0127" class="number" data-prize="5" name="giaibon">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item" class="formLeft" class="prize">Giải năm</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="6">
                                <input data-value="4269" class="number" data-prize="6" name="giainam">
                                <input data-value="1805" class="number" data-prize="6" name="giainam">
                                <input data-value="1836" class="number" data-prize="6" name="giainam">
                                <input data-value="5259" class="number" data-prize="6" name="giainam">
                                <input data-value="8452" class="number" data-prize="6" name="giainam">
                                <input data-value="6811" class="number" data-prize="6" name="giainam">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item" class="formLeft" class="prize">Giải sáu</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="3">
                                <input data-value="888" class="number" data-prize="7" name="giaisau">
                                <input data-value="890" class="number" data-prize="7" name="giaisau">
                                <input data-value="213" class="number" data-prize="7" name="giaisau">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item" class="formLeft" class="prize">Giải bảy</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="4">
                                <input data-value="24" class="number" data-prize="8" name="giaibay">
                                <input data-value="06" class="number" data-prize="8" name="giaibay">
                                <input data-value="22" class="number" data-prize="8" name="giaibay">
                                <input data-value="91" class="number" data-prize="8" name="giaibay">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="item" class="formLeft" class="prize">Giải Tám</td>
                        <td class="item" class="results">
                            <div class="quantity-of-number" data-quantity="4">
                                <input data-value="24" class="number" data-prize="9" name="giaitam">
                                <input data-value="06" class="number" data-prize="9" name="giaitam">
                                <input data-value="22" class="number" data-prize="9" name="giaitam">
                                <input data-value="91" class="number" data-prize="9" name="giaitam">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>
                        <td class="item" style="">
                            <input type="submit" id="search_tran" value="Thêm kết quả" class="button blueB"
                                   style="margin-left: 50px">
                        </td>
                        <td class="item">
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('report/rechargebybank') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow"> <h5>Tổng:      <span style="color: #7a6fbe" id="summoney"></span></h5></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="height: 20px;">
                <td>STT</td>
                <td>Nickname</td>
                <td>Tiền</td>
                <td>Ngân hàng</td>

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
    function joinBrack(string){
        return "[" + string+ "]";
    }

    function submitAddKetqua(){
        var giaidacbiet = $("input[name='giaidacbiet']")
            .map(function(){
                if($(this).val()==""){
                  return ;
                }
                return $(this).val();
            }).get();
        var giainhat = $("input[name='giainhat']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaihai = $("input[name='giaihai']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaiba = $("input[name='giaiba']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaibon = $("input[name='giaibon']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giainam = $("input[name='giainam']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaisau = $("input[name='giaisau']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaibay = $("input[name='giaibay']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();}).get();
        var giaitam = $("input[name='giaitam']")
            .map(function(){
                if($(this).val()==""){
                    return ;
                }
                return $(this).val();
            }).get();
        var phien = $("#phien").val();

        var date = phien.split("-");
        var session = date[0]+date[1]+date[2];
        console.log(session);
        console.log(String.valueOf(giaitam.toString()));
        var thoigianquay = $("#thoigianquay").val();
        console.log(thoigianquay);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loto/addketqualodeajax')?>",
            data: {
                session: session,
                chanel: $("#select_chanel").val(),
                rsdb : "["+giaidacbiet.toString()+"]",
                rs1 :joinBrack(giainhat.toString()),
                rs2 :joinBrack(giaihai.toString()),
                rs3 :joinBrack(giaiba.toString()),
                rs4 :joinBrack(giaibon.toString()),
                rs5 :joinBrack(giainam.toString()),
                rs6 :joinBrack(giaisau.toString()),
                rs7 :joinBrack(giaibay.toString()),
                rs8 :joinBrack(giaitam.toString()),
                dateResult :thoigianquay.toString()
            },

            dataType: 'json',
            success: function (result) {
                console.log(result);
                if(result["code"]==1){
                    alert(" thành công!");
                   // window.location.href = "";
                }else{
                    alert("thất bại!")
                }

            }, error: function () {
                // $("#spinner").hide();
                // $('#logaction').html("");
                $("#resultsearch").html("chưa cập nhật kết quả của ngày hôm nay!");
            },timeout : 20000
        })
    }


    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
       submitAddKetqua();
    });
    // function resultSearchTransction(stt,tid, nickname, money, bank,ip, status,description,time,updatetime, userApprove) {
    //     var rs = "";
    //
    //     rs += "<tr>";
    //     rs += "<td>" + stt + "</td>";
    //     rs += "<td>" + nickname + "</td>";
    //     rs += "<td>" + commaSeparateNumber(money) + "</td>";
    //     rs += "<td>" + bank + "</td>";
    //
    //     rs += "<td>" + tid + "</td>";
    //     rs += "<td>" + time + "</td>";
    //     rs += "<td>" + getStatusText(status) + "</td>";
    //     rs += "<td>" + description + "</td>";
    //     rs += "<td>" + updatetime + "</td>";
    //     if(status == 1){
    //         rs += "<td>  <span class='label label-danger'><a style='color: white;' href=\"javascript: reject("+tid+")\">Từ chối</a></span> <span class='label label-success'><a style='color: white;' href=\"javascript: approve("+tid+")\">Duyệt</a></span> </td>";
    //
    //     }else{
    //         rs += "<td></td>"
    //     }
    //     rs += "<td>" + userApprove + "</td>";
    //     rs += "</tr>";
    //     return rs;
    // }
    //function reject(tid){
    //    $.ajax({
    //        type: "POST",
    //        url: "<?php //echo admin_url('report/updatedepositbankmanual')?>//",
    //        data: {
    //            transId: tid,
    //            type: 1
    //        },
    //
    //        dataType: 'json',
    //        success: function (result) {
    //            $("#spinner").hide();
    //            if(result.success){
    //                alert("Từ chối thành công!");
    //                window.location.href = "";
    //            }else{
    //                alert("Từ chối thất bại!")
    //            }
    //
    //        }, error: function () {
    //            $("#spinner").hide();
    //            $('#logaction').html("");
    //            $("#resultsearch").html("chưa cập nhật kết quả của ngày hôm nay!");
    //        },timeout : 20000
    //    })
    //}
    //function approve(tid){
    //    $.ajax({
    //        type: "POST",
    //        url: "<?php //echo admin_url('report/updatedepositbankmanual')?>//",
    //        data: {
    //            transId: tid,
    //            type: 0
    //        },
    //
    //        dataType: 'json',
    //        success: function (result) {
    //            $("#spinner").hide();
    //            if(result.success){
    //                alert("Duyệt thành công!")
    //                window.location.href = "";
    //            }else{
    //                alert("Duyệt thất bại")
    //            }
    //
    //        }, error: function () {
    //            $("#spinner").hide();
    //            $('#logaction').html("");
    //            $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
    //        },timeout : 20000
    //    })
    //}
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
    //$(document).ready(function () {
    //    var result = "";
    //    var oldpage = 0;
    //    $('#pagination-demo').css("display", "block");
    //    $("#spinner").show();
    //    $.ajax({
    //        type: "POST",
    //        url: "<?php //echo admin_url('loto/addketqualodeajax')?>//",
    //        // url: "http://192.168.0.251:8082/api_backend",
    //        data: {
    //            nickname: $("#filter_iname").val(),
    //            txtvinplay: $("#txtvinplay").val(),
    //            txtip: $("#txtip").val(),
    //            bank: $("#select_bank").val(),
    //            status:  $("#select_status").val(),
    //            toDate:   $("#toDate").val(),
    //            fromDate: $("#fromDate").val(),
    //            pages: 1
    //        },
    //
    //        dataType: 'json',
    //        success: function (result) {
    //            $("#spinner").hide();
    //            if (result.ListTrans == "") {
    //                $('#pagination-demo').css("display", "none");
    //                $("#resultsearch").html("Không tìm thấy kết quả");
    //            } else {
    //                $("#resultsearch").html("");
    //                var totalPage = Math.round(result.TotalTrans / 50) + 1;
    //                console.log(totalPage);
    //                var totalmoney = commaSeparateNumber(result.TotalMoney);
    //                $('#summoney').html(totalmoney);
    //                stt = 1
    //                $.each(result.ListTrans, function (index, value) {
    //                    result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.BankBrandName, value.Id, value.Status, value.Description, value.CreatedAt, value.UpdatedAt, value.UserApprove);
    //                    stt++;
    //                });
    //                $('#logaction').html(result);
    //                $('#pagination-demo').twbsPagination({
    //                    totalPages: totalPage,
    //                    visiblePages: 5,
    //                    onPageClick: function (event, page) {
    //                        if(oldpage>0) {
    //                            $("#spinner").show();
    //                            $.ajax({
    //                                type: "POST",
    //                                url: "<?php //echo admin_url('loto/addketqualodeajax')?>//",
    //
    //                                data: {
    //                                    nickname: $("#filter_iname").val(),
    //                                    txtvinplay: $("#txtvinplay").val(),
    //                                    txtip: $("#txtip").val(),
    //                                    bank: $("#select_bank").val(),
    //                                    status: $("#select_status").val(),
    //                                    toDate: $("#toDate").val(),
    //                                    fromDate: $("#fromDate").val(),
    //                                    pages: page
    //                                },
    //                                dataType: 'json',
    //                                success: function (result) {
    //                                    $("#resultsearch").html("");
    //                                    $("#spinner").hide();
    //                                    stt = 1;
    //                                    $.each(result.ListTrans, function (index, value) {
    //                                        result += resultSearchTransction(stt, value.Id, value.Nickname, value.Amount, value.BankBrandName, value.Id, value.Status, value.Description, value.CreatedAt, value.UpdatedAt , value.UserApprove);
    //                                        stt++;
    //                                    });
    //                                    $('#logaction').html(result);
    //                                }, error: function () {
    //                                    $("#spinner").hide();
    //                                    $('#logaction').html("");
    //                                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
    //                                },timeout : 20000
    //                            });
    //                        }
    //                        oldpage = page;
    //                    }
    //                });
    //            }
    //
    //        }, error: function () {
    //            $("#spinner").hide();
    //            $('#logaction').html("");
    //            $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
    //        },timeout : 20000
    //    })
    //
    //});
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>