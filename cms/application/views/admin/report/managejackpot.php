<title>Quản Lý Quỹ</title>

<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Quản lý quỹ game</h5>
        </div>
        <div class="clear"></div>
    </div>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Danh sách quỹ</h6>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                    <tr style="height: 20px;">
                        <td>STT</td>
                        <td>Game</td>
                        <td>Quỹ hiện tại</td>
                        <td>Cập nhật</td>
                        <td>Cập nhật bởi</td>
                        <td>Hành động</td>
                    </tr>
                </thead>
                <tbody id="listFund">
                </tbody>
            </table>
        </div>
    </div>
    <div class="wrapper">
        <div class="widget">
            <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
            <div class="title">
                <h6>Lịch sử nạp rút quỹ</h6>
            </div>
            <form class="list_filter form">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon" />
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>


                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span class="input-group-addon" />
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </td>


                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label style="margin-left: 90px;margin-bottom:-2px;width: 60px">Hiển thị:</label></td>
                            <td class="">
                                <select id="size" style="margin-left: 20px;margin-bottom:-2px;width: 145px">
                                    <option value="10">10</option>
                                    <option selected value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                </select>
                            </td>


                            <td><label id="labelvin" style="margin-left: 60px;margin-bottom:-2px;width: 70px;">
                                    Hành động:</label></td>
                            <td><select id="type" name="type" style="margin-left: 35px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Chọn</option>
                                    <option value="deposit">Nạp quỹ</option>
                                    <option value="withdraw">Rút quỹ</option>
                                </select></td>
                        </tr>
                    </table>

                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label id="labelvin" style="margin-left: 50px;margin-bottom:-2px;width: 100px;">Tên quỹ</label></td>
                            <td><select id="fundName" name="fundName" style="margin-left: 20px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Chọn</option>
                                    <?php
                                    $listFund = [
                                        'TaiXiu' => 'Tài Xỉu',
                                        'TaiXiuMd5' => 'Tài Xỉu MD5',
                                        'XocDia' => 'Xóc Đĩa',
                                        'BauCuaTo_vin_1000' => 'Bầu Cua',
                                        'BongLaiCac_vin_100' => 'Bồng Lai Các 100',
                                        'BongLaiCac_vin_1000' => 'Bồng Lai Các 1000',
                                        'BongLaiCac_vin_10000' => 'Bồng Lai Các 10000',
                                        'LienMinh_vin_100' => 'Liên Minh 100',
                                        'LienMinh_vin_1000' => 'Liên Minh 1000',
                                        'LienMinh_vin_10000' => 'Liên Minh 10000',
                                        'Cowboy_vin_100' => 'Cao bồi 100',
                                        'Cowboy_vin_1000' => 'Cao bồi 1000',
                                        'Cowboy_vin_10000' => 'Cao bồi 10000',
                                        'LadyNight_vin_100' => 'Lady Night 100',
                                        'LadyNight_vin_1000' => 'Lady Night 1000',
                                        'LadyNight_vin_10000' => 'Lady Night 10000',
                                        'SexyDance_vin_100' => 'Sexy Dance 100',
                                        'SexyDance_vin_1000' => 'Sexy Dance 1000',
                                        'SexyDance_vin_10000' => 'Sexy Dance 10000',
                                        'FastAndFurious_vin_100' => 'Fast & Furious 100',
                                        'FastAndFurious_vin_1000' => 'Fast & Furious 1000',
                                        'FastAndFurious_vin_10000' => 'Fast & Furious 10000',
                                        'LasVegas_vin_100' => 'Thần bài Ma Cao 100',
                                        'LasVegas_vin_1000' => 'Thần bài Ma Cao 1000',
                                        'LasVegas_vin_10000' => 'Thần bài Ma Cao 10000',
                                        'Halloween_vin_100' => 'Halloween 100',
                                        'Halloween_vin_1000' => 'Halloween 1000',
                                        'Halloween_vin_10000' => 'Halloween 10000',
                                        'BigCityBoy_vin_100' => 'Big City Boy 100',
                                        'BigCityBoy_vin_1000' => 'Big City Boy 1000',
                                        'BigCityBoy_vin_10000' => 'Big City Boy 10000',
                                        'cao_thap_vin_1000' => 'Trên Dưới 1000',
                                        'cao_thap_vin_10000' => 'Trên Dưới 10000',
                                        'cao_thap_vin_50000' => 'Trên Dưới 50000',
                                        'cao_thap_vin_100000' => 'Trên Dưới 100000',
                                        'cao_thap_vin_500000' => 'Trên Dưới 500000',
                                        'CANDY_vin_100' => 'Whisky 100',
                                        'CANDY_vin_1000' => 'Whisky 1000',
                                        'CANDY_vin_10000' => 'Whisky 10.000',
                                        'MiniPoker_vin_100' => 'MiniPoker 100',
                                        'MiniPoker_vin_1000' => 'MiniPoker 1000',
                                        'MiniPoker_vin_10000' => 'MiniPoker 10000',
                                    ];
                                    ?>
                                    <?php foreach ($listFund as $key => $value) : ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select></td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            </td>
                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 55px">
                            </td>
                            <td>
                                <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/managejackpot') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>

            </form>
            <div class="formRow">
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                    <tr style="height: 20px;">
                        <td>STT</td>
                        <td>Tên quỹ</td>
                        <td>Số tiền ban đầu</td>
                        <td>Số tiền</td>
                        <td>Hành động</td>
                        <td>Cập nhật bởi</td>
                        <td>Thời gian</td>
                    </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="line"></div>
