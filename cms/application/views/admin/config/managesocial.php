<title>Config Link</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
			<h5>Quản lý link</h5>
		</div>
        <div class="clear"></div>
    </div>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Danh sách link </h6>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Đường dẫn hiện tại</td>
                    <td>Cập nhật</td>
                    <td>Hành động</td>
                </tr>
                </thead>
                <tbody id="listLink">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="line"></div>
<style>
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
    #listLink td:nth-child(2) {
        text-align: left;
    }
    #listLink td:nth-child(3) {
        text-align: right;
    }
    #listLink td:nth-child(4) {
        text-align: center;
    }
    #listLink td:nth-child(5) {
        text-align: center;
    }
    #listLink button {
        color: #fff !important;
    }
    #listLink button[disabled] {
        background-color: gray !important;
    }
</style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-sm"></ul>
    </div>
</div>
<script>
  
  function resultSearch(index, key, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + index + "</td>";
        rs += "<td>" + key  + "</td>";
        rs += "<td>" + value + "</td>";
        rs += "<td>" + `<input name="social" id="${key}" type="text" />` + "</td>";
        rs += "<td>" + `<button social-id="${key}" style="margin-left: 15px" disabled>Cập nhật</button>`+"</td>";
        rs += "</tr>";
        return rs;
    }
    const SOCIAL = {
        "fanPage": "",
        "groupFacebook": "",
        "teleCSKH": "",
        "botTele": "",
        "groupTele": "",
        "liveChat": "",
        "linkDownload": "",
        "home": "",
        "chatId": ""
    }
    function onUpdateSocial() {
        $('#listLink input').on('input', function() {
            const socialId = $(this).attr('id');
            const value = $(this).val();
            if(value) {
                $(`button[social-id="${socialId}"]`).removeAttr('disabled');
            } else {
                $(`button[social-id="${socialId}"]`).attr('disabled', 'disabled');
            }
        });

        $('#listLink button').on('click', function() {
            const socialId = $(this).attr('social-id');
            const value = $(`input[id=${socialId}]`).val();
            if(value) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('config/updatelinkajax')?>", 
                    data: {
                        key: socialId,
                        value
                    },
                    success: function(res) {
                        if(res == 1) {
                            // Fund updated successfully
                            alert("Cập nhật Link thành công!")
                            window.location.reload();
                        } else {
                            // Error updating fund
                            alert("Cập nhật Link KHÔNG thành công!")
                        }
                    },
                    error: function(res) {
                        // Error updating fund
                        alert("Lỗi hệ thống vui lòng thử lại sau")
                    }
                });
            }
        });
    }
    $(document).ready(function (){
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('config/managesocialajax')?>",
            data: {},
            dataType: 'json',
            success: function (res) {
                $("#spinner").hide();
                if(res.success) {
                    let index = 1
                    for (const key in SOCIAL) {
                        if (SOCIAL.hasOwnProperty(key)) {
                            $('#listLink').append(resultSearch( index, key, res[key]));
                            index += 1;
                        }
                    }
                    onUpdateSocial();
                } else {
                    $("#error-popup").show();
                }
            },
            error: function () {
                $("#spinner").hide();
                $("#error-popup").show();
            }
        });
    });
</script>