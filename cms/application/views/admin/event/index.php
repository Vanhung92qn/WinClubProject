<?php $this->load->view('admin/event/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>Danh sách sự kiện </h6>
            <div  class="num f12">Tổng số: <b id ="num"></b></div>
        </div>
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>

        <table>
            <tr>
                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Tên sự kiện:</label></td>
                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="eventName" value="<?php echo $this->input->post('name') ?>" name="event"></td>
                <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Tỷ lệ:</label></td>
                <td><input type="number" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="rate" value="<?php echo $this->input->post('rate') ?>"></td>
                
                <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Trạng thái:</label></td>
                <td class="">
                    <select id="typegd" name="money_type" style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                        <option value="" selected>Tất cả</option>
                        <option value="true" <?php if ($this->input->post('status') == "true") {
                                                echo "selected";
                                            } ?>>Hoạt động</option>                
                        <option value="false" <?php if ($this->input->post('status') == "false") {
                                                echo "selected";
                                            } ?>>Không hoạt động</option>

                    </select>
                </td>

            </tr>
        </table>
        <table style="margin-top: 15px">
            <tr>
                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Loại sự kiện:</label></td>
                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="eventType" value="" name="type"></td>
                <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Đường link:</label></td>
                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="eventUrl" value=""></td>
                <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Hành động:</label></td>
                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px" id="eventAction" value=""></td>

            </tr>
        </table>
        <table style="margin-top: 15px">
            <tr>
                <td>
                    <label for="param_name" class="formLeft" id="nameuser" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Ngày bắt đầu:</label>
                </td>
                <td class="item">
                    <div class="input-group date" id="datetimepicker1">
                        <input type="text" id="fromDate" name="fromDate" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>


                </td>

                <td>
                    <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Ngày kết thúc: </label>
                </td>
                <td class="item">

                    <div class="input-group date" id="datetimepicker2">
                        <input type="text" id="toDate" name="toDate" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </td>

                <td style="">
                    <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 123px">
                </td>
                <td>
                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('event/index') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                </td>

            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Tên sự kiện</td>
                    <td>Ngày bắt đầu</td>
                    <td>Ngày kết thúc</td>
                    <td>Tỷ lệ</td>
                    <td>Trạng thái</td>
                    <td>Loại sự kiện</td>
                    <td>Đường link</td>
                    <td>Hành động</td>
                    <td>Cập nhật</td>
                </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
        <div class="modal fade"  id="modalUpdate">
        <button style="align-self: flex-end; background-color: cyan" id="closeModal">X</button>
        <input type="text" id="idModal" hidden>

        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Tên sự kiện:</label>

                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="eventNameModal" />

                                </div>
                                <label class="col-sm-2" id="errorph" style="color: red"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row" style="display: flex">
                                <div class="col-sm-2">
                                </div>
                                <label id="labelvin" class="col-sm-2 control-label">Ngày bắt đầu:</label>
                                <div class="col-sm-2 input-group date" style="padding-inline: 15px" id="datetimepicker3">
                                    <input type="text" id="fromDateModal" style="width: 100%; line-height: 2.5" name="fromDate">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <label class="col-sm-2 control-label">Ngày kết thúc:</label>

                                <div class="col-sm-2 input-group date" style="padding-inline: 15px" id="datetimepicker4">
                                    <input type="text" id="toDateModal" style="width: 100%; line-height: 2.5" name="toDate" >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Tỷ lệ:</label>

                                <div class="col-sm-2">
                                    <select id="rateModal">
                                        <option value="10">10%</option>
                                        <option value="20" selected>20%</option>
                                        <option value="50">50%</option>
                                        <option value="100">100%</option>
                                    </select>
                                </div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Trạng thái:</label>

                                <div class="col-sm-2">
                                    <select id="statusModal">
                                        <option value="true">Hoạt động</option>
                                        <option value="false">Ngừng hoạt động</option>
                                    </select>
                                </div>
                                <label class="col-sm-2" id="errorsl" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Loại sự kiện:</label>
                                <div class="col-sm-2" style="padding-inline: 15px">
                                    <input type="text" id="eventTypeModal" style="width: 100%; line-height: 2.5" name="type">
                                </div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Đường link:</label>
                                <div class="col-sm-2" style="padding-inline: 15px">
                                    <input type="text" id="eventUrlModal" style="width: 100%; line-height: 2.5" name="url">
                                </div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <label class="col-sm-2 control-label">Hành động:</label>
                                <div class="col-sm-2" style="padding-inline: 15px">
                                    <input type="text" id="eventActionModal" style="width: 100%; line-height: 2.5" name="action">
                                </div>
                                <label id="errormg" style="color:red " class="col-sm-2"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-1"><input type="button" data-toggle="modal" data-target="#modalUpdate" value="Lưu thay đổi" name="button" class="btn btn-primary pull-left" id="update"></div>
                                
                            </div>
                        </div>

        </div>
    </div>
</div>
<script>
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    $("#update").click(function() {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('event/updateEventAjax')?>",
            data: {
                eventName: $("#eventNameModal").val(),
                toDate: $("#toDateModal").val(),
                fromDate: $("#fromDateModal").val(),
                id: $("#idModal").val(),
                rate: $("#rateModal").val(),
                status: $("#statusModal").val(),
                type: $("#eventTypeModal").val(),
                url: $("#eventUrlModal").val(),
                action: $("#eventActionModal").val(),
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                $("#modalUpdate").hide();
                if (result.errorCode != "200") {
                    alert('Cập nhật không thành công. Thử lại sau')
                } else {
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.events, function(index, value) {
                        result += resultSearchTransction(stt, value.id, value.eventName, value.timeStart, value.timeEnd, value.rate, 
                        value.status, value.type, value.url, value.action);
                        stt++;

                    });
                    $('#logaction').html(result);
                    alert('Cập nhật thành công!')
                
                }
            },
            error: function() {
                $("#spinner").hide();
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 3 * 60 * 1000
        })
    })
    $("#search_tran").click(function() {
        var fromDatetime = moment($("#fromDate").val(), 'DD-MM-YYYY');
        var toDatetime = moment($("#toDate").val(), 'DD-MM-YYYY');
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('event/listAllEventAjax')?>",
            data: {
                eventName: $("#eventName").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                status: $("#typegd").val(),
                rate: $("#rate").val(),
                type: $("#eventType").val(),
                url: $("#eventUrl").val(),
                action: $("#eventAction").val()
            },

            dataType: 'json',
            success: function(result) {
                $("#spinner").hide();
                if (!result.events) {
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.events, function(index, value) {
                        result += resultSearchTransction(stt, value.id, value.eventName, value.timeStart, 
                        value.timeEnd, value.rate, value.status, value.type, value.url, value.action);
                        stt++;

                    });
                    $('#logaction').html(result);
                
                }
            },
            error: function() {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            },
            timeout: 3 * 60 * 1000
        })
    });

    function resultSearchTransction(stt, id, eventName, start, end, rate, status, type, url, action) {
        var rs = "";
        rs += `<tr style="text-align: center" id="${id}">`;
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + eventName + "</td>";
        rs += "<td>" + start + "</td>";
        rs += "<td>" + end + "</td>";
        rs += "<td>" + rate + "</td>";
        rs += `<td>${status ? 'Hoạt động' : 'Không hoạt động'}</td>`;
        rs += "<td>" + type + "</td>";
        rs += "<td>" + url + "</td>";
        rs += "<td>" + action + "</td>";

        rs += `<td><input type="button" data-toggle="modal" data-target="#modalUpdate" onclick=\"updateEvent('${id}', '${eventName}', '${start}', '${end}', '${rate}','${status}', '${type}', '${url}', '${action}')\" style="color: #fff" value="Cập nhật" /></td>`;
        rs += "</tr>";
        return rs;
    }
   

