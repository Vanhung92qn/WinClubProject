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
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
    <div class="widget" style="background: #82d1ff; border-radius: 15px; max-width: 600px;margin: 0 auto;">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div class="title">
            <h6 style="color: #001f0f;">XÓA TÀI KHOẢN</h6>
        </div>
        <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: 47px; transform: translate(-50%, 0);"></p></h3>
        <form class="list_filter form" action="" method="post">
            <div class="formRow">
                <table style='margin: 0 auto;'>
                    <tr>
                        <td>
                            <div class="radio-container">
                                <input type="radio" id="username" name="nametimkiem" value="1">
                                <label for="username">XÓA THEO USERNAME</label>
                                <input type="radio" id="nickname" name="nametimkiem" value="0">
                                <label for="nickname">XÓA THEO NICKNAME</label>
                            </div>

                        </td>
                    </tr>
                </table>


                <hr>

                <table id="table1" style="display:none;">
                    <tr>
                        <td class="item">
                            <div class="input-group" style="width: 300px;">
                                <input type="text" id="timkiem_username" name="timkiem_username" placeholder="XÓA theo Username" >
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="delete_username" value="XÓA" class="button blueB" style="margin-left: 70px">
                        </td>
                    </tr>
                </table>

                <table id="table2">
                    <tr>
                        <td class="item">
                            <div class="input-group" style="width: 300px;">
                                <input type="text" id="timkiem_nickname" name="timkiem_nickname" placeholder="XÓA theo Nickname" >
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="delete_nickname" value="XÓA" class="button blueB" style="margin-left: 70px">
                        </td>
                    </tr>
                </table>
            </div>
        </form>




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

    div.radio-wrapper {
        text-align: center;
        font-size: 1.2em;
        font-weight: bolder;
        color: #099100;
    }

    div.radio-container {
        display: inline-block;
    }

    div.radio-container input[type=radio] {
        opacity: 0;
        display: none;
        margin: 0;
        outline: none;
    }

    div.radio-container input[type="radio"]:checked+label {
        background-color: #099100;
        color: white;
        animation-name: radio-active;
        animation-duration: 0.2s;
    }

    @keyframes radio-active {
        from {
            transform: scale(0.6, 0.6);
        }
        to {
            transform: scale(1, 1);
        }
    }

    div.radio-container label {
        padding: 0.8em;
        cursor: pointer;
        background: none;
        display: inline-block;
        outline: none;
        letter-spacing: 0.1em;
        background-color: #cbcbcb;
        color: black;
        transition: all ease-in-out 0.1s;
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
        $("#nickname").prop('checked', true);
    });

    $("input[type='radio'][name='nametimkiem']").change(function() {
        var congthe = $("input[type='radio'][name='nametimkiem']:checked").val();
        console.log(congthe);
        if (congthe == '1') {
            $("#table1").show();
            $("#table2").hide();
        } else {
            $("#table1").hide();
            $("#table2").show();
        }
    });

    $("#delete_nickname").click(function(event) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/xoataikhoanajax") ?>",
            data: {
                nickname: $("#timkiem_nickname").val(),
                username: null,
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $("#resultAdd").html("XÓA: " + result.trangthai);

            }
            ,error: function(){
                $("#spinner").hide();
                $("#resultAdd").html("vui lòng thử lại sau");
            },
            timeout:3000
        });
    });

    $("#delete_username").click(function(event) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/xoataikhoanajax") ?>",
            data: {
                username: $("#timkiem_username").val(),
                nickname: null,
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                $("#resultAdd").html("XÓA: " + result.trangthai);
            }
            ,error: function(){
                $("#spinner").hide();
                $("#resultAdd").html("Vui lòng thử lại sau!");
            },
            timeout:3000
        });
    });

</script>
