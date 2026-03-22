<title>Xóc Đĩa</title>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if ($role == null): ?>
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
            input[type=radio] {
                width: 30px;
                height: 30px;
            }

            .myLable {
                font-size: 22px;
            }
            td>div>div {
                margin-bottom: 40px;
                text-align: center;
            }
            td>div>div>span {
                font-size: 20px;
            }
        </style>
        <section class="content">
        <div class="topContainer">
            <table class="table-bordered w-4" >
                <tbody>
                    <tr>
                        <td id="phien">Phiên</td>
                        <td id="betting-state">Trạng thái</td>
                        <td id="thoigian">Thời gian</td>
                        <td>
                            <span>QUỸ HIỆN TẠI: <span style="color: #00b894" id="numberHuXD">$0</span></span>      
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table-bordered w-5-1" >
                <tbody>
                    <tr>
                        <td> 
                            <label class="form-check-label myLable " for="inlineRadio1">
                                <img src="<?php echo public_url() ?>/admin/crown/images/kqXocdia0.png" />
                            </label>
                        </td>
                        <td>
                            <label class="form-check-label myLable " for="inlineRadio2">
                                <img src="<?php echo public_url() ?>/admin/crown/images/kqXocdia1.png" />
                            </label>
                        </td>
                        <td>
                            <label class="form-check-label myLable " for="inlineRadio3">
                                <img src="<?php echo public_url() ?>/admin/crown/images/kqXocdia2.png" />
                            </label>
                        </td>
                        <td>
                            <label class="form-check-label myLable " for="inlineRadio4">
                                <img src="<?php echo public_url() ?>/admin/crown/images/kqXocdia3.png" />
                            </label>
                        </td>
                        <td>
                            <label class="form-check-label myLable " for="inlineRadio5">
                                <img src="<?php echo public_url() ?>/admin/crown/images/kqXocdia4.png" />
                            </label>
                        </td>
                        <td>
                            RANDOM
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0">    
                        </td>
                        <td>
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1">
                        </td>
                        <td>
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="2">
                        </td>
                        <td>
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="3">
                        </td>
                        <td>
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="4">
                        </td>
                        <td>
                            <input checked class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio6" value="5">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id="money0"></span>
                        </td>
                        <td>
                            <span id="money1"></span>
                        </td>
                        <td>
                            <span id="money2"></span> 
                        </td>
                        <td>
                            <span id="money3"></span>
                        </td>
                        <td>
                            <span id="money4"></span>
                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table-bordered w-6" >
                <tbody>
                    <tr>
                        <td>TRẮNG-TRẮNG-TRẮNG-TRẮNG = 0</td>
                        <td>TRẮNG-TRẮNG-TRẮNG-ĐEN = 1</td>
                        <td>CHẴN</td>
                        <td>LẺ</td>
                        <td>TRẮNG-ĐEN-ĐEN-ĐEN = 3</td>
                        <td>ĐEN-ĐEN-ĐEN-ĐEN = 4</td>

                    </tr>
                    <tr>
                        <td><span id="result0">4 Trắng : 0<span</td>
                        <td><span id="result1">1 Đen 3 Trắng: 0<span</td>
                        <td><span id="resultChan">Chẵn : 0<span</td>
                        <td><span id="resultLe">Lẻ : 0<span</td>
                        <td><span id="result3">3 Đen 1 Trắng : 0<span</td>
                        <td><span id="result4">4 Đen : 0<span></td>

                    </tr>
                </tbody>
            </table>
        </div>
            <div class="container">
                <div class="rightContainer">
                    <h4 class="alignContent">
                        Danh sách người chơi</h4>
