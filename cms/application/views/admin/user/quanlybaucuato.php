<title>Bầu Cua</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            Quản lý Bầu cua
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role === null): ?>
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
        <link rel="stylesheet" type="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"  media="screen" />
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.twbsPagination.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
        <style>
            /* input[type=radio] {
                width: 30px;
                height: 30px;
            } */

            .myLable {
                margin-right: 20px;
                font-size: 22px;

            }

            .container {
                background-color: #fff !important
            }
            .w-100 {
                width: 100%;
            }
            .w-25 {
                width: 25%;
            }
            .w-50px {
                width: 50px;
            }
            .w-25px{
                width: 25px;
            }
            .p-5 {
                padding: 5px;
            }
            .p-10 {
                padding: 10px;
            }
            .center {
                text-align: center;
            }
            .align {
                align-content: center
            }
        </style>
        <section class="content">
            <!-- new layout-->
            <div class="container">
                <table class="table-bordered w-100" >
                    <tbody>
                        <tr>
                            <td class="w-25 p-10 center align" id="phien"></td>
                            <td class="w-25 p-10 center align" style="font-weight: bold; font-size: large;">
                                <div id="status">
                                </div>
                                <div id="thoigian">
                                </div>
                            </td>
                            <td class="w-25 p-10 center align" id="numberHuBC">$0</td>
                            <td class="w-25" style="padding: 5px;">
                                <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <td colspan="3" class="center">Kết quả chọn</td>
                                      </tr>
                                      <tr>
                                        <td class="center">
                                            <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png"  class="img-fluid w-50px" alt="Image 1">
                                        </td>
                                        <td class="center">
                                            <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png"  class="img-fluid w-50px" alt="Image 1">
                                        </td>
                                        <td class="center">
                                            <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png"  class="img-fluid w-50px" alt="Image 1">
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>    
            </div>
            <div class="container">
                <table class="table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_bau.png" class="img-fluid w-50px" alt="Image bau">
                            </td>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_cua.png" class="img-fluid w-50px" alt="Image cua">
                            </td>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_ca.png" class="img-fluid w-50px" alt="Image ca">
                            </td>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_ga.png" class="img-fluid w-50px" alt="Image ga">
                            </td>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_tom.png" class="img-fluid w-50px" alt="Image tom">
                            </td>
                            <td class="p-10 center">
                                <img src="<?php echo public_url('admin')?>/images/icon_huou.png" class="img-fluid w-50px" alt="Image huou">
                            </td>
                            <td class="p-10 center">Random</td>
                        </tr>
                        <tr>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="bau"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="1" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="1" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="1" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="cua"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="4" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="4" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="4" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="ca"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="3" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="3" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="3" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="ga"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="2" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="2" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="2" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="tom"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="5" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="5" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="5" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center" id="nai"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="0" name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="0" name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="0" name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="center">0</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">Dice1</td>
                                            <td class="center">Dice2</td>
                                            <td class="center">Dice3</td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <img name="icon-dice1" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice2" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                            <td class="center">
                                                <img name="icon-dice3" src="<?php echo public_url('admin')?>/images/icon_question.png" class="img-fluid w-25px" alt="Image question">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center">
                                                <input type="radio" value="6" checked name="inlineRadioOptions">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="6" checked name="inlineRadioOptions2">
                                            </td>
                                            <td class="center">
                                                <input type="radio" value="6" checked name="inlineRadioOptions3">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end new layout-->
            <div class="container">
                <div class="rightContainer">
                    <h4 class="alignContent">Danh sách người chơi</h4>
<!--                    <div id="user_list" class="table-wrapper-scroll-y my-custom-scrollbar">-->
<!--                    </div>-->
                    <table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered alignContent" width="100%" cellspacing="0" id="example">
                        <thead>
                        <tr style="height: 20px;">

                            <td>Nickname</td>
                            <td>Tiền cược phiên hiện tại</td>
                            <td>Chi tiết</td>
                            <td>Tiền hiện có</td>
                            <td>Lãi (lỗ) trong ngày</td>
                        </tr>
                        </thead>
                        <tbody id="logaction">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
