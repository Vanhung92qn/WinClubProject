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
            <h6 style="color: #001f0f;">DANH SÁCH ACC ĐANG QUAY HŨ</h6>
        </div>

        <div style='position: relative;'>
            <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: -25px; transform: translate(-50%, 0);"></p></h3>
            <div Class="Content-table">
                <div class="Content-table-item">
                    <div class="Content-table-item__ttl formRow">
                        <h4>DANH SÁCH ACC ĐANG QUAY HŨ</h4>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="tableAcc" style="background: #fffed9;display: block; max-height: 600px; overflow-y: scroll">
                        <thead style="height: 35px; background: #a51700;">
                            <tr style="height: 35px;">
                                <td  style="width: 100px;">STT</td>
                                <td>Nickname</td>
                                <td>Trạng thái</td>
                                <td>Tên game</td>
                                <td>Loại hũ</td>
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
    });

    function listAccFunc(stt, value) {
		if(value[0] == 'Leonlisad') {
            //console.log(value);
        }
        var rs = "";
        rs += "<tr id=" + value[0] + "_item" + ">";
        rs += "<td style='text-align: center;'>" + stt + "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; min-width: 161px;'>" + value[0] + "</td>";
        if(value[1] == 'play') {
            rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>Đang quay</td>";
        } else if(value[1] == 'join'){
            rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>Mới vào</td>";
        }
		rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + getNameGame(value[2])+ "</td>";
        rs += "<td style='color: #01125f;font-weight: bold; text-align: center;'>" + value[3] + "</td>";

        rs += "<td id=" + value[0] + "_action" + "><span class='label label-danger' style='padding: 8px;margin-left: 10px;'><a style='color: white;' href=\"javascript: SetNoHu(" + "`" + value + "`" + ")\">Set Nổ Hũ</a></span></td>";
        rs += "</tr>";
        return rs;
    }

    function SetNoHu(value) {
        const infoArray = value.split(",");
        if (!confirm('Bạn chắc chắn muốn +Tài khoản: ' +  infoArray[0]  +' +Nổ Hũ: ' + getNameGame(infoArray[2]) + ' +Loại hũ: ' + infoArray[3] + ' không ?')) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/setjackpotajax')?>",
            data: {
                gamename :  infoArray[2],
                typejackpot : 1,
                nickname:  infoArray[0],
                typeUser: "real",
                moneyPot: 0,
                typeMoney: infoArray[3],
                act: 'add'
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                console.log(result);
                if (result.success) {
                    alert("Set nổ hũ thành công!");
                }
            }, error: function () {
                $("#spinner").hide();
                $("#errorname").html("Hệ thống quá tải. Vui long thử lại sau");
            },timeout : 20000
        });
    }
	
    var ex = [];
    ex.push(function(){
        var itemSocket = new WebSocket("<?php echo web_socket() ?>state-report"); // ket noi ws server
        itemSocket.onopen = function (event) {};
        itemSocket.onmessage = function (evt) {
            var received_msg = evt.data;
            var res = JSON.parse(received_msg);
            if(res["code"] === "2"){
                var listAcchtml = "";
                $.each(res.stateLists, function (index, value) {
                    const myArray = value.split(" ");
                    listAcchtml += listAccFunc(index, myArray);
                });
                $('#logactionAcc').html(listAcchtml);
            }
            
           
        };
        return itemSocket;
    }());

    function getNameGame(name){
        switch(name){
            case 'TAMHUNG':
                return "Prirate King";
            case 'BENLEY':
                return "Thần Tài";
            case 'RANGE_ROVER':
                return "AVENGERS";
            case 'CANDY':
                return "Minigame Kim Cương";
            case 'MiniPoker':
                return "Minigame MiniPoker";
            default:
                return "Không xác định";
        }
    }
	


</script>
