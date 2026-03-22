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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #82d1ff; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title" style="display: flex;justify-content: center">
            <h6 style="color: #0096a5; font-size: 28px;">CODE TÂN THỦ</h6>
        </div>

        <form class="list_filter form">
            <div class="formRow">
                <table style="width: 60%;text-align: center;margin: 11px auto;max-width: 600px;">
                    <tr>
                        <td> <label for="param_name" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 100px">MÃ CODE:</label></td>
                        <td class="item">
                            <div class="input-group">
                                <input type="text" id="codeTanThu" name="codeTanThu" value="">
                            </div>
                        </td>

                        <td><label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> GIÁ TRỊ: </label></td>
                        <td class="item">
                            <div class="input-group" >
                                <input type="text" id="money" name="money" value="">
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="create_code" value="TẠO CODE" class="button blueB" style="margin-left: 70px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <div style='position: relative;'>
            <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH CODE TÂN THỦ</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllDoimain" style="background: rgb(224, 255, 255); display: block;border: 1px solid green;max-height: 300px;overflow-y: scroll;width: 100%;">
                        <thead style="height: 35px; background: #0096a5;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>Mã Code Tân Thủ</td>
                                <td>Giá trị</td>
                                <td>Ngày tạo</td>
                                <td>Trạng thái</td>
                                <td>Hành động</td>
                            </tr>
                        </thead>
                        <tbody id="logactionAcc">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->
        </div>
        <hr>

        <form class="list_filter form">
            <div class="formRow">
                <table style="width: 60%;text-align: center;margin: 11px auto;max-width: 400px;">
                    <tr>
                        <td> <label for="param_name" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 100px">MÃ CODE:</label></td>
                        <td class="item">
                            <div class="input-group">
                                <input type="text" id="codeTanThuSearch" name="codeTanThuSearch" value="">
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="search_code" value="TÌM KIẾM" class="button blueB" style="margin-left: 70px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <div style='position: relative;'>
            <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH USER DÙNG CODE TÂN THỦ</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllAccUse" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>Mã Code</td>
                                <td>NickName</td>
								<td>Username</td>
								<td>Phone</td>
								<td>Active</td>
                                <td>Thời gian sử dụng</td>
                                <td>Use</td>
                            </tr>
                        </thead>
                        <tbody id="logactionAccUse">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->
        </div>


    </div>
</div>

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
    }
    .sTable thead td {
        border-bottom: 1px solid #cbcbcb;
        border-left: 1px solid #cbcbcb;
        font-size: 15px;
        color: #ffffff;
        padding: 10px 4px 2px 4px;
    }

    .Content-table {
        display: flex;
        justify-content: space-between;
        justify-content: space-around;
        margin-top: 30px;
    }

    .Content-table-item__ttl {
        text-align: center;
    }

    .Content-table-item__ttl h4 {
        font-size: 25px;
        color: #a51700;
        font-weight: bold;
    }

    </style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>

    $(document).ready(function () {
        $("#create_code").click(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('user/addCodeTanThuAjax')?>",
                data: {
                    code:  $("#codeTanThu").val(),
                    money: $("#money").val()
                },

                dataType: 'json',
                success: function (result) {
                    
                    if (result == '1') {
                        renderlistAcc();
                    } else {
                        alert("Thêm thất bại!")
                    }

                }, error: function () {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                }, timeout: 20000
            })

        });

        $("#search_code").click(function() {
            var accUse = "";
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('user/searchCodeTanThuAjax')?>",
                data: {
                    code:  $("#codeTanThuSearch").val()
                },

                dataType: 'json',
                success: function (result) {
                    console.log(result);

                    stt = 1
                    $.each(result.reverse(), function (index, value) {
                        accUse += listAccUse(stt, value);
                        stt++;
                    });
                    $('#logactionAccUse').html(accUse);
                    var table = $('#checkAllAccUse').DataTable({
                        "ordering": true,
                        "searching": true,
                        "paging": false,
                        "draw": false
                    });
                }, error: function () {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                }, timeout: 20000
            })

        });
        renderlistAcc();
    });

    function listAccFunc(stt, value) {
        console.log(value);
        var rs = "";
        rs += "<tr id=" + value.nickname + "_item" + ">";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; min-width: 161px;'>" + value.code + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + commaSeparateNumber(value.money) + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.timelog + "</td>";
        if (value.stop == '0') {
            rs += "<td style='color: #01125f;font-weight: bold; text-align: center;background-color: #81ffb9;'>Đã kích hoạt</td>";
        } else {
            rs += "<td style='color: #01125f;font-weight: bold; text-align: center;background-color: #f1e985;'>Chưa kích hoạt</td>";
        }

        rs += "<td id=" + value.nickname + "_action" + " style='display: flex;justify-content: center;align-items: center;'>"

        if (value.stop == '0') {
            rs += "<span class='label label-danger' style='padding: 8px;margin-left: 10px;background-color: #7a6fbe;'><a style='color: white;' href=\"javascript: HuyKichHoat(" + "`" + value.code + "`" + ")\">Hủy Kích Hoạt</a></span>";
        } else {
            rs += "<span class='label label-danger' style='padding: 8px;margin-left: 10px;background-color: #00a7af;'><a style='color: white;' href=\"javascript: KichHoat(" + "`" + value.code + "`" + ")\">Kích Hoạt</a></span>";
        }
        rs += "<span class='label label-danger' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: Delete(" + "`" + value.code + "`" + ")\">Xóa</a></span>";
    
        rs += "</td>";

        rs += "</tr>";
        return rs;
    }
    function listAccUse(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; min-width: 161px;'>" + value.code + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.nickname + "</td>";
		rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.username + "</td>";
		rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.phone + "</td>";
		if(value.active == 1) {
			rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>Đã kích hoạt</td>";
		} else {
			rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>Chưa kích hoạt</td>";
		}
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.timelog + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.use + "</td>";
        rs += "</tr>";
        return rs;
    }



    function Delete(code) {
        if (!confirm('Bạn chắc chắn muốn Xóa Acc active này không ?')) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/deleteCodeTanThuAjax')?>",
            data: {
                code: code
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result == '1') {
                    renderlistAcc();
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function KichHoat(code) {
        if (!confirm('Bạn chắc chắn muốn kích hoạt code tân thủ này không ?')) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/updateCodeTanThuAjax')?>",
            data: {
                code: code,
                stop: 0
            },

            dataType: 'json',
            success: function (result) {
                if(result == '1') {
                    renderlistAcc();
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    function HuyKichHoat(code) {
        if (!confirm('Bạn chắc chắn muốn hủy Code tân thủ này không ?')) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/updateCodeTanThuAjax')?>",
            data: {
                code: code,
                stop: 1
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                if(result == '1') {
                    renderlistAcc();
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

    
    function renderlistAcc() {
        var listAcc = "";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/listCodeTanThuAjax") ?>",
            data: {
                fromDate: $("#fromDate").val(),
                toDate: $("#toDate").val()
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                stt = 1
                $.each(result.reverse(), function (index, value) {
                    listAcc += listAccFunc(stt, value);
                    stt++;
                });
                $('#logactionAcc').html(listAcc);

                // var table = $('#checkAllDoimain').DataTable({
                //     "ordering": true,
                //     "searching": true,
                //     "paging": false,
                //     "draw": false
                // });
            },
            error: function () {
                console.log(66666);
                $("#spinner").hide();
            }, timeout: 50000000
        });
    }

</script>

<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function convertTime(time) {
        var a = new Date(time);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
        return time;
    }
</script>

