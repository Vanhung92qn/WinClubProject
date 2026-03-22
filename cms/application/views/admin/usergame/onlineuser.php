<title>Tài Khoản Online</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
			<h5>Số người đang chơi game <span style="color:#7a6fbe" id="numuser"></span></h5>
		</div>
        <div class="clear"></div>
    </div>
    <div class="wrapper">
        <div class="widget">
            <h5 id="resultsearch"style="color: #e72929;margin-left: 10px"></h5>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Làm mới sau:</label></td>
                            <td>
                                <select id="timeLoopSelect" name="select_time" style="margin-left: 0px;margin-bottom:-2px;width: 70px;">
                                    <option value="60000" selected>1 phút</option>
                                    <option value="120000">2 phút</option>
                                    <option value="180000">3 phút</option>
                                    <option value="300000">5 phút</option>
                                    <option value="600000">10 phút</option>
                                    <option value="1800000">30 phút</option>
                                    <option value="3600000">1 tiếng</option>
                                    <option value="28800000">8 tiếng</option>
                                </select>
                            </td>
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
                        
                        
                        </tr>
                    </table>
                </div>
            <form class="list_filter form" action="<?php echo admin_url('usergame/onlineuser') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td hidden><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                            <td hidden><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name"></td>
                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('usergame/onlineuser') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Tên Nhân Vật</td>
                    <td>Số Dư</td>
                    <td>Tổng Nạp</td>
                    <td>Tổng Rút</td>
                </tr>
                </thead>
                <tbody id="listUser">
                </tbody>
            </table>
        </div>
    </div>
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
    .rowUser input{
        color: white !important;
    }
    .rowUser td{
        text-align: center;
    }
    .loading-icon {
        width: 20px;
        height: 20px;
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
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    function onClickRow(nickname) {
        const loading =  `<img class="loading-icon" id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>`;
        $(`td#${nickname}`).html(loading);
        $.ajax({
                type: "POST",
                url: "<?php echo admin_url('usergame/detailonlineuserajax')?>",
                data: {
                    nickname,
                },

                dataType: 'json',
                success: function (res) {
                    if(res.user) {
                        const user = res.user;
                        const moneyIn =  commaSeparateNumber(user.rechargeMoney) || 0;
                        const moneyOut = commaSeparateNumber(user.cashout) || 0;
                        const money = commaSeparateNumber(user.vinTotal) || 0;
                        const html = `<span>Số dư: ${money}<br/>Tổng nạp: ${moneyIn}<br/>Tổng rút: ${moneyOut}</span>`;
                        $(`td#${nickname}`).html(html);
                    } else {
                        $(`td#${nickname}`).html(`<span>Không tìm thấy user: ${nickname}</span>`);
                    }
                },
                error: function () {
                    $(`td#${nickname}`).html(`<span>Hộ thống đang bận</span>`);
                    $("#error-popup").show();
                }
            });
    }
    $(document).ready(function (){
        var table;
        function fetchData() {
            var oldPage = 0;
            if(table) {
                $("#listUser").empty();
                table.destroy();
            }
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('usergame/onlineuserajax')?>",
                data: {
                    nickname: $("#filter_iname").val(),
                    pages: 1,
                    size: $('#record').val()
                },

                dataType: 'json',
                success: function (res) {
                    $("#spinner").hide();
                    if(res.success) {
                        if(res.users && res.users?.length) {
                            $("#numuser").text(res.totalRecord);
                            let content = "";
                            res.users.map((item, index) => {
                                const {nickName, totalDeposit, totalCashOut, totalMoney} = item;
                                content += `<tr class="rowUser" >`;
                                content += " <td>" + (index + 1) + "</td>";
                                content += " <td><a title='Chi tiết'  style = 'color:#7a6fbe' target='_blank' class='open' href='<?php echo admin_url('transaction?nn=') ?>" + nickName +"'>"+ nickName + "</a></td>";
                                content += `<td>${totalMoney ? commaSeparateNumber(totalMoney) : 0}</td>`;
                                content +=  `<td>${totalDeposit ? commaSeparateNumber(totalDeposit) : 0}</td>`;
                                content +=  `<td>${totalCashOut ? commaSeparateNumber(totalCashOut) : 0}</td>`;
                                content += " </tr>"
                            })
                            $("#listUser").html(content);
                            table = $('#checkAll').DataTable({
                                "ordering": true,
                                "searching": true,
                                "paging": false,
                                "draw": false
                            });
                            const totalPage = res.totalPage;
                            var $pagination = $('#pagination-demo');

                        // Temporarily unbind onPageClick event to prevent AJAX call
                        $pagination.off('page');

                        // Now safely destroy the pagination
                        $pagination.twbsPagination('destroy');
                        $pagination.twbsPagination({
                            totalPages: totalPage,
                            visiblePages: 5,
                            onPageClick: function (event, page) {
                                if (oldPage > 0) {
                                    $("#spinner").show();
                                    $("#listUser").empty();
                                    table.destroy();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo admin_url('usergame/onlineuserajax')?>",
                                        data: {
                                            nickname: $("#filter_iname").val(),
                                            pages: page,
                                            size: $('#record').val()
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $("#listUser").html("");
                                            $("#spinner").hide();
                                            $("#numuser").text(result.totalRecord);
                                            let content = "";
                                            result.users.map((item, index) => {
                                                const {nickName, totalDeposit, totalCashOut, totalMoney} = item;
                                                content += `<tr class="rowUser" >`;
                                                content += " <td>" + (index + 1) + "</td>";
                                                content += " <td><a title='Chi tiết'  style = 'color:#7a6fbe' class='open' href='<?php echo admin_url('transaction?nn=') ?>" + nickName +"'>"+ nickName + "</a></td>";
                                                content += `<td>${totalMoney ? commaSeparateNumber(totalMoney) : 0}</td>`;
                                                content +=  `<td>${totalDeposit ? commaSeparateNumber(totalDeposit) : 0}</td>`;
                                                content +=  `<td>${totalCashOut ? commaSeparateNumber(totalCashOut) : 0}</td>`;
                                                content += " </tr>"
                                            })
                                            $("#listUser").html(content);
                                            
                                            table = $('#checkAll').DataTable({
                                                "ordering": true,
                                                "searching": true,
                                                "paging": false,
                                                "draw": false
                                            });
                                        }, error: function () {
                                            $("#spinner").hide();
                                            $('#logaction').html("");
                                            $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                                        },timeout : 20000
                                    });
                                }
                                oldPage = page;
                            }
                        });
                        } else {
                            $("#numuser").text(0);
                        }

                    }
                    
                },
                error: function () {
                    $("#spinner").hide();
                    $("#error-popup").show();
                }
            });
        }
        function setLoop(selectedInterval) {
            if (window.fetchDataInterval) {
                clearInterval(window.fetchDataInterval);
            }
            window.fetchDataInterval = setInterval(fetchData, selectedInterval);
        }
        $('#timeLoopSelect').change(function() {
            setLoop($("#timeLoopSelect").val());
        });
        $("#search_tran").click(function () {
            fetchData();
        })

        fetchData();
        if($("#timeLoopSelect").val()) {
            setLoop($("#timeLoopSelect").val());
        }
    });
</script>