<!-- <?php endif; ?> -->
<style>
    .badge{
        font-size: 14px;
        font-weight: 700;
        line-height: 2;
        background-color: black;
    }
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
</style>
<style>
    .padding-setbot {
        padding: 0px 40px 0px 40px
    }
    #status {
        border-bottom: 1px black solid;
        padding-bottom: 15px;
    }
    #thoigian {
        padding-top: 15px;
    }
    .anyClass {
        height: 150px;
        overflow-y: scroll;
    }

    .message_inputField {
        margin-right: 4px;

    }

    .container {
        width: 100%;
        display: flex;
        flex-direction: column;
        background-color: rgb(200, 215, 230);
        padding-top: 10px;
    }

    .leftContainer {
        flex: 2;
        margin-right: 10px;
        border-radius: 10px;
        margin-left: 10px;
        padding: 15px;
        background-color: white;
    }

    .rightContainer {
        flex: 1;
        background-color: #4bcffa;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 10px;
    }

    .blockTop {
        display: flex;
        padding-bottom: 15px;
        border-radius: 10px;

    }

    .button {
        height: 30px;
        padding: 5px;
        border: #0E0E0E;
        border-radius: 5px;
    }

    .bottomBlock {
        display: flex;
    }

    .alignContent {
        text-align: center;
    }

    .borderBottom {
        padding-bottom: 10px;
        padding-top: 5px;
        border-bottom: 1px solid rgb(185 185 185 / 47%);
    }

    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .table-content-body {
        max-height: 100px;
        overflow: auto;
        display: inline-block;
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


    var status="auto";
   


    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 0,
        minimumFractionDigits: 0,
    });

    function updateViewPhienBet(obj){
        document.getElementById("nai").innerText = "Nai :" +formatter.format(obj.mapReportBet["0"]);
        document.getElementById("bau").innerText = "Bầu: " + formatter.format(obj.mapReportBet["1"]);
        document.getElementById("ga").innerText = "Gà: " + formatter.format(obj.mapReportBet["2"]);
        document.getElementById("ca").innerText = "Cá: " + formatter.format(obj.mapReportBet["3"]);
        document.getElementById("cua").innerText = "Cua: " + formatter.format(obj.mapReportBet["4"]);
        document.getElementById("tom").innerText = "Tôm: " + formatter.format(obj.mapReportBet["5"]);
    }

    function updateViewPhienHead(obj){
        document.getElementById("phien").innerText = "Phiên :" +obj.referenceId;
        if(obj.betting) {
            document.getElementById("thoigian").innerText = "" + obj.remainingTime;
            document.getElementById("status").innerText = "Đặt cược";
        } else {
           

            document.getElementById("status").innerText = "Trả thưởng";
            document.getElementById("thoigian").innerText = ""+ obj.remainingTime;
            if(obj.remainingTime == "2") {
                let icon = "<?php echo public_url('admin')?>/images/icon_question.png";
                $(`img[name=icon-dice1]`).attr('src', icon)
                $(`img[name=icon-dice2]`).attr('src', icon)
                $(`img[name=icon-dice3]`).attr('src', icon)
                $('input[name="inlineRadioOptions"][value="6"]').trigger('click');
                $('input[name="inlineRadioOptions2"][value="6"]').trigger('click');
                $('input[name="inlineRadioOptions3"][value="6"]').trigger('click');
                status="auto";
                $.ajax({
                    type:"POST",
                    url: "<?php echo admin_url('user/beCaubaucuaAjax')?>",
                    data:{
                        status:status,
                        dice1:"6",
                        dice2:"6",
                        dice3:"6"
                    },
                    dataType :'json',
                    success: function (result) {
                        if(result.toString()=="0"){
                            toasty.success('Random');
                        }
                    }
                })
            }
        }
    }
    function getRandomFromArray() {
        const arr = ["0", "1", "2", "3", "4", "5"];
        // Generate a random index between 0 and the length of the array minus 1
        const randomIndex = Math.floor(Math.random() * arr.length);
        // Return the element at the random index
        return arr[randomIndex];
    }
    function setIconDice(name, value) {
        let icon = "<?php echo public_url('admin')?>/images/icon_question.png";
        switch (value) {
            case "0":
                icon = "<?php echo public_url('admin')?>/images/icon_huou.png"
                break;
            case "1":
                icon = "<?php echo public_url('admin')?>/images/icon_bau.png"
                break;
            case "2":
                icon = "<?php echo public_url('admin')?>/images/icon_ga.png"
                break;
            case "3":
                icon = "<?php echo public_url('admin')?>/images/icon_ca.png"
                break;
            case "4":
                icon = "<?php echo public_url('admin')?>/images/icon_cua.png"
                break;
            case "5":
                icon = "<?php echo public_url('admin')?>/images/icon_tom.png"
                break;
            default:
                break;
        }
        $(`img[name=${name}]`).attr('src', icon)
    }

    $("input").not('[value="6"]').click(function () {
        let dice1 = $('input[name="inlineRadioOptions"]:checked').val();
        let dice2 = $('input[name="inlineRadioOptions2"]:checked').val();
        let dice3 = $('input[name="inlineRadioOptions3"]:checked').val();
        if(dice1 != "6" || dice2 != "6" || dice3 != "6" ){
            status="be";
            if(dice1 == "6") {
                dice1 = getRandomFromArray();
            }
            setIconDice('icon-dice1', dice1)

            if(dice2 == "6") {
                dice2 = getRandomFromArray();
            }
            setIconDice('icon-dice2', dice2)

            if(dice3 == "6") {
                dice3 = getRandomFromArray();
            }
            setIconDice('icon-dice3', dice3)
            $.ajax({
                type:"POST",
                url: "<?php echo admin_url('user/beCaubaucuaAjax')?>",
                data:{
                    status:status,
                    dice1:dice1,
                    dice2:dice2,
                    dice3:dice3
                },
                dataType :'json',
                success: function (result) {
                    if(result.toString()=="0"){
                        toasty.success('Bẻ cầu thành công');
                    }
                }
            })
        } 
        // else {
        //     status="auto";
        //     setIconDice('icon-dice1', dice1)
        //     setIconDice('icon-dice2', dice2)
        //     setIconDice('icon-dice3', dice3)
        //     $.ajax({
        //         type:"POST",
        //         url: "<?php echo admin_url('user/beCaubaucuaAjax')?>",
        //         data:{
        //             status:status,
        //             dice1:dice1,
        //             dice2:dice2,
        //             dice3:dice3
        //         },
        //         dataType :'json',
        //         success: function (result) {
        //             if(result.toString()=="0"){
        //                 toasty.success('Random');
        //             }
        //         }
        //     })
        // }
    })


