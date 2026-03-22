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
            <h3 style="color: #733000; text-align: center; font-size: 30px; font-weight: bold;">REMOVE DB</h3>
        </div>

        <div class="list_filter form" >
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
                    </tr>
                    
                </table>
            </div><!-- formRow -->

            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin:15px">Bảng cần xóa:  </label></td>
                        <td>
                            <select id="name_db" name="name_db" >
                                <option value=""></option>
                                <option value="bau_cua_results">bau_cua_results</option>
                                <option value="bau_cua_toi_chon_ca">bau_cua_toi_chon_ca</option>
                                <option value="bau_cua_transaction">bau_cua_transaction</option>
                                <option value="bau_cua_transaction_detail">bau_cua_transaction_detail</option>
                                <option value="bong_da">bong_da</option>
                                <option value="bong_da_request">bong_da_request</option>
                                <option value="Card_mobile_Auto">Card_mobile_Auto</option>
                                <option value="cashout_by_bank_ls">cashout_by_bank_ls</option>
                                <option value="cashout_by_card_ls">cashout_by_card_ls</option>
                                <option value="deposit_bank_manual">deposit_bank_manual</option>
                                <option value="deposit_momo_manual">deposit_momo_manual</option>
                                <option value="deposit_OnePay_bank_manual">deposit_OnePay_bank_manual</option>
                                <option value="History_User_transaction">History_User_transaction</option>
                                <option value="log_Audition">log_Audition</option>
                                <option value="log_BENLEY">log_BENLEY</option>
                                <option value="log_candy">log_candy</option>
                                <option value="log_cao_thap">log_cao_thap</option>
                                <option value="log_cao_thap_win">log_cao_thap_win</option>
                                <option value="log_ccu">log_ccu</option>
                                <option value="log_chuyen_tien_dai_ly">log_chuyen_tien_dai_ly</option>
                                <option value="log_game">log_game</option>
                                <option value="log_game_detail">log_game_detail</option>
                                <option value="log_hu_game_bai">log_hu_game_bai</option>
                                <option value="log_MAYBACH">log_MAYBACH</option>
                                <option value="log_mini_poker">log_mini_poker</option>
                                <option value="log_money_user_nap_vin">log_money_user_nap_vin</option>
                                <option value="log_money_user_tieu_vin">log_money_user_tieu_vin</option>
                                <option value="log_money_user_vin">log_money_user_vin</option>
                                <option value="log_no_hu_slot">log_no_hu_slot</option>
                                <option value="log_RANGE_ROVER">log_RANGE_ROVER</option>
                                <option value="log_ROLL_ROYE">log_ROLL_ROYE</option>
                                <option value="log_Spartan">log_Spartan</option>
                                <option value="log_TAMHUNG">log_TAMHUNG</option>
                            </select>

                        </td>
                        <td><label style="margin:15px">Trường map time:  </label></td>
                        <td>
                            <select id="created_at">
                                <option value=""></option>
                                <option value="CreatedAt">CreatedAt</option>
                                <option value="time_log">time_log</option>
                                <option value="createAt">createAt</option>
                                <option value="trans_time">trans_time</option>
                                <option value="create_time">create_time</option>
                            </select>
                        </td>

                        <td style="">
                            <input id="btnremove" type="submit" data-toggle="modal" data-target="#exampleModalCenter" value="Xóa" class="button blueB" style="margin-left: 50px">
                        </td>
                        <td>
                            <input type="reset" onclick="window.location.href = '<?php echo admin_url('report/removedbmongo') ?>'; " value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                    
                </table>
            </div><!-- formRow -->
        </div><!-- list_filter -->


        <h3 id="notify"></h3>
        <div>Thời gia từ: <span id="timeStart"></span> - Đến <span id="timeEnd"></span></div>
        <div>Tên bảng xóa: <span id="tenBangXoa"></span></div>
        <div>Số lượng trường đã xóa: <span id="soTruongXoa"></span></div>

        <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="margin: 150px auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bạn đã chắc chắn xóa DB này chưa?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>Lưu ý: Việc xóa BD sẽ không thể khôi phục</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Hủy bỏ</button>
        <button id="act_remove"  type="button" class="btn btn-primary">Xóa</button>
      </div>
    </div>
  </div>
</div>


    </div>
</div>


<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
    </div>
</div>

<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
    
    $('#name_db').change(function() {
        switch ($(this).val()) {
            case "bau_cua_results":
            case "bau_cua_toi_chon_ca":
            case "bau_cua_transaction":
            case "bau_cua_transaction_detail":
            case "log_Audition":
            case "log_candy":
            case "log_cao_thap":
            case "log_cao_thap_win":
            case "log_ccu":
            case "log_game":
            case "log_game_detail":
            case "log_hu_game_bai":
            case "log_mini_poker":
            case "log_no_hu_slot":
            case "log_ROLL_ROYE":
            case "log_Spartan":
                $("#created_at").val("time_log");
                break;
            case "log_BENLEY":
            case "log_RANGE_ROVER":
            case "log_TAMHUNG":
            case "log_MAYBACH":
                $("#created_at").val("create_time");
                break;
            case "log_chuyen_tien_dai_ly":
            case "log_money_user_nap_vin":
            case "log_money_user_tieu_vin":
            case "log_money_user_vin":
                $("#created_at").val("trans_time");
                break;
            case "bong_da":
            case "bong_da_request":
            case "Card_mobile_Auto":
            case "cashout_by_bank_ls":
            case "cashout_by_card_ls":
            case "deposit_bank_manual":
            case "deposit_momo_manual":
            case "deposit_OnePay_bank_manual":
                $("#created_at").val("CreatedAt");
                break;
            case "History_User_transaction":
                $("#created_at").val("createAt");
                break;
            default:
                break;
        }

    });
    $("#act_remove").click(function () {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        var d = new Date;
        var month = d.getMonth();
        if (Number(d.getMonth()) < 10) {
            month = "0" + d.getMonth();
        }
        var dformat = [d.getFullYear(), month, d.getDate()].join('-')+' '+ [d.getHours(), d.getMinutes(), d.getSeconds()].join(':');
        if (toDatetime > dformat) {
            alert('Bạn không được xóa dự liệu tháng gần nhất!')
            return false;
        }
        
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        alert('Bạn chắc chắn xóa db!')
        remove();
    });

    function remove() {
        
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/removedbMongoajax')?>",
            data: {
                name_db: $("#name_db").val(),
                created_at: $("#created_at").val(),
                fromDate: $("#fromDate").val(),
                toDate: $("#toDate").val()
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $("#spinner").hide();
                if (result.success) {
                    $("#timeStart").html($("#fromDate").val());
                    $("#timeEnd").html($("#toDate").val());
                    $("#tenBangXoa").html($("#name_db").val());
                    $("#soTruongXoa").html(result.count);
                    $("#spinner").hide();
                    $("#notify").html("Xóa Thành công!");
                } else {
                    alert("Xóa thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 200000
        })
    }

</script>