<style>
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

    #listFund td:nth-child(2) {
        text-align: left;
    }

    #listFund td:nth-child(3) {
        text-align: right;
    }

    #listFund td:nth-child(4) {
        text-align: center;
    }

    #listFund td:nth-child(5) {
        text-align: center;
    }

    #listFund button {
        color: #fff !important;
    }

    #listFund button[disabled] {
        background-color: gray !important;
    }
</style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-sm"></ul>
    </div>
</div>
<script>
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });

    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    const FUND_TITLE = {
        TaiXiu: 'Tài Xỉu',
        TaiXiuMd5: 'Tài Xỉu MD5',
        XocDia: 'Xóc Đĩa',
        BauCuaTo_vin_1000: 'Bầu Cua',
        BongLaiCac_vin_100: 'Bồng Lai Các 100',
        BongLaiCac_vin_1000: 'Bồng Lai Các 1000',
        BongLaiCac_vin_10000: 'Bồng Lai Các 10000',
        LienMinh_vin_100: 'Liên Minh 100',
        LienMinh_vin_1000: 'Liên Minh 1000',
        LienMinh_vin_10000: 'Liên Minh 10000',
        Cowboy_vin_100: 'Cao bồi 100',
        Cowboy_vin_1000: 'Cao bồi 1000',
        Cowboy_vin_10000: 'Cao bồi 10000',
        LadyNight_vin_100: 'Lady Night 100',
        LadyNight_vin_1000: 'Lady Night 1000',
        LadyNight_vin_10000: 'Lady Night 10000',
        SexyDance_vin_100: 'Sexy Dance 100',
        SexyDance_vin_1000: 'Sexy Dance 1000',
        SexyDance_vin_10000: 'Sexy Dance 10000',
        FastAndFurious_vin_100: 'Fast & Furious 100',
        FastAndFurious_vin_1000: 'Fast & Furious 1000',
        FastAndFurious_vin_10000: 'Fast & Furious 10000',
        LasVegas_vin_100: 'Thần bài Ma Cao 100',
        LasVegas_vin_1000: 'Thần bài Ma Cao 1000',
        LasVegas_vin_10000: 'Thần bài Ma Cao 10000',
        Halloween_vin_100: 'Halloween 100',
        Halloween_vin_1000: 'Halloween 1000',
        Halloween_vin_10000: 'Halloween 10000',
        BigCityBoy_vin_100: 'Big City Boy 100',
        BigCityBoy_vin_1000: 'Big City Boy 1000',
        BigCityBoy_vin_10000: 'Big City Boy 10000',
        cao_thap_vin_1000: 'Trên Dưới 1000',
        cao_thap_vin_10000: 'Trên Dưới 10000',
        cao_thap_vin_50000: 'Trên Dưới 50000',
        cao_thap_vin_100000: 'Trên Dưới 100000',
        cao_thap_vin_500000: 'Trên Dưới 500000',
        CANDY_vin_100: 'Whisky 100',
        CANDY_vin_1000: 'Whisky 1000',
        CANDY_vin_10000: 'Whisky 10000',
        MiniPoker_vin_100: 'MiniPoker 100',
        MiniPoker_vin_1000: 'MiniPoker 1000',
        MiniPoker_vin_10000: 'MiniPoker 10000',
    }
    const FUND_NAME = {
        fundTaiXiu: 'hu_tx_auto',
        fundXocDia: 'hu_xd_auto',
        fundBauCua: 'hu_bc_auto',
        fundLasVegas: 'Las Vegas',
        fundBongLaiCac: 'BongLaiCac',
        fundLienMinh: 'LienMinh',
        fundHalloween: 'Halloween',
        fundCaribe: 'Caribe',
        fundCowboy: 'Cowboy',
        fundLadyNight: 'LadyNight',
        fundSexyDance: 'SexyDance',
    }
    const DEPOSIT_FUND = 'Nạp quỹ';
    const WITHDRAW_FUND = 'Rút quỹ';

    function resultSearch(index, fundTitle, money) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + index + "</td>";
        rs += "<td>" + FUND_TITLE[fundTitle] + "</td>";
        rs += "<td>" + `<input id="${fundTitle}" class="hidden" value="${money}"/><span>${commaSeparateNumber(money)}</span>` + "</td>";
        rs += "<td>" + `<input class="${fundTitle}" type="number" min="0"/><br/><span></span>` + "</td>";
        rs += "<td>" + `<input data-update-by="${fundTitle}" type="text"/>` + "</td>";
        rs += "<td>" + `<button class="${fundTitle}" disabled>${DEPOSIT_FUND}</button><button style="margin-left: 15px" class="${fundTitle}" disabled>${WITHDRAW_FUND}</button>` + "</td>";
        rs += "</tr>";
        return rs;
    }

    function onUpdateFund() {
        $('#listFund input[type="number"]').on('input', function() {
            const funtTitle = $(this).attr('class');
            const amount = parseInt($(this).val());
            $(this).val(amount);
            $(this).next().next().html(commaSeparateNumber(amount));
            if (amount > 0) {
                $(`button[class="${funtTitle}"]`).removeAttr('disabled');
            } else {
                $(`button[class="${funtTitle}"]`).attr('disabled', 'disabled');
            }
        });

        $('#listFund button').on('click', function() {
            const funtTitle = $(this).attr('class');
            const oldValue = parseInt($(`#${funtTitle}`).val());
            var amount = $(`input[class="${funtTitle}"]`).val();
            var updatedBy = $(`input[data-update-by="${funtTitle}"]`).val();
            var type = $(this).text().trim();
            if (amount) {
                let data = {
                    amount,
                    updatedBy,
                    currentMoney: oldValue,
                    type: 'deposit',
                    fundName: funtTitle
                };
                if (!updatedBy) {
                   
                    alert("Bắt buộc điền người cập nhật")
                    return;
                  
                }
                if (type === WITHDRAW_FUND) {
                    if (amount > oldValue) {
                        $(`input[class="${funtTitle}"]`).val(0);
                        alert("Số tiền rút không được lớn hơn số tiền hiện tại")
                        return;
                    } else {
                        data.type = 'withdraw'
                    }
                }

                // Add confirmation dialog
                if (confirm(`Bạn có chắc chắn muốn ${type === WITHDRAW_FUND ? 'rút' : 'nạp'} số tiền ${amount} vào quỹ ${funtTitle}?`)) {
                    // Call API to deposit/withdraw fund
                    $.ajax({
                        type: "POST",
                        url: "<?php echo admin_url('report/updatefundajax') ?>",
                        data,
                        success: function(res) {
                            if (res == 1) {
                                // Fund updated successfully
                                alert("Cập nhật quỹ thành công!")
                                window.location.reload();
                            } else {
                                // Error updating fund
                                alert("Cập nhật quỹ KHÔNG thành công!")
                            }
                        },
                        error: function(res) {
                            // Error updating fund
                            alert("Lỗi hệ thống vui lòng thử lại sau")
                        }
                    });
                }
            }
        });
    }
    setInterval(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/managejackpotajax') ?>",
            data: {},
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    const {
                        funds
                    } = res;
                    for (const key in FUND_TITLE) {
                        const fund = funds.find((item) => item.name === key);
                        if (fund) {
                            $(`#${key}`).val(fund.value);
                            $(`#${key}`).html("<span>" + commaSeparateNumber(fund.value) + "</span");
                        }
                    }
                } else {
                    $("#error-popup").show();
                }
            },
            error: function() {
                $("#error-popup").show();
            }
        });
    }, 30000);

    function getKeyByValue(object, value) {
        return Object.keys(object).find(key => object[key] === value);
    }
    var currentPage = 1;
    var totalPage = 0;

    function resultSearchHistory(stt, record) {
        const {
            fundName,
            amount,
            type,
            createdTime,
            updatedBy,
            currentMoney
        } = record;
        // const fundTitle = getKeyByValue(FUND_NAME, fundName);
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + FUND_TITLE[fundName] + "</td>";
        rs += "<td>" + commaSeparateNumber(currentMoney) + "</td>";
        rs += "<td>" + commaSeparateNumber(amount) + "</td>";
        rs += `<td>${type === 'deposit' ? 'Nạp quỹ': 'Rút quỹ'}</td>`;
        rs += "<td>" + updatedBy + "</td>";
        rs += "<td>" + createdTime + "</td>";
        rs += "</tr>";
        return rs;
    }

    function searchHistory(currentPage) {
        $("#spinner").show();
        pageSize = $("#size").val();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/historyfundajax') ?>",
            data: {
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                page: currentPage || 1,
                pageSize,
                type: $("#type").val(),
                fundName: $("#fundName").val(),
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                $("#num").text("");
                if (result == "0") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $('#logaction').html("");
                } else {
                    let displayData = "";
                    $("#resultsearch").html("");
                    const totalRecord = result.total;
                    if (totalRecord) {
                        totalPage = Math.floor(totalRecord / pageSize) * pageSize < totalRecord ? Math.floor(totalRecord / pageSize) + 1 : Math.floor(totalRecord / pageSize);
                        $.each(result.transactions, function(index, value) {
                            displayData += resultSearchHistory(index + 1, value);
                        });
                        $('#logaction').html(displayData);
                        var table = $('#checkAll').DataTable({
                            "ordering": true,
                            "searching": true,
                            "paging": false,
                            "draw": false,
                            "retrieve": true
                        });

                        // Assuming $pagination is your pagination element
                        var $pagination = $('#pagination-demo');

                        // Temporarily unbind onPageClick event to prevent AJAX call
                        $pagination.off('page');

                        // Now safely destroy the pagination
                        $pagination.twbsPagination('destroy');

                        $pagination.twbsPagination({
                            totalPages: totalPage,
                            visiblePages: 5,
                            startPage: currentPage || 1,
                            onPageClick: function(event, pageNumber) {
                                event.preventDefault();
                                if (pageNumber !== currentPage) { // Assuming currentPage is tracked somewhere
                                    searchHistory(pageNumber);
                                }
                            }
                        })
                    } else {
                        $('#logaction').html("Không có lịch sử trong thời gian này");
                    }
                }

            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 40000
        })
    }
    $("#search_tran").click(function() {
        var toDatetime = $("#toDate").val();
        var fromDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        $('#pagination-demo').css("display", "block");
        searchHistory();
    });
    $(document).ready(function() {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/managejackpotajax') ?>",
            data: {},
            dataType: 'json',
            success: function(res) {
                $("#spinner").hide();
                if (res.success) {
                    const {
                        funds
                    } = res;
                    let index = 1
                    for (const key in FUND_TITLE) {
                        const fund = funds.find((item) => item.name === key);
                        if (fund) {
                            $('#listFund').append(resultSearch(index, key, fund.value));
                            index += 1;
                        }
                    }
                    onUpdateFund();
                } else {
                    $("#error-popup").show();
                }
            },
            error: function() {
                $("#spinner").hide();
                $("#error-popup").show();
            }
        });
        searchHistory();
    });
</script>