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
        <div class="title">
            <h6 style="color: #001f0f;">THỐNG KÊ CLICK QUẢNG CÁO ĐẾN WEB</h6>
        </div>

        <form class="list_filter form" action="<?php echo admin_url('user/seogame') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td> <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $start_time ?>"> <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>

                        <td><label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Đến ngày: </label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $end_time ?>"><span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>

                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>

                        <td style="">
                            <input type="button" value="Sửa list" class="button blueB" style="margin-left: 70px" data-toggle="modal" data-target="#modalUpdateListDaily">
                        </td>

                    </tr>
                </table>
            </div>
        </form>

        <div style='position: relative;'>

            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH CLICK SEO</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllDoimain" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>WEB ĐẶT LINK (A)</td>
                                <td>CLICK (A) => (B)</td>
                                <td>WEB TRỎ TỚI (B)</td>
                                <td>UTM_DL</td>
                                <td>utm_medium 1</td>
                                <td>utm_medium 2</td>
                                <td>utm_medium 3</td>
                                <td>utm_medium 4</td>
                                <td>utm_medium 5</td>
                            </tr>
                        </thead>
                        <tbody id="logactionDoimain">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalUpdateListDaily" tabindex="-1" role="dialog" aria-labelledby="modalUpdateListDailyTitle" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 96%;padding-left: 260px;margin-top: 66px;">
                <div class="modal-content" style="border-radius: 10px; background: #fff;">
                    <div class="modal-header" style="border-bottom-color: #f4f4f4; background: linear-gradient(0deg, rgb(41 55 70), rgb(0 0 0));">
                        <h2 style="text-align: center; color: #fff; font-weight: bold;" class="modal-title" id="modalUpdateListDailyTitle">Danh Sách utm_medium</h2>
                        <div style="text-align: center; color: #fff; font-weight: bold;">LINK SEO: <br><span id="renderUrlCeoText"></span></div>
                        <h3 style="position: relative;"><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
                    </div>
                    <div class="modal-body">

                        <table id="tableListDaily"  class="table table-bordered table-hover" style="table-layout: fixed;word-wrap: break-word;">
                            <thead>
                            <tr>
                                <th style="width: 5px">STT</th>
                                <th style="width: 55px">WEB GẮN LINK</th>
                                <th style="width: 55px">WEB TRỎ TỚI</th>
                                <th style="width: 55px">UTM_DL</th>
                                <th>utm_medium 1</th>
                                <th>utm_medium 2</th>
                                <th>utm_medium 3</th>
                                <th>utm_medium 4</th>
                                <th>utm_medium 5</th>