function updateEvent(id, eventName, start, end, rate, status, type, url, action) {
    $('#modalUpdate').show();
    $('#modalUpdate').attr('style', 'display: flex; flex-direction: column');
    $('#eventNameModal').val(eventName);
    $('#idModal').val(id);
    $('#fromDateModal').val(start);
    $('#toDateModal').val(end);
    $('#rateModal').val(rate);
    $('#statusModal').val(status);
    $('#eventTypeModal').val(type);
    $('#eventUrlModal').val(url);
    $('#eventActionModal').val(action);
}
$(document).ready(function() {
    // var oldPage = 0;
    var result = "";
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('event/listAllEventAjax')?>",
        data: {
            eventName: $("#eventName").val(),
            toDate: $("#toDate").val(),
            fromDate: $("#fromDate").val(),
            status: $("#typegd").val(),
            rate: $("#rate").val(),
            type: $("#eventType").val(),
            url: $("#eventUrl").val(),
            action: $("#eventAction").val()
        },

        dataType: 'json',
        success: function(result) {
            $("#spinner").hide();
            if (!result.events) {
                $("#resultsearch").html("Không tìm thấy kết quả");
            } else {
                $("#resultsearch").html("");
                stt = 1;
                $.each(result.events, function(index, value) {
                    result += resultSearchTransction(stt, value.id, value.eventName, value.timeStart, 
                    value.timeEnd, value.rate, value.status, value.type, value.url, value.action);
                    stt++;

                });
                $('#logaction').html(result);
               
            }
        },
        error: function() {
            $("#spinner").hide();
            $('#logaction').html("");
            $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
        },
        timeout: 3 * 60 * 1000
    });

    $('#closeModal').click(function () {
        $('#modalUpdate').hide();
    })

});
</script>
<style>
    #modalUpdate {
        position: absolute;
        background: cyan;
        height: 70vh;
        top: 0;
    }
    #modalUpdate input {
        font-size: 18px;
    }
    table input {
        height: 26px;
    }
</style>