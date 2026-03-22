<title>Back Code Thua</title>
<?php $this->load->view('admin/giftcode/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Danh sách Thua</h6>
            <h6 style="float: right">Tổng số tài khoản:<span style="color:#7a6fbe" id="numuser"></span></h6>

        </div>
        <div class="formRow">
            <form class="list_filter form" action="" method="get">
                <table>
                    <tr>

                        <td>
                            <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Chọn ngày:</label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <!-- <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td> -->
                        </tr>
                        <tr>
                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;" class="formLeft"> Hiển thị: </label>
                        </td>
                        <td class="item"><select id="record" name="record" style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                     <option value="10" <?php if ($this->input->post('record') == 10) {
                                                            echo "selected";
                                                        } ?>>10
                                    </option>
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
                        <td>
                            <input type="button" id="btn_modal" data-toggle="modal" data-target="#exampleModal1" value="Gửi Code" class="basic" style="margin-left: 20px">
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
                    <td>Số tiền</td>
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
    <div class="modal fade" id="exampleModal1">
        <div class="modal-dialog" style="right: 0; left: 0; width: 30%; position: absolute; top: 30%;">
            <div class="modal-content" style="background: #7cffaa;">
                <div class="modal-header" style="font-size: 15px; text-align: center; font-weight: bold; color: #d05600;">
                    GỬI CODE CHO NGƯỜI THUA
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>
                                <label for="percent" class="formLeft" style="margin-left: 50px;width: 100px">Phần trăm:</label>
                            </td>
                            <td class="item">
                                <div class="mb5">
                                    <span>3%</span>
                                    <input style="width: 100%" hidden type="number" id="percent" name="percent" disabled value="3" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="messageCode" class="formLeft" style="margin-left: 50px;width: 100px">Lời nhắn:</label>
                            </td>
                            <td class="item">
                                <div class="mb5">
                                    <input style="width: 100%" type="text" id="messageCode" name="messageCode" value="" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="">
                                <input type="button" id="send_code" value="GỬI" class="button blueB" data-toggle="modal" data-target="#exampleModal1" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
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

        #exampleModal1 input {
            height: 25px;
        }
    </style>
    <script>
        $("#datetimepicker1").datetimepicker({
            format: 'YYYY-MM-DD'
        });
        // $("#datetimepicker2").datetimepicker({
        //     format: 'YYYY-MM-DD'
        // });

        function resultUser(user, stt) {
            const {
                nickname,
                money,
                chatId,
                code,
                moneyCashBack
            } = user;

            var rs = "";
            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            rs += `<td style="text-align: center;">${nickname}</td>"`;
            rs += `<td style="text-align: center;">${commaSeparateNumber(money)}</td>`;
            rs += "</tr>";
            return rs;
        }
        $("#search_tran").click(function() {
            var oldPage = 0;
            var from = moment($("#fromDate").val(), "YYYY-MM-DD");
            // var to = moment($("#toDate").val(), "YYYY-MM-DD");
            // if (from > to) {
            //     alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            //     return false;
            // }
            $("#spinner").bind("ajaxSend", function() {
                $(this).show();
            }).bind("ajaxStop", function() {
                $(this).hide();
            }).bind("ajaxError", function() {
                $(this).hide();
            });
            // const te = moment($("#toDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
            const ts = moment($("#fromDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');

            $('#pagination-demo').css("display", "block");
            $("#numuser").html(0);
            $("#resultsearch").html("");


            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/usersAjax') ?>",
                data: {
                    ts,
                    // te,
                    page: 1,
                    size: $('#record').val(),
                    c: "11033"
                },
                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
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
                            $("#numuser").html(result.totalRecord);
                            var $pagination = $('#pagination-demo');

                            // Temporarily unbind onPageClick event to prevent AJAX call
                            $pagination.off('page');

                            // Now safely destroy the pagination
                            $pagination.twbsPagination('destroy');
                            $pagination.twbsPagination({
                                totalPages: result.totalPage,
                                visiblePages: 5,
                                onPageClick: function(event, page) {
                                    if (oldPage > 0) {
                                        $("#resultsearch").html("");
                                        $("#spinner").show();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo admin_url('giftcode/usersAjax') ?>",
                                            data: {
                                                ts,
                                                // te,
                                                page,
                                                size: $('#record').val(),
                                                c: "11033"
                                            },
                                            dataType: 'json',
                                            success: function(result) {
                                                $("#spinner").hide();
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
                                                        $("#numuser").html(result.totalRecord);
                                                        
                                                    }
                                                } else {
                                                    $('#pagination-demo').css("display", "none");
                                                }
                                            }
                                        });
                                    }
                                    oldPage = page;
                                }
                            })
                        }
                    } else {
                        $('#pagination-demo').css("display", "none");
                    }
                }
            });
        });
        $(document).ready(function() {
            var oldPage = 0;
            // const te = moment($("#toDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
            const ts = moment($("#fromDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
            $('#pagination-demo').css("display", "block");
            $("#numuser").html(0);

            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/usersAjax') ?>",
                data: {
                    ts,
                    // te,
                    page: 1,
                    size: $('#record').val(),
                    c: "11033"
                },
                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
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
                            $("#numuser").html(result.totalRecord);
                            var $pagination = $('#pagination-demo');

                            // Temporarily unbind onPageClick event to prevent AJAX call
                            $pagination.off('page');

                            // Now safely destroy the pagination
                            $pagination.twbsPagination('destroy');
                            $pagination.twbsPagination({
                                totalPages: result.totalPage,
                                visiblePages: 5,
                                onPageClick: function(event, page) {
                                    if (oldPage > 0) {
                                        $("#resultsearch").html("");
                                        $("#spinner").show();

                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo admin_url('giftcode/usersAjax') ?>",
                                            data: {
                                                ts,
                                                // te,
                                                page,
                                                size: $('#record').val(),
                                                c: "11033"
                                            },
                                            dataType: 'json',
                                            success: function(result) {
                                                $("#spinner").hide();
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
                                                        $("#numuser").html(result.totalRecord);
                                                        
                                                    }
                                                } else {
                                                    $('#pagination-demo').css("display", "none");
                                                }
                                            }
                                        });
                                    }
                                    oldPage = page;
                                }
                            })
                        }
                    } else {
                        $('#pagination-demo').css("display", "none");
                    }
                }
            });
            $("#send_code").click(function() {
                const percent = $("#percent").val();
                const messageCode = $("#messageCode").val();
                if (!percent || !messageCode) {
                    alert("Bạn phải điền đầy đủ thông tin");
                    return false;
                }
                if (percent <= 0 || percent > 100) {
                    alert("Phần trăm phải lớn hơn 0 và nhỏ hơn 100");
                    return false;
                }
                // const te = moment($("#toDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');
                const ts = moment($("#fromDate").val(), "YYYY-MM-DD").format('YYYY-MM-DD');

                $("#spinner").show();
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('giftcode/sendCodeUserAjax') ?>",
                    data: {
                        ts,
                        // te,
                        percent,
                        messageCode,
                        c: "11032"
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#spinner").hide();
                        if (result.success) {
                            alert("Gửi code thành công!")
                        } else {
                            alert(`Gửi code KHÔNG thành công! Lý do: ${result.errorCode}`)
                        }
                    }
                });

            });
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