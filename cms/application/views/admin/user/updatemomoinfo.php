<title>Cập Nhật Momo</title>
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
            <h6 style="color: #001f0f;">CẬP NHẬT THÔNG TIN MOMO</h6>
        </div>

        <form class="list_filter form">

				
				<table>
					<tr>
                        <td><label style="margin-left: 20px;width: 100px;margin-bottom:-3px;" class="formLeft"> Tìm kiếm: </label></td>
                        <td class="item">
                            <div class="input-group" style="width: 300px;">
                                <input type="text" id="timkiem" name="timkiem" placeholder="Tìm theo Nickname" >
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="search_name" value="Tìm kiếm" class="button blueB" style="margin-left: 70px">
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
                        <h4>KẾT QUẢ TÌM KIẾM</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAllDoimain" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td>STT</td>
                                <td>Nickname</td>
                                <td>Tên Momo</td>
                                <td>Số điện thoại</td>
								<td>Thời gian</td>
                                <td>Hành động</td>
                            </tr>
                        </thead>
                        <tbody id="logactionAcc">
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
        $(function() {});
		$("#search_name").click(function() {
			findAccountByNickname();
        });
    });

    function listAccFunc(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += `<td style='color: #01125f;font-weight: bold; min-width: 161px;'><input id="${value.nickName}_id" hidden value="${value.id}"/>${value.nickName}</td>`;
        rs += `<td style='color: #01125f;font-weight: bold; text-align: center;'><input id="${value.nickName}_phoneName" value="${value.phoneName}"/></td>`;
        rs += `<td style='color: #01125f;font-weight: bold; text-align: center;'><input id="${value.nickName}_phoneNumber" value="${value.phoneNumber}"/></td>`;
		rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value.createdDate + "</td>";
        rs += "<td  id=" + value.nickName +`" data-id=${value.id}` +"  style='display: flex;justify-content: center;align-items: center;'><span class='label label-danger' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: Update(" + "`" + value.nickName + "`"+")\">Cập nhật</a></span></td>";
        rs += "</tr>";
        return rs;
    }

    function Update(name) {
        if (!confirm('Bạn chắc chắn muốn cập nhật tài khoản này không ?')) {
            return false;
        }
        const phoneName = $(`#${name}_phoneName`).val();
        const phoneNumber = $(`#${name}_phoneNumber`).val();
        const id = $(`#${name}_id`).val();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/updateMomoInfoAjax')?>",
            data: {
                nickname: name,
                phoneName,
                phoneNumber,
                id
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.success) {
                    //Update success
                    alert("Cập nhật thành công")
                } else {
                    alert("Cập nhật thất bại!")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

	function findAccountByNickname() {
		var Accfind = "";
        const nickname = $("#timkiem").val()
        if(!nickname) {
            $("#resultsearch").html("Bạn phải nhập nickname!");
            return;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/findMomoByNicknameAjax')?>",
            data: {
                nickname
            },

            dataType: 'json',
            success: function (result) {
				if(result != null && result.momo?.length) {
					Accfind = listAccFunc(1, result.momo[0]);
					$('#logactionAcc').html(Accfind);
				} else {
					$("#resultsearch").html("Không tìm thấy kết quả!");
					$('#logactionAcc').html("");
				} 

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })
    }

</script>