<!--                    <div id="user_list" class="table-wrapper-scroll-y my-custom-scrollbar">-->
<!--                    </div>-->
                    <table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered alignContent" width="100%" cellspacing="0" id="example">
                        <thead>
                        <tr style="height: 20px;">

                            <td>Nickname</td>
                            <td>Số dư</td>
                            <td>tiền cược hiện tại</td>
                            <td>Lãi (lỗ)</td>
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
    #betting-state {
        font-weight: bold;
        font-size: 20px;
    }
    #thoigian {
        font-weight: bold;
        font-size: 20px;
    }
    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }
    .topContainer {
        background: white;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .topContainer td {
        text-align: center;
        word-break: normal;
        padding: 5px;
    }
    table.w-4 td {
        width: 25%;
    }
    table.w-6 td {
        width: 16.66%;
    }
    table.w-5-1 td {
        min-width: 16.66%;
    }
    table.w-5-1 td img {
        width: 100%;
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

    .anyClass {
        height: 150px;
        overflow-y: scroll;
    }

    .message_inputField {
        margin-right: 4px;

    }
    #example td {
        word-break: normal;
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

    const KETQUA = {
        0: {dice1: 0, dice2: 0, dice3: 0, dice4: 0},
        1: {dice1: 1, dice2: 0, dice3: 0, dice4: 0},
        2: {dice1: 1, dice2: 1, dice3: 0, dice4: 0},
        3: {dice1: 1, dice2: 1, dice3: 1, dice4: 0},
        4: {dice1: 1, dice2: 1, dice3: 1, dice4: 1},
    }
    var status="auto";
    function getVal(){
        var dice1 = $('input[name="inlineRadioOptions"]:checked').val();
        var dice2 = $('input[name="inlineRadioOptions2"]:checked').val();
        var dice3 = $('input[name="inlineRadioOptions3"]:checked').val();
        var dice4 = $('input[name="inlineRadioOptions4"]:checked').val();
        if(dice1!=null && dice2!=null && dice3!=null ){
              status="be";
        } else {
            status="auto";
        }
    }



 

    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 0,
        minimumFractionDigits: 0,
    });
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    function tinhLoLai(money) {
        let money0 = 0;
        let money1 = 0;
        let money2 = 0;
        let money3 = 0;
        let money4 = 0;
        const {chan, le, fourDen, fourTrang, oneDen, baDen} = money;
        money0 = (fourDen + oneDen + baDen) - (fourTrang * 15 + chan);
        money1 = (fourTrang + fourDen + baDen) - (oneDen * 3 + le);
        money2 = (fourTrang + oneDen + baDen + fourDen) - chan;
        money3 = (fourTrang + oneDen + fourDen) - (baDen * 3 + le);
        money4 = (fourTrang + oneDen + baDen) - (fourDen * 15 + chan);
        document.getElementById("money0").innerText = money0 > 0 ? '+' : '' + commaSeparateNumber(money0);
        document.getElementById("money0").style.color = money0 > 0 ? 'green' : 'red';
        document.getElementById("money1").innerText = money1 > 0 ? '+' : '' + commaSeparateNumber(money1);
        document.getElementById("money1").style.color = money1 > 0 ? 'green' : 'red';
        document.getElementById("money2").innerText = money2 > 0 ? '+' : '' + commaSeparateNumber(money2);
        document.getElementById("money2").style.color = money2 > 0 ? 'green' : 'red';
        document.getElementById("money3").innerText = money3 > 0 ? '+' : '' + commaSeparateNumber(money3);
        document.getElementById("money3").style.color = money3 > 0 ? 'green' : 'red';
        document.getElementById("money4").innerText = money4 > 0 ? '+' : '' + commaSeparateNumber(money4);
        document.getElementById("money4").style.color = money4 > 0 ? 'green' : 'red';

    }

    function updateViewPhienBet(obj){
        let chan = obj.potList["0"].totalMoneyUserBet;
        let le = obj.potList["1"].totalMoneyUserBet;
        let fourDen = obj.potList["2"].totalMoneyUserBet;
        let fourTrang = obj.potList["3"].totalMoneyUserBet;
        let oneDen = obj.potList["4"].totalMoneyUserBet;
        let baDen = obj.potList["5"].totalMoneyUserBet;
        tinhLoLai({chan, le, fourDen, fourTrang, oneDen, baDen});
        document.getElementById("resultChan").innerText = commaSeparateNumber(obj.potList["0"].totalMoneyUserBet);
        document.getElementById("resultLe").innerText = commaSeparateNumber(obj.potList["1"].totalMoneyUserBet);
        document.getElementById("result4").innerText =  commaSeparateNumber(obj.potList["2"].totalMoneyUserBet);
        document.getElementById("result0").innerText =  commaSeparateNumber(obj.potList["3"].totalMoneyUserBet);
        document.getElementById("result1").innerText = commaSeparateNumber(obj.potList["4"].totalMoneyUserBet);
        document.getElementById("result3").innerText = commaSeparateNumber(obj.potList["5"].totalMoneyUserBet);
    }

    function updateViewPhienHead(obj){
        document.getElementById("phien").innerText = "Phiên :" +obj.referenceId;
        document.getElementById("thoigian").innerText = "Thời gian: " + obj.remainingTime;
        document.getElementById("betting-state").innerText = obj.betting ? "Đặt cược" : "Trả thưởng";
    }

    setInterval(function () {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("admin/user/getResultXocDia") ?>",
            success: function (result) {
                obj = JSON.parse(result);
                document.getElementById("numberHuXD").innerText = commaSeparateNumber(obj.fund_xd_auto);
            }
        })

    }, 1000);

    $(`input[name="inlineRadioOptions"]`).click(function () {
        let result = $('input[name="inlineRadioOptions"]:checked').val();
        if(result != "5"){
            status="be";
        } else {
            status="auto";
        }
        const { dice1, dice2, dice3, dice4 } = KETQUA[parseInt(result)];
        $.ajax({
            type:"POST",
            url: "<?php echo admin_url('user/beCauxocdiaAjax')?>",
            data:{
                status:status,
                dice1:dice1,
                dice2:dice2,
                dice3:dice3, 
                dice4:dice4
            },
            dataType :'json',
            success: function (result) {
                if(result.toString()=="0"){
                    toasty.otp('Bẻ cầu thành công !');
                }

            }

        })
    })


