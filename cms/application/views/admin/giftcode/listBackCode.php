<title>Thống Kê Back Code</title>
<?php $this->load->view('admin/giftcode/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Danh sách Back Code</h6>

        </div>
        <div class="formRow">
            <form class="list_filter form" action="" method="get">
                <table>
                    <tr>

                        <td>
                            <label for="datetimepicker1" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 200px">Từ ngày:</label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <label for="datetimepicker2" style="margin-left: 20px;width: 200px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="nickname" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 200px">Tên tài khoản:</label>
                        </td>
                        <td class="item">
                            <div class="input-group">
                                <input type="text" id="nickname" name="nickname">
                            </div>
                        </td>
                        <td>
                            <label for="nickname" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 200px">CODE:</label>
                        </td>
                        <td class="item">
                            <div class="input-group">
                                <input type="text" id="code" name="code">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nickname" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 200px">Loại backcode:</label>
                        </td>
                        <td class="item">
                            <div class="input-group">
                                <select id="type" name="type">
                                    <option value="">Tất cả</option>
                                    <option value="WIN">Thắng</option>
                                    <option value="LOSE">Thua</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;" class="formLeft"> Hiển thị: </label>
                        </td>
                        <td class="item"><select id="record" name="record" style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                            
                                    <option value="25" <?php if ($this->input->post('record') == 25) {
                                                            echo "selected";
                                                        } ?>>25
                                    </option>
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
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Tên tài khoản</td>
                    <td>Số tiền thắng/thua</td>
                    <td>Tiền back</td>
                    <td>Loại giftcode</td>
                    <td>CODE</td>
                    <td>Trạng thái</td>
                    <td>Ngày tạo</td>
                    <td>Ngày hết hạn</td>
                    <td>Ngày sử dụng</td>
                </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
        <div id="resultsearch"></div>
        <div class="pagination">
            <div id="pagination"></div>
        </div>
    </div>

    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
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
            width: 200px;
            /* width of the spinner gif */
            height: 102px;
            /*hight of the spinner gif +2px to fix IE8 issue */
        }

        .item {
            vertical-align: middle;
        }
    </style>
    <script>
        $("#datetimepicker1").datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $("#datetimepicker2").datetimepicker({
            format: 'YYYY-MM-DD'
        });

        function resultUser(user, stt) {
            const {
                nickname,
                money,
                chatId,
                code,
                status,
                createdDate,
                expirationDate,
                activeDate,
                moneyCashBack
            } = user;

            var rs = "";
            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            rs += `<td style="text-align: center;">${nickname}</td>"`;
            rs += `<td style="text-align: center;">${commaSeparateNumber(money)}</td>`;
            rs += `<td style="text-align: center;">${commaSeparateNumber(moneyCashBack)}</td>`;
            rs += `<td style="text-align: center;">${money > 0 ? 'thắng' : 'thua'}</td>`;
            rs += `<td style="text-align: center;">${code}</td>"`;
            rs += `<td style="text-align: center;">${status ? 'Đã sử dụng' : 'Chưa sử dụng'}</td>"`;
            rs += `<td style="text-align: center;">${createdDate}</td>"`;
            rs += `<td style="text-align: center;">${expirationDate ? expirationDate : ""}</td>"`;
            rs += `<td style="text-align: center;">${activeDate || ''}</td>"`;
            rs += "</tr>";
            return rs;
        }
        $("#search_tran").click(function() {
            var from = moment($("#fromDate").val(), "YYYY-MM-DD");
            var to = moment($("#toDate").val(), "YYYY-MM-DD");
            if (from > to) {
                alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
                return false;
            }
            $("#spinner").bind("ajaxSend", function() {
                $(this).show();
            }).bind("ajaxStop", function() {
                $(this).hide();
            }).bind("ajaxError", function() {
                $(this).hide();
            });
            $("#spinner").show();
            const ts = moment($("#fromDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
            const te = moment($("#toDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/listBackCodeAjax') ?>",
                data: {
                    ts,
                    te,
                    page: 0,
                    pageSize: $('#record').val(),
                    nickname: $("#nickname").val(),
                    code: $("#code").val(),
                    type: $("#type").val(),
                },
                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
                    var totalRecord = result.totalRecord;
                    var totalPage = totalRecord / $('#record').val() + 1;
                    if (result.success) {
                        if (result.users?.length == 0) {
                            $("#btn_modal").attr('disabled', 'disabled');
                            $("#resultsearch").html("Không tìm thấy kết quả");
                            $('#logaction').html("");
                        } else {
                            $("#btn_modal").removeAttr('disabled');
                            $("#resultsearch").html("");
                            let resultUsers = "";
                            result.users.map((user, index) => {
                                resultUsers += resultUser(user, index + 1);
                            });
                            $('#logaction').html(resultUsers);
                            var $pagination = $('#pagination');

                        // Temporarily unbind onPageClick event to prevent AJAX call
                        $pagination.off('page');

                        // Now safely destroy the pagination
                        $pagination.twbsPagination('destroy');
                        $pagination.twbsPagination({
                                totalPages: totalPage,
                                visiblePages: 5,
                                onPageClick: function(event, page) {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo admin_url('giftcode/listBackCodeAjax') ?>",
                                        data: {
                                            ts,
                                            te,
                                            page: page - 1,
                                            pageSize: $('#record').val(),
                                            nickname: $("#nickname").val(),
                                            code: $("#code").val(),
                                            type: $("#type").val(),
                                        },
                                        dataType: 'json',
                                        success: function(result) {
                                            if (result.success) {
                                                let resultUsers = "";
                                                result.users.map((user, index) => {
                                                    resultUsers += resultUser(user, index + 1);
                                                });
                                                $('#logaction').html(resultUsers);
                                            }
                                        },
                                    });
                                },
                            });
                        }
                    }
                }
            })
        });
        $(document).ready(function() {
            $("#search_tran").trigger("click");
        })
    </script>
    <script>
        function commaSeparateNumber(val) {
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
            }
            return val;
        }
    </script>