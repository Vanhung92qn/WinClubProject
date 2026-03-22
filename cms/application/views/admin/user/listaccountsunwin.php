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
            <h6 style="color: #001f0f;">DANH SÁCH ACC SUNWIN</h6>
        </div>

        <form class="list_filter form">
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
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
                        </td>
                    </tr>
                </table>
				<hr>
            </div>
        </form>

        <div style='position: relative;'>
            <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH TÀI KHOẢN SUNWIN</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllDoimain" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td style="width: 60px;">STT</td>
                                <td>Mã đại lý</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>phone</td>
								<td>Time</td>
                                <td>Nickname</td>
								<td>Tiền</td>
								<td>Note</td>
								<td>tùy chỉnh</td>
                            </tr>
                        </thead>
                        <tbody id="logactionAcc">
                        </tbody>
                    </table>
                </div><!-- Content-table-item -->

            </div><!-- Content-table -->
        </div>
		
		<hr>
		
		<div style='position: relative;'>
            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH DÁCH TÀI KHOẢN SUNWIN CHƯA CÓ NICKNAME</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllAccNotNickname" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td style="width: 60px;">STT</td>
                                <td>Mã đại lý</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>phone</td>
								<td>Time</td>
                                <td>Nickname</td>
								<td>Tiền</td>
								<td>Note</td>
								<td>tùy chỉnh</td>
                            </tr>
                        </thead>
                        <tbody id="logactionAccNotNickname">
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
			renderlistAccByTime();
        });
		renderlistAccByTime();
    });

    function listAccFunc(stt, value) {
        var rs = "";
		var username = value.username;
		var timelog = value.timelog;
        rs += "<tr id=" + value.id + "_item" + ">";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; min-width: 161px;'>" + value.codedaily + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.username + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.password + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.phone + "</td>";
		rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.timelog + "</td>";
		if(value.tien != undefined){
			rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.nickname + "</td>";
			rs += "<td style='color: #0008ff;font-weight: bold;'>" + commaSeparateNumber(value.tien) + "</td>";
		} else {
			//rs += "<td style='color: #0008ff;font-weight: bold;'><input class='form-control keyupCheck' name='' id=" + value.id + "_nickname" + "></td>";
			rs += "<td style='color: #0008ff;font-weight: bold;'></td>";
			rs += "<td style='color: #0008ff;font-weight: bold;'></td>";
		}
		
		if(value.dangky){
			rs += "<td style='color: #0008ff;font-weight: bold;'>Đăng ký auto</td>";
		} else {
			rs += "<td style='color: #0008ff;font-weight: bold;'></td>";
		}
		
		rs += "<td id=" + value.id + "_action" +">  <span class='label label-danger'></span> <span class='label label-danger'><a style='color: white;' href=\"javascript: Delete(`" + value.id + "`,`" + username + "`,`" + timelog + "`)\">Delete</a></span> </td>";


        rs += "</tr>";
        return rs;
    }
	
	function Delete(id, username, timelog) {
		console.log(username);
		console.log(timelog);
        if (!confirm('Bạn có chắc chắn XÓA tài khoản này không?')) {
            return false;
        }
        $.ajax({
            type: "POST",
			url: "<?php echo base_url("admin/user/DeleteAccountSunwinAjax") ?>",
            data: {
                username: username,
				timelog: timelog
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.trangthai == 'ok') {
                    document.getElementById(id + "_item").innerHTML = "";
                } else {
                    alert("Xóa thất bại!")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

	function renderlistAccByTime() {
        var listAccByTime = "";
		var listAccNotNickname = "";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/listAccountSunWinByTimeAjax") ?>",
            data: {
                page: 0,
                maxitem: 5000,
				timestart: $("#fromDate").val(),
				timeend: $("#toDate").val()
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                stt1 = 1
				stt2 = 1
                $.each(result, function (index, value) {
                    
					if(value.nickname == undefined || value.tien == '0') {
						listAccNotNickname += listAccFunc(stt1, value);
						stt1++;
					} else {
						listAccByTime += listAccFunc(stt2, value);
						stt2++;
					}
                    
                });
                $('#logactionAcc').html(listAccByTime);
				
				$('#logactionAccNotNickname').html(listAccNotNickname);
				
				var table = $('#checkAllDoimain').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": false,
                    "draw": false
                });
				
				var table = $('#checkAllAccNotNickname').DataTable({
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
	

</script>
