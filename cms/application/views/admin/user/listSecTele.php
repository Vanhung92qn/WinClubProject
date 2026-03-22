<title>Bảo Mật Telegram</title>

<div class="line"></div>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.table2excel.js"></script>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Danh sách bảo mật Telegram</h6>

        </div>
        <div class="formRow">
            <form class="list_filter form" action="" method="get">
                <table>
                    <tr>
                       
                        <td>
                            <label for="nickname" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 200px">Tên nhân vật:</label></td>
                        <td class="item">
                            <input type="text" id="nickname" name="nickname" value=""> 
                        </td>
                        <td>
                            <label for="phone" class="formLeft" style="margin-left: 50px;margin-bottom:-2px;width: 200px">Số điện thoại:</label></td>
                        <td class="item">
                            <input type="text" id="phone" name="phone" value=""> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;" class="formLeft"> Hiển thị: </label>
                        </td>
                        <td class="item"><select id="record" name="record" style="margin-left: 5px;margin-bottom:-2px;width: 150px">
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
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 20px">
                        </td>
                        <td>
                                <input type="button" id="exportexel" value="Xuất Exel" class="button blueB" style="margin-left: 20px">
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
                <td>Số điện thoại</td>
                <td>Ngày tạo</td>
                <td>Hành động</td>
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
   
</div>

<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
</div>
<div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
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
    .cancel {
        color: white;
    }
   
</style>
<script>
   
    function resultUser(user, stt) {
        const {nickname, phoneNumber, createdDate, active} = user;

        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += `<td style="text-align: center;">${nickname}</td>`;
        rs += `<td style="text-align: end;">${phoneNumber}</td>`;
        rs += `<td style="text-align: end;">${createdDate}</td>`;
        rs += `<td style="text-align: center;">${active ? `<button class="cancel" data-nickname="${nickname}">Hủy</button>` : ''}</td>`;
        rs += "</tr>";
        return rs;
    }
  
    $(document).ready(function() {
        var users = [];
        const nickname = $("#nickname").val()
        $("#spinner").show();
        var oldPage = 1;

$.ajax({
    type: "POST",
    url: "<?php echo admin_url('user/listSecAjax') ?>",
    data: {
        nickname,
        page: oldPage,
        phone: $("#phone").val(),
        pageSize: $("#record").val(),
        c: "11041"
    },
    dataType: 'json',
    success: function(result) {
        $("#spinner").hide();
        if (result.success) {
            if (result.users?.length == 0) {
                $("#btn_modal").attr('disabled', 'disabled');
                $("#resultsearch").html("Không tìm thấy kết quả");
                $('#logaction').html("");
                $('#pagination-demo').css("display", "none");

            } else {
                $("#btn_modal").removeAttr('disabled');
                $("#resultsearch").html("");
                let resultUsers = "";
                users = [];
                result.users.map((user, index) => {
                    users.push(user.nickname);
                    resultUsers += resultUser(user, index + 1);
                });
                $('#logaction').html(resultUsers);
                var $pagination = $('#pagination-demo');

                    // Temporarily unbind onPageClick event to prevent AJAX call
                    $pagination.off('page');

                    // Now safely destroy the pagination
                    $pagination.twbsPagination('destroy');
                    $pagination.twbsPagination({
                    totalPages: result.totalPage,
                    visiblePages: 5,
                    onPageClick: function(event, page) {
                        let currentPage = page;
                            $("#spinner").show();
                            $.ajax({
                                type: "POST",
                                url: "<?php echo admin_url('user/listSecAjax') ?>",
                                data: {
                                    nickname,
                                    phone: $("#phone").val(),
                                    page: currentPage,
                                    pageSize: $("#record").val(),
                                    c: "11041"
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
                                            users = [];
                                            result.users.map((user, index) => {
                                                users.push(user.nickname);
                                                resultUsers += resultUser(user, index + 1);
                                            });
                                            var totalPage = result.totalPage;
                                            $('#logaction').html(resultUsers);
                                            $('.cancel').click(function() {
                                                const nickname = $(this).attr("data-nickname")
                                                window.location.href = `<?php echo admin_url('user/delsecuser') ?>?nickname=${nickname}&type=tele`
                                            })
                                            oldPage = currentPage;
                                        }
                                    }
                                }
                            });
                        
                    }
                })
                                
                   
               
                $('.cancel').click(function() {
                    const nickname = $(this).attr("data-nickname")
                    window.location.href = `<?php echo admin_url('user/delsecuser') ?>?nickname=${nickname}&type=tele`
                })
            }
        }
    }
});
$("#search_tran").click(function() {
    $('#pagination-demo').css("display", "none");

    $("#spinner").bind("ajaxSend", function() {
        $(this).show();
    }).bind("ajaxStop", function() {
        $(this).hide();
    }).bind("ajaxError", function() {
        $(this).hide();
    });
    const nickname = $("#nickname").val();
    $("#spinner").show();
    oldPage = 1
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('user/listSecAjax') ?>",
        data: {
            nickname,
            page: oldPage,
            phone: $("#phone").val(),
            pageSize: $("#record").val(),
            c: "11041"
        },
        dataType: 'json',
        success: function(result) {
            $("#spinner").hide();
            if (result.success) {
                if (result.users?.length == 0) {
                    $("#btn_modal").attr('disabled', 'disabled');
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $('#logaction').html("");
                    $('#pagination-demo').css("display", "none");

                } else {
                    $('#pagination-demo').css("display", "block");

                    $("#btn_modal").removeAttr('disabled');
                    $("#resultsearch").html("");
                    let resultUsers = "";
                    users = [];
                    result.users.map((user, index) => {
                        users.push(user.nickname);
                        resultUsers += resultUser(user, index + 1);
                    });
                    $('#logaction').html(resultUsers);
                    var $pagination = $('#pagination-demo');

                    // Temporarily unbind onPageClick event to prevent AJAX call
                    $pagination.off('page');

                    // Now safely destroy the pagination
                    $pagination.twbsPagination('destroy');
                    $pagination.twbsPagination({
                        totalPages: result.totalPage,
                        visiblePages: 5,
                        onPageClick: function(event, page) {
                            let currentPage = page;
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('user/listSecAjax') ?>",
                                    data: {
                                        nickname,
                                        page,
                                        phone: $("#phone").val(),
                                        pageSize: $("#record").val(),
                                        c: "11041"
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
                                                users = [];
                                                result.users.map((user, index) => {
                                                    users.push(user.nickname);
                                                    resultUsers += resultUser(user, index + 1);
                                                });
                                                var totalPage = result.totalPage;
                                                $('#logaction').html(resultUsers);
                                                $('.cancel').click(function() {
                                                    const nickname = $(this).attr("data-nickname")
                                                    window.location.href = `<?php echo admin_url('user/delsecuser') ?>?nickname=${nickname}&type=tele`
                                                })
                                                oldPage = page;
                                            }
                                        }
                                    }
                                });
                            
                        }
                    })
                                    
                    
                
                    $('.cancel').click(function() {
                        const nickname = $(this).attr("data-nickname")
                        window.location.href = `<?php echo admin_url('user/delsecuser') ?>?nickname=${nickname}&type=tele`
                    })
                }
            }
        }
    });
});
        $("#exportexel").click(function() {
            $("#logaction").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "DanhSachBaoMatTelegram",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    })
</script>