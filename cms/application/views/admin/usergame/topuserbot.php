<title>Top Chơi Game</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if($role == false): ?>
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
    <link rel="stylesheet"
          href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
    <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
    <script
        src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
    <div class="widget">
        <div class="title">
            <h6>Top chơi game</h6>
        </div>
        <form class="list_filter form" action="" method="get">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="toDate" name="toDate"
                                       value="<?php echo $this->input->post('toDate') ?>"> <span
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
                                <input type="text" id="fromDate" name="fromDate"
                                       value="<?php echo $this->input->post('fromDate') ?>"> <span
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
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Hiển thị:</label></td>
                        <td><select id="displaygame">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="500">500</option>

                            </select>
                        </td>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Tên Game:</label></td>
                        <td><select id="gamename">
                                <option value="all" >Tất cả
                                </option>
                                <option value="TaiXiu" >------Chơi game Tài Xỉu
                                </option>
                                <option value="TaiXiuMd5">------Chơi game Tài Xỉu MD5
                                </option>
                                <option value="MiniPoker">------Chơi game Mini Poker
                                </option>
                                <option value="CaoThap">------Chơi game Cao Thấp
                                </option>
                                <option value="CANDY" >------Quay Rượu Whisky
                                </option>

                                <option value="LadyNight">------Quay Lady Night
                                </option>
                                <option value="FastAndFurious">------Quay Fast And Furious
                                </option>
                                <option value="SexyDance" >------Quay Sexy Dance
                                </option>
                                <option value="LienMinh" >------Quay Liên Minh Huyền Thoại
                                </option>
                                <option value="Cowboy" >------Quay Cao Bồi
                                </option>
                                <option value="BongLaiCac" >------Quay Bồng Lai Các
                                </option>
                                <option value="Halloween" >------Quay Halloween
                                </option>
                                <option value="LasVegas" >------Quay Las Vegas
                                </option>
                                <option value="BigCityBoy" >------Quay Big City Boy
                                </option>

                                <option value="XocDia">------Chơi game Xóc Đĩa
                                </option>
                                <option value="BauCuaTo">------Chơi game Bầu Cua
                                </option>
                                <option value="Exchange" >------Đổi thưởng bắn cá
                                </option>
                                <option value="Binh" >------ Mậu Binh
                                </option>
                                <option value="BaiCao" >------ Bài Cào
                                </option>
                                <option value="Sam">------ Sâm Lốc
                                </option>
                                <option value="Tlmn" >------ Tiến Lên Miền Nam
                                </option>
                                <option value="Poker" >------ Poker
                                </option>
                                <option value="BaCay" >------ Ba Cây
                                </option>
                        </select>
                        </td>
                        <td style="">
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 123px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('usergame/topuserbot') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow">
            <div class="row">
                <h4 style="text-align: left;margin-left: 30px" >Tên game:<span style="color:red" id="tengame"></span></h4>
                </div>
            </div>

            <div class="formRow">
            <div class="row">

                <div class="col-xs-6">
                    <h3 style="text-align: center;color: #7a6fbe">Top User thắng</h3>
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>STT</td>
                            <td>Nickname</td>
                            <td>Tiền thắng</td>
                        </tr>
                        </thead>

                        <tbody id="loguserwin">
                        </tbody>
                        <h4 style="text-align: center;color:red" id="resultuserwin"></h4>
                    </table>
                </div>
                <div class="col-xs-6">
                    <h3 style="text-align: center;color: #7a6fbe">Top User thua</h3>
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>STT</td>
                            <td>Nickname</td>
                            <td>Tiền thua</td>
                        </tr>
                        </thead>
                        <tbody id="loguserlost">
                        </tbody>
                        <h4 style="text-align: center;color:red" id="resultuserlost"></h4>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="formRow">
            <div class="row">

                <div class="col-xs-6">
                    <h3 style="text-align: center;color: #7a6fbe">Top Bot thắng</h3>
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>STT</td>
                            <td>Nickname</td>
                            <td>Tiền thắng</td>
                        </tr>
                        </thead>
                        <tbody id="logbotwin">
                        </tbody>
                        <h4 style="text-align: center;color:red" id="resultbotwin"></h4>
                    </table>
                </div>
                <div class="col-xs-6">
                    <h3 style="text-align: center;color: #7a6fbe">Top Bot thua</h3>
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>STT</td>
                            <td>Nickname</td>
                            <td>Tiền thua</td>
                        </tr>
                        </thead>
                        <tbody id="logbotlost">
                        </tbody>
                        <h4 style="text-align: center;color:red" id="resultbotlost"></h4>
                    </table>
                </div>
            </div>
        </div> -->
    </div>

