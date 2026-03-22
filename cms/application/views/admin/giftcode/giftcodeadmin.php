<title>Thống Kê GiftCode</title>
<?php $this->load->view('admin/giftcode/head', $this->data) ?>
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
    <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
    <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.table2excel.js"></script>
    <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>

    <div class="wrapper">
        <div class="widget">
            <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>

            <div class="title">
                <h6>Danh sách giftcode</h6>

                <div class="num f12">Tổng số giftcode: <b id="num"></b></div>
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
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="1000">1,000</option>
                                    <option value="10000">10,000</option>
                                </select>
                            </td>


                            <td><label id="labelvin" style="margin-left: 60px;margin-bottom:-2px;width: 70px;">Trạng
                                    thái</label></td>
                            <td><select id="gcuse" name="gcuse" style="margin-left: 35px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Tất cả</option>
                                    <option value="0">Đã sử dụng</option>
                                    <option value="1">Chưa sử dụng</option>
                                </select></td>
                        </tr>
                    </table>

                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label id="labelvin" style="margin-left: 50px;margin-bottom:-2px;width: 100px;">Mệnh giá</label></td>
                            <td><select id="menhgiavin" name="menhgiavin" style="margin-left: 20px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Chọn</option>
                                    <option value="10000">10K Win</option>
                                    <option value="20000">20K Win</option>
                                    <option value="50000">50K Win</option>
                                    <option value="100000">100K Win</option>
                                    <option value="200000">200K Win</option>
                                    <option value="500000">500K Win</option>
                                    <option value="1000000">1000K Win</option>
                                </select></td>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Tên chiến dịch:</label>
                            </td>
                            <td class="item">
                                <select id="typegiftcode" class="" name="typegiftcode" style="margin-left: 20px;width:138px">
                                    <option value="" <?php if ($this->input->post("typegiftcode") == "") {
                                                            echo "selected";
                                                        } ?>>Tất cả
                                    </option>
                                    <?php foreach ($listtype as $key => $row) : ?>
                                        <option value="<?php echo $row->id ?>" <?php echo ($this->input->post("typegiftcode") == $row->id ? 'selected' : ''); ?>><?php echo $row->campaignName ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>

                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nickname:</label>
                            </td>
                            <td>
                                <input style="margin-left: 20px;height:25px;width: 145px" id="nickname" name="nickname">
                            </td>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Code:</label>
                            </td>
                            <td>
                                <input style="height:25px;width: 145px;margin-left:20px;" id="giftcode" name="giftcode">
                            </td>
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
                                <input type="reset" onclick="window.location.href = '<?php echo admin_url('giftcode/giftcodeadmin') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <td>
                                <input type="button" id="exportexel" value="Xuất Exel" class="button blueB" style="margin-left: 20px">
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
                        <td>Mệnh giá</td>
                        <td>GiftCode</td>
                        <td>Nickname</td>
                        <td>Tên chiến dịch</td>
                        <td>Trạng thái</td>
                        <td>Ngày tạo</td>
                        <td>Ngày sử dụng</td>
                        <td>Ngày hết hạn</td>
                        <td>Hành động</td>
                    </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
            <div class="text-center">
                <ul id="pagination-demo" class="pagination-sm"></ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<div class="container" style="margin-top:150px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
</div>
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
</style>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script>
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    var totalPage = 0;
    var pageSize = 20;
    var page = 1;

    function onThuhoi() {
        $('button[name=thuhoi]').click(function() {
            $("#spinner").show();
            const type = $(this).attr('gc-type');
            const code = $(this).attr('gc-code');
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/adminthuhoi') ?>",
                data: {
                    code,
                    type
                },
                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
                    if (result == "1") {
                        alert("Thu hồi thành công");
                        searchGiftcode(page);
                    } else {
                        alert("Thu hồi thất bại");
                    }
                },
                error: function() {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                },
                timeout: 40000
            })
        })
    }

    function searchGiftcode(currentPage) {
        page = currentPage || 1;
        $("#spinner").show();
        pageSize = $("#size").val();
        const toDate = $("#toDate").val() ? moment($("#toDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD') : '';
        const fromDate = $("#fromDate").val() ? moment($("#fromDate").val(), 'YYYY-MM-DD').format('YYYY-MM-DD') : '';
        const isActive = $("#gcuse").val() === "" ? "" : $("#gcuse").val() == 1;
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcode/giftcodeadminajax') ?>",
            data: {
                nickname: $("#nickname").val(),
                code: $("#giftcode").val(),
                price: $("#menhgiavin").val(),
                isActive,
                toDate,
                fromDate,
                page,
                pageSize,
                type: $("#typegiftcode").val(),
            },
            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                $("#num").text("");
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $('#logaction').html("");
                } else {
                    $("#resultsearch").html("");
                    let displayData = "";
                    const totalRecord = result.total;
                    $("#num").text(totalRecord);
                    totalPage = Math.floor(totalRecord / pageSize) * pageSize < totalRecord ? Math.floor(totalRecord / pageSize) + 1 : Math.floor(totalRecord / pageSize);
                    $.each(result.transactions, function(index, value) {
                        displayData += resultgiftcode(index + 1, value);
                    });
                    $('#logaction').html(displayData);
                    onThuhoi();
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

                    // Reinitialize the pagination as needed without triggering unwanted AJAX calls
                    $pagination.twbsPagination({
                        totalPages: totalPage, // Make sure totalPage is defined
                        visiblePages: 5,
                        startPage: currentPage || 1,
                        onPageClick: function(event, pageNumber) {
                            event.preventDefault();
                            if (pageNumber !== currentPage) { // Assuming currentPage is tracked somewhere
                                searchGiftcode(pageNumber);
                            }
                        }
                    }).show();
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
        var toDatetime = moment($("#toDate").val(), 'YYYY-MM-DD');
        var fromDatetime = moment($("#fromDate").val(), 'YYYY-MM-DD');
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        $('#pagination-demo').css("display", "block");
        searchGiftcode();
    });

    function getType(type) {
        const option = $('#typegiftcode option[value="' + type + '"]')[0]
        return option ? option.innerHTML : `type=${type} Chưa xác định`;
    }

    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function resultgiftcode(stt, record) {
        const {
            active,
            code,
            createdDate,
            expirationTime,
            expirationDate,
            nickName,
            price,
            quantity,
            type,
            usedTime
        } = record;
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + commaSeparateNumber(price) + "</td>";
        rs += "<td>" + code + "</td>";
        rs += `<td>${nickName || '' }</td>`;
        rs += "<td>" + getType(type) + "</td>";
        if (active) {
            rs += "<td>" + "Chưa sử dụng" + "</td>";
        } else {
            rs += "<td>" + `${nickName ? "Đã sử dụng" : "Không khả dụng"}` + "</td>";
        }
        const createdTime = moment(createdDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
        const useTime = usedTime ? moment(usedTime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') : '';
        const expiration = expirationTime ? moment(expirationTime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') : '';
        rs += "<td>" + createdTime + "</td>";
        rs += `<td>${useTime || ''}</td>`;
        rs += "<td>" + expiration + "</td>";
        rs += `<td>${active ? `<button style="color: #ffffff" name="thuhoi" gc-type="${type}" gc-code="${code}">Thu hồi</button>` : ''}</td>`;
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function() {
        searchGiftcode();
        $("#exportexel").click(function() {
            $("#checkAll").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "Listgiftcode",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>