<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role == false): ?>
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
        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
        <script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget" style="background: #ffd6d6; border-radius: 15px;">
            <h4 id="resultsearch" style="color: #b82516;margin-left: 10px"></h4>
            <div class="title">
                <h6 style="color: #7b0000;">Thêm Kèo Bóng Đá</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/cashoutbybank') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 150px">Thời gian đá:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="thoiGianDa" name="toDate" value="<?php echo $start_time ?>">
                                    <span
                                            class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>


                            </td>


                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px; margin-top: 6px;">Đội
                                    A:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px; margin-top: 6px;"
                                       id="doiA" value="<?php echo $this->input->post('doiA') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px ; margin-top: 6px;">Đội
                                    B:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px; margin-top: 6px;"
                                       id="doiB" value="<?php echo $this->input->post('doiB') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Bàn thắng Đội
                                    A:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px; margin-top: 5px;"
                                       id="banThangDoiA" value="<?php echo $this->input->post('banThangDoiA') ?>"
                                       name="name"></td>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Bàn thắng Đội
                                    B:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px; margin-top: 5px;"
                                       id="banThangDoiB" value="<?php echo $this->input->post('banThangDoiB') ?>"
                                       name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px; margin-top: 5px;">Tỉ lệ đội A chấp
                                    cả trận:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tiLeDoiAChapCaTran"
                                       value="<?php echo $this->input->post('tiLeDoiAChapCaTran') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội B chấp cả
                                    trận:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tiLeDoiBChapCaTran"
                                       value="<?php echo $this->input->post('tiLeDoiBChapCaTran') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Ăn cả
                                    trận:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileAnDoiACaTran"
                                       value="<?php echo $this->input->post('tileAnDoiACaTran') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Ăn cả
                                    trận:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileAnDoiBCaTran"
                                       value="<?php echo $this->input->post('tileAnDoiBCaTran') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Chấp
                                    tài xỉu:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileDoiAChapTaiXiu"
                                       value="<?php echo $this->input->post('tileDoiAChapTaiXiu') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Chấp
                                    tài xỉu:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileDoiBChapTaiXiu"
                                       value="<?php echo $this->input->post('tileDoiBChapTaiXiu') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Ăn Tài
                                    Xỉu:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileAnDoiATaiXiu"
                                       value="<?php echo $this->input->post('tileAnDoiATaiXiu') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Ăn Tài
                                    Xỉu:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileAnDoiBTaiXiu"
                                       value="<?php echo $this->input->post('tileAnDoiBTaiXiu') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Chấp
                                    Hiệp 1:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileDoiAChapHiep1"
                                       value="<?php echo $this->input->post('tileDoiAChapHiep1') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Chấp
                                    Hiệp 1:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileDoiBChapHiep1"
                                       value="<?php echo $this->input->post('tileDoiBChapHiep1') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Ăn Hiệp
                                    1:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileAnDoiAHiep1" value="<?php echo $this->input->post('tileAnDoiAHiep1') ?>"
                                       name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Ăn
                                    Hiệp 1:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileAnDoiBHiep1" value="<?php echo $this->input->post('tileAnDoiBHiep1') ?>"
                                       name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Chấp
                                    Hiệp 2:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileDoiAChapHiep2"
                                       value="<?php echo $this->input->post('tileDoiAChapHiep2') ?>" name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Chấp
                                    Hiệp 2:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileDoiBChapHiep2"
                                       value="<?php echo $this->input->post('tileDoiBChapHiep2') ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px;">Tỉ lệ đội A Ăn Hiệp
                                    2:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px;margin-top: 5px;"
                                       id="tileAnDoiAHiep2" value="<?php echo $this->input->post('tileAnDoiAHiep2') ?>"
                                       name="name"></td>

                            <td><label style="margin-left: 30px;margin-bottom:-2px;margin-top: 5px; ">Tỉ lệ đội B Ăn
                                    Hiệp 2:</label></td>

                            <td><input type="text"
                                       style="margin-left: 20px;margin-bottom:-2px;width: 150px ;margin-top: 5px;"
                                       id="tileAnDoiBHiep2" value="<?php echo $this->input->post('tileAnDoiBHiep2') ?>"
                                       name="name"></td>
                        </tr>
                        <td style="">
                            <input type="button" id="search_tran" value="Thêm" class="button blueB"
                                   style="margin-left: 70px ; margin-top: 50px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('user/addkeobongda') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px ; margin-top: 50px">
                        </td>

                        </tr>

                    </table>

                </div>
            </form>


        </div>
    </div>