</script>
<script type = "text/javascript">

// Let us open a web socket
// var ws = new WebSocket("wss://wsadmin.ace88.live/ws?req=ok&userName=daodeptrai1");var ws  
var ws = null;

doconnect();

function doconnect(){
  try {
     ws = new WebSocket("<?php echo web_socket() ?>ws?req=ok&userName=daodeptrai1");
  } catch (error) {
      doconnect();
  }
  ws.onclose = function() { 
     doconnect();
//    alert("Connection is closed..."); 
};
}
/*
ws.onopen = function() {

   var objetSender = {
      type :"login",
      requestBody :{
         username:"name",
         pass:"passs"
      },
      message:"hello"
   };
   ws.send(JSON.stringify(objetSender));
};*/
let arrTable=[];
function getPotType(i){
     switch(i){
         case 0: return "Chan";
         case 1 :return "Le";
         case 2 :return "4 Den";
         case 3 :return "4 Trang";
         case 4 :return "1 Den 3 Trang";
         case 5 :return "1 Trang 3 Den";
     }
 }
ws.onmessage = function (evt) { 
   var received_msg = evt.data;
   var res = JSON.parse(received_msg);
   if("1"===(res["code"])){
       document.getElementById("phien").innerText = "Phiên :" +res.sessionId;
        document.getElementById("thoigian").innerText = "Thời gian: " + res.timmer;
        document.getElementById("betting-state").innerText = res.isBetting === "true" ? "Đặt cược" : "Trả thưởng";
        if(res.timmer === "0"){
            $("input[name=inlineRadioOptions]").prop('checked', false);
            $("#inlineRadio6").prop('checked', 'checked');
        }
   }else if("2"===(res["code"])){
     let arr = [];
     for(var i=0; i<res["potList"].length;i++){
         for(j=0;j< Object.keys(res["potList"][i]["userBetMap"]).length;j++){
             var potname = getPotType(i);
             const name =  Object.keys(res["potList"][i]["userBetMap"])[j];
             const exValue = arr.find((item) => item.name === name);
             const money = res["users"].find((item) => item.nickname === name);
             const betmoney = exValue ? exValue.betmoney + `, ${potname}: ${commaSeparateNumber(Object.values(res["potList"][i]["userBetMap"])[j])}` : `${potname}: ${commaSeparateNumber(Object.values(res["potList"][i]["userBetMap"])[j])}`
             let object ={
                 name,
                 betmoney,
                 totalMoney: commaSeparateNumber(money?.totalMoney),
                 totalProfit: commaSeparateNumber(money?.totalProfit)
             }
             if(exValue) {
                const index = arr.findIndex((e) => e.name === name);
                arr[index] = object;
             }else {
                arr.push(object);
             }
         }
    
      
     }
     arrTable = arr;
     updateTable();
     updateViewPhienBet(res);
     
   }

};

function updateTable(){
    $('#example').DataTable({
                            destroy: true,
                            searching: true,
                            pageLength: 100,
                            data: (arrTable),
                            columns: [

                                { data: 'name' },
                                { data: 'totalMoney' },
                                { data: 'betmoney' },
                                { data: 'totalProfit' },

                            ],
                        });
}
function sendMessage(varx){
   ws.send(varx);
   
}

ws.onclose = function() { 
doconnect();

};


</script>