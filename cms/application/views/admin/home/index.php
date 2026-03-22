<title>Trang chủ</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="title-homepage">
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
                <td style="">
                    <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 20px">
                </td>
            </tr>
        </table>

        </div>
        <div class="dashboard-container">
            <div class="dashboard-item ">
                <div class="header new-users-today">User đăng ký mới <span id="totalUser">0</span></div>
                <div class="content-item">
                    <div>
                        <span id="totalRechargedUser">0</span>
                        <span>Đã nạp tiền</span>
                    </div>
                    <div>
                        <span id="totalSercureUser">0</span>
                        <span>Kích hoạt bảo mật</span>
                    </div>
                    <div>
                        <span id="totalRnSUser">0</span>
                        <span>Vừa nạp & bảo mật</span>
                    </div>
                </div>
            </div>
            <!-- <div class="dashboard-item ">
                <div class="header active-users">User đăng nhập <span>0</span></div>
                <div class="content-item">
                    <div>
                        <span>0</span>
                        <span>IOS</span>
                    </div>
                    <div>
                        <span>0</span>
                        <span>ANDROID</span>
                    </div>
                    <div>
                        <span>0</span>
                        <span>WEB</span>
                    </div>
                </div>
            </div> -->
            <div class="dashboard-item ">
                <div class="header active-users">Tổng tiền nạp<span id="totalIn">0</span></div>
                <div class="content-item">
                    
                    <div>
                        <span id="realInBank">0</span>
                        <span>Bank</span>
                    </div>
                    <div>
                        <span id="realInMomo">0</span>
                        <span>Momo</span>
                    </div>
                    <div>
                        <span id="realInCard">0</span>
                        <span>Thẻ cào</span>
                    </div>
                </div>
            </div>
            <div class="dashboard-item ">
                <div class="header total-deposit">Tổng tiền rút <span id="totalOut">0</span></div>
                <div class="content-item">
                <div>
                        <span id="realOutBank">0</span>
                        <span>Bank</span>
                    </div>    
                <div>
                        <span id="realOutMomo">0</span>
                        <span>Momo</span>
                    </div>
                    
                    <div>
                        <span>0</span>
                        <span>Thẻ cào</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-4-col">
            <div class="header total-members">
                <span id="allUser">0</span>
                <span>Tổng user hệ thống</span>
            </div>
            <div style="cursor: pointer" id="to_giftcode" class="header vang-nhat">
                <span id="giftcode">0</span>
                <span>Tiền User nhận giftcode</span>
            </div>
            <div class="header active-users">
                <span id="countInUser">0</span>
                <span>Tổng số user nạp</span>
            </div>
            <div class="header total-deposit">
                <span id="countOutUser">0</span>
                <span>Tổng số user rút</span>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="dashboard-item ">
                <div class="header total-fee">Tổng phế <span id="totalFee">0</span></div>
                <div class="content-item-row">
                    <div>
                        <span>Tài Xỉu</span>
                        <span id="taiXiuFee">0</span>
                    </div>
                    <div>
                        <span>Tài Xỉu MD5</span>
                        <span id="taiXiuMd5Fee">0</span>
                    </div>
                    <div>
                        <span>Sicbo</span>
                        <span id="sicboFee">0</span>
                    </div>
                    <div>
                        <span>Xóc Đĩa</span>
                        <span id="xocDiaFee">0</span>
                    </div>
                    <div>
                        <span>Bầu Cua</span>
                        <span id="bauCuaFee">0</span>
                    </div>
                    <div>
                        <span>Slot Cao bồi</span>
                        <span id="slot1Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Fast & Furious</span>
                        <span id="slot2Fee">0</span>
                    </div>
                    <div>
                        <span>Slot LadyNight</span>
                        <span id="slot3Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Big City Boy</span>
                        <span id="slot4Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Bồng Lai Các</span>
                        <span id="slot5Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Halloween</span>
                        <span id="slot6Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Thần bài Ma Cao</span>
                        <span id="slot7Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Sexy Dance</span>
                        <span id="slot8Fee">0</span>
                    </div>
                    <div>
                        <span>Slot Liên minh</span>
                        <span id="slot9Fee">0</span>
                    </div>
                    <div>
                        <span>Rượu Whisky</span>
                        <span id="candyFee">0</span>
                    </div>
                    <div>
                        <span>Mini Poker</span>
                        <span id="miniPokerFee">0</span>
                    </div>
                    <div>
                        <span>Cao Thấp</span>
                        <span id="caoThapFee">0</span>
                    </div>
                    <div>
                        <span>Lô Đề</span>
                        <span id="lodeFee">0</span>
                    </div>
                    <div>
                        <span>Thể Thao</span>
                        <span id="theThaoFee">0</span>
                    </div>
                    <div>
                        <span>Bài Cào</span>
                        <span id="baiCaoFee">0</span>
                    </div>
                    <div>
                        <span>Mậu Binh</span>
                        <span id="binhFee">0</span>
                    </div>
                    <div>
                        <span>Sâm Lốc</span>
                        <span id="samFee">0</span>
                    </div>
                    <div>
                        <span>Tiến Lên Miền Nam</span>
                        <span id="tlmnFee">0</span>
                    </div>
                    <div>
                        <span>Poker</span>
                        <span id="pokerFee">0</span>
                    </div>
                    <div>
                        <span>Ba Cây</span>
                        <span id="baCayFee">0</span>
                    </div>
                </div>
            </div>
            <div class="dashboard-item">
                <div class="header admin-money">ADMIN / Cộng trừ tiền <span id="adminMoney">0</span></div>
                <div class="content-item-row">
                    <div>
                        <span>Cộng tiền</span>
                        <span id="add">0</span>
                    </div>
                    <div>
                        <span>Trừ tiền</span>
                        <span id="subtract">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
</div>
</div>
<div class="line"></div>
<div class="wrapper">
    <div class="widgets">
        <!-- Stats -->
        <div class="clear"></div>
    </div>
</div>
<div class="clear mt30"></div>
<script>
    const now = new Date();
    function formatDate(date) {
        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }
    function revertedFormat(inputDate) {
        const dateParts = inputDate.split("-");
        const outputDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
        return outputDate
    }
    function getTimeThisDay() {
        let startOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        let endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        return {
            fromDate: formatDate(startOfDay),
            toDate: formatDate(endOfDay)
        };
    }
    function getTimeThisWeek() {
        const dayOfWeek = now.getDay(); // 0 (Sunday) to 6 (Saturday)
        const startOfWeek = new Date(now);
        const endOfWeek = new Date(now);

        // Set start of the week to Monday
        startOfWeek.setDate(dayOfWeek === 0 ? now.getDate() - 7 : now.getDate() - dayOfWeek + 1);
        startOfWeek.setHours(23, 59, 59, 999); // End of the day

        // Set end of the week to Sunday
        endOfWeek.setDate(dayOfWeek === 0 ? now.getDate() : now.getDate() - dayOfWeek + 7);
        endOfWeek.setHours(23, 59, 59, 999); // End of the day

        return {
            fromDate: formatDate(startOfWeek),
            toDate: formatDate(endOfWeek)
        };
    }
    function getTimeThisMonth() {
         // Start of the month
        let startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
        startOfMonth.setHours(0, 0, 0, 0); // Set to midnight

        // End of the month
        let endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0); // Set to the last day of the current month
        endOfMonth.setHours(23, 59, 59, 999); // Set to just before midnight

        return {
            fromDate: formatDate(startOfMonth),
            toDate: formatDate(endOfMonth)
        };
    }
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    function getTotalFee(actionGame, taiXiu) {
        let totalFee = 0;
        for (let game in actionGame) {
            if (actionGame.hasOwnProperty(game)) {
                totalFee += actionGame[game].fee;
            }
        }
        totalFee += taiXiu.fee;
        return totalFee;
    }
    function getResult(rangeFilter, initData) {
        const {fromDate, toDate} = rangeFilter;
        var fromDatetime = moment(fromDate, 'DD-MM-YYYY');
        var toDatetime = moment(toDate, 'DD-MM-YYYY');
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        $("#spinner").show();
        const toDateReverted = revertedFormat(toDate);
        const fromDateReverted = revertedFormat(fromDate);
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('home/moneyajax')?>",
            data: {
                toDate: toDateReverted,
                fromDate: fromDateReverted
            },
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    const {totalInUser, countInUser, totalIn, totalOut, actionGame, taiXiu, vinOutUser, vinInUser, countOutUser} = result;
                    $("#totalIn").html(totalIn ? commaSeparateNumber(totalIn) : 0);
                    $("#totalInUser").html(totalInUser ? commaSeparateNumber(totalInUser) : 0);
                    
                    $("#countOutUser").html(countOutUser ? commaSeparateNumber(countOutUser) : 0);
                    
                    $("#countInUser").html(countInUser ? commaSeparateNumber(countInUser) : 0);
                    $("#totalOut").html(totalOut ? commaSeparateNumber(totalOut) : 0);
                    if(actionGame || taiXiu) {
                        $("#totalFee").html(commaSeparateNumber(getTotalFee(actionGame, taiXiu)));
                    }
                    if(taiXiu) {
                        $("#taiXiuFee").html(commaSeparateNumber(taiXiu.fee));
                    }
                    if(vinOutUser?.realCashoutByBank) {
                        $("#realOutBank").html(commaSeparateNumber(vinOutUser?.realCashoutByBank));
                    }
                    if(vinOutUser?.realCashoutByMomo) {
                        $("#realOutMomo").html(commaSeparateNumber(vinOutUser?.realCashoutByMomo));
                    }
                    if(vinInUser?.RechargeByBank) {
                        $("#realInBank").html(commaSeparateNumber(vinInUser?.RechargeByBank));
                    }
                    if(vinInUser?.RechargeByMomo) {
                        $("#realInMomo").html(commaSeparateNumber(vinInUser?.RechargeByMomo));
                    }
                    if(vinInUser?.RechargeByCard) {
                        $("#realInCard").html(commaSeparateNumber(vinInUser?.RechargeByCard));
                    }
                    

                    const { XocDia, CaoThap, MiniPoker, Poker, BaCay, Binh, Sam, Lode, CANDY, Halloween, SexyDance,LienMinh,
                    Sport, ShootFish, BauCuaTo, BaiCao, Cowboy, FastAndFurious, LadyNight, BigCityBoy, LasVegas, BongLaiCac, Tlmn, TaiXiuMd5} = actionGame;
                    $("#taiXiuMd5Fee").html(TaiXiuMd5 ? commaSeparateNumber(TaiXiuMd5?.fee) : 0);
                    $("#xocDiaFee").html(XocDia ? commaSeparateNumber(XocDia?.fee) : 0);
                    $("#bauCuaFee").html(BauCuaTo ? commaSeparateNumber(BauCuaTo?.fee) : 0);

                    $("#slot1Fee").html(Cowboy ? commaSeparateNumber(Cowboy?.fee) : 0);
                    $("#slot2Fee").html(FastAndFurious ? commaSeparateNumber(FastAndFurious?.fee) : 0);
                    $("#slot3Fee").html(LadyNight ? commaSeparateNumber(LadyNight?.fee) : 0);
                    $("#slot4Fee").html(BigCityBoy ? commaSeparateNumber(BigCityBoy?.fee) : 0);
                    $("#slot5Fee").html(BongLaiCac ? commaSeparateNumber(BongLaiCac?.fee) : 0);
                    $("#slot6Fee").html(Halloween ? commaSeparateNumber(Halloween?.fee) : 0);
                    $("#slot7Fee").html(LasVegas ? commaSeparateNumber(LasVegas?.fee) : 0);
                    $("#slot8Fee").html(SexyDance ? commaSeparateNumber(SexyDance?.fee) : 0);
                    $("#slot9Fee").html(LienMinh ? commaSeparateNumber(LienMinh?.fee) : 0);

                    $("#candyFee").html(CANDY ? commaSeparateNumber(CANDY?.fee) : 0);
                    $("#miniPokerFee").html(MiniPoker ? commaSeparateNumber(MiniPoker?.fee) : 0);
                    $("#caoThapFee").html(CaoThap ? commaSeparateNumber(CaoThap?.fee) : 0);
                    $("#lodeFee").html(Lode ? commaSeparateNumber(Lode?.fee) : 0);
                    $("#theThaoFee").html(Sport ? commaSeparateNumber(Sport?.fee) : 0);
                    $("#baiCaoFee").html(BaiCao ? commaSeparateNumber(BaiCao?.fee) : 0);
                    $("#binhFee").html(Binh ? commaSeparateNumber(Binh?.fee) : 0);
                    $("#samFee").html(Sam ? commaSeparateNumber(Sam?.fee) : 0);
                    $("#tlmnFee").html(Tlmn ? commaSeparateNumber(Tlmn?.fee) : 0);
                    $("#pokerFee").html(Poker ? commaSeparateNumber(Poker?.fee) : 0);
                    $("#baCayFee").html(BaCay ? commaSeparateNumber(BaCay?.fee) : 0);
            
                } else {
                    alert("Tìm kiếm phế thất bại")
                }
            }, error: function () {
                alert("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        });

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('home/userajax')?>",
            data: {
                toDate: toDateReverted,
                fromDate: fromDateReverted
            },
            dataType: 'json',
            success: function (result) {
                if(result.success) {
                    const {total, userPay, userSecurity, userPayAndSecurity} = result;
                    $("#totalUser").html(total ? commaSeparateNumber(total) : 0);
                    $("#totalRechargedUser").html(userPay ? commaSeparateNumber(userPay) : 0);
                    $("#totalSercureUser").html(userSecurity ? commaSeparateNumber(userSecurity) : 0);
                    $("#totalRnSUser").html(userPayAndSecurity ? commaSeparateNumber(userPayAndSecurity) : 0);
                } else {
                    alert("Tìm kiếm user thất bại")
                }
            }, error: function () {
                alert("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        });
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('home/getGiftcodeAjax')?>",
            data: {
                toDate: revertedFormat(toDate),
                fromDate: revertedFormat(fromDate)
            },
            dataType: 'json',
            success: function (result) {
                if(result.success) {
                    const {addMoney, subtractMoney, totalMoneyGiftCode} = result;
                    $("#add").html(typeof(addMoney) == 'number' ? commaSeparateNumber(addMoney) : 0);
                    //subtractMoney is always negative number
                    $("#subtract").html(typeof(subtractMoney) == 'number' ? commaSeparateNumber(subtractMoney) : 0);
                    const adminMoney = typeof(addMoney) == 'number' && typeof(subtractMoney) == 'number' ? commaSeparateNumber(addMoney + subtractMoney) : 0
                    $("#adminMoney").html(adminMoney);
                    $("#giftcode").html(totalMoneyGiftCode ? commaSeparateNumber(totalMoneyGiftCode) : 0);
                }
            }, error: function () {
                alert("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        });
        $("#spinner").hide();

    }
    function getFixedReport() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('home/getTotalMemberajax')?>",
            data: {
                pages: 1,
                record: 50,
                taikhoanbot: 0,
                typetk: 0,
            },
            dataType: 'json',
            success: function (result) {
                if(result.success) {
                    const {totalRecord} = result;
                    $("#allUser").html(totalRecord ? commaSeparateNumber(totalRecord) : 0);
                }
            }, error: function () {
                alert("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        });
    }
    $('#to_giftcode').click(function() {
        window.location.href = "<?php echo admin_url('giftcode/giftcodeadmin') ?>"
    })
    $(document).ready(function() {
        $(function() {
            $('#datetimepicker1').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('#datetimepicker2').datetimepicker({
                format: 'DD-MM-YYYY'
            });
        });
        getFixedReport();
        const initData = true;
        fetchData(initData);
        $('#search_tran').click(function () {
            fetchData(false);
        })
    });
    function fetchData(initData) {
        getResult({fromDate: $("#fromDate").val(), toDate: $("#toDate").val()}, initData);
    }
</script>
<style>
  .title-homepage {
    margin-top: 20px;
  }
  .header {
    width: 100%;
    height: 60px;
    border-radius: 4px 4px 0 0;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .content-item {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-between;
    width: 100%;
    align-items: center;
    background-color: white;
    border-radius: 0 0 4px 4px;
  }
  .content-item-row {
    display: flex;
    flex-direction: column;
    width: 100%;
  }
  .content-item-row > div {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    padding: 7px 10px;
    border: 1px #0000006e solid;
  }
  .content-item > div {
    display: flex;
    border: rgb(102, 102, 102) 0.5px solid;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 60px;
    color: #474747;
  }
  .dashboard-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
    padding: 10px;
  }
  .dashboard-4-col {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
    padding: 10px;
  }
  .dashboard-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
  }
  .new-users-today, .admin-money {
    background-color: #3498db;
  }
  .total-members, .total-fee {
    background-color: #004d8e;
  }
  .active-users, .total-giftcode {
    background-color: #2ecc71;
  }
  .total-deposit, .total-withdraw {
    background-color: #e74c3c;
  }
  .vang-nhat {
    background-color: #b9af2e;
  }
  .gray-light {
    background-color: #8f8f90;
  }
  .gray-dark {
    background-color: #474747;
  }
  input#fromDate, #toDate {
    line-height: 25px
  }
  </style>
<script>

</script>