</script>
<script type = "text/javascript">

    // Let us open a web socket
    var ws = null;

    doconnect();

    function doconnect(){
        try {
            ws = new WebSocket("<?php echo web_socket() ?>baucua?req=ok&userName=daodeptrai1")
        } catch (error) {
            doconnect();
        }
        ws.onclose = function() {
            doconnect();
            //    alert("Connection is closed...");
        };
    }

    // ws.onopen = function() {

    //     var objetSender = {
    //         type :"login",
    //         requestBody :{
    //             username:"name",
    //             pass:"passs"
    //         },
    //         message:"hello"
    //     };
    //     ws.send(JSON.stringify(objetSender));

    // };
        function betDetail(value) {
            return `Bầu: ${commaSeparateNumber(value[1])}; Cua: ${commaSeparateNumber(value[4])}; Cá: ${commaSeparateNumber(value[3])}; Gà: ${commaSeparateNumber(value[2])}; Tôm: ${commaSeparateNumber(value[5])}; Nai: ${commaSeparateNumber(value[0])}`
        }
    ws.onmessage = function (evt) {
        var received_msg = evt.data;
        var res = JSON.parse(received_msg);
        if (res["errorCode"]==="0"){
            updateViewPhienHead(res);
            updateViewPhienBet(res);
        } else if(res["errorCode"]==="1"){
                const { listBauCuaInformation } = res
                const data = listBauCuaInformation.map((user) => ({
                    ...user,
                    totalBet: commaSeparateNumber(user.totalBet),
                    betDetail: betDetail(user.betDetail),
                    totalCurrentMoney: commaSeparateNumber(user.totalCurrentMoney),
                    reportMoneyToday: commaSeparateNumber(user.reportMoneyToday),
                }));
                $('#example').DataTable({
                    destroy: true,
                    searching: true,
                    pageLength: 50,
                    data: (data),
                    columns: [

                        { data: 'username' },
                        { data: 'totalBet' },
                        { data: 'betDetail' },
                        { data: 'totalCurrentMoney' },
                        { data: 'reportMoneyToday' }


                    ],
                });

        }



    };

    function sendMessage(varx){
        ws.send(varx);

    }

    ws.onclose = function() {
        doconnect();

    };
    setInterval(function () {
        $.ajax({
            type: "GET",
            url: "<?php echo admin_url("report/managejackpotajax") ?>",
            success: function (result) {
                obj = JSON.parse(result);
                if(obj) {
                    const funds = obj.funds;
                    const fundBauCua = funds.find((item) => item.name === "BauCuaTo_vin_1000")
                    if(fundBauCua){
                        document.getElementById("numberHuBC").innerText ="Quỹ hiện tại:" + commaSeparateNumber(fundBauCua.value);
                    }
                }
            }
        })

    }, 1000);

</script>