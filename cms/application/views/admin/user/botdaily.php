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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #82d1ff; border-radius: 15px;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #001f0f;">THÊM BOT CHAT ĐẠI LÝ</h6>
        </div>
        <p style="color: #076f00; font-weight: bold;">NOTE: Tìm kiếm ID Telegram tại bảng <span>GET ID TELEGRAM</span> sau đó Thêm / Cập nhật ID Telegram mới Sang bảng <span>DANH DÁCH BOT ĐẠI LÝ</span></p>
        <form class="list_filter form" action="" method="post">
            <div class="formRow">
                <table style='margin: 0 auto;'>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="nickName" value="" name="nickName"></td>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">ID TeleGram:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="idTelegram" value="" name="idTelegram"></td>
                        <td><input type="button" id="addNickname" value="THÊM / CẬP NHẬT" class="button blueB" style="margin-left: 50px"></td>
                    </tr>
                </table>
            </div>
        </form>
        
        <div style='position: relative;'>
            <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
            <div Class="Content-table">

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4 style="color: #003a3a;">GET ID TELEGRAM <i class="fa fa-telegram" aria-hidden="true"></i></h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllTele" style="background: #e0ffff;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #0096a5;">
                        <tr style="height: 35px;">
                            <td>STT</td>
                            <td>NickName</td>
                            <td>ID TeleGram</td>
                        </tr>
                        </thead>
                        <tbody id="logactionTele">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH BOT ĐẠI LÝ</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllBot" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>NickName</td>
                                <td>ID TeleGram</td>
                                <td>Hành động</td>
                            </tr>
                        </thead>
                        <tbody id="logactionBot">
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
        getIDTele();
        renderListBotDaily();
    });

    $("#addNickname").click(function () {
        addBotTeleDailyToList();
    });

    function searchTrans(stt, value) {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    }

    function resultSearchTransction(stt, value) {
        var rs = "";
        if ((value.TotalInUser + value.totalOutUser) < 0) {
            rs += "<tr style='background: #ffdbdb;'>";
        } else {
            rs += "<tr style='background: #c1ffcf;'>";
        }
        rs += "<td>" + stt + "</td>";
        rs += "<td style='color: #001fff;font-weight: bold;'>" + value.NickName + "</td>";
        rs += "<td style='color: #0028ec;font-weight: bold;'>" + commaSeparateNumber(value.TotalInUser) + "</td>";
        rs += "<td style='color: #530054;font-weight: bold;'>" + commaSeparateNumber(value.totalOutUser) + "</td>";
        rs += "<td style='color: #001fff;font-weight: bold;'>" + commaSeparateNumber(value.TotalInUser + value.totalOutUser) + "</td>";
        rs += "</tr>";
        return rs;
    }

    function addBotTeleDailyToList() {
        if ($("#nickName").val() == "") {
            $("#resultAdd").html("Bạn chưa nhập NickName!");
            return;
        }
        if ($("#idTelegram").val() == "") {
            $("#resultAdd").html("Bạn chưa nhập ID Telegram!");
            return;
        }
        console.log($("#idTelegram").val());
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/addbotdailyajax") ?>",
            data: {
                nickName: $("#nickName").val(),
                idTele: $("#idTelegram").val()
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                switch (result.errorCode) {
                    case '0':
                        $("#resultAdd").css({"color": "#00801b"});
                        $("#resultAdd").html("Thêm thành công!");
                        renderListBotDaily();
                        break;
                    case '1':
                        $("#resultAdd").css({"color": "#00801b"});
                        $("#resultAdd").html("Update thành công!");
                        renderListBotDaily();
                        break;
                    default:
                        $("#resultAdd").html("Lỗi không xác định!");
                        break;
                }
                $("#spinner").hide();
            }
            ,error: function(){
                $("#spinner").hide();
                $("#resultAdd").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout:3000
        });
        
    }
    function remove(nickName) {
        if(!confirm("Bạn có chắc chắn xóa bỏ?")){
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/user/removebotdailyajax')?>",
            data: {
                nickName: nickName
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $("#spinner").hide();
                if (result.success) {
                    $("#resultAdd").css({"color": "#00801b"});
                    $("#resultAdd").html("Xóa thành công!");
                    renderListBotDaily();
                } else {
                    $("#resultAdd").css({"color": "#00801b"});
                    $("#resultAdd").html("Xóa thất bại!");
                }

            }, error: function () {
                $("#spinner").hide();
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }


    function ListBotTeleDaily(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; min-width: 161px;'>" + value.NickName + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold;'>" + value.IDTele + "</td>";
        rs += "<td><span class='label label-danger'><a style='color: white;' href=\"javascript: remove('" + value.NickName + "')\">Xóa</a></span></td>";
        rs += "</tr>";
        return rs;
    }
    
    function renderListBotDaily() {
        var listBotDaily = "";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/listbotdailyajax") ?>",
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                stt = 1
                $.each(result.ListBotTeleDaily, function (index, value) {
                    listBotDaily += ListBotTeleDaily(stt, value);
                    stt++;
                });
                $('#logactionBot').html(listBotDaily);
                // var table = $('#checkAllBot').DataTable({
                //     "ordering": true,
                //     "searching": true,
                //     "paging": false,
                //     "draw": false
                // });
            }
            ,error: function(){
                $("#spinner").hide();
            },
            timeout:3000
        });
    }

    function resultListTele(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td style='font-weight: bold; min-width: 161px;'>" + value.message.chat.username + "</td>";
        rs += "<td style='font-weight: bold;'>" + value.message.chat.id + "</td>";
        rs += "</tr>";
        return rs;
    }

    function getIDTele() {
        var listTele = "";
        $.ajax({
            type: "GET",
            url: "https://api.telegram.org/bot1794953953:AAFFk-QGjN6KIGPfVi48fQKDKqYsujel2EI/getupdates",
            cache: true,
            dataType: 'json',
            success: function (data) {
                stt = 1
                $.each(data.result, function (index, value) {
                    listTele += resultListTele(stt, value);
                    stt++;
                });

                $('#logactionTele').html(listTele);
                var table = $('#checkAllTele').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
            }
            ,error: function(){
                $("#spinner").hide();
            },
            timeout:3000
        });
    }


</script>
