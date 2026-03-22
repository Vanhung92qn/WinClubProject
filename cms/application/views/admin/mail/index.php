<title>Danh Sách Mail Đã Gửi</title>
<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<?php if($role == false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="widget">
        <h4 id="resultsearch" style="color: red"></h4>
        <div class="title">
            <h6>Danh sách mail gửi</h6>
            <h6 style="float: right">Tổng số mail:<span style="color:#7a6fbe" id="numuser"></span></h6>

        </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Nickname:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="nickname" value="<?php echo $this->input->get('username') ?>" name="username">
                        </td>
                        <td>
                            <label for="isSendAll" style="width: 115px;margin-bottom:-3px;margin-left: 47px;" class="formLeft">Loại: </label>
                        </td>
                        <td class="item">
                            <select id="isSendAll" name="type" style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                            <option value="true" selected>Gửi Toàn Bộ User</option>    
                            <option value="false">Gửi Cá Nhân</option>
                                
                            </select>
                        </td>
                        <td>
                            <label for="record" style="width: 115px;margin-bottom:-3px;margin-left: 47px;" class="formLeft"> Hiển thị: </label>
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
                        
                                                        </tr>
                        <tr>
                        <td style="">
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 123px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('mail') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </div>
        <div class="formRow">
            <div class="row">
                <div class="col-xs-12">
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>STT</td>
                            <td>Tiêu đề</td>
                            <td>Người gửi</td>
                            <td>Nickname nhận</td>
                            <td>Content</td>
                            <td>Ngày tạo</td>
                            <td>Xóa mail</td>
                        </tr>
                        </thead>
                        <tbody id="logaction">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
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
    }</style>
<div class="container" style="margin-right:20px;">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>

</div>
<script>
    function fetchData () {
        $("#numuser").html(0);
        $('#logaction').html('');

        $.ajax({
        type: "POST",
        url: "<?php echo admin_url('mail/indexajax')?>",
        data: {
            nickname : $("#nickname").val(),
            size: $('#record').val(),
            isAll: $('#isSendAll').val(),
            pages : 1
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            var totalPage = result.totalPages;
            $("#numuser").html(result.totalRecords || 0);

            if (result.transactions == "") {
                $('#pagination-demo').css("display", "none");
                $("#resultsearch").html("Không tìm thấy kết quả");
            } else {
                $("#resultsearch").html("");
                stt = 1;
                $.each(result.transactions, function (index, value) {
                    result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id, value.nickname);
                    stt++
                });
                $('#logaction').html(result);
                var $pagination = $('#pagination-demo');

                // Temporarily unbind onPageClick event to prevent AJAX call
                $pagination.off('page');

                // Now safely destroy the pagination
                $pagination.twbsPagination('destroy');
                $pagination.twbsPagination({
                    totalPages: totalPage,
                    visiblePages: 5,
                    onPageClick: function (event, page) {
                        $("#spinner").show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('mail/indexajax')?>",
                            data: {
                                nickname : $("#nickname").val(),
                                size: $('#record').val(),
                                isAll: $('#isSendAll').val(),
                                pages : page
                            },
                            dataType: 'json',
                            success: function (result) {
                                $("#spinner").hide();
                                $("#numuser").html(result.totalRecords || 0);
                                stt = 1;
                                $.each(result.transactions, function (index, value) {
                                    result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id, value.nickname);
                                    stt++
                                });
                                $('#logaction').html(result);
                            },
                            error: function (result) {
                                $("#spinner").hide();
                                $("#numuser").html(0);

                            }
                        });
                    }
                });
            }
        },
        error: function(err) {
            $("#spinner").hide();
            $("#numuser").html(0);
            $("#resultsearch").html("Lỗi hệ thống");
        }
        })
    }

function resultSearchTransction(stt,title,user,content,date,mid, nickname) {
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + stt + "</td>";
    rs += "<td>" + title + "</td>";
    rs += "<td>" + user + "</td>";
    rs += `<td>${nickname == 'null' || !nickname ? 'Gửi Toàn Bộ User' : nickname}</td>`;
    rs += "<td>" + content + "</td>";
    rs += "<td>" + date + "</td>";
    rs += "<td>" + `<input type='button' value='Xóa' class='button redB' style='margin-left: 70px' onclick=\"xoamail('${mid}','${nickname ? nickname : ''}')\" >` + "</td>";
    rs += "</tr>";
    return rs;
}
$(document).ready(function() {
    $("#spinner").show();
    fetchData();
    $("#search_tran").click(function () {
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        fetchData();
    });
})
function xoamail(mid, nickname) {
    if(!confirm('Bạn chắc chắn muốn xóa mail ?'))
    {
        return false;
    }
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('mail/delmail')?>",
        data: {
            mid: mid,
            nickname
        },

        dataType: 'json',
        success: function (res) {
            if(res.success) {
                $("#resultsearch").html("Xóa mail thành công");

                fetchData();
            } else {
                $("#resultsearch").html("Xóa mail không thành công");

            }
        }
    });
}

</script>