<!--                                <th>utm_medium 6</th>-->
<!--                                <th>utm_medium 7</th>-->
<!--                                <th>utm_medium 8</th>-->
<!--                                <th>utm_medium 9</th>-->
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="listEditKey">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="text-align: center;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;background-color: #2b3a4a;">Close</button>
                        <button type="button" id="addKey" class="btn label-success" style="color: #fff;">Thêm Mới Đại Lý</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal -->
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
                alert('Ngày kết thúc phải lớn hơn ngày bắt đầu');
                return false;
            }
        });
        renderlistDoimainajax();
        getListKeyajax();

        $("#addKey").click(function() {
            $('#tableListDaily > tbody > tr:first').before(renderInputKey());
        });
    });

    function ListDoimain(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span>" + value.key10.value + "</span></td>";
        rs += "<td style='color: #f00;font-weight: bold; text-align: center; font-size: 18px;'>" + commaSeparateNumber(value.key10.count) + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span>" + value.key9.value + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span>" + value.code_dl + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span style='color: #f00;font-size: 18px;'>" + commaSeparateNumber(value.key1.count) + "</span><br><span>" + value.key1.value + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span style='color: #f00;font-size: 18px;'>" + commaSeparateNumber(value.key2.count) + "</span><br><span>" + value.key2.value + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span style='color: #f00;font-size: 18px;'>" + commaSeparateNumber(value.key3.count) + "</span><br><span>" + value.key3.value + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span style='color: #f00;font-size: 18px;'>" + commaSeparateNumber(value.key4.count) + "</span><br><span>" + value.key4.value + "</span></td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'><span style='color: #f00;font-size: 18px;'>" + commaSeparateNumber(value.key5.count) + "</span><br><span>" + value.key5.value + "</span></td>";
        rs += "</tr>";
        return rs;
    }

    function renderInputKey(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>NEW</td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeUtmSource'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeDomain'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeDaily'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeKey1'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeKey2'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeKey3'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeKey4'></td>";
        rs += "<td style='color: #0008ff;font-weight: bold;'><input style='width: 100%;' class='form-control' name='' id='codeKey5'></td>";
        // rs += "<td style='color: #0008ff;font-weight: bold;'><input class='form-control' name='' id='codeKey6'></td>";
        // rs += "<td style='color: #0008ff;font-weight: bold;'><input class='form-control' name='' id='codeKey7'></td>";
        // rs += "<td style='color: #0008ff;font-weight: bold;'><input class='form-control' name='' id='codeKey8'></td>";
        rs += "<td style='display: flex;justify-content: space-evenly;align-items: center;height: 50px;'><span class='label label-success'><a style='color: white;' href=\"javascript: addKeyToListAjax(1)\">Thêm</a></span><span class='label label-primary'><a style='color: white;' href=\"javascript: addKeyToListAjax(0)\">Update</a></span></td>";
        rs += "</tr>";
        return rs;
    }
    // data-toggle='modal' data-target='#modalUpdateListDaily'
    // <a href=\"javascript: approve(" + tid + "," + money + ")\">Duyệt</a>
    function renderListEditKey(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += value.key10 == undefined ? "<td></td>" : "<td style='color: #0532b1;font-weight: bold;background: #16ffc9;'>" + value.key10 + "</td>";
        rs += value.key9 == undefined ? "<td></td>" : "<td style='color: #0532b1;font-weight: bold;background: #f0ff9a;'>" + value.key9 + "</td>";
        rs += "<td style='color: #0532b1;font-weight: bold;background: #daefea;'>" + value.code_dl + "</td>";
        rs += value.key1 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'><a href=\"javascript: functionrenderListKey('" + value.code_dl + "','" + value.key1 + "','" + value.key9 + "','" + value.key10 + "')\">" + value.key1 + "</a></td>";
        rs += value.key2 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'><a href=\"javascript: functionrenderListKey('" + value.code_dl + "','" + value.key2 + "','" + value.key9 + "','" + value.key10 + "')\">" + value.key2 + "</a></td>";
        rs += value.key3 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'><a href=\"javascript: functionrenderListKey('" + value.code_dl + "','" + value.key3 + "','" + value.key9 + "','" + value.key10 + "')\">" + value.key3 + "</a></td>";
        rs += value.key4 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'><a href=\"javascript: functionrenderListKey('" + value.code_dl + "','" + value.key4 + "','" + value.key9 + "','" + value.key10 + "')\">" + value.key4 + "</a></td>";
        rs += value.key5 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'><a href=\"javascript: functionrenderListKey('" + value.code_dl + "','" + value.key5 + "','" + value.key9 + "','" + value.key10 + "')\">" + value.key5 + "</a></td>";
        // rs += value.key6 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'>" + value.key6 + "</td>";
        // rs += value.key7 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'>" + value.key7 + "</td>";
        // rs += value.key8 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'>" + value.key8 + "</td>";
        // rs += value.key9 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'>" + value.key9 + "</td>";
        // rs += value.key10 == undefined ? "<td></td>" : "<td style='color: #ff0500;font-weight: bold;'>" + value.key10 + "</td>";
        rs += "<td style='display: flex;justify-content: space-evenly;align-items: center;height: 37px;'><span class='label label-danger'><a style='color: white;' href=\"javascript: removeKey('" + value.code_dl + "')\">Xóa</a></span></td>";
        rs += "</tr>";
        return rs;
    }

    function functionrenderListKey(code_dl, utm_medium, domain, utm_source) {
        var renderUrlKey = "https://" + domain + "?seo=true&utm_dl=" + code_dl + "&utm_source=" + utm_source + "&utm_medium=" + utm_medium + "&utm_campaign=CEO_1";
        console.log(renderUrlKey);
        $('#renderUrlCeoText').html(renderUrlKey);
    }

    
    function renderlistDoimainajax() {
        var listDoimain = "";
        $.ajax({
            type: "GET",
            url: "https://apisieunhangao.net/api",
            data: {
                c: 4056,
                start: $("#fromDate").val(),
                end: $("#toDate").val()
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                stt = 1
                $.each(result, function (index, value) {
                    listDoimain += ListDoimain(stt, value);
                    stt++;
                });
                $('#logactionDoimain').html(listDoimain);
                var table = $('#checkAllDoimain').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
            },
            error: function () {
                $("#spinner").hide();
            }, timeout: 50000000
        });
    }

    function getListKeyajax() {
        var result = "";
        var listEitkey = "";
        $.ajax({
            type: "GET",
            url: "https://apisieunhangao.net/api",
            data: {
                c: 4053,
                page: 1,
                maxItem: 1000
            },
            dataType: 'json',
            success: function (result) {
                stt = 1
                $.each(result, function (index, value) {
                    listEitkey += renderListEditKey(stt, value);
                    stt++;
                });
                $('#listEditKey').html(listEitkey);
                var table = $('#tableListDaily').DataTable({
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

    function removeKey(code_dl) {
        alert('Chức năng cần mới code!')
    }

    function addKeyToListAjax(type) {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "https://apisieunhangao.net/api",
            data: {
                c: 4054,
                type: type,
                key9: $("#codeDomain").val().trim(),
                key10: $("#codeUtmSource").val().trim(),
                code_dl: $("#codeDaily").val().trim(),
                key1: $("#codeKey1").val().trim(),
                key2: $("#codeKey2").val().trim(),
                key3: $("#codeKey3").val().trim(),
                key4: $("#codeKey4").val().trim(),
                key5: $("#codeKey5").val().trim(),
                key6: "",
                key7: "",
                key8: ""
            },
            cache: true,
            dataType: 'json',
            success: function (result) {

                switch (result.error) {
                    case '0':
                        $("#resultAdd").css({"color": "#00ff37"});
                        $("#resultAdd").html("Thêm thành công!");
                        getListKeyajax();
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

</script>

<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>