<?php endif; ?>
<style>
    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }

    .spinner {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -50px;
        /* half width of the spinner gif */
        margin-top: -50px;
        /* half height of the spinner gif */
        text-align: center;
        z-index: 1234;
        overflow: auto;
        width: 100px;
        /* width of the spinner gif */
        height: 102px;
        /*hight of the spinner gif +2px to fix IE8 issue */
    }

    .sTable thead td {
        border-bottom: 1px solid #cbcbcb;
        border-left: 1px solid #cbcbcb;
        font-size: 15px;
        color: #ffffff;
        padding: 10px 4px 2px 4px;
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
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
        var count =0;
        var arr = $("input[name='name']").map(function () {
            console.log("ok");
            if(this.value==null || this.value==""){
                count++;
            }
        }).get();
        if(count>0){
            alert("Hãy điền đầy đủ các trường!")
            window.location.href = "";
        }
        var thoiGianDa = $("#thoiGianDa").val();
        var doiA = $("#doiA").val();
        var doiB = $("#doiB").val();
        var banThangDoiA = $("#banThangDoiA").val();
        var banThangDoiB = $("#banThangDoiB").val();
        var tiLeDoiAChapCaTran = $("#tiLeDoiAChapCaTran").val();
        var tiLeDoiBChapCaTran = $("#tiLeDoiBChapCaTran").val();
        var tileDoiAChapTaiXiu = $("#tileDoiAChapTaiXiu").val();
        var tileDoiBChapTaiXiu = $("#tileDoiBChapTaiXiu").val();
        var tileDoiAChapHiep1 = $("#tileDoiAChapHiep1").val();
        var tileDoiBChapHiep1 = $("#tileDoiBChapHiep1").val();
        var tileDoiAChapHiep2 = $("#tileDoiAChapHiep2").val();
        var tileDoiBChapHiep2 = $("#tileDoiBChapHiep2").val();
        var tileAnDoiACaTran = $("#tileAnDoiACaTran").val();
        var tileAnDoiBCaTran = $("#tileAnDoiBCaTran").val();
        var tileAnDoiATaiXiu = $("#tileAnDoiATaiXiu").val();
        var tileAnDoiBTaiXiu = $("#tileAnDoiBTaiXiu").val();
        var tileAnDoiAHiep1 = $("#tileAnDoiAHiep1").val();
        var tileAnDoiBHiep1 = $("#tileAnDoiBHiep1").val();
        var tileAnDoiAHiep2 = $("#tileAnDoiAHiep2").val();
        var tileAnDoiBHiep2 = $("#tileAnDoiBHiep2").val();
        var status = "0";
        var url = "none";
        var buildSession = thoiGianDa.split(" ");
        var mSession = buildSession[0].split("-");
        let session = mSession[2] + mSession[1] + mSession[0];
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('user/addkeoajax')?>",
            data: {
                doiA: doiA,
                doiB: doiB,
                banThangDoiA: banThangDoiA,
                banThangDoiB: banThangDoiB,
                tiLeDoiAChapCaTran: tiLeDoiAChapCaTran,
                tiLeDoiBChapCaTran: tiLeDoiBChapCaTran,
                tileDoiAChapTaiXiu: tileDoiAChapTaiXiu,
                tileDoiBChapTaiXiu: tileDoiBChapTaiXiu,
                tileDoiAChapHiep1: tileDoiAChapHiep1,
                tileDoiBChapHiep1: tileDoiBChapHiep1,
                tileDoiAChapHiep2: tileDoiAChapHiep2,
                tileDoiBChapHiep2: tileDoiBChapHiep2,
                tileAnDoiACaTran: tileAnDoiACaTran,
                tileAnDoiBCaTran: tileAnDoiBCaTran,
                tileAnDoiATaiXiu: tileAnDoiATaiXiu,
                tileAnDoiBTaiXiu: tileAnDoiBTaiXiu,
                tileAnDoiAHiep1: tileAnDoiAHiep1,
                tileAnDoiBHiep1: tileAnDoiBHiep1,
                tileAnDoiAHiep2: tileAnDoiAHiep2,
                tileAnDoiBHiep2: tileAnDoiBHiep2,
                status: status,
                url: url,
                session: session,
                thoiGianDa:thoiGianDa
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result = "1") {
                    alert("thêm thành công!")
                    window.location.href = "";
                } else {
                    alert("Duyệt thất bại")
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
            }, timeout: 20000
        })

    });
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function convertTime(time) {
        var a = new Date(time);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
        return time;
    }
</script>
