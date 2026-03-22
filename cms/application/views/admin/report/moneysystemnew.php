<title>Chi Tiết Game</title>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
<script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.css">
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
    <?php $this->load->view('admin/error') ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>

        <form class="list_filter form" action="<?php echo admin_url('report/moneysystemnew') ?>" method="post">


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
                            <label for="param_name" style="margin-left: 20px;width: 150px;margin-bottom:-3px;" class="formLeft"> NickName: </label>
                        </td>
                        <td class="item">

                            <div class="input-group " id="">
                                <input type="text" id="nickName" name="nickName" value="<?php echo $nickName ?>">
                            </div>
                        </td>

                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/moneysystemnew') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>

        </form>

        <div class="formRow">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                                <tr style="height: 20px;">
                                    <td>Tiền nạp</td>
                                    <td>Tiền sự kiên</td>
                                    <td style="font-weight: 600;color: #7a6fbe">Tổng nạp<br>(A)</td>
                                    <!-- <td>Tiền đổi thưởng</td> -->
                                    <!-- <td>Tiền lệch đại lý</td> -->
                                    <!--                        <td>Tiền lệch user</td>-->
                                    <td style="font-weight: 600;color: #7a6fbe">Tổng rút<br>(B)</td>
                                    <!-- <td style="font-weight: 600;color: #7a6fbe">Tỉ lệ đổi thưởng<br>(%)</td> -->
                                    <td style="font-weight: 600;color: #7a6fbe">Số dư<br>(A+B)</td>
                                </tr>
                            </thead>
                            <tbody id="logactiontotal"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="formRow">
            <div class="container">
                <div id="tabs-container">
                    <ul class="tabs-menu">
                        <li class="current"><a href="#tab-1">Game</a></li>
                        <li><a href="#tab-2">Tiền vào game</a></li>
                        <li><a href="#tab-3">Tiền ra game</a></li>
                        <li><a href="#tab-4">Tiền khác</a></li>
                        <!--    <li><a href="#tab-5">Bot</a></li>-->
                    </ul>
                    <div class="tab row">
                        <div id="tab-1" class="tab-content col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 id="" style="color: #e72929;margin-left: 10px">
                                        Chú thích: <br>
                                        (A) Tiền User đặt cược trong game;<br>
                                        (B) Tiền trả thưởng cho User thắng cược;<br>
                                        (C) Tiền hoàn trả: Trong game Tài xỉu hoàn trả cược, các game khác là tiền chi sự kiện;<br>
                                        (D) Tiền hệ thống ăn được từ phế giao dịch game;<br>
                                        (F = A - B - C) Tiền doanh thu của game đã bao gồm <b>PHẾ và QUỸ và Hũ (nếu là game SLOT)</b><br>
                                    </h6>
                                </div>
                                <div class="col-sm-12">
                                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                        <thead>
                                            <tr style="height: 20px;">
                                                <td>Tên game</td>
                                                <td>Tiền User cược<br>(A)</td>
                                                <td>Trả thưởng<br>(B)</td>
                                                <td>Tiền hoàn trả<br>(C)</td>
                                                <td>Phế<br>(D)</td>
                                                <td>Quỹ<br>(E)</td>
                                                <td class="col-sm-2">Doanh thu game<br>(F)</td>
                                                <!-- <td>Fund<br>(F)</td> -->
                                                <!-- <td>Doanh thu tổng<br>(D + E)</td> -->
                                            </tr>
                                        </thead>
                                        <tbody id="logaction1"></tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="">Tổng:</td>
                                                <td id="totalmoneylost" style="color:#7a6fbe "></td>
                                                <td id="totalmoneywin" style="color: #7a6fbe"></td>
                                                <td id="totalrefund" style="color: #7a6fbe">0</td>
                                                <td id="totalmoneyfee" style="color: #7a6fbe"></td>
                                                <td id="totalmoneyfund" style="color: #7a6fbe"></td>
                                                <td id="totalmoneyplay" style="color: #7a6fbe"></td>
                                                <!-- <td id="totalfund" style="color: #7a6fbe"></td> -->
                                                <!-- <td id="totalmoney" style="color: #7a6fbe"></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Game bài</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll1" class="table table-bordered" style="table-layout: fixed">
                                    <thead>
                                        <tr style="height: 20px;">
                                            <td>Tên game</td>
                                            <td>Tiền cược</td>
                                            <td>Trả thưởng</td>
                                            <td>Tiền hoàn trả</td>
                                            <td>Tiền sự kiện</td>
                                            <td>Phế</td>
                                            <td class="col-sm-2">Tiền thắng trong game</td>
                                            <td>Tiền thắng tổng</td>
                                        </tr>
                                    </thead>
                                    <tbody id="logaction2"></tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="">Tổng:</td>
                                            <td id="totalmoneylostbai" style="color:#7a6fbe "></td>
                                            <td id="totalmoneywinbai" style="color: #7a6fbe"></td>
                                            <td id="" style="color: #7a6fbe">0</td>
                                            <td id="totalmoneyotherbai" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyfeebai" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyplaybai" style="color: #7a6fbe"></td>
                                            <td id="totalmoneybai" style="color: #7a6fbe"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Game khác</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll1" class="table table-bordered" style="table-layout: fixed">
                                    <thead>
                                        <tr style="height: 20px;">
                                            <td>Tên game</td>
                                            <td>Tiền Vin đổi sang</td>
                                            <td>Tiền đổi sang Vin</td>
                                            <td>Tiền hoàn trả</td>
                                            <td>Tiền sự kiện</td>
                                            <td>Phế (A)</td>
                                            <td class="col-sm-2">Tiền thắng game (B)</td>
                                            <td>Tiền thắng tổng (A+B)</td>
                                        </tr>
                                    </thead>
                                    <tbody id="logactiongamekhac"></tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Tổng</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                    <tbody>
                                        <tr>
                                            <td colspan="">Tổng:</td>
                                            <td id="summoneylost" style="color:#7a6fbe "></td>
                                            <td id="summoneywin" style="color: #7a6fbe"></td>
                                            <td id="sumrefund" style="color: #7a6fbe"></td>
                                            <td id="summoneyother" style="color: #7a6fbe"></td>
                                            <td id="summoneyfee" style="color: #7a6fbe"></td>
                                            <td id="summoneyplay" style="color: #7a6fbe" class="col-sm-2"></td>
                                            <td id="summoney" style="color: #7a6fbe"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->
                            </div>
                        </div>
                        <div id="tab-2" class="tab-content col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                        <tr>
                                            <td rowspan="4" style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tiền nạp user
                                            </td>
                                            <td>Tiền nạp thẻ</td>
                                            <td id="RechargeByCard" class="moneyhtml"></td>
                                        </tr>

                                        <tr>

                                            <td>Ngân hàng</td>
                                            <td id="RechargeByBank" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td>Momo</td>
                                            <td id="RechargeByMomo" class="moneyhtml"></td>
                                        </tr>





                                        <tr>

                                            <td style="color: #7a6fbe;font-weight: 600">Tổng</td>
                                            <td id="totalDeposit" style="color: #7a6fbe;font-weight: 600;text-align: right"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="height: 30px"></td>
                                        </tr>

                                        <tr>
                                            <td rowspan="4" style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tiền sự kiện
                                            </td>
                                            <td>GiftCode</td>
                                            <td id="GiftCode" class="moneyhtml"></td>
                                        </tr>

                                        <tr>

                                            <td>GiftCode vận hành</td>
                                            <td id="GiftCodeVH" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td>Gift code marketing</td>
                                            <td id="GiftCodeMKT" class="moneyhtml"></td>
                                        </tr>


                                        <tr>

                                            <td style="color: #7a6fbe;font-weight: 600">Tổng</td>
                                            <td id="totalInEvent" style="color: #7a6fbe;font-weight: 600; text-align: right">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="height: 30px"></td>
                                        </tr>

                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tổng tiền vào
                                            </td>

                                            <td colspan="2" id="totalMoneyIn" style="vertical-align: middle;text-align: right;color: #e72929;font-weight: 600">
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>

                        </div>
                        <div id="tab-3" class="tab-content col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                        <tr>
                                            <td rowspan="8" style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tiền user đổi thưởng
                                            </td>
                                            <td>Đổi thẻ</td>
                                            <td id="CashOutByCard" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td>Rút qua ngân hàng</td>
                                            <td id="CashOutByBank" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td>Rút qua Momo</td>
                                            <td id="CashOutByMomo" class="moneyhtml"></td>
                                        </tr>

                                        <tr>
                                        <tr>
                                            <td>Chuyển Hoàn</td>
                                            <td id="RefundRechargeError" class="moneyhtml"></td>
                                        </tr>
                                        <tr>
                                            <td>Admin chuyển tiền</td>
                                            <td id="Admin" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td>Phí</td>
                                            <td id="TotalFeeCashout" class="moneyhtml"></td>
                                        </tr>

                                        <tr>

                                            <td style="color: #7a6fbe;font-weight: 600">Tổng</td>
                                            <td id="totalCashout" style="color: #7a6fbe;font-weight: 600;text-align: right"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="height: 30px"></td>
                                        </tr>


                                        <tr>
                                            <td colspan="3" style="height: 30px"></td>
                                        </tr>

                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tổng tiền ra
                                            </td>

                                            <td colspan="2" id="totalMoneyOut" style="vertical-align: middle;text-align: right;color: #e72929;font-weight: 600">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-content col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                        <tr>
                                            <td rowspan="4" style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                                Tiền khác
                                            </td>
                                            <td>Chuyển khoản</td>
                                            <td id="TransferMoney" class="moneyhtml"></td>
                                        </tr>

                                        <tr>
                                            <td>Phí SMS</td>
                                            <td id="ChargeSMS" class="moneyhtml"></td>
                                        </tr>
                                        <tr>
                                            <td>Admin</td>
                                            <td id="Admin" class="moneyhtml"></td>
                                        </tr>
                                        <tr>

                                            <td style="color: #7a6fbe;font-weight: 600">Tổng</td>
                                            <td id="totalOther" style="color: #7a6fbe;font-weight: 600;text-align: right"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="height: 30px"></td>
                                        </tr>
                                        <?php if ($nickName === "") { ?>
                                            <!-- <tr>
                                        <td rowspan="3"
                                            style="vertical-align: middle;text-align: center;color: #e72929;font-weight: 600">
                                            Tiền lệch user
                                        </td>
                                        <td>Đầu</td>
                                        <td id="UserMoneyStart" class="moneyhtml"></td>
                                    </tr>

                                    <tr>

                                        <td>Cuối</td>
                                        <td id="UserMoneyEnd" class="moneyhtml"></td>
                                    </tr>

                                    <tr>

                                        <td style="color: #7a6fbe;font-weight: 600">Tiền lệch</td>
                                        <td id="UserMoneyDiff" style="color: #7a6fbe;font-weight: 600; text-align: right">
                                        </td>
                                    </tr> -->
                                        <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="tab-5" class="tab-content col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Tiền bot</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                    <thead>
                                        <tr style="height: 20px;">
                                            <td>Cộng trừ tiền bot</td>
                                            <td>Admin</td>
                                            <td>Vippoint event</td>
                                        </tr>
                                        <tr style="height: 20px;">
                                            <td id="bot1"></td>
                                            <td id="bot2"></td>
                                            <td id="bot3"></td>
                                        </tr>
                                    </thead>

                                </table>
                            </div>


                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Game</h4>
                                <h6 id="" style="color: #e72929;margin-left: 10px">
                                    Chú thích: <br>
                                    A: Tiền hệ thống ăn được từ phế giao dịch game <br>
                                    B: Tiền hệ thống lãi trong game
                                </h6>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                    <thead>
                                        <tr style="height: 20px;">
                                            <td>Tên game</td>
                                            <td>Tiền cược</td>
                                            <td>Trả thưởng</td>
                                            <td>Tiền hoàn trả</td>
                                            <td>Tiền sự kiện</td>
                                            <td>Phế (A)</td>
                                            <td>Tiền thắng game (B)</td>
                                            <td>Tiền thắng tổng (A+B)</td>
                                        </tr>
                                    </thead>
                                    <tbody id="logactionbot1"></tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="">Tổng:</td>
                                            <td id="totalmoneylostbot" style="color:#7a6fbe "></td>
                                            <td id="totalmoneywinbot" style="color: #7a6fbe"></td>
                                            <td id="totalrefundbot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyotherbot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyfeebot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyplaybot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneybot" style="color: #7a6fbe"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Game bài</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                    <thead>
                                        <tr style="height: 20px;">
                                            <td>Tên game</td>
                                            <td>Tiền cược</td>
                                            <td>Trả thưởng</td>
                                            <td>Tiền hoàn trả</td>
                                            <td>Tiền sự kiện</td>
                                            <td>Phế</td>
                                            <td>Tiền thắng trong game</td>
                                            <td>Tiền thắng tổng</td>
                                        </tr>
                                    </thead>
                                    <tbody id="logactionbot2"></tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="">Tổng:</td>
                                            <td id="totalmoneylostbaibot" style="color:#7a6fbe "></td>
                                            <td id="totalmoneywinbaibot" style="color: #7a6fbe"></td>
                                            <td id="" style="color: #7a6fbe">0</td>
                                            <td id="totalmoneyotherbaibot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyfeebaibot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneyplaybaibot" style="color: #7a6fbe"></td>
                                            <td id="totalmoneybaibot" style="color: #7a6fbe"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <h4 id="" style="color: #e72929;margin-left: 10px">Tổng</h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                                    <tbody>
                                        <tr>
                                            <td colspan="">Tổng:</td>
                                            <td id="summoneylostbot" style="color:#7a6fbe "></td>
                                            <td id="summoneywinbot" style="color: #7a6fbe"></td>
                                            <td id="sumrefundbot" style="color: #7a6fbe"></td>
                                            <td id="summoneyotherbot" style="color: #7a6fbe"></td>
                                            <td id="summoneyfeebot" style="color: #7a6fbe"></td>
                                            <td id="summoneyplaybot" style="color: #7a6fbe"></td>
                                            <td id="summoneybot" style="color: #7a6fbe"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <style>
        .moneyhtml {
            text-align: right;
        }

        .tabs-menu {
            /* height: 30px; */
            /*float: left;*/
            clear: both;
        }

        .tabs-menu li {
            height: 30px;
            line-height: 30px;
            float: left;
            margin-right: 10px;
            background-color: #ccc;
            /* border-top: 1px solid #d4d4d1;
        border-right: 1px solid #d4d4d1;
        border-left: 1px solid #d4d4d1; */
        }

        .tabs-menu li.current {
            position: relative;
            background-color: #fff;
            /* border-bottom: 1px solid #fff; */
            z-index: 5;
        }

        .tabs-menu li a {
            padding: 10px;
            text-transform: uppercase;
            color: #fff;
            text-decoration: none;
        }

        .tabs-menu .current a {
            color: #2e7da3;
        }

        .tab {
            /* border: 1px solid #d4d4d1; */
            background-color: #fff;
            float: left;
            margin-bottom: 20px;
            width: auto;
            -webkit-box-shadow: 0 -3px 31px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
            box-shadow: 0 -3px 31px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
        }

        .tab-content {
            width: 100%;
            padding: 20px;
            display: none;
        }

        #tab-1 {
            display: block;
        }

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
                format: 'YYYY-MM-DD'
            });
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD'
            });

        });
        $("#search_tran").click(function() {

        });
        const GAME_NAME = {
            TaiXiu: "Tài Xỉu",
            TaiXiuMd5: "Tài Xỉu MD5",
            XocDia: "Xóc Đĩa",
            BauCuaTo: "Bầu Cua",
            Cowboy: "Slot Cao Bồi",
            CANDY: "Rượu Whisky",
            FastAndFurious: "Slot Fast And Furious",
            LadyNight: "Slot Lady Night",
            BigCityBoy: "Slot Big City Boy",
            BongLaiCac: "Slot Bồng Lai Các",
            Halloween: "Slot Halloween",
            LasVegas: "Slot Thần bài Ma Cao",
            SexyDance: "Slot Sexy Dance",
            LienMinh: "SLot Liên Minh",
            KimCuong: "Kim Cương",
            MiniPoker: "Mini Poker",
            CaoThap: "Cao Thấp",
            Lode: "Lô Đề",
            Sport: "Thể Thao",
            ShootFish: "Bắn cá",
            BaiCao: "Bài Cào",
            Binh: "Mậu Binh",
            Sam: "Sâm Lốc",
            Tlmn: "Tiến Lên Miền Nam",
            Poker: "Poker",
            BaCay: "Ba Cây",
        }

        function resultSearchTransaction(gameAction, moneywin, moneylost, moneyother, fee, moneytotal, revenue, fund) {

            var rs = "";
            rs += "<tr>";
            rs += `<td>${GAME_NAME[gameAction] || gameAction}</td>`;
            rs += "<td class='moneylostuser'>" + commaSeparateNumber(-moneylost) + "</td>";
            rs += "<td class='moneywinuser'>" + commaSeparateNumber(moneywin) + "</td>";
            rs += "<td class='moneyotheruser'>" + commaSeparateNumber(moneyother) + "</td>";
            rs += "<td class='feeuser'>" + commaSeparateNumber(fee) + "</td>";
			// if(gameAction === 'MiniPoker' 9th Sept a T need remove
			// 	|| gameAction === 'CANDY' 
			// 	|| gameAction === 'Cowboy' 
			// 	|| gameAction === 'FastAndFurious' 
			// 	|| gameAction === 'LadyNight' 
			// 	|| gameAction === 'BigCityBoy' 
			// 	|| gameAction === 'BongLaiCac'
			// 	|| gameAction === 'Halloween'
			// 	|| gameAction === 'LasVegas'
			// 	|| gameAction === 'SexyDance'
			// 	|| gameAction === 'LienMinh') {
			// 	rs += "<td class='moneytotalfun'>" + commaSeparateNumber(-moneytotal - fee * 2) + "</td>";
			// } else {
				rs += "<td class='moneytotalfun'>" + commaSeparateNumber(-moneytotal - fee) + "</td>";
			// }9th Sept a T need remove
            rs += "<td class='moneytotaluser'>" + commaSeparateNumber(-moneytotal) + "</td>";
            // rs += "<td class='funduser'>" + commaSeparateNumber(fund) + "</td>";
            // rs += "<td class='revenueuser'>" + commaSeparateNumber(-revenue) + "</td>";
            rs += "</tr>";
            return rs;
        }

        function resulttotal(inuser, inevent, totalin, outuser, totalout, ratio) {

            var rs = "";
            rs += "<tr style='color: #7a6fbe'>";
            rs += "<td >" + commaSeparateNumber(inuser) + "</td>";
            rs += "<td>" + commaSeparateNumber(inevent) + "</td>";
            rs += "<td>" + commaSeparateNumber(totalin) + "</td>";
            rs += "<td>" + commaSeparateNumber(totalout) + "</td>";
            // rs += "<td>" + ratio + "%" + "</td>";
            rs += "<td>" + commaSeparateNumber(totalin - (-totalout)) + "</td>";
            rs += "</tr>";
            return rs;
        }

        $(document).ready(function() {
            var result1 = "";
            var result2 = "";
            var result3 = "";
            var result4 = "";
            var result11 = "";
            var result22 = "";
            var result33 = "";
            var result44 = "";
            $(".tabs-menu a").click(function(event) {
                event.preventDefault();
                $(this).parent().addClass("current");
                $(this).parent().siblings().removeClass("current");
                var tab = $(this).attr("href");
                $(".tab-content").not(tab).css("display", "none");
                $(tab).fadeIn();
            });
            $("#spinner").show();
            let realToDate = $("#toDate").val();
            let toDate = moment(realToDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
            let fromDate = moment($("#fromDate").val(),'YYYY-MM-DD').format('YYYY-MM-DD');
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('report/moneysystemajax') ?>",
                data: {
                    toDate: toDate,
                    fromDate,
                    nickName: $("#nickName").val()
                },

                dataType: 'json',
                success: function(res) {
                    $("#spinner").hide();
                    $("#resultsearch").html("");
                    var sumBet = 0;
                    var sumReward = 0;
                    var sumRefund = 0;
                    var sumFee = 0;
					var sumFeeWithJackpot = 0;
                    var sumPlayGame = 0;
                    var sumTotal = 0;
                    // sum deposit
                    var sumDeposit = 0;
                    var sumInEvent = 0;
                    var sumFeeIn = 0;
                    // sum cashout
                    var sumCashout = 0;
                    var sumFeeCashout = 0;
                    var sumFeeRefundError = 0;
                    // sum other
                    var sumOther = 0;
                    var sumFund = 0;
                    // process game data
                    if (res.ListReportGame !== undefined && res.ListReportGame != null) {
                        var resGame = res.ListReportGame;
                        for (i = 0; i < resGame.length; i++) {
                            result2 += resultSearchTransaction(resGame[i].actionName, resGame[i].moneyWin,
                                resGame[i].moneyLost, resGame[i].moneyOther, resGame[i].fee,
                                resGame[i].revenuePlayGame, resGame[i].revenue, resGame[i].fund);
                            sumBet += resGame[i].moneyLost;
                            sumReward += resGame[i].moneyWin;
                            sumRefund += resGame[i].moneyOther;
                            sumFee += resGame[i].fee;
							if(resGame[i].actionName === 'MiniPoker' 
								|| resGame[i].actionName === 'CANDY' 
								|| resGame[i].actionName === 'Cowboy' 
								|| resGame[i].actionName === 'FastAndFurious' 
								|| resGame[i].actionName === 'LadyNight' 
								|| resGame[i].actionName === 'BigCityBoy' 
								|| resGame[i].actionName === 'BongLaiCac'
								|| resGame[i].actionName === 'Halloween'
								|| resGame[i].actionName === 'LasVegas'
								|| resGame[i].actionName === 'SexyDance'
								|| resGame[i].actionName === 'LienMinh') {
								sumFeeWithJackpot += resGame[i].fee * 2;	
							} else {
								sumFeeWithJackpot += resGame[i].fee;
							}
                            sumPlayGame += resGame[i].revenuePlayGame;
                            sumTotal += resGame[i].revenue;
                            sumFund += resGame[i].fund;
                        }
                    }
                    //Loi nhuan ban ca

                    if (res.totalShootFishProfit) {
                        const shootFish = -res.totalShootFishProfit
                        result2 += resultSearchTransaction('Bắn Cá', 0, 0, 0, 0, shootFish, shootFish, 0);
                        sumPlayGame += shootFish;
                        sumTotal += shootFish;
                    }
                    $('#logaction1').html(result2);


                    if (res.ListUserIn !== undefined && res.ListUserIn != null) {
                        var resGame = res.ListUserIn;
                        for (i = 0; i < resGame.length; i++) {
                            $("#" + resGame[i].actionName).html(commaSeparateNumber(resGame[i].total));
                            sumDeposit += resGame[i].total;
                            sumFeeIn += resGame[i].fee;
                        }

                    }
                    if (res.ListUserInEvent !== undefined && res.ListUserInEvent != null) {
                        var resGame = res.ListUserInEvent;
                        for (i = 0; i < resGame.length; i++) {
                            $("#" + resGame[i].actionName).html(commaSeparateNumber(resGame[i].total));
                            sumInEvent += resGame[i].total;
                            sumFeeIn += resGame[i].fee;
                        }

                    }
                    if (res.ListUserOut !== undefined && res.ListUserOut != null) {
                        var resGame = res.ListUserOut;
                        for (i = 0; i < resGame.length; i++) {
                            $("#" + resGame[i].actionName).html(commaSeparateNumber(resGame[i].total));
                            if (resGame[i].actionName == "RefundRechargeError") {
                                sumFeeRefundError += resGame[i].fee;
                            } else {
                                sumFeeCashout += resGame[i].fee;
                            }
                            sumCashout += resGame[i].total;

                        }

                    }
                    if (res.ListOther !== undefined && res.ListOther != null) {
                        var resGame = res.ListOther;
                        for (i = 0; i < resGame.length; i++) {
                            $("#" + resGame[i].actionName).html(commaSeparateNumber(resGame[i].total));
                            sumOther += resGame[i].total;
                        }

                    }
                    $("#totalmoneylost").html(commaSeparateNumber(-sumBet));
                    $("#totalmoneywin").html(commaSeparateNumber(sumReward));
                    $("#totalrefund").html(commaSeparateNumber(sumRefund));

                    $("#totalmoneyfee").html(commaSeparateNumber(sumFee));
                    $("#totalmoneyplay").html(commaSeparateNumber(-sumPlayGame));
                    $("#totalmoneyfund").html(commaSeparateNumber(-sumPlayGame - sumFee));
                    // $("#totalfund").html(commaSeparateNumber(sumFund));
                    $("#totalmoney").html(commaSeparateNumber(-sumTotal));
                    // money in
                    $("#totalDeposit").html(commaSeparateNumber(sumDeposit))
                    $("#totalInEvent").html(commaSeparateNumber(sumInEvent))
                    $("#totalMoneyIn").html(commaSeparateNumber(sumInEvent + sumDeposit))

                    // money out
                    var totalFeeCashoutAndRefund = sumFeeCashout - sumFeeRefundError;
                    $("#totalCashout").html(commaSeparateNumber(sumCashout + totalFeeCashoutAndRefund));

                    $("#TotalFeeCashout").html(commaSeparateNumber(totalFeeCashoutAndRefund));


                    $("#totalMoneyOut").html(commaSeparateNumber(sumCashout + totalFeeCashoutAndRefund));

                    // money other
                    // $("#UserMoneyStart").html(commaSeparateNumber(res.UserMoney.userStart));
                    // $("#UserMoneyEnd").html(commaSeparateNumber(res.UserMoney.userEnd));
                    // $("#UserMoneyDiff").html(commaSeparateNumber(res.UserMoney.userEnd - res.UserMoney.userStart));
                    var sumUser = res.UserMoney.userEnd - res.UserMoney.userStart;
                    $("#totalOther").html(commaSeparateNumber(sumOther));

                    //sumary
                    sumCashout += totalFeeCashoutAndRefund;
                    var totalCashout = sumCashout;
                    var totalDeposit = sumInEvent + sumDeposit;
                    var percenCashout = ((-totalCashout)) / (totalDeposit) * 100;
                    percenCashout = percenCashout.toFixed(2);
                    var result44 = resulttotal(sumDeposit, sumInEvent, totalDeposit, sumCashout, totalCashout, percenCashout);
                    $('#logactiontotal').html(result44);





                },
                error: function() {
                    $("#spinner").hide();
                    $("#error-popup").modal("show");
                },
                timeout: 40000
            })
        });
    </script>
    <script>
        function commaSeparateNumber(val) {
            if (val == undefined) {
                return 0;
            }
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
            }
            return val;
        }
    </script>