<title>Chi Tiết Người Chơi</title>
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
    <?php $this->load->view('admin/error')?>
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
                <h6>Luồng tiền người chơi</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/moneyuser') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate') ?>"> 
                                    <span class="input-group-addon">
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
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate') ?>"> 
                                    <span class="input-group-addon">
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
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>
                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/moneyuser') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <input type="hidden" value="<?php echo $admin_info->Status ?>" id="status">
            <div class="formRow">
                <h4>Tài khoản:<span id="typetaikhoan" style="color: #7a6fbe"></span> 
                <br> Số dư Win:<span id="vinht" style="color: #7a6fbe"></span> 
                <br> Két sắt: <span id="ketsat" style="color: #7a6fbe"></span> 
                <br> Tổng Win: <span id="totalvin" style="color: #7a6fbe"></span></h4>
            </div>

            <div class="formRow">
                <div class="row">
                    <h4 id="" style="color: #7a6fbe;margin-left: 20px">Game</h4>
                    <h4 id="resultsearch" style="color: #e72929;text-align:center"></h4>
                </div>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr style="height: 20px;">
                                <td>STT</td>
                                <td>Tên game</td>
                                <td>Tiền cược</td>
                                <td>Trả thưởng</td>
                                <td>Tiền sư kiện</td>
                                <td>Phế</td>
                                <td>Tiền thắng game</td>
                                <td>Tiền thắng tổng</td>
                            </tr>
                            </thead>
                            <tbody id="logaction">
                            </tbody>
                            <tbody><tr id="totalmar">
                                <td colspan="2">Tổng:</td>
                                <td class="rowDataSd" id="totalmoneylost" style="color:blue" align=right></td>
                                <td class="rowDataSd" id="totalmoneywin" style="color: blue" align=right></td>
                                <td class="rowDataSd" id="totalsk" style="color: blue" align=right></td>
                                <td class="rowDataSd" id="totalfee" style="color: blue" align=right></td>
                                <td class="rowDataSd" id="totalmoney" style="color:blue" align=right></td>
                                <td class="rowDataSd" id="totalrevalue" style="color: blue" align=right></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="formRow">
                <div class="row">
                    <h4 id="" style="color: blue;margin-left: 20px">Tiền khác</h4>
                    <h4 id="resultsearchother" style="color: #e72929;text-align:center"></h4>
                </div>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr style="height: 20px;">
                                <td>STT</td>
                                <td>Dịch vụ</td>
                                <td>Tiền</td>
                            </tr>
                            </thead>
                            <tbody id="logdichvu">
                            </tbody>
                            <tfoot>
                                <td colspan="2">Tổng:</td>
                                <td id="totalKhac" align="right" style="color: blue;"></td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<style>
    td {
        word-break: normal;
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
        format: 'YYYY-MM-DD'
    });

});
$("#search_tran").click(function () {
    if($("#filter_iname").val()==""){
        alert('Bạn phải nhập nickname')
        return false;

    }
    var result1 = "";
    var result3 = "";
    $("#spinner").show();
    let toDate = moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
    let fromDate = moment($("#fromDate").val(),'YYYY-MM-DD').format('YYYY-MM-DD');

    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('report/moneyuserajax')?>",
        data: {
            nickname: $("#filter_iname").val(),
            toDate: toDate,
            fromDate : fromDate
        },

        dataType: 'json',
        success: function (res) {

            $("#spinner").hide();
            if(res.users.isBot == 0){
                $('#typetaikhoan').html("Thường");
            }else if(res.users.isBot == 1){
                $('#typetaikhoan').html("Bot");
            }
            $('#vinht').html(commaSeparateNumber(res.users.currentMoney));
            $('#ketsat').html(commaSeparateNumber(res.users.safeMoney));
            $('#totalvin').html(commaSeparateNumber(res.users.totalMoney));
            if ($.isEmptyObject(res.users.actionGame)) {
                $('#logaction').html("");
                $('#logactionbai').html("");
                $("#resultsearch").html("Không tìm thấy kết quả");
                $("#totalskbai").text("");
                $("#totalsk").text("");
                $("#totalmoneywin").text("");
                $("#totalmoneylost").text("");
                $("#totalfee").text("");
                $("#totalmoney").text("");
                $("#totalrevalue").text("");

            } else  {

                var total=0;
                var total1=0;
                var total2=0;
                var total3=0;
                var total4=0;
                var total5=0;
                $("#resultsearch").html("");
                var stt = 0;
                if(res.users.actionGame.TaiXiu != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Tài Xỉu", res.users.actionGame.TaiXiu.moneyWin, res.users.actionGame.TaiXiu.moneyLost, res.users.actionGame.TaiXiu.moneyOther, res.users.actionGame.TaiXiu.fee, res.users.actionGame.TaiXiu.revenuePlayGame, res.users.actionGame.TaiXiu.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.TaiXiu.moneyWin;
                    total1 += res.users.actionGame.TaiXiu.moneyLost;
                    total2 += res.users.actionGame.TaiXiu.moneyOther;
                    total3 += res.users.actionGame.TaiXiu.fee;
                    total4 += res.users.actionGame.TaiXiu.revenuePlayGame;
                    total5 += res.users.actionGame.TaiXiu.revenue;
                }else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.TaiXiuMd5 != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Tài Xỉu MD5", res.users.actionGame.TaiXiuMd5.moneyWin, res.users.actionGame.TaiXiuMd5.moneyLost, res.users.actionGame.TaiXiuMd5.moneyOther, res.users.actionGame.TaiXiuMd5.fee, res.users.actionGame.TaiXiuMd5.revenuePlayGame, res.users.actionGame.TaiXiuMd5.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.TaiXiuMd5.moneyWin;
                    total1 += res.users.actionGame.TaiXiuMd5.moneyLost;
                    total2 += res.users.actionGame.TaiXiuMd5.moneyOther;
                    total3 += res.users.actionGame.TaiXiuMd5.fee;
                    total4 += res.users.actionGame.TaiXiuMd5.revenuePlayGame;
                    total5 += res.users.actionGame.TaiXiuMd5.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.XocDia != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Xóc Đĩa", res.users.actionGame.XocDia.moneyWin, res.users.actionGame.XocDia.moneyLost, res.users.actionGame.XocDia.moneyOther, res.users.actionGame.XocDia.fee, res.users.actionGame.XocDia.revenuePlayGame, res.users.actionGame.XocDia.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.XocDia.moneyWin;
                    total1 += res.users.actionGame.XocDia.moneyLost;
                    total2 += res.users.actionGame.XocDia.moneyOther;
                    total3 += res.users.actionGame.XocDia.fee;
                    total4 += res.users.actionGame.XocDia.revenuePlayGame;
                    total5 += res.users.actionGame.XocDia.revenue;
                }

                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.BauCuaTo != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Bầu Cua", res.users.actionGame.BauCuaTo.moneyWin, res.users.actionGame.BauCuaTo.moneyLost, res.users.actionGame.BauCuaTo.moneyOther, res.users.actionGame.BauCuaTo.fee, res.users.actionGame.BauCuaTo.revenuePlayGame, res.users.actionGame.BauCuaTo.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.BauCuaTo.moneyWin;
                    total1 += res.users.actionGame.BauCuaTo.moneyLost;
                    total2 += res.users.actionGame.BauCuaTo.moneyOther;
                    total3 += res.users.actionGame.BauCuaTo.fee;
                    total4 += res.users.actionGame.BauCuaTo.revenuePlayGame;
                    total5 += res.users.actionGame.BauCuaTo.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Cowboy != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Cao Bồi", res.users.actionGame.Cowboy.moneyWin, res.users.actionGame.Cowboy.moneyLost, res.users.actionGame.Cowboy.moneyOther, res.users.actionGame.Cowboy.fee, res.users.actionGame.Cowboy.revenuePlayGame, res.users.actionGame.Cowboy.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Cowboy.moneyWin;
                    total1 += res.users.actionGame.Cowboy.moneyLost;
                    total2 += res.users.actionGame.Cowboy.moneyOther;
                    total3 += res.users.actionGame.Cowboy.fee;
                    total4 += res.users.actionGame.Cowboy.revenuePlayGame;
                    total5 += res.users.actionGame.Cowboy.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.FastAndFurious != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Fast & Furious", res.users.actionGame.FastAndFurious.moneyWin, res.users.actionGame.FastAndFurious.moneyLost, res.users.actionGame.FastAndFurious.moneyOther, res.users.actionGame.FastAndFurious.fee, res.users.actionGame.FastAndFurious.revenuePlayGame, res.users.actionGame.FastAndFurious.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.FastAndFurious.moneyWin;
                    total1 += res.users.actionGame.FastAndFurious.moneyLost;
                    total2 += res.users.actionGame.FastAndFurious.moneyOther;
                    total3 += res.users.actionGame.FastAndFurious.fee;
                    total4 += res.users.actionGame.FastAndFurious.revenuePlayGame;
                    total5 += res.users.actionGame.FastAndFurious.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.LadyNight != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Lady Night", res.users.actionGame.LadyNight.moneyWin, res.users.actionGame.LadyNight.moneyLost, res.users.actionGame.LadyNight.moneyOther, res.users.actionGame.LadyNight.fee, res.users.actionGame.LadyNight.revenuePlayGame, res.users.actionGame.LadyNight.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.LadyNight.moneyWin;
                    total1 += res.users.actionGame.LadyNight.moneyLost;
                    total2 += res.users.actionGame.LadyNight.moneyOther;
                    total3 += res.users.actionGame.LadyNight.fee;
                    total4 += res.users.actionGame.LadyNight.revenuePlayGame;
                    total5 += res.users.actionGame.LadyNight.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Binh != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Mậu Binh", res.users.actionGame.Binh.moneyWin, res.users.actionGame.Binh.moneyLost, res.users.actionGame.Binh.moneyOther, res.users.actionGame.Binh.fee, res.users.actionGame.Binh.revenuePlayGame, res.users.actionGame.Binh.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Binh.moneyWin;
                    total1 += res.users.actionGame.Binh.moneyLost;
                    total2 += res.users.actionGame.Binh.moneyOther;
                    total3 += res.users.actionGame.Binh.fee;
                    total4 += res.users.actionGame.Binh.revenuePlayGame;
                    total5 += res.users.actionGame.Binh.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Sam != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Sâm Lốc", res.users.actionGame.Sam.moneyWin, res.users.actionGame.Sam.moneyLost, res.users.actionGame.Sam.moneyOther, res.users.actionGame.Sam.fee, res.users.actionGame.Sam.revenuePlayGame, res.users.actionGame.Sam.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Sam.moneyWin;
                    total1 += res.users.actionGame.Sam.moneyLost;
                    total2 += res.users.actionGame.Sam.moneyOther;
                    total3 += res.users.actionGame.Sam.fee;
                    total4 += res.users.actionGame.Sam.revenuePlayGame;
                    total5 += res.users.actionGame.Sam.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.BigCityBoy != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Big City Boy", res.users.actionGame.BigCityBoy.moneyWin, res.users.actionGame.BigCityBoy.moneyLost, res.users.actionGame.BigCityBoy.moneyOther, res.users.actionGame.BigCityBoy.fee, res.users.actionGame.BigCityBoy.revenuePlayGame, res.users.actionGame.BigCityBoy.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.BigCityBoy.moneyWin;
                    total1 += res.users.actionGame.BigCityBoy.moneyLost;
                    total2 += res.users.actionGame.BigCityBoy.moneyOther;
                    total3 += res.users.actionGame.BigCityBoy.fee;
                    total4 += res.users.actionGame.BigCityBoy.revenuePlayGame;
                    total5 += res.users.actionGame.BigCityBoy.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.BongLaiCac != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Bồng Lai Các", res.users.actionGame.BongLaiCac.moneyWin, res.users.actionGame.BongLaiCac.moneyLost, res.users.actionGame.BongLaiCac.moneyOther, res.users.actionGame.BongLaiCac.fee, res.users.actionGame.BongLaiCac.revenuePlayGame, res.users.actionGame.BongLaiCac.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.BongLaiCac.moneyWin;
                    total1 += res.users.actionGame.BongLaiCac.moneyLost;
                    total2 += res.users.actionGame.BongLaiCac.moneyOther;
                    total3 += res.users.actionGame.BongLaiCac.fee;
                    total4 += res.users.actionGame.BongLaiCac.revenuePlayGame;
                    total5 += res.users.actionGame.BongLaiCac.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Halloween != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Halloween", res.users.actionGame.Halloween.moneyWin, res.users.actionGame.Halloween.moneyLost, res.users.actionGame.Halloween.moneyOther, res.users.actionGame.Halloween.fee, res.users.actionGame.Halloween.revenuePlayGame, res.users.actionGame.Halloween.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Halloween.moneyWin;
                    total1 += res.users.actionGame.Halloween.moneyLost;
                    total2 += res.users.actionGame.Halloween.moneyOther;
                    total3 += res.users.actionGame.Halloween.fee;
                    total4 += res.users.actionGame.Halloween.revenuePlayGame;
                    total5 += res.users.actionGame.Halloween.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.LasVegas != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Thần Bài macao", res.users.actionGame.LasVegas.moneyWin, res.users.actionGame.LasVegas.moneyLost, res.users.actionGame.LasVegas.moneyOther, res.users.actionGame.LasVegas.fee, res.users.actionGame.LasVegas.revenuePlayGame, res.users.actionGame.LasVegas.revenue);
                    $('#logaction').html(result1);

                    total += res.users.actionGame.LasVegas.moneyWin;
                    total1 += res.users.actionGame.LasVegas.moneyLost;
                    total2 += res.users.actionGame.LasVegas.moneyOther;
                    total3 += res.users.actionGame.LasVegas.fee;
                    total4 += res.users.actionGame.LasVegas.revenuePlayGame;
                    total5 += res.users.actionGame.LasVegas.revenue;
                }else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.SexyDance != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Sexy Dance", res.users.actionGame.SexyDance.moneyWin, res.users.actionGame.SexyDance.moneyLost, res.users.actionGame.SexyDance.moneyOther, res.users.actionGame.SexyDance.fee, res.users.actionGame.SexyDance.revenuePlayGame, res.users.actionGame.SexyDance.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.SexyDance.moneyWin;
                    total1 += res.users.actionGame.SexyDance.moneyLost;
                    total2 += res.users.actionGame.SexyDance.moneyOther;
                    total3 += res.users.actionGame.SexyDance.fee;
                    total4 += res.users.actionGame.SexyDance.revenuePlayGame;
                    total5 += res.users.actionGame.SexyDance.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.LienMinh != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Slot Liên Minh", res.users.actionGame.LienMinh.moneyWin, res.users.actionGame.LienMinh.moneyLost, res.users.actionGame.LienMinh.moneyOther, res.users.actionGame.LienMinh.fee, res.users.actionGame.LienMinh.revenuePlayGame, res.users.actionGame.LienMinh.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.LienMinh.moneyWin;
                    total1 += res.users.actionGame.LienMinh.moneyLost;
                    total2 += res.users.actionGame.LienMinh.moneyOther;
                    total3 += res.users.actionGame.LienMinh.fee;
                    total4 += res.users.actionGame.LienMinh.revenuePlayGame;
                    total5 += res.users.actionGame.LienMinh.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Tlmn != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Tiến Lên Miền Nam", res.users.actionGame.Tlmn.moneyWin, res.users.actionGame.Tlmn.moneyLost, res.users.actionGame.Tlmn.moneyOther, res.users.actionGame.Tlmn.fee, res.users.actionGame.Tlmn.revenuePlayGame, res.users.actionGame.Tlmn.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Tlmn.moneyWin;
                    total1 += res.users.actionGame.Tlmn.moneyLost;
                    total2 += res.users.actionGame.Tlmn.moneyOther;
                    total3 += res.users.actionGame.Tlmn.fee;
                    total4 += res.users.actionGame.Tlmn.revenuePlayGame;
                    total5 += res.users.actionGame.Tlmn.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.TaLa != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Tá Lả", res.users.actionGame.TaLa.moneyWin, res.users.actionGame.TaLa.moneyLost, res.users.actionGame.TaLa.moneyOther, res.users.actionGame.TaLa.fee, res.users.actionGame.TaLa.revenuePlayGame, res.users.actionGame.TaLa.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.TaLa.moneyWin;
                    total1 += res.users.actionGame.TaLa.moneyLost;
                    total2 += res.users.actionGame.TaLa.moneyOther;
                    total3 += res.users.actionGame.TaLa.fee;
                    total4 += res.users.actionGame.TaLa.revenuePlayGame;
                    total5 += res.users.actionGame.TaLa.revenue;
                }
                else{
                    $('#logaction').html("");
                }
                if(res.users.actionGame.Lieng != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Liêng", res.users.actionGame.Lieng.moneyWin, res.users.actionGame.Lieng.moneyLost, res.users.actionGame.Lieng.moneyOther, res.users.actionGame.Lieng.fee, res.users.actionGame.Lieng.revenuePlayGame, res.users.actionGame.Lieng.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Lieng.moneyWin;
                    total1 += res.users.actionGame.Lieng.moneyLost;
                    total2 += res.users.actionGame.Lieng.moneyOther;
                    total3 += res.users.actionGame.Lieng.fee;
                    total4 += res.users.actionGame.Lieng.revenuePlayGame;
                    total5 += res.users.actionGame.Lieng.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.XiTo != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Xì Tố", res.users.actionGame.XiTo.moneyWin, res.users.actionGame.XiTo.moneyLost, res.users.actionGame.XiTo.moneyOther, res.users.actionGame.XiTo.fee, res.users.actionGame.XiTo.revenuePlayGame, res.users.actionGame.XiTo.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.XiTo.moneyWin;
                    total1 += res.users.actionGame.XiTo.moneyLost;
                    total2 += res.users.actionGame.XiTo.moneyOther;
                    total3 += res.users.actionGame.XiTo.fee;
                    total4 += res.users.actionGame.XiTo.revenuePlayGame;
                    total5 += res.users.actionGame.XiTo.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.BaiCao != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Bài Cào", res.users.actionGame.BaiCao.moneyWin, res.users.actionGame.BaiCao.moneyLost, res.users.actionGame.BaiCao.moneyOther, res.users.actionGame.BaiCao.fee, res.users.actionGame.BaiCao.revenuePlayGame, res.users.actionGame.BaiCao.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.BaiCao.moneyWin;
                    total1 += res.users.actionGame.BaiCao.moneyLost;
                    total2 += res.users.actionGame.BaiCao.moneyOther;
                    total3 += res.users.actionGame.BaiCao.fee;
                    total4 += res.users.actionGame.BaiCao.revenuePlayGame;
                    total5 += res.users.actionGame.BaiCao.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }


                if(res.users.actionGame.Poker != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Poker", res.users.actionGame.Poker.moneyWin, res.users.actionGame.Poker.moneyLost, res.users.actionGame.Poker.moneyOther, res.users.actionGame.Poker.fee, res.users.actionGame.Poker.revenuePlayGame, res.users.actionGame.Poker.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Poker.moneyWin;
                    total1 += res.users.actionGame.Poker.moneyLost;
                    total2 += res.users.actionGame.Poker.moneyOther;
                    total3 += res.users.actionGame.Poker.fee;
                    total4 += res.users.actionGame.Poker.revenuePlayGame;
                    total5 += res.users.actionGame.Poker.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }

                if(res.users.actionGame.MiniPoker != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Minigame Poker", res.users.actionGame.MiniPoker.moneyWin, res.users.actionGame.MiniPoker.moneyLost, res.users.actionGame.MiniPoker.moneyOther, res.users.actionGame.MiniPoker.fee, res.users.actionGame.MiniPoker.revenuePlayGame, res.users.actionGame.MiniPoker.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.MiniPoker.moneyWin;
                    total1 += res.users.actionGame.MiniPoker.moneyLost;
                    total2 += res.users.actionGame.MiniPoker.moneyOther;
                    total3 += res.users.actionGame.MiniPoker.fee;
                    total4 += res.users.actionGame.MiniPoker.revenuePlayGame;
                    total5 += res.users.actionGame.MiniPoker.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }

                if(res.users.actionGame.CaoThap != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Minigame Cao Thấp", res.users.actionGame.CaoThap.moneyWin, res.users.actionGame.CaoThap.moneyLost, res.users.actionGame.CaoThap.moneyOther, res.users.actionGame.CaoThap.fee, res.users.actionGame.CaoThap.revenuePlayGame, res.users.actionGame.CaoThap.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.CaoThap.moneyWin;
                    total1 += res.users.actionGame.CaoThap.moneyLost;
                    total2 += res.users.actionGame.CaoThap.moneyOther;
                    total3 += res.users.actionGame.CaoThap.fee;
                    total4 += res.users.actionGame.CaoThap.revenuePlayGame;
                    total5 += res.users.actionGame.CaoThap.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.Caro != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Caro", res.users.actionGame.Caro.moneyWin, res.users.actionGame.Caro.moneyLost, res.users.actionGame.Caro.moneyOther, res.users.actionGame.Caro.fee, res.users.actionGame.Caro.revenuePlayGame, res.users.actionGame.Caro.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.Caro.moneyWin;
                    total1 += res.users.actionGame.Caro.moneyLost;
                    total2 += res.users.actionGame.Caro.moneyOther;
                    total3 += res.users.actionGame.Caro.fee;
                    total4 += res.users.actionGame.Caro.revenuePlayGame;
                    total5 += res.users.actionGame.Caro.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.CoTuong != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Cờ tướng", res.users.actionGame.CoTuong.moneyWin, res.users.actionGame.CoTuong.moneyLost, res.users.actionGame.CoTuong.moneyOther, res.users.actionGame.CoTuong.fee, res.users.actionGame.CoTuong.revenuePlayGame, res.users.actionGame.CoTuong.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.CoTuong.moneyWin;
                    total1 += res.users.actionGame.CoTuong.moneyLost;
                    total2 += res.users.actionGame.CoTuong.moneyOther;
                    total3 += res.users.actionGame.CoTuong.fee;
                    total4 += res.users.actionGame.CoTuong.revenuePlayGame;
                    total5 += res.users.actionGame.CoTuong.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                if(res.users.actionGame.CANDY != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Minigame Rượu Whisky", res.users.actionGame.CANDY.moneyWin, res.users.actionGame.CANDY.moneyLost, res.users.actionGame.CANDY.moneyOther, res.users.actionGame.CANDY.fee, res.users.actionGame.CANDY.revenuePlayGame, res.users.actionGame.CANDY.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.CANDY.moneyWin;
                    total1 += res.users.actionGame.CANDY.moneyLost;
                    total2 += res.users.actionGame.CANDY.moneyOther;
                    total3 += res.users.actionGame.CANDY.fee;
                    total4 += res.users.actionGame.CANDY.revenuePlayGame;
                    total5 += res.users.actionGame.CANDY.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }

                if(res.users.actionGame.BaCay != null) {
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Ba Cây", res.users.actionGame.BaCay.moneyWin, res.users.actionGame.BaCay.moneyLost, res.users.actionGame.BaCay.moneyOther, res.users.actionGame.BaCay.fee, res.users.actionGame.BaCay.revenuePlayGame, res.users.actionGame.BaCay.revenue);
                    $('#logaction').html(result1);
                    total += res.users.actionGame.BaCay.moneyWin;
                    total1 += res.users.actionGame.BaCay.moneyLost;
                    total2 += res.users.actionGame.BaCay.moneyOther;
                    total3 += res.users.actionGame.BaCay.fee;
                    total4 += res.users.actionGame.BaCay.revenuePlayGame;
                    total5 += res.users.actionGame.BaCay.revenue;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }

                if(res.totalShootFishProfit) {
                    const shootFish = -res.totalShootFishProfit
                    stt += 1;
                    result1 += resultSearchTransction(stt, "Bắn cá", 0, 0, 0, 0, shootFish, shootFish);
                    $('#logaction').html(result1);
                    total4 += shootFish;
                    total5 += shootFish;
                }
                else{
                    result1 += "";
                    $('#logaction').html(result1);
                }
                $("#totalmoneywin").text(commaSeparateNumber(total));
                $("#totalmoneylost").text(commaSeparateNumber(total1));
                $("#totalsk").text(commaSeparateNumber(total2));
                $("#totalfee").text(commaSeparateNumber(total3));
                $("#totalmoney").text(commaSeparateNumber(total4));
                $("#totalrevalue").text(commaSeparateNumber(total5));

            }


            if ($.isEmptyObject(res.users.actionOther)) {

                $("#resultsearchother").html("Không tìm thấy kết quả");
                $('#logdichvu').html("");
            }else  {
                var stt = 0;
                $("#resultsearchother").html("");
                
                const actionDescriptions = {
                    RechargeByCard: "Nạp Win thẻ cào",
                    RechargeByBank: "Nạp qua ngân hàng",
                    GiftCode: "Giftcode",
                    CashoutByVP: "Đổi thưởng vippoint",
                    RefundFee: "Hoàn trả phí",
                    CashOutByCard: "Rút tiền qua thẻ cào",
                    CashOutByTopUp: "Nạp tiền điện thoại",
                    VQVIP: "Vòng quay vip",
                    KhoBauVqFree: "Vòng quay kho báu free",
                    NuDiepVienVqFree: "Vòng quay Dragon ball free",
                    SieuAnhHungVqFree: "Vòng quay Than dong dat viet free",
                    NapXu: "Nạp xu",
                    ChargeSMS: "Phí SMS đại lý",
                    TransferMoney: "Chuyển khoản",
                    Admin: "Cộng trừ tiền Admin",
                    Bot: "Cộng trừ tiền Bot",
                    RechargeByIAP: "Nạp Win qua IAP",
                    EventVPBonus: "Vippoint Event",
                    GcAgent: "Giftcode đại lý",
                    BonusTopDS: "Thưởng doanh số đại lý",
                    RechargeBySMS: "Nạp tiền qua SMS",
                    GiftCodeVH: "Giftcode vận hành",
                    GiftCodeMKT: "Giftcode marketing",
                    EventVP: "Trao thưởng Vippoint Event",
                    VQVIP: "Vòng quay vip",
                    KhoBauVqFree: "Vòng quay kho báu free",
                    NuDiepVienVqFree: "Vòng quay Dragon ball free",
                    SieuAnhHungVqFree: "Vòng quay Than dong dat viet free",
                    VuongQuocVinVqFree: "Vòng quay Doraemon free",
                    RechargeByVinCard: "Nạp Win qua Wincard",
                    RechargeByMegaCard: "Nạp Win qua Megacard",
                    NhiemVu: "Thưởng nhiệm vụ",
                    TopupVTCPay: "Nạp từ VTC",
                    RechargeByMomo: "Nạp qua MOMO",
                    RechargeByCard: "Nạp qua thẻ",
                    CashOutByBank: "Rút qua bank",
                    CashOutByMomo: "Rút qua MOMO",
                    RefundRechargeError: "Hoàn trả tiền rút",
                    'Gift Code': "Gift Code"
                };
                
                let actionOtherArray = Object.entries(res.users.actionOther);
                let totalKhac = 0;
                actionOtherArray.forEach(([action, amount]) => {
                    if (actionDescriptions[action] != undefined) {
                        stt++;
                        result3 += resultmoneyother(stt, actionDescriptions[action], amount);
                    } else {
                        stt++;
                        result3 += resultmoneyother(stt, action, amount);
                    }
                    $('#logdichvu').html(result3);
                    totalKhac += parseInt(amount, 10); // Added radix parameter for clarity
                });

                $("#totalKhac").text(commaSeparateNumber(totalKhac));
            }

        }, error: function () {
            $("#spinner").hide();
            $("#error-popup").modal("show");
        }, timeout: 40000
    })
});
function resultSearchTransction(stt, gamename, moneywin, moneylost,moneyother, fee, moneytotal, revenue) {

    var rs = "";
    rs += "<tr>";
    rs += "<td >" + stt + "</td>";
    rs += "<td>" + gamename + "</td>";
    rs += "<td class='rowDataSd2' align=right>" + commaSeparateNumber(moneylost) + "</td>";
    rs += "<td class='rowDataSd1' align=right>" + commaSeparateNumber(moneywin) + "</td>";
    rs += "<td class='rowDataSd3' align=right>" + commaSeparateNumber(moneyother) + "</td>";
    rs += "<td class='rowDataSd4' align=right>" + commaSeparateNumber(fee) + "</td>";
    rs += "<td class='rowDataSd5' align=right>" + commaSeparateNumber(moneytotal) + "</td>";
    rs += "<td class='rowDataSd6' align=right>" + commaSeparateNumber(revenue) + "</td>";
    rs += "</tr>";
    return rs;
}

function resultmoneyother(stt, gamename, money) {

    var rs = "";
    rs += "<tr>";
    rs += "<td >" + stt + "</td>";
    rs += "<td>" + gamename + "</td>";
    rs += "<td align=right>" + commaSeparateNumber(money) + "</td>";
    rs += "</tr>";
    return rs;
}
$(document).ready(function () {
    $("#toDate").val( moment().format('YYYY-MM-DD'));
    $("#fromDate").val( moment().format('YYYY-MM-DD'));
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