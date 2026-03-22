<title>Lịch Sử Giao Dịch Hệ Thống</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role == false): ?>
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
        <div class="widget" style="background: #d3fbff; border-radius: 15px; border: 1px solid #75dbff;">
            <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>

            <div class="title">
                <h6>Lịch sử giao dịch hệ thống</h6>
            </div>
            <form class="list_filter form" style="float:left;" action="<?php echo admin_url('transaction') ?>" method="post">
                <!-- <div class="list_filter form" style="float:left;"> -->
                <table>
                    <tr>
                        <td>
                            <label for="param_name" style="margin-top:30px;width: 100px">Từ ngày:</label></td>
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
                <table>
                    <tr>
                        <td><label style="margin-left: 0px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-top:30px;width: 150px" id="filter_iname"
                                   value="<?php echo $this->input->post('name') ?>" name="name"></td>
                        <td><label style="margin-left: 105px;margin-bottom:-2px;width: 100px">Tiền:</label></td>
                        <td class="">
                            <select id="money_type" name="money" style="margin-left: -30px;margin-bottom:-2px;width: 143px">
                                <option value="vin" <?php if ($this->input->post('money') == "vin") {
                                    echo "selected";
                                } ?>>Win
                                </option>
                            </select>
                        </td>

                        <td><label style="margin: 10px">Tìm Theo DB:</label></td>
                        <td>
                            <select id="typeSearch" name="typeSearch" style="">
                                <option value="mongo" selected>Tìm theo mongo</option>
                            </select>
                        </td>

                    </tr>

                </table>

                <table>
                    <tr>
                        <td>
                            <label for="param_name"
                                   style="width: 100px;margin-bottom:-3px;margin-left: 0px;margin-top: 30px"
                                   class="formLeft">Dịch vụ: </label>
                        </td>
                        <td class="item"><select id="servicename" name="servicename"
                                                 style="margin-left: -15px;margin-bottom:-2px;width: 142px">
                                <option value="">Tất cả</option>
                                <option value="TaiXiu" <?php if ($this->input->post('servicename') == "TaiXiu") {
                                    echo "selected";
                                } ?>>------Chơi game Tài Xỉu
                                </option>
                                <option value="TaiXiuMd5" <?php if ($this->input->post('servicename') == "TaiXiuMd5") {
                                    echo "selected";
                                } ?>>------Chơi game Tài Xỉu MD5
                                </option>
                                <option value="MiniPoker" <?php if ($this->input->post('servicename') == "MiniPoker") {
                                    echo "selected";
                                } ?>>------Chơi game Mini Poker
                                </option>
                                <option value="CaoThap" <?php if ($this->input->post('servicename') == "CaoThap") {
                                    echo "selected";
                                } ?>>------Chơi game Cao Thấp
                                </option>
                                <option value="CANDY" <?php if ($this->input->post('servicename') == "CANDY") {
                                    echo "selected";
                                } ?>>------Quay Rượu Whisky
                                </option>

                                <option value="LadyNight" <?php if ($this->input->post('servicename') == "LadyNight") {
                                    echo "selected";
                                } ?>>------Quay Lady Night
                                </option>
                                <option value="FastAndFurious" <?php if ($this->input->post('servicename') == "FastAndFurious") {
                                    echo "selected";
                                } ?>>------Quay Fast And Furious
                                </option>
                                <option value="SexyDance" <?php if ($this->input->post('servicename') == "SexyDance") {
                                    echo "selected";
                                } ?>>------Quay Sexy Dance
                                </option>
                                <option value="LienMinh" <?php if ($this->input->post('servicename') == "LienMinh") {
                                    echo "selected";
                                } ?>>------Quay Liên Minh Huyền Thoại
                                </option>
                                <option value="Cowboy" <?php if ($this->input->post('servicename') == "Cowboy") {
                                    echo "selected";
                                } ?>>------Quay Cao Bồi
                                </option>
                                <option value="BongLaiCac" <?php if ($this->input->post('servicename') == "BongLaiCac") {
                                    echo "selected";
                                } ?>>------Quay Bồng Lai Các
                                </option>
                                <option value="Halloween" <?php if ($this->input->post('servicename') == "Halloween") {
                                    echo "selected";
                                } ?>>------Quay Halloween
                                </option>
                                <option value="LasVegas" <?php if ($this->input->post('servicename') == "LasVegas") {
                                    echo "selected";
                                } ?>>------Quay Thần Bài macao
                                </option>
                                <option value="BigCityBoy" <?php if ($this->input->post('servicename') == "BigCityBoy") {
                                    echo "selected";
                                } ?>>------Quay Big City Boy
                                </option>

                                <option value="XocDia" <?php if ($this->input->post('servicename') == "XocDia") {
                                    echo "selected";
                                } ?>>------Chơi game Xóc Đĩa
                                </option>
                                <option value="BauCuaTo" <?php if ($this->input->post('servicename') == "BauCuaTo") {
                                    echo "selected";
                                } ?>>------Chơi game Bầu Cua
                                </option>
                                <option value="Exchange" <?php if ($this->input->post('servicename') == "Exchange") {
                                    echo "selected";
                                } ?>>------Đổi thưởng bắn cá
                                </option>

                                <option value="Binh" <?php if ($this->input->post('servicename') == "Binh") {
                                    echo "selected";
                                } ?>>------ Mậu Binh
                                </option>
                                <option value="BaiCao" <?php if ($this->input->post('servicename') == "BaiCao") {
                                    echo "selected";
                                } ?>>------ Bài Cào
                                </option>
                                <option value="Sam" <?php if ($this->input->post('servicename') == "Sam") {
                                    echo "selected";
                                } ?>>------ Sâm Lốc
                                </option>
                                <option value="Tlmn" <?php if ($this->input->post('servicename') == "Tlmn") {
                                    echo "selected";
                                } ?>>------ Tiến Lên Miền Nam
                                </option>
                                <option value="Poker" <?php if ($this->input->post('servicename') == "Poker") {
                                    echo "selected";
                                } ?>>------ Poker
                                </option>
                                <option value="BaCay" <?php if ($this->input->post('servicename') == "BaCay") {
                                    echo "selected";
                                } ?>>------ Ba Cây
                                </option>
                            </select>
                        </td>

                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Hiển thị: </label>
                        </td>
                        <td class="item"><select id="record" name="record"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option value="50" <?php if ($this->input->post('record') == 50) {
                                    echo "selected";
                                } ?>>50
                                </option>
                                <option value="100" <?php if ($this->input->post('record') == 100) {
                                    echo "selected";
                                } ?>>100
                                </option>
                                <option value="200" <?php if ($this->input->post('record') == 200) {
                                    echo "selected";
                                } ?>>200
                                </option>
                                <option value="500" <?php if ($this->input->post('record') == 500) {
                                    echo "selected";
                                } ?>>500
                                </option>
                                <option value="1000" <?php if ($this->input->post('record') == 1000) {
                                    echo "selected";
                                } ?>>1000
                                </option>
                                <option value="2000" <?php if ($this->input->post('record') == 2000) {
                                    echo "selected";
                                } ?>>2000
                                </option>
                                <option value="5000" <?php if ($this->input->post('record') == 5000) {
                                    echo "selected";
                                } ?>>5000
                                </option>
                            </select>
                        </td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 60px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('transaction') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>

            </form>

            <div id="TableNapRut" style="display: none;">

                <div class="formRow" style="display: inline-flex; justify-content: space-between; width: 100%">
                    <h4 style="font-size: 22px; color: #080a62; font-weight: bold; max-width: 50%">
                        <div>Tài khoản:<span id="typetaikhoan" style="color: #f80000"></span>
                        <div>Số dư:<span id="vinht" style="color: #f80000"></span></div>
                        <div>Két sắt: <span id="ketsat" style="color: #f80000"></span></div>
                        <div>Tổng: <span id="totalvin" style="color: #f80000"></span></div>
                        <div class="Content-table-item__ttl formRow">
                            <h4>Tổng Nạp Giftcode: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyGc">0</span></h4>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableGc" style="background: #e0ffff;display: block; max-height: 600px; overflow-y: scroll; font-size: 14px">
                            <thead style="height: 35px; background: #0096a5;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <!-- <td>Mã giao dịch</td> -->
                                <td>Cổng giao dịch</td>
                                <td>Mã giao dịch</td>
                                <td>Nickname</td>
                                <td>Số Tiền</td>
                                <td>Thời gian</td>
                            </tr>
                            </thead>
                            <tbody id="logactionGc">
                            </tbody>
                        </table>
                    </h4>
                    <div class="Content-table-item" style="max-width:50%">
                    <div class="formRow">
                            <div class="row">
                                <h4 id="" style="color: #f80000;margin-left: 20px">Tổng cược</h4>
                                <h4 id="resultsearch" style="color: #e72929;text-align:center"></h4>
                            </div>
                        </div>
                        <div class="formRow">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed; font-size: 16px">
                                        <thead style="background: #0096a5;color: #fff;font-weight: bold;">
                                        <tr style="height: 20px;">
                                            <td>STT</td>
                                            <td>Tên game</td>
                                            <td>Tiền cược</td>
                                            
                                        </tr>
                                        </thead>
                                        <tbody id="logaction">
                                        </tbody>
                                        <tbody><tr id="totalmar">
                                            <td colspan="2">Tổng:</td>
                                            <td class="rowDataSd" id="totalmoneylost" style="color:blue "></td>
                                        
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
                <!-- <h1 style="text-align: center;">Số dư hiện tại: <span id="nickName" style="font-size: 45px; color: #021d6b; font-weight: bold;"></span> còn <span id="currentMoney" style="font-size: 45px;color: #ff0a0a; font-weight: bold;">0</span></h1> -->
                <div Class="Content-table">
                    <div class="Content-table-item">
                        <div class="Content-table-item__ttl formRow">
                            <h4>Tổng Nạp: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap">0</span></h4>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNap" style="background: #e0ffff;display: block; max-height: 600px; overflow-y: scroll">
                            <thead style="height: 35px; background: #0096a5;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <!-- <td>Mã giao dịch</td> -->
                                <td>Cổng giao dịch</td>
                                <td>Mã giao dịch</td>
                                <td>Nickname</td>
                                <td>Số Tiền</td>
                                <td>Thời gian</td>
                            </tr>
                            </thead>
                            <tbody id="logactionNap">
                            </tbody>
                        </table>
                    </div><!-- Content-table-item -->

                    <div class="Content-table-item">
                        <div class="Content-table-item__ttl formRow">
                            <h4>Tổng Rút: <br><span style="font-size: 30px;color: #e42708;" id="summoneyRut">0</span></h4>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableRut" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                            <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <!-- <td>Mã giao dịch</td> -->
                                <td>Cổng giao dịch</td>
                                <td>Mã giao dịch</td>
                                <td>Nickname</td>
                                <td>Số Tiền</td>
                                <td>Thời gian</td>
                            </tr>
                            </thead>
                            <tbody id="logactionRut">
                            </tbody>
                        </table>
                    </div><!-- Content-table-item -->
                </div><!-- Content-table -->
            </div>
            <div class="text-right">
                <input type="button" class="reloadBtn" value="🔄" onclick="showLichSuGiaoDich()">
                <ul id="pagination-demo" class="pagination-sm"></ul>
                </div>
            <div class="formRow">
                <table cellpadding="0" cellspacing="0" width="100%" class="tablesorter table table-bordered table-hover" id="checkAlltransaction">
                    <thead>
                    <tr style="height: 20px; background: #05677d; color: #fff7f7; font-weight: bold;">
                        <th>STT</th>
                        <th>Nick name</th>
                        <th>Dịch vụ</th>
                        <th>Hành động</th>
                        <th class="col-sm-3" id="des">Mô tả</th>
                        <th>Phế</th>
                        <th>Tiền thay đổi</th>
                        <th style="width:120px;">Số dư</th>
                        <th>Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody id="logTransaction">
                    </tbody>
                </table>
               
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
    .reloadBtn {
        margin-top: 26px;
        margin-right: 5px;
        padding: 0 !important;
        font-size: 28px !important;
        height: 28px;
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
    .Content-table {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .Content-table-item__ttl {
        text-align: center;
    }

    .Content-table-item__ttl h4 {
        font-size: 25px;
        color: #2d2d2d;
        font-weight: bold;
    }
    .sTable thead td {
        border-bottom: 1px solid #cbcbcb;
        border-left: 1px solid #cbcbcb;
        font-size: 15px;
        color: #ffffff;
        padding: 10px 4px 2px 4px;
    }

    #checkAllMuaVao.sTable tbody tr:nth-child(even) {
        background-color: #ffd9d9;
    }

    #checkAllBanRa.sTable tbody tr:nth-child(even) {
        background-color: #bfffed;
    }

</style>

<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
</div>


<script src="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.css">
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
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        // if($("#filter_iname").val() != "") {
        //     showUserDetail();
        // }
        //     $("#TableDaily").hide();
        //     $("#TableNapRut").hide();
        // }
        // showLichSuGiaoDich();
    });

    function resultSearchTransction(stt, transactionTime, nickName, actionName, description, currentMoney, moneyExchange,
                                    serviceName, fee) {
        var rs = "";
        var checkMoneyExchange = 0;
        if (typeof(moneyExchange) == 'string') {
            checkMoneyExchange = Number(moneyExchange.replaceAll(",", ""));
        } else {
            checkMoneyExchange = moneyExchange;
        }

        if (checkMoneyExchange > 0) {
            rs += "<tr style='background-color: #bfffc8;'>";
        } else if (checkMoneyExchange < 0) {
            rs += "<tr style='background-color: #f7dede;'>";
        } else {
            rs += "<tr>";
        }

        rs += "<td>" + stt + "</td>";
        rs += "<td>" + nickName + "</td>";
        actionName = actionName.replace("LasVegas", "Thần Bài macao");
        if (actionName == 'RANGE_ROVER') {
            rs += "<td>Kho báu tứ linh</td>";
        } else if (actionName == 'TAMHUNG') {
            rs += "<td>Tây du ký</td>";
        } else if (actionName == 'MAYBACH') {
            rs += "<td>Sơn Tinh - Thủy tinh</td>";
        } else if (actionName == 'Spartan') {
            rs += "<td>THẦN TÀI</td>";
        } else if (actionName == 'ROLL_ROYE') {
            rs += "<td>ĂN KHẾ TRẢ VÀNG</td>";
        } else if (actionName == 'BENLEY') {
            rs += "<td>Cung Hỷ - Phát Tài</td>";
        } else if (actionName == 'Audition') {
            rs += "<td>Audition</td>";
        } else {
            rs += "<td>" + actionName + "</td>";
        }

        serviceName = serviceName.replace("LasVegas", "Thần Bài macao");
        description = description.replace("LasVegas", "Thần Bài macao");
        rs += "<td>" + serviceName + "</td>";
        if (actionName != "CashOutByCard") {
            rs += "<td>" + description + "</td>";
        } else {
            rs += "<td></td>";
        }
        rs += "<td>" + fee + "</td>";

        if (checkMoneyExchange > 0) {
            rs += "<td style='color: #05677d; font-weight: bold; font-size: 17px;'>" + moneyExchange + "</td>";
            rs += "<td style='color: #05677d; font-weight: bold; font-size: 17px;'>" + currentMoney + "</td>";
        } else if (checkMoneyExchange < 0) {
            rs += "<td style='color: #028612; font-weight: bold; font-size: 17px;'>" + moneyExchange + "</td>";
            rs += "<td style='color: #028612; font-weight: bold; font-size: 17px;'>" + currentMoney + "</td>";
        } else {
            rs += "<td style='color: #028612; font-weight: bold; font-size: 17px;'>" + moneyExchange + "</td>";
            rs += "<td style='color: #028612; font-weight: bold; font-size: 17px;'>" + currentMoney + "</td>";
        }

        rs += "<td>" + transactionTime + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resultSearchTransctionNapRut(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.congGiaoDich + "</td>";
        rs += "<td>" + value.giaodich + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + value.nickName + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold; text-align: right;'>" + commaSeparateNumber(Math.abs(value.sotien)) + "</td>";
        rs += "<td>" + value.createAt + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resultSearchTransctionDaily(stt, namesend, namerecive, moneysend, moneyrecive,fee,status,date) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + namesend + "</td>";
        rs += "<td>" + namerecive + "</td>";
        rs += "<td>" + commaSeparateNumber(moneyrecive) + "</td>";
        rs += "<td>" + statustranfer(status) + "</td>";
        rs += "<td>" + date + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resultSearchTransctionUser(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.transId + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + value.nickName + "</td>";
        rs += "<td>" + value.ghiChu + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold; text-align: right;'>" + commaSeparateNumber(Math.abs(value.sotien)) + "</td>";
        rs += "<td>" + value.createAt + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resultSearchTransctionGame(stt, gamename, moneywin, moneylost,moneyother, fee, moneytotal, revenue) {

        var rs = "";
        rs += "<tr>";
        rs += "<td >" + stt + "</td>";
        rs += "<td>" + gamename + "</td>";
        rs += "<td class='rowDataSd2'>" + commaSeparateNumber(moneylost) + "</td>";
        rs += "</tr>";
        return rs;
    }
    function resultSearchTransctionbai(stt, gamename, moneywin, moneylost,moneyother, fee, moneytotal, revenue) {

        var rs = "";
        rs += "<tr>";
        rs += "<td >" + stt + "</td>";
        rs += "<td>" + gamename + "</td>";
        rs += "<td class='moneywinuserbai'>" + commaSeparateNumber(moneywin) + "</td>";
        rs += "<td class='moneylostuserbai'>" + commaSeparateNumber(moneylost) + "</td>";
        rs += "<td class='moneyotheruserbai'>" + commaSeparateNumber(moneyother) + "</td>";
        rs += "<td class='feeuserbai'>" + commaSeparateNumber(fee) + "</td>";
        rs += "<td class='moneytotaluserbai'>" + commaSeparateNumber(moneytotal) + "</td>";
        rs += "<td class='revenueuserbai'>" + commaSeparateNumber(revenue) + "</td>";
        rs += "</tr>";
        return rs;
    }

    function showUserDetail() {
        // Table Nap rut
        var resultNap = "";
        var resultRut = "";
        var resultGc = "";
        var result_USER_CK = "";

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/statisticalajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val(),
                fromDate : $("#fromDate").val(),
                type: 'mongo',
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $('#nickName').html(result.nickName);
                if($("#filter_iname").val() != ""){
                    $("#TableNapRut").show();
                }
                $("#spinner").hide();
                $("#resultsearch").html("");
                sttNap = 1;
                sttRut = 1;
                sttGc = 1;
                stt_USER_CK = 1;
                TotalNap = 0;
                TotalGc = 0;
                TotalRut = 0;
                Total_USER_CK = 0;

                $.each(result.listTrans, function (index, value) {
                    if (value.trangthai.trim().toUpperCase() == 'THÀNH CÔNG' || value.trangthai.trim().toUpperCase() == 'ĐÃ DUYỆT') {
                        switch (value.hinhthucTrans) {
                            case 'MOMO':
                            case 'BANK':
                            case 'CARD':
                            case 'ONE_PAY':
                            case 'ADMIN_TRANSFER_TO_USER':
                                resultNap += resultSearchTransctionNapRut(sttNap,value);
                                TotalNap += Number(value.sotien);
                                sttNap++;
                                break;
                            case 'GIFT_CODE':
                                resultGc += resultSearchTransctionNapRut(sttGc,value);
                                TotalGc += Number(value.sotien);
                                sttGc++;
                                break;
                            case 'RUT_CARD':
                            case 'RUT_BANK':
                                resultRut += resultSearchTransctionNapRut(sttRut,value);
                                TotalRut += Number(value.sotien);
                                sttRut++;
                                break;
                            case 'GAMER':
                                if (value.hinhthuc.trim().toUpperCase() == 'CHUYỂN KHOẢN') {
                                    result_USER_CK += resultSearchTransctionUser(stt_USER_CK,value);
                                    Total_USER_CK += Number(value.sotien);
                                    stt_USER_CK++;
                                }
                                break;
                            default:
                                break;
                        }

                    }
                });

                $('#logactionNap').html(resultNap);
                $('#summoneyNap').html(commaSeparateNumber(TotalNap));

                $('#logactionRut').html(resultRut);
                $('#summoneyRut').html(commaSeparateNumber(Math.abs(TotalRut)));

                $('#logactionGc').html(resultGc);
                $('#summoneyGc').html(commaSeparateNumber(Math.abs(TotalGc)));
                
                $('#logactionChuyenTienUser').html(result_USER_CK);
                $('#summoneyChuyenTienUser').html(commaSeparateNumber(Math.abs(Total_USER_CK)));
                table2 = $('#TableGc').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
                table3 = $('#TableNap').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
                table4 = $('#TableRut').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
                table5 = $('#TableChuyenTienUser').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });

            }, error: function () {
                $("#spinner").hide();
            }, timeout: 40000
        })

        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo admin_url('report/statisticalajax')?>",
        //     // url: "http://192.168.0.251:8082/api_backend",
        //     data: {
        //         nickname: $("#filter_iname").val(),
        //         toDate: $("#toDate").val(),
        //         fromDate : $("#fromDate").val(),
        //         type: 'elk',
        //     },
        //     dataType: 'json',
        //     success: function (result) {
        //         console.log(result);
        //         $('#nickName').html(result.nickName);
        //         $("#spinner").hide();
        //         $("#resultsearch").html("");

        //         // Đại lý nhận
        //         var resultReceive = '';
        //         sttReceive = 1;
        //         var tongnhan = 0;
        //         if(result.listTransReceive) {
        //             $.each(result.listTransReceive, function (index, value) {
        //                 resultReceive += resultSearchTransctionDaily(sttReceive, value.nick_name_send, value.nick_name_receive, value.money_send, value.money_receive, value.fee, value.status, value.trans_time);
        //                 tongnhan += value.money_receive;
        //                 sttReceive++;
        //             });
        //         }
        //         console.log(resultReceive);
        //         $('#logactionNapYouDaiLy').html(resultReceive);
        //         $('#summoneyBanra').html(commaSeparateNumber(tongnhan));

        //         // Đại lý chuyển
        //         var tongchuyen = 0
        //         var resultSend = '';
        //         sttSend = 1;
        //         result.listTransSend?.length && $.each(result.listTransSend, function (index, value) {
        //             resultSend += resultSearchTransctionDaily(sttSend, value.nick_name_send, value.nick_name_receive, value.money_send, value.money_receive, value.fee, value.status, value.trans_time);
        //             sttSend++;
        //             tongchuyen += value.money_send;
        //         });
        //         $('#summoneyMuaVao').html(commaSeparateNumber(tongchuyen));
        //         $('#logactionRutYouDaiLy').html(resultSend);

        //         table1 = $('#checkAllBanra').DataTable({
        //             "ordering": true,
        //             "searching": true,
        //             "paging": false,
        //             "draw": false
        //         });
        //         table1 = $('#checkAllMuaVao').DataTable({
        //             "ordering": true,
        //             "searching": true,
        //             "paging": false,
        //             "draw": false
        //         });


        //     }, error: function () {
        //         $("#spinner").hide();
        //     }, timeout: 40000
        // })

        // SoTien Hien tại

        var result1 = "";
        var result2 = "";
        var result3 = "";
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/moneyuserajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val().split(" ")[0],
                fromDate : $("#fromDate").val().split(" ")[0]
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
                    // $('#logactionbai').html("");
                    $("#resultsearch").html("Hiện tại tài khoản chưa chơi game nào");
                    $("#totalskbai").text("");
                    $("#totalsk").text("");
                    $("#totalmoneywin").text("");
                    $("#totalmoneylost").text("");
                    $("#totalfee").text("");
                    $("#totalmoney").text("");
                    $("#totalrevalue").text("");
                    $("#totalmoneywinbai").text("");
                    $("#totalmoneylostbai").text("");
                    $("#totalfeebai").text("");
                    $("#totalmoneybai").text("");
                    $("#totalrevaluebai").text("");

                } else  {
                    var total=0;
                    var total1=0;
                    var total2=0;
                    var total3=0;
                    var total4=0;
                    var total5=0;
                    var total6=0;
                    var total7 =0;
                    var total8=0;
                    var total9=0;
                    var total10=0;
                    var total11=0;
                    $("#resultsearch").html("");
                    var stt = 0;
                    if(res.users.actionGame.TaiXiu != null) {
                        stt += 1;
                        result1 += resultSearchTransctionGame(stt, "Tài Xỉu", res.users.actionGame.TaiXiu.moneyWin, res.users.actionGame.TaiXiu.moneyLost, res.users.actionGame.TaiXiu.moneyOther, res.users.actionGame.TaiXiu.fee, res.users.actionGame.TaiXiu.revenuePlayGame, res.users.actionGame.TaiXiu.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Tài Xỉu MD5", res.users.actionGame.TaiXiuMd5.moneyWin, res.users.actionGame.TaiXiuMd5.moneyLost, res.users.actionGame.TaiXiuMd5.moneyOther, res.users.actionGame.TaiXiuMd5.fee, res.users.actionGame.TaiXiuMd5.revenuePlayGame, res.users.actionGame.TaiXiuMd5.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Xóc Đĩa", res.users.actionGame.XocDia.moneyWin, res.users.actionGame.XocDia.moneyLost, res.users.actionGame.XocDia.moneyOther, res.users.actionGame.XocDia.fee, res.users.actionGame.XocDia.revenuePlayGame, res.users.actionGame.XocDia.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Bầu Cua", res.users.actionGame.BauCuaTo.moneyWin, res.users.actionGame.BauCuaTo.moneyLost, res.users.actionGame.BauCuaTo.moneyOther, res.users.actionGame.BauCuaTo.fee, res.users.actionGame.BauCuaTo.revenuePlayGame, res.users.actionGame.BauCuaTo.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Cao Bồi", res.users.actionGame.Cowboy.moneyWin, res.users.actionGame.Cowboy.moneyLost, res.users.actionGame.Cowboy.moneyOther, res.users.actionGame.Cowboy.fee, res.users.actionGame.Cowboy.revenuePlayGame, res.users.actionGame.Cowboy.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Fast & Furious", res.users.actionGame.FastAndFurious.moneyWin, res.users.actionGame.FastAndFurious.moneyLost, res.users.actionGame.FastAndFurious.moneyOther, res.users.actionGame.FastAndFurious.fee, res.users.actionGame.FastAndFurious.revenuePlayGame, res.users.actionGame.FastAndFurious.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Lady Night", res.users.actionGame.LadyNight.moneyWin, res.users.actionGame.LadyNight.moneyLost, res.users.actionGame.LadyNight.moneyOther, res.users.actionGame.LadyNight.fee, res.users.actionGame.LadyNight.revenuePlayGame, res.users.actionGame.LadyNight.revenue);
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
                        result1 += resultSearchTrresultSearchTransctionGameansction(stt, "Mậu Binh", res.users.actionGame.Binh.moneyWin, res.users.actionGame.Binh.moneyLost, res.users.actionGame.Binh.moneyOther, res.users.actionGame.Binh.fee, res.users.actionGame.Binh.revenuePlayGame, res.users.actionGame.Binh.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Sâm Lốc", res.users.actionGame.Sam.moneyWin, res.users.actionGame.Sam.moneyLost, res.users.actionGame.Sam.moneyOther, res.users.actionGame.Sam.fee, res.users.actionGame.Sam.revenuePlayGame, res.users.actionGame.Sam.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Big City Boy", res.users.actionGame.BigCityBoy.moneyWin, res.users.actionGame.BigCityBoy.moneyLost, res.users.actionGame.BigCityBoy.moneyOther, res.users.actionGame.BigCityBoy.fee, res.users.actionGame.BigCityBoy.revenuePlayGame, res.users.actionGame.BigCityBoy.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Bồng Lai Các", res.users.actionGame.BongLaiCac.moneyWin, res.users.actionGame.BongLaiCac.moneyLost, res.users.actionGame.BongLaiCac.moneyOther, res.users.actionGame.BongLaiCac.fee, res.users.actionGame.BongLaiCac.revenuePlayGame, res.users.actionGame.BongLaiCac.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Halloween", res.users.actionGame.Halloween.moneyWin, res.users.actionGame.Halloween.moneyLost, res.users.actionGame.Halloween.moneyOther, res.users.actionGame.Halloween.fee, res.users.actionGame.Halloween.revenuePlayGame, res.users.actionGame.Halloween.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Thần Bài macao", res.users.actionGame.LasVegas.moneyWin, res.users.actionGame.LasVegas.moneyLost, res.users.actionGame.LasVegas.moneyOther, res.users.actionGame.LasVegas.fee, res.users.actionGame.LasVegas.revenuePlayGame, res.users.actionGame.LasVegas.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Sexy Dance", res.users.actionGame.SexyDance.moneyWin, res.users.actionGame.SexyDance.moneyLost, res.users.actionGame.SexyDance.moneyOther, res.users.actionGame.SexyDance.fee, res.users.actionGame.SexyDance.revenuePlayGame, res.users.actionGame.SexyDance.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Slot Liên Minh", res.users.actionGame.LienMinh.moneyWin, res.users.actionGame.LienMinh.moneyLost, res.users.actionGame.LienMinh.moneyOther, res.users.actionGame.LienMinh.fee, res.users.actionGame.LienMinh.revenuePlayGame, res.users.actionGame.LienMinh.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Tiến Lên Miền Nam", res.users.actionGame.Tlmn.moneyWin, res.users.actionGame.Tlmn.moneyLost, res.users.actionGame.Tlmn.moneyOther, res.users.actionGame.Tlmn.fee, res.users.actionGame.Tlmn.revenuePlayGame, res.users.actionGame.Tlmn.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Tá Lả", res.users.actionGame.TaLa.moneyWin, res.users.actionGame.TaLa.moneyLost, res.users.actionGame.TaLa.moneyOther, res.users.actionGame.TaLa.fee, res.users.actionGame.TaLa.revenuePlayGame, res.users.actionGame.TaLa.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Liêng", res.users.actionGame.Lieng.moneyWin, res.users.actionGame.Lieng.moneyLost, res.users.actionGame.Lieng.moneyOther, res.users.actionGame.Lieng.fee, res.users.actionGame.Lieng.revenuePlayGame, res.users.actionGame.Lieng.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Xì Tố", res.users.actionGame.XiTo.moneyWin, res.users.actionGame.XiTo.moneyLost, res.users.actionGame.XiTo.moneyOther, res.users.actionGame.XiTo.fee, res.users.actionGame.XiTo.revenuePlayGame, res.users.actionGame.XiTo.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Bài Cào", res.users.actionGame.BaiCao.moneyWin, res.users.actionGame.BaiCao.moneyLost, res.users.actionGame.BaiCao.moneyOther, res.users.actionGame.BaiCao.fee, res.users.actionGame.BaiCao.revenuePlayGame, res.users.actionGame.BaiCao.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Poker", res.users.actionGame.Poker.moneyWin, res.users.actionGame.Poker.moneyLost, res.users.actionGame.Poker.moneyOther, res.users.actionGame.Poker.fee, res.users.actionGame.Poker.revenuePlayGame, res.users.actionGame.Poker.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Minigame Poker", res.users.actionGame.MiniPoker.moneyWin, res.users.actionGame.MiniPoker.moneyLost, res.users.actionGame.MiniPoker.moneyOther, res.users.actionGame.MiniPoker.fee, res.users.actionGame.MiniPoker.revenuePlayGame, res.users.actionGame.MiniPoker.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Minigame Cao Thấp", res.users.actionGame.CaoThap.moneyWin, res.users.actionGame.CaoThap.moneyLost, res.users.actionGame.CaoThap.moneyOther, res.users.actionGame.CaoThap.fee, res.users.actionGame.CaoThap.revenuePlayGame, res.users.actionGame.CaoThap.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Caro", res.users.actionGame.Caro.moneyWin, res.users.actionGame.Caro.moneyLost, res.users.actionGame.Caro.moneyOther, res.users.actionGame.Caro.fee, res.users.actionGame.Caro.revenuePlayGame, res.users.actionGame.Caro.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Cờ tướng", res.users.actionGame.CoTuong.moneyWin, res.users.actionGame.CoTuong.moneyLost, res.users.actionGame.CoTuong.moneyOther, res.users.actionGame.CoTuong.fee, res.users.actionGame.CoTuong.revenuePlayGame, res.users.actionGame.CoTuong.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Minigame Rượu Whisky", res.users.actionGame.CANDY.moneyWin, res.users.actionGame.CANDY.moneyLost, res.users.actionGame.CANDY.moneyOther, res.users.actionGame.CANDY.fee, res.users.actionGame.CANDY.revenuePlayGame, res.users.actionGame.CANDY.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Ba Cây", res.users.actionGame.BaCay.moneyWin, res.users.actionGame.BaCay.moneyLost, res.users.actionGame.BaCay.moneyOther, res.users.actionGame.BaCay.fee, res.users.actionGame.BaCay.revenuePlayGame, res.users.actionGame.BaCay.revenue);
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
                        result1 += resultSearchTransctionGame(stt, "Bắn cá", 0, 0, 0, 0, shootFish, shootFish);
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
                    $("#totalmoneywinbai").text(commaSeparateNumber(total6));
                    $("#totalmoneylostbai").text(commaSeparateNumber(total7));
                    $("#totalskbai").text(commaSeparateNumber(total8));
                    $("#totalfeebai").text(commaSeparateNumber(total9));
                    $("#totalmoneybai").text(commaSeparateNumber(total10));
                    $("#totalrevaluebai").text(commaSeparateNumber(total11));
                    var table = $('#checkAll').DataTable({
                            "ordering": true,
                            "searching": true,
                            "paging": false,
                            "draw": false
                        });
                }

            }, error: function () {
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    }

    function showLichSuGiaoDich() {
        var oldPage = 0;
        var result = "";

        $('#pagination-demo').css("display", "block");
        $("#spinner").show();

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('transaction/indexajax')?>",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                money: $("#money_type").val(),
                servicename: $("#servicename").val(),
                action_name: $("#action_name").val(),
                pages: 1,
                timkiemtheo: $("#timkiemtheo").val(),
                record: $("#record").val(),
                type: $("#typeSearch").val(),
            },



            dataType: 'json',
            success: function(result) {
                $("#resultsearch").html(result);
                $("#spinner").hide();

                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Chưa có giao dịch nào");
                    } else {
                        $("#resultsearch").html("");
                        var totalPage = result.totalPages;
                        stt = 1;
                        $.each(result.transactions, function(index, value) {
                            result += resultSearchTransction(stt, value.transactionTime, value
                                    .nickName, value.actionName, value.description,
                                commaSeparateNumber(value.currentMoney), commaSeparateNumber(
                                    value.moneyExchange), value.serviceName,
                                commaSeparateNumber(value.fee));
                            stt++;

                        });
                        $('#logTransaction').html(result);
                        
                        $('#pagination-demo').twbsPagination({
                            totalPages: totalPage,
                            visiblePages: 5,
                            onPageClick: function(event, page) {
                                if (oldPage > 0) {
                                    $("#spinner").show();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo admin_url('transaction/indexajax')?>",
                                        // url: "http://192.168.0.251:8082/api_backend",
                                        data: {
                                            nickname: $("#filter_iname").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            money: $("#money_type").val(),
                                            servicename: $("#servicename").val(),
                                            action_name: $("#action_name").val(),
                                            pages: page,
                                            timkiemtheo: $("#timkiemtheo").val(),
                                            record: $("#record").val(),
                                            type: $("#typeSearch").val(),
                                        },
                                        dataType: 'json',

                                        success: function(result) {
                                            $("#resultsearch").html("");
                                            $("#spinner").hide();
                                            stt = 1;
                                            $.each(result.transactions, function(
                                                index, value) {
                                                result +=
                                                    resultSearchTransction(
                                                        stt, value
                                                            .transactionTime,
                                                        value.nickName,
                                                        value.actionName,
                                                        value.description,
                                                        commaSeparateNumber(
                                                            value
                                                                .currentMoney),
                                                        commaSeparateNumber(
                                                            value
                                                                .moneyExchange),
                                                        value.serviceName,
                                                        commaSeparateNumber(
                                                            value.fee));
                                                stt++;

                                            });
                                            $('#logTransaction').html(result);
                                           
                                        },
                                        error: function() {
                                            $("#spinner").hide();
                                            $('#logTransaction').html("");
                                            $("#resultsearch").html(
                                                "Hệ thống quá tải. Vui lòng  F5 lại pages"
                                            );
                                        },
                                        timeout: 5 * 60 * 1000,
                                        statusCode: {
                                            502: function() {
                                                $("#spinner").hide();
                                                $('#logTransaction').html("");
                                                $("#resultsearch").html(
                                                    "Hệ thống quá tải. Vui lòng  F5 lại pages"
                                                );
                                            }
                                        }
                                    });
                                }
                                oldPage = page;
                            }
                        });
                    }
            },
            error: function () {
                console.log(66666);
                $("#spinner").hide();
            }, timeout: 50000000
        })
    }

    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        const user = params.get("nn");
        if(user) {
            $("#filter_iname").val(user);
            // showUserDetail();
        }
        if($("#filter_iname").val() != "") {
            showUserDetail();
        } else {
            $("#TableNapRut").hide();
        }
        showLichSuGiaoDich();
        var table = $('#checkAlltransaction').DataTable({
                            "ordering": true,
                            "searching": false,
                            "paging": false,
                            "draw": false
                        });

    });
</script>
<script>
    function commaSeparateNumber(val) {
        if (val === '' || val === undefined ) {
            return;
        }
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function commaSeparateNumber1(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ' ' + '$2');
        }
        return val;
    }
    function statustranfer(feetran){
        var strresult;
        switch (feetran) {
            case 1:
                strresult = "TK thường chuyển Đại lý C1";
                break;
            case 2:
                strresult = "TK thường chuyển Đại lý C2";
                break;
            case 3:
                strresult = "Đại lý C1 chuyển TK thường";
                break;
            case 4:
                strresult = "Đại lý C1 chuyển Đại lý C1";
                break;
            case 5:
                strresult = "Đại lý C1 chuyển Đại lý C2";
                break;
            case 6:
                strresult = "Đại lý C2 chuyển TK thường";
                break;
            case 7:
                strresult = "Đại lý C2 chuyển Đại lý C1";
                break;
            case 8:
                strresult = "Đại lý C2 chuyển Đại lý C2";
                break;
        }
        return strresult;
    }
</script>