</div>
<?php endif; ?>

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
</div>
<script>
$("#search_tran").click(function () {
    // if($("#gamename").val()== ""){
    //     alert("Bạn chưa nhập tên game");
    //     return false;
    // }
    $("#spinner").show();
    var result1 = "";
    var result2 = "";
    var result3 = "";
    var result4 = "";
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('usergame/topuserbotajax')?>",
        timeout: 20000,
        data: {
            gamename: $("#gamename").val(),
            display : $("#displaygame").val(),
            toDate: $("#toDate").val(),
            fromDate:  $("#fromDate").val()
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            $("#tengame").html($("#gamename option:selected").text());

            if (result.topUserWin == "") {
                $("#resultuserwin").html("Không tìm thấy kết quả");
                $('#loguserwin').html("");
            } else {
                $("#resultuserwin").html("");
                stt = 1;
                $.each(result.topUserWin, function (index, value) {
                    result1 += resultSearchTransction(stt, value.nickname, value.moneyWin);
                    stt++
                });
                $('#loguserwin').html(result1);
            }
            if (result.topUserLost == "") {
                $("#resultuserlost").html("Không tìm thấy kết quả");
                $('#loguserlost').html("");
            } else {
                $("#resultuserlost").html("");
                stt = 1;
                $.each(result.topUserLost, function (index, value) {
                    result2 += resultSearchTransction(stt, value.nickname, value.moneyWin);
                    stt++
                });
                $('#loguserlost').html(result2);
            }
            // if (result.topBotWin == "") {
            //     $("#resultbotwin").html("Không tìm thấy kết quả");
            //     $('#logbotwin').html("");
            // } else {
            //     $("#resultbotwin").html("");
            //     stt = 1;
            //     $.each(result.topBotWin, function (index, value) {
            //         result3 += resultSearchTransction(stt, value.nickname, value.moneyWin);
            //         stt++
            //     });
            //     $('#logbotwin').html(result3);
            // }
            // if (result.topBotLost == "") {
            //     $("#resultbotlost").html("Không tìm thấy kết quả");
            //     $('#logbotlost').html("");
            // } else {
            //     $("#resultbotlost").html("");
            //     stt = 1;
            //     $.each(result.topBotLost, function (index, value) {
            //         result4 += resultSearchTransction(stt, value.nickname, value.moneyWin);
            //         stt++
            //     });
            //     $('#logbotlost').html(result4);
            // }

        }, error: function(xhr, textStatus, errorThrown){
            alert('request failed');
        }
    })
});
$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });

});
$(document).ready(function () {
    $("#toDate").val( moment().format('YYYY-MM-DD'));
    $("#fromDate").val( moment().format('YYYY-MM-DD'));
    $("#spinner").show();
    var result1 = "";
    var result2 = "";
    var result3 = "";
    var result4 = "";
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('usergame/topuserbotajax')?>",
        // url: "http://api.vinplay.com:8081/api",
        data: {
            gamename: $("#gamename").val(),
            display : $("#displaygame").val(),
            toDate: $("#toDate").val(),
            fromDate:  $("#fromDate").val()
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            $("#tengame").html($("#gamename option:selected").text());

            if (result.topUserWin == "") {
                $("#resultuserwin").html("Không tìm thấy kết quả");
                $('#loguserwin').html("");
            } else {
                $("#resultuserwin").html("");
                stt = 1;
                $.each(result.topUserWin, function (index, value) {
                    result1 += resultSearchTransction(stt, value.nickname, value.moneyWin);
                    stt++
                });
                $('#loguserwin').html(result1);
            }
            if (result.topUserLost == "") {
                $("#resultuserlost").html("Không tìm thấy kết quả");
                $('#loguserlost').html("");
            } else {
                $("#resultuserlost").html("");
                stt = 1;
                $.each(result.topUserLost, function (index, value) {
                    result2 += resultSearchTransction(stt, value.nickname, value.moneyWin);
                    stt++
                });
                $('#loguserlost').html(result2);
            }
            // if (result.topBotWin == "") {
            //     $("#resultbotwin").html("Không tìm thấy kết quả");
            //     $('#logbotwin').html("");
            // } else {
            //     $("#resultbotwin").html("");
            //     stt = 1;
            //     $.each(result.topBotWin, function (index, value) {
            //         result3 += resultSearchTransction(stt, value.nickname, value.moneyWin);
            //         stt++
            //     });
            //     $('#logbotwin').html(result3);
            // }
            // if (result.topBotLost == "") {
            //     $("#resultbotlost").html("Không tìm thấy kết quả");
            //     $('#logbotlost').html("");
            // } else {
            //     $("#resultbotlost").html("");
            //     stt = 1;
            //     $.each(result.topBotLost, function (index, value) {
            //         result4 += resultSearchTransction(stt, value.nickname, value.moneyWin);
            //         stt++
            //     });
            //     $('#logbotlost').html(result4);
            // }

        }
    });


});

function resultSearchTransction(stt, nickname,moneywin) {
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + stt + "</td>";
    rs += "<td>" + nickname + "</td>";
    rs += "<td>" + commaSeparateNumber(moneywin) + "</td>";
    rs += "</tr>";
    return rs;
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