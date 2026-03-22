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
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>

    
    <div class="widget" style="background: #cddee8; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h3 style="color: #733000; text-align: center; font-size: 30px; font-weight: bold;">THỐNG KÊ</h3>
        </div>

        <form class="list_filter form" action="<?php echo admin_url('report/statistical') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>


                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>

                        <td><label style="margin-left:15px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-top:30px;width: 150px" id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>

                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 50px">
                        </td>
                        <td class="">
                            <select id="ts" name="ts"
                                    style="margin-left: 20px;margin-bottom:-2px;width: 100px">
                                <option value="elk">elk</option>
                                <option value="mongo">mongo</option>
                            </select>
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/statistical') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
						
						<td style="">
                            <input type="submit" id="delete_log" value="Xóa Log" class="button blueB" style="margin-left: 50px">
                        </td>
                    </tr>
                </table>
            </div><!-- formRow -->
        </form><!-- list_filter -->
        <hr>
        <div id="doanhThu" style="display: none;">
            <h2 style="color: #158202; text-align: center; font-size: 27px; font-weight: bold;">Doanh thu ước tính</h2>
            <h2 style="color: #158202; text-align: center; font-size: 40px; font-weight: bold;"><span id="summoney_loinhuan">0</span></h2>
        </div>
        <div id="soDuHienTai" style="display: none;">
            <div class="formRow">
                <h4 style="font-size: 22px; color: #080a62; font-weight: bold">Tài khoản:<span id="typetaikhoan" style="color: #f80000"></span>  Số dư YOU:<span id="vinht" style="color: #f80000"></span>  Két sắt: <span id="ketsat" style="color: #f80000"></span> Tổng YOU: <span id="totalvin" style="color: #f80000"></span></h4>
            </div>
            <!-- <h1 style="text-align: center;">Số dư hiện tại: <span id="nickName" style="font-size: 45px; color: #021d6b; font-weight: bold;"></span> còn <span id="currentMoney" style="font-size: 45px;color: #ff0a0a; font-weight: bold;">0</span></h1> -->
        </div>
        <hr>
        <div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Nạp Ngân Hàng: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap_BANK">0</span></h4>
                    <button id="btnExportNapNganHang" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNapBank" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionNap_BANK">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->

            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Rút Ngân hàng: <br><span style="font-size: 30px;color: #e42708;" id="summoneyRut_BANK">0</span></h4>
                    <button id="btnExportRutNganHang" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableRutBank" style="background: #fffed9;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #a51700;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>Mã giao dịch</td>
                            <td>Nickname</td>
                            <td>Số Tiền</td>
                            <td>Thời gian</td>
                        </tr>
                    </thead>
                    <tbody id="logactionRut_BANK">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
        </div><!-- Content-table -->

        <div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Nạp THẺ CÀO: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap_CARD">0</span></h4>
                    <button id="btnExportNapTheCao" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNapTheCao" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionNap_CARD">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->

            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Rút THẺ CÀO: <br><span style="font-size: 30px;color: #e42708;" id="summoneyRut_RUT_CARD">0</span></h4>
                    <button id="btnExportRutTheCao" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableRutTheCao" style="background: #fffed9;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #a51700;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>Mã giao dịch</td>
                            <td>Nickname</td>
                            <td>Số Tiền</td>
                            <td>Thời gian</td>
                        </tr>
                    </thead>
                    <tbody id="logactionRut_RUT_CARD">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
        </div><!-- Content-table -->

        <div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Thưởng active telegram <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap_ONE_PAY">0</span></h4>
                    <button id="btnExportNapOnePay" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNapOnePay" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionNap_ONE_PAY">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Nạp MO MO: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap_MOMO">0</span></h4>
                    <button id="btnExportNapMoMo" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNapMoMo" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionNap_MOMO">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
            
        </div><!-- Content-table -->
		
		<div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>Tổng Nạp CODEPAY: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyNap_CODEPAY">0</span></h4>
                    <!--<button id="btnExportNapMoMo" class="basic" style="padding: 3px 18px;"> EXPORT </button>-->
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableNapCodePay" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionNap_CODEPAY">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
            
        </div><!-- Content-table -->

        <hr>

        <div id="TableDaily">
            <div Class="Content-table">

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>Nạp YOU đại lý<br><span style="font-size: 30px;color: #021d6b;" id="summoneyNapYou">0</span></h4>
                        <button id="btnExportNapYou" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllNapYouDaiLy" style="background: #e0ffff;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #0096a5;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>TK Chuyển</td>
                            <td>TK Nhận</td>
                            <td>Số tiền</td>
                            <td>Trạng thái</td>
                            <td>Thời gian</td>
                        </tr>
                        </thead>
                        <tbody id="logactionNapYouDaiLy">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>Rút YOU đại lý<br><span style="font-size: 30px;color: #e42708;" id="summoneyRutYou">0</span></h4>
                        <button id="btnExportRutYou" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllRutYouDaiLy" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>TK Chuyển</td>
                                <td>TK Nhận</td>
                                <td>Số tiền</td>
                                <td>Trạng thái</td>
                                <td>Thời gian</td>
                            </tr>
                        </thead>
                        <tbody id="logactionRutYouDaiLy">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->
        </div>

        <hr>

        <div Class="Content-table">

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>CHUYỂN TIỀN VÀO BÓNG ĐÁ<br><span style="font-size: 30px;color: #021d6b;" id="summoneyChuyenTienBongDa">0</span></h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllChuyenTienBongDa" style="background: #e0ffff;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #0096a5;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>NickName</td>
                            <td>Mô tả</td>
                            <td>Số tiền chuyển vào</td>
                            <td>Số tiền hiện tại</td>
                            <td>Thời gian</td>
                        </tr>
                        </thead>
                        <tbody id="logactionChuyenTienBongDa">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>RÚT RA TỪ BÓNG ĐÁ<br><span style="font-size: 30px;color: #e42708;" id="summoneyNhanTienBongDa">0</span></h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllNhanTienBongDa" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>NickName</td>
                                <td>Mô tả</td>
                                <td>Số tiền rút ra</td>
                                <td>Số tiền hiện tại</td>
                                <td>Thời gian</td>
                            </tr>
                        </thead>
                        <tbody id="logactionNhanTienBongDa">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->


        <hr>

        <div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>NGƯỜI CHƠI CHUYỂN TIỀN: <br><span style="font-size: 30px;color: #021d6b;" id="summoneyChuyenTienUser">0</span></h4>
                    <button id="btnExportChuyenTienUser" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableChuyenTienUser" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>TK Chuyển</td>
                        <td>TK Nhận</td>
                        <td>Số Tiền</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logactionChuyenTienUser">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
        </div><!-- Content-table -->

        <hr>

        <div Class="Content-table">
            <div class="Content-table-item">
                <div class="Content-table-item__ttl formRow">
                    <h4>LOG ADMIN: <br><span style="font-size: 30px;color: #021d6b;" id="summoney_ADMIN_ACT">0</span></h4>
                    <button id="btnExportDaily" class="basic" style="padding: 3px 18px;"> EXPORT </button>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="TableAdminAct" style="background: #e0ffff;display: block; border: 1px solid green; max-height: 600px; overflow-y: scroll">
                    <thead style="height: 35px; background: #0096a5;">
                    <tr style="height: 35px;">
                        <td>STT</td>
                        <td>Mã giao dịch</td>
                        <td>Nickname</td>
                        <td>Loại tài khoản</td>
                        <td>Hình thức</td>
                        <td>Số Tiền</td>
                        <td>Trạng thái</td>
                        <td>Lý do chuyển</td>
                        <td>Thời gian</td>
                    </tr>
                    </thead>
                    <tbody id="logaction_ADMIN_ACT">
                    </tbody>
                </table>
            </div><!-- Content-table-item -->
            <div class="Content-table-item">
            </div><!-- Content-table-item -->
        </div><!-- Content-table -->

    </div>
</div>
<style>
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

    .tab {
        /* border: 1px solid #d4d4d1; */
        background-color: #fff;
        float: left;
        margin-bottom: 20px;
        width: auto;
        -webkit-box-shadow: 0 -3px 31px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
        box-shadow: 0 -3px 31px 0 rgba(0, 0, 0, 0.05), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
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
</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
	
	$("#delete_log").click(function () {
		if(!confirm('Bạn chắc chắn muốn Xóa log ?')){
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/deletelogjax')?>",
            data: {
                nickname: $("#filter_iname").val()
            },

            dataType: 'json',
            success: function (res) {
				console.log(res);
				//alert('Ngày kết thúc phải lớn hơn ngày bắt đầu');
            }, error: function () {
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    });

    $("#btnExportNapNganHang").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_NAP_NGAN_HANG_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableNapBank');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_KE_NAP"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportRutNganHang").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_RUT_NGAN_HANG_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableRut = document.getElementById('TableRutBank');
        var wb = XLSX.utils.table_to_book(tableRut, {sheet: "YOU88_THONG_KE_RUT"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportNapTheCao").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_NAP_THE_CAO_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableNapTheCao');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_KE_NAP"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportRutTheCao").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_RUT_THE_CAO_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableRutTheCao');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_KE_RUT"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportNapMoMo").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_NAP_MO_MO_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableNapMoMo');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_KE_NAP"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportNapOnePay").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_NAP_ONE_PAY_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableNapOnePay');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_KE_NAP"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportDaily").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_Chuyen_you_ADMIN_ACT_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableAdminAct');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88_THONG_DAI_LY"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportNapYou").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_NAP_YOU_DAI_LY_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('checkAllNapYouDaiLy');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportRutYou").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_RUT_YOU_DAI_LY_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('checkAllRutYouDaiLy');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });

    $("#btnExportChuyenTienUser").click(function(e) {
        e.preventDefault()
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        var fileName = 'THONG_KE_ChuyenTienUser_from_' + fromDatetime +'_to_'+ toDatetime;
        var tableNap = document.getElementById('TableChuyenTienUser');
        var wb = XLSX.utils.table_to_book(tableNap, {sheet: "YOU88"});
        return XLSX.writeFile(wb, null || (fileName + '.xlsx'));
    });


    function resultSearchTransction(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.transId + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + value.nickName + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold; text-align: right;'>" + commaSeparateNumber(Math.abs(value.sotien)) + "</td>";
        rs += "<td>" + value.createAt + "</td>";
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

    function resultSearchTransction_Daily(stt, transId, nickName, congGiaoDich, hinhthuc, sotien, trangthai, ghiChu, createAt, hinhthucTrans) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + transId + "</td>";
        rs += "<td style='color: #297900;font-weight: bold;'>" + nickName + "</td>";
        if (hinhthucTrans === 'ADMIN_TRANSFER_TO_DAILY') {
            rs += "<td>Đại lý</td>";
        } else {
            rs += "<td>User</td>";
        }
        rs += "<td>" + hinhthuc + "</td>";
        rs += "<td style='color: #0008ff;font-weight: bold; text-align: right;'>" + commaSeparateNumber(Math.abs(sotien)) + "</td>";
        rs += "<td>" + trangthai + "</td>";
        rs += "<td>" + ghiChu + "</td>";
        rs += "<td>" + createAt + "</td>";
        rs += "</tr>";
        return rs;
    }

    function resultSearchTransctionDaily(stt, namesend, namerecive, moneysend, moneyrecive,fee,status,date) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + namesend + "</td>";
        rs += "<td>" + namerecive + "</td>";
        // rs += "<td>" + commaSeparateNumber(moneysend) + "</td>";
        rs += "<td>" + commaSeparateNumber(moneyrecive) + "</td>";
        // rs += "<td>" + commaSeparateNumber(fee) + "</td>";
        rs += "<td>" + statustranfer(status) + "</td>";
        rs += "<td>" + date + "</td>";
        rs += "</tr>";
        return rs;
    }

    
    function resultSearchTienBongDa(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.nickName + "</td>";
        rs += "<td>" + value.description + "</td>";
        rs += "<td>" + commaSeparateNumber(value.moneyExchange) + "</td>";
        rs += "<td>" + commaSeparateNumber(value.currentMoney) + "</td>";
        rs += "<td>" + value.transactionTime + "</td>";
        rs += "</tr>";
        return rs;
    }

    $(document).ready(function () {
        var resultNap_MOMO = "";
		var resultNap_CODEPAY = "";
        var resultNap_BANK = "";
        var resultNap_CARD = "";
        var resultNap_ONE_PAY = "";
        var resultRut_RUT_CARD = "";
        var resultRut_RUT_BANK = "";
        var result_ADMIN_ACT = "";
        var result_USER_CK = "";
        
        var TotalDoanhThuUocTinh = 0;
        $("#spinner").show();
        // var type_search = document.getElementById('ts').value();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/statisticalajax')?>",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                //type: $("#typeSearch").val(),
                type: $("#ts").val()
            },
            dataType: 'json',
            success: function (result) {

                if(result.nickName != "") {
                    $('#soDuHienTai').show()
                    $('#doanhThu').hide()
                    $('#currentMoney').html(commaSeparateNumber(result.currentMoney));
                    $('#nickName').html(result.nickName);
                } else {
                    $('#soDuHienTai').hide()
                    $('#doanhThu').show()
                }

                $("#spinner").hide();
                if (result.listTrans == "") {
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    sttNap_MOMO = 1;
					sttNap_CODEPAY = 1;
                    sttNap_BANK = 1;
                    sttNap_CARD = 1;
                    sttNap_ONE_PAY = 1;
                    sttRut_RUT_CARD = 1;
                    sttRut_RUT_BANK = 1;
                    stt_ADMIN_ACT = 1;
                    stt_USER_CK = 1;

                    TotalNap_MOMO = 0;
					TotalNap_CODEPAY = 0;
                    TotalNap_BANK = 0;
                    TotalNap_CARD = 0;
                    TotalNap_ONE_PAY = 0;
                    TotalRut_RUT_CARD = 0;
                    TotalRut_RUT_BANK = 0;
                    Total_ADMIN_ACT = 0;
                    Total_USER_CK = 0;

                    $.each(result.listTrans, function (index, value) {
                        if (value.trangthai.trim().toUpperCase() == 'THÀNH CÔNG' || value.trangthai.trim().toUpperCase() == 'ĐÃ DUYỆT') {
                            switch (value.hinhthucTrans) {
                                case 'MOMO':
                                    resultNap_MOMO += resultSearchTransction(sttNap_MOMO,value);
                                    TotalNap_MOMO += Number(value.sotien);
                                    sttNap_MOMO++;
                                    break;
                                case 'BANK':
									if(value.congGiaoDich.trim().toUpperCase() == 'MOMO') {
										resultNap_MOMO += resultSearchTransction(sttNap_MOMO,value);
										TotalNap_MOMO += Number(value.sotien);
										sttNap_MOMO++;
									} else if (value.congGiaoDich.trim().toUpperCase() == 'CODEPAY') {
										resultNap_CODEPAY += resultSearchTransction(sttNap_CODEPAY,value);
										TotalNap_CODEPAY += Number(value.sotien);
										sttNap_CODEPAY++;
									} else {
										resultNap_BANK += resultSearchTransction(sttNap_BANK,value);
										TotalNap_BANK += Number(value.sotien);
										sttNap_BANK++;
									}
									break;
                                case 'CARD':
                                    resultNap_CARD += resultSearchTransction(sttNap_CARD,value);
                                    TotalNap_CARD += Number(value.sotien);
                                    sttNap_CARD++;
                                    break;
                                case 'ONE_PAY':
                                    resultNap_ONE_PAY += resultSearchTransction(sttNap_ONE_PAY,value);
                                    TotalNap_ONE_PAY += Number(value.sotien);
                                    sttNap_ONE_PAY++;
                                    break;
                                case 'RUT_CARD':
                                    resultRut_RUT_CARD += resultSearchTransction(sttRut_RUT_CARD,value);
                                    TotalRut_RUT_CARD += Number(value.sotien);
                                    sttRut_RUT_CARD++;
                                    break;
                                case 'RUT_BANK':
                                    resultRut_RUT_BANK += resultSearchTransction(sttRut_RUT_BANK,value);
                                    TotalRut_RUT_BANK += Number(value.sotien);
                                    sttRut_RUT_BANK++;
                                    break;
                                case 'ADMIN_TRANSFER_TO_DAILY':
                                    result_ADMIN_ACT += resultSearchTransction_Daily(stt_ADMIN_ACT, value.transId, value.nickName, value.congGiaoDich, value.hinhthuc, value.sotien, value.trangthai, value.ghiChu, value.createAt, value.hinhthucTrans);
                                    Total_ADMIN_ACT += Number(value.sotien);
                                    stt_ADMIN_ACT++;
                                    break;
                                case 'ADMIN_TRANSFER_TO_USER':
                                    result_ADMIN_ACT += resultSearchTransction_Daily(stt_ADMIN_ACT, value.transId, value.nickName, value.congGiaoDich, value.hinhthuc, value.sotien, value.trangthai, value.ghiChu, value.createAt, value.hinhthucTrans);
                                    Total_ADMIN_ACT += Number(value.sotien);
                                    stt_ADMIN_ACT++;
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

                    // var Total_loinhuan = TotalNap_MOMO + TotalNap_CODEPAY + TotalNap_BANK + TotalNap_CARD + TotalNap_ONE_PAY + TotalRut_RUT_CARD + TotalRut_RUT_BANK;
                    var Total_loinhuan = TotalNap_MOMO + TotalNap_CODEPAY + TotalNap_BANK + TotalNap_CARD  + TotalRut_RUT_CARD + TotalRut_RUT_BANK;
                    TotalDoanhThuUocTinh += Total_loinhuan;
                    $('#summoney_loinhuan').html(commaSeparateNumber(TotalDoanhThuUocTinh));

                    $('#logactionNap_MOMO').html(resultNap_MOMO);
                    $('#summoneyNap_MOMO').html(commaSeparateNumber(TotalNap_MOMO));
                    var table = $('#TableNapMoMo').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

					$('#logactionNap_CODEPAY').html(resultNap_CODEPAY);
                    $('#summoneyNap_CODEPAY').html(commaSeparateNumber(TotalNap_CODEPAY));
                    var table = $('#TableNapCodePay').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logactionNap_BANK').html(resultNap_BANK);
                    $('#summoneyNap_BANK').html(commaSeparateNumber(TotalNap_BANK));
                    var table = $('#TableNapBank').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logactionNap_CARD').html(resultNap_CARD);
                    $('#summoneyNap_CARD').html(commaSeparateNumber(TotalNap_CARD));
                    var table = $('#TableNapTheCao').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logactionNap_ONE_PAY').html(resultNap_ONE_PAY);
                    $('#summoneyNap_ONE_PAY').html(commaSeparateNumber(TotalNap_ONE_PAY));
                    var table = $('#TableNapOnePay').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logaction_ADMIN_ACT').html(result_ADMIN_ACT);
                    $('#summoney_ADMIN_ACT').html(commaSeparateNumber(Total_ADMIN_ACT));
                    var table = $('#TableAdminAct').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });


                    $('#logactionRut_RUT_CARD').html(resultRut_RUT_CARD);
                    $('#summoneyRut_RUT_CARD').html(commaSeparateNumber(Math.abs(TotalRut_RUT_CARD)));
                    var table = $('#TableRutTheCao').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logactionRut_BANK').html(resultRut_RUT_BANK);
                    $('#summoneyRut_BANK').html(commaSeparateNumber(Math.abs(TotalRut_RUT_BANK)));
                    var table = $('#TableRutBank').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                    $('#logactionChuyenTienUser').html(result_USER_CK);
                    $('#summoneyChuyenTienUser').html(commaSeparateNumber(Math.abs(Total_USER_CK)));
                    var table = $('#TableChuyenTienUser').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });

                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000000
        })


        //$.ajax({
        //    type: "POST",
        //    url: "<?php //echo admin_url('report/statisticalajax')?>//",
        //    data: {
        //        nickname: $("#filter_iname").val(),
        //        toDate: $("#toDate").val(),
        //        fromDate: $("#fromDate").val(),
        //        //type: $("#typeSearch").val(),
        //        type: 'elk'
        //    },
        //    dataType: 'json',
        //    success: function (result) {
        //
        //        if(result.nickName != "") {
        //            $('#soDuHienTai').show()
        //            $('#doanhThu').hide()
        //            $('#currentMoney').html(commaSeparateNumber(result.currentMoney));
        //            $('#nickName').html(result.nickName);
        //        } else {
        //            $('#soDuHienTai').hide()
        //            $('#doanhThu').show()
        //        }
        //
        //        $("#spinner").hide();
        //        if (result.listTrans == "") {
        //            $("#resultsearch").html("Không tìm thấy kết quả");
        //        } else {
        //            $("#resultsearch").html("");
        //            sttNap_MOMO = 1;
        //            sttNap_BANK = 1;
        //            sttNap_CARD = 1;
        //            sttNap_ONE_PAY = 1;
        //            sttRut_RUT_CARD = 1;
        //            sttRut_RUT_BANK = 1;
        //            stt_ADMIN_ACT = 1;
        //            stt_USER_CK = 1;
        //
        //            TotalNap_MOMO = 0;
        //            TotalNap_BANK = 0;
        //            TotalNap_CARD = 0;
        //            TotalNap_ONE_PAY = 0;
        //            TotalRut_RUT_CARD = 0;
        //            TotalRut_RUT_BANK = 0;
        //            Total_ADMIN_ACT = 0;
        //            Total_USER_CK = 0;
        //
        //
        //            // Đại lý nhận
        //            var totalmoneyReceive = 0;
        //            var resultReceive = '';
        //            sttReceive = 1;
        //            $.each(result.listTransReceive, function (index, value) {
        //                resultReceive += resultSearchTransctionDaily(sttReceive, value.nick_name_send, value.nick_name_receive, value.money_send, value.money_receive, value.fee, value.status, value.trans_time);
        //                totalmoneyReceive += value.money_receive;
        //                sttReceive++;
        //            });
        //            $('#summoneyNapYou').html(commaSeparateNumber(totalmoneyReceive));
        //            $('#logactionNapYouDaiLy').html(resultReceive);
        //            var table = $('#checkAllNapYouDaiLy').DataTable({
        //                "ordering": true,
        //                "searching": true,
        //                "paging": false,
        //                "draw": false
        //            });
        //
        //            // Đại lý chuyển
        //            var totalmoneySend = 0;
        //            var result2 = '';
        //            sttSend = 1;
        //            $.each(result.listTransSend, function (index, value) {
        //                result2 += resultSearchTransctionDaily(sttSend, value.nick_name_send, value.nick_name_receive, value.money_send, value.money_receive, value.fee, value.status, value.trans_time);
        //                totalmoneySend += value.money_send;
        //                sttSend++;
        //            });
        //            $('#summoneyRutYou').html(commaSeparateNumber(totalmoneySend));
        //            $('#logactionRutYouDaiLy').html(result2);
        //            var table = $('#checkAllRutYouDaiLy').DataTable({
        //                "ordering": true,
        //                "searching": true,
        //                "paging": false,
        //                "draw": false
        //            });
        //
        //
        //            // CHUYỂN TIỀN BÓNG ĐÁ
        //            var totalmoneyChuyenTienBongDa = 0;
        //            var resultChuyenTienBongDa = '';
        //            sttChuyenTienBongDa = 1;
        //            $.each(result.listChuyenTienBongDa, function (index, value) {
        //                resultChuyenTienBongDa += resultSearchTienBongDa(sttChuyenTienBongDa, value);
        //                totalmoneyChuyenTienBongDa += value.moneyExchange;
        //                sttChuyenTienBongDa++;
        //            });
		//
        //            $('#summoneyChuyenTienBongDa').html(commaSeparateNumber(totalmoneyChuyenTienBongDa));
        //            $('#logactionChuyenTienBongDa').html(resultChuyenTienBongDa);
        //
		//			var table = $('#checkAllChuyenTienBongDa').DataTable({
        //                "ordering": true,
        //                "searching": true,
        //                "paging": false,
        //                "draw": false
        //            });
        //            // END: CHUYỂN TIỀN BÓNG ĐÁ
		//
		//
        //
        //            // NHẬN TIỀN BÓNG ĐÁ
        //            var totalmoneyNhanTienBongDa = 0;
        //            var resultNhanTienBongDa = '';
        //            sttNhanTienBongDa = 1;
        //            $.each(result.listNhanTienBongDa, function (index, value) {
        //                resultNhanTienBongDa += resultSearchTienBongDa(sttNhanTienBongDa, value);
        //                totalmoneyNhanTienBongDa += value.moneyExchange;
        //                sttNhanTienBongDa++;
        //            });
        //            $('#summoneyNhanTienBongDa').html(commaSeparateNumber(totalmoneyNhanTienBongDa));
        //            $('#logactionNhanTienBongDa').html(resultNhanTienBongDa);
        //            var table = $('#checkAllNhanTienBongDa').DataTable({
        //                "ordering": true,
        //                "searching": true,
        //                "paging": false,
        //                "draw": false
        //            });
        //            // END: NHẬN TIỀN BÓNG ĐÁ
        //        }
        //
        //    }, error: function () {
        //        $("#spinner").hide();
        //        $('#logaction').html("");
        //        $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
        //    }, timeout: 20000000
        //})

        // SoTien Hien tại
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/moneyuserajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val(),
                fromDate : $("#fromDate").val()
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
            }, error: function () {
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
        
    });

    function commaSeparateNumber(val) {
        if (val === "" || val === undefined) {
            return;
        }
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
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