<title>Tài Xỉu Kubet</title>
<?php if ($role == null): ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else: ?>
<div class="wrapper">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/moment.min.js"></script>
    <section class="content-header">
        <!--div style="text-align: right;">
            <button class="button" data-toggle="modal" data-target="#myModalToturial"
                    style="background-color: #d63031; color: white">ẤN VÀO ĐÂY ĐỂ XEM
                HƯỚNG DẪN
            </button>
        </!div-->
        <div class="modal fade" id="myModalToturial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center">Hướng Dẫn Sử Dụng</h4>
                    </div>
                    <div class="modal-body" style=" color: rebeccapurple; font-size: larger">
                        <br style="text-align: center ;">
                        Lưu ý : Thời gian bẻ càng tài xỉu là 2 - 6 giây cuối của Time phiên hiện tại
                        và thời gian SETBOT là trước 5 giây cuối của Time chờ phiên mới, khi đang trong phiên hiện tại
                        thì setbot
                        sẽ không ăn mà khi đó thông tin set sẽ đẩy sang phiên sau
                        </br>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-1">
                                <button data-dismiss="modal" class="btn btn-primary pull-left" style="width: 100px">
                                    Đóng
                                </button>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container">
            <div>
                       
                <div class="blockTop">
                    <div style="display: flex; align-items: baseline; justify-content: space-around; gap: 30px" class="kyTinhVcl">
                        <!--
                        <div>Đang bẻ càng về: <span style="font-size: 24px; color: green;" id="ket_qua_be_cang"></span></div>
                        <div style="text-align: center">QUỸ HIỆN TẠI: <span style="color: #00b894" id="numberHuTx">$0</span></div>
                        -->
                    </div>
                    <div id="cau"></div>
                    <div class="row_be_cang">
                        <iframe src="<?php echo getenv('TAI_XIU_KUBET_IFRAME_URL'); ?>" frameborder="0" width="400" height="200"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    <div class="row_be_cang">
                        <div id="label-tai" class="column_flex">
                            <img class="tx-label" id="tai" src="<?php echo public_url() ?>/admin/images/tai.png"/>
                            <div style="color: yellow; z-index:1;" id="tien_ca_bot_tai">Tiền cả bot</div>
                            <div style="color: #ffab00;"><span class="glyphicon glyphicon-user"></span></div>
                            <span id='number_user_tai'style="margin: 0px 5px; color: yellow;">0</span>
                        </div>
                        <div id="label-chan" class="column_flex">
                            <img class="tx-label" id="chan" src="<?php echo public_url() ?>/admin/images/chan.png"/>
                            <div style="color: yellow; z-index:1;" id="tien_ca_bot_chan">Tiền cả bot</div>
                            <div style="color: #ffab00;"><span class="glyphicon glyphicon-user"></span></div>
                            <span id='number_user_chan' style="margin: 0px 5px; color: yellow;">0</span>
                        </div>
                        <div class="column_flex">
                            <div style="color: white;"> Số user thực <span title="Số người thực tế chơi" id="number_user_real"></span></div>
                            <div style="position: relative">
                            <!-- 0 title="Thời gian chờ phiên mới" -->
                            <div class="time_pending_round" id="time_wait_new_round"></div>
                            <div style="color: yellow; font-size: 64px; width: 120px; height: 120px" class="icon_tai" title="Thời gian phiên" id="real_time">
                            </div>
                            </div>

                            <!-- <div style="color: white;" class="alignContent">
                                Tổng số tiền đặt phiên
                             </div>
                            <div class="alignContent" style="flex: 1; color: #00b894 ; font-size: x-large;"
                             id="total_money_phien">0</div> -->
                        </div>
                        <div id="label-le" class="column_flex">
                            <img class="tx-label" id="le" src="<?php echo public_url() ?>/admin/images/le.png"/>
                            <div style="color: yellow; z-index:1;" id="tien_ca_bot_le">Tiền cả bot</div>
                            <div style="color: #ffab00;"><span class="glyphicon glyphicon-user"></span></div>
                            <span id='number_user_le' style="margin: 0px 5px; color: yellow;">0</span>
                        </div>
                        <div id="label-xiu" class="column_flex">
                            <img class="tx-label" id="xiu" src="<?php echo public_url() ?>/admin/images/xiu.png"/>
                            <div style="color: yellow; z-index:1;" id="tien_ca_bot_xiu">Tiền cả bot</div>
                            <div style="color: #ffab00;"><span class="glyphicon glyphicon-user"></span></div>
                            <span id='number_user_xiu' style="margin: 0px 5px; color: yellow;">0</span>
                        </div>
                    </div>
                    <div style="flex: 1" id="phien_id">số phiên hiện tại</div>

                    <!--div class="row_be_cang">
                        <input type="radio" name="becang" class="button" id="autoTai"></input>
                        <input type="radio" name="becang" class="button" id="auto"></input>
                        <input type="radio" name="becang" class="button" id="autoXiu"></input>
                    </div-->
                </div>
                <!--div>
                    <div style="display: flex; justify-content: space-around; align-items: center">
                        <div class="set-bot-tai">
                            <input type="button" id="set_bot_Tai"   value="Tài hơn"
                                class="btn btn-primary pull-left">
                        </div>

                        <div class="set-bot-same">
                            <input type="button" id="set_bot_same"  
                                value="Cân bằng" class="btn btn-primary pull-left">
                        </div>

                        <div class="set-bot-xiu">
                            <input type="button" id="set_bot_xiu"   value="Xỉu hơn"
                                class="btn btn-primary pull-left">
                        </div>

                    </div> 
                </div-->
                <div class="row_list_user">
                    <div>
                        Tổng đặt TÀI:
                        <span style="color: #00b894; font-size: x-large;" id="user_tai" onload="setUserTaiXiuPlay()">Tiền không bot</span>
                    </div>
                    <div>
                        Tổng đặt CHẴN:
                        <span style="color: #00b894; font-size: x-large;" id="user_chan" onload="setUserChanLePlay()">Tiền không bot</span>
                    </div>
                    <div>
                        Tổng đặt LẺ:
                        <span style="color: #00b894; font-size: x-large;" id="user_le" onload="setUserChanLePlay()">Tiền không bot</span>
                    </div>
                    <div>
                        Tổng đặt XỈU:
                        <span style="color: #00b894; font-size: x-large;" id="user_xiu" onload="setUserTaiXiuPlay()">Tiền không bot</span>
                    </div>
                </div>
                <div class="row_list_user">
                    <div id="user_list_tai" class="table-wrapper-scroll-y my-custom-scrollbar">
                    </div>
					 <div id="user_list_chan" class="table-wrapper-scroll-y my-custom-scrollbar">
                    </div>
					<div id="user_list_le" class="table-wrapper-scroll-y my-custom-scrollbar">
                    </div>
                    <div id="user_list_xiu" class="table-wrapper-scroll-y my-custom-scrollbar">
                    </div>
                </div>
                <!--h4 class="alignContent" style="margin-top: 10px;">Chat người dùng</!--h4>
                <div id="message_block" class="nav nav-pills nav-stacked anyClass"
                     style="flex: 1; background-color: cornsilk; text-align: right; padding: 5px;  overflow: auto"></div>
                    <div>
                        <div class="col-sm-2"
                            style="width: 55%; padding: 5px 10px 10px 15px; ">
                            <label for="bots">Chọn Bot chat:</label>
                            <select name="bots" id="bot_list" class="custom-select">
                                <option value="phucnguyen">phucnguyen</option>
                                <option value="anhminh">anhminh</option>
                                <option value="sanbangtatca">sanbangtatca</option>
                                <option value="gaothettenem">gaothettenem</option>
                                <option value="buonchaomi">buonchaomi</option>
                                <option value="congckuapong">congckuapong</option>
                                <option value="cheolencotdien">cheolencotdien</option>
                                <option value="thehienty">thehienty</option>
                                <option value="thoxaymac">thoxaymac</option>
                                <option value="quanrach">quanrach</option>
                                <option value="conbao">conbao</option>
                                <option value="sobayy">sobayy</option>
                                <option value="chiataynhe">chiataynhe</option>
                                <option value="buoncuoi">buoncuoi</option>
                                <option value="neuemcothai">neuemcothai</option>
                                <option value="dungkhai">dungkhai</option>
                                <option value="hanhphucc">hanhphucc</option>
                                <option value="suynghituong">suynghituong</option>
                                <option value="chaytheocon">chaytheocon</option>
                                <option value="chomeoxinh">chomeoxinh</option>
                                <option value="tuongdolaem">tuongdolaem</option>
                                <option value="cuoctinhbuon">cuoctinhbuon</option>
                                <option value="lagicuanhau">lagicuanhau</option>
                                <option value="cuongiay">cuongiay</option>
                                <option value="dienthoaii">dienthoaii</option>
                                <option value="xinhnhuai">xinhnhuai</option>
                                <option value="emyeuba">emyeuba</option>
                                <option value="tuoitrelam">tuoitrelam</option>
                                <option value="thehe8x">thehe8x</option>
                                <option value="thoidaitre">thoidaitre</option>
                                <option value="thaosusu">thaosusu</option>
                                <option value="dusaoem">dusaoem</option>
                                <option value="maitrong">maitrong</option>
                                <option value="anxinhdep">anxinhdep</option>
                                <option value="mytontom">mytontom</option>
                                <option value="vitdauto">vitdauto</option>
                                <option value="trangthuy">trangthuy</option>
                                <option value="caohang">caohang</option>
                                <option value="duongquoctuan">duongquoctuan</option>
                                <option value="longnhannguyet">longnhannguyet</option>
                            </select>
                        </div>
                    </div>
                </div-->
                <!--div class="form-group">
                    <div class="row">
                        <div style="padding-left: 4%">
                            <div style="display: inline-block; padding: 10px">
                                <input type="button" id="auto_chat_xiu"
                                       value="Auto chat xỉu" class="btn btn-primary pull-left"
                                       style="padding: 6px 8px; background-color: #ee5253">
                            </div>
                            <div style="display: inline-block; padding: 10px">
                                <input type="button" id="auto_chat_tai"
                                       value="Auto chat tài" class="btn btn-primary pull-left"
                                       style="padding: 6px 8px; background-color: #0d6aad">
                            </div>
                        </div>
                        <br><br>
                        <div class="col-sm-2" style="width: 97%; padding-right: 0px; ">
                            <input style="border: solid black 1px; border-radius: 5px;" type="text" id="content_msg"
                                   class="form-control"
                                   placeholder="Nhập tin nhắn">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; margin-top: 5px;">
                        <input type="button" id="send_msg"
                               value="Gửi" class="btn btn-primary pull-left" style="padding: 6px 8px; width: 30%;">
                    </div>
                </div-->
            
                    <div style="padding: 15px; background: #ffcbcb; border-radius: 5px;">
                        <h4 style="text-align: center; color: #fff;">SET BOT</h4>
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="" id="moneyMin" class="form-control" placeholder="Mức cược tối thiểu" value="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="" id="moneyMax" class="form-control" placeholder="Mức cược tối đa" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="number" id="numberUserTaiMax" class="form-control" placeholder="Số người đặt TÀI tối đa">
                                    </div>
                                    <label id="numchuyen" style="color: blueviolet"></label>
                                </div>

                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="number" id="numberUserXiuMax" class="form-control" placeholder="Số người đặt XỈU tối đa">
                                    </div>
                                    <label id="numchuyen" style="color: blueviolet"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="padding-setbot">
                                    <input type="number" id="numberUserChanMax" class="form-control" placeholder="Số người đặt CHẴN tối đa">
                                </div>
                                <label id="numchuyen" style="color: blueviolet"></label>
                            </div>

                            <div class="col-sm-6">
                                <div class="padding-setbot">
                                    <input type="number" id="numberUserLeMax" class="form-control" placeholder="Số người đặt LẺ tối đa">
                                </div>
                                <label id="numchuyen" style="color: blueviolet"></label>
                        </div>

                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-2">
                                <input type="button" id="save_set_bot" style="background-color: #c0392b" value="Cập nhật" class="btn btn-primary pull-left">
                            </div>
                            <div class="col-sm-2">
                                <input type="button" id="cancel" style="width: 100px; background-color: #d35400" value="HỦY" class="btn btn-primary pull-left" data-dismiss="modal">
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
					
					
					<!--div style="padding: 15px; background: #2980b9; border-radius: 5px;">
                        <h4 style="text-align: center; color: #fff;">SET SỐ LƯỢNG BOT</h4>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="number" id="numberBotTaiFake" class="form-control" placeholder="Bot Fake TÀI">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="padding-setbot">
                                        <input type="number" id="numberBotXiuFake" class="form-control" placeholder="Bot Fake Xỉu">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex;justify-content: center;">
                            <input type="button" id="setBotFake" style="background-color: #2700ff" value="Set Bot" class="btn btn-primary pull-left">
                        </div>
                    </div-->
                    <br>
                    <h4 style="text-align: center">Thông Tin Bot Đang Được Set</h4>
                    <div id="bot_info" class="table-wrapper-scroll-y my-custom-scrollbar" style="background: #ffffff; border-radius: 15px; border: 1px solid #ff8c8c;">
                    </div>
                
            </div>
        </div>
    </section>
</div>
<!-- <?php endif; ?> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" rel="stylesheet"/>

<script>
function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
    }
    return val;
}
    function sendMessage() {
        var message = $('#msg').val();
        $('#msg').val('');

        var jsonObject = {
            userName: userName,
            message: message
        };
        socket.emit('chatevent', jsonObject);
    }

    function output(message) {
        var currentTime = "<span class='time'>" + moment().format('HH:mm:ss.SSS') + "</span>";
        var element = $("<div>" + currentTime + " " + message + "</div>");
        $('#console').prepend(element);
    }

    $(document).keydown(function (e) {
        if (e.keyCode == 13) {
            $('#send').click();
        }
    });
</script>
<script>
    var rows = [];

    var numberMax = [550, 600, 700];
    var numberMoneyMax = [500000, 400000, 450000];
    var numberMin = [450, 480, 500];
    var numberMoneyMin = [150000, 100000, 50000];

    var moneyMaxGlobal = 0;
    var moneyMinGlobal = 0;
    var numberUserTaiMaxGlobal = 0;
    var numberUserXiuMaxGlobal = 0;
    var numberUserChanMaxGlobal = 0;
    var numberUserLeMaxGlobal = 0;

    $("#save_set_bot").click(function () {
        var moneyMin = Number($("#moneyMin").val().replaceAll(',', '').replaceAll('.',''));
        var moneyMax = Number($("#moneyMax").val().replaceAll(',', '').replaceAll('.',''));
        if ($("#numberUserTaiMax").val() === "" || $("#numberUserXiuMax").val() === "" || $("#moneyMax").val() === "" || $("#moneyMax").val() === "NaN" || $("#moneyMin").val() === "" || $("#moneyMin").val() === "NaN" || $("#numberUserChanMax").val() === "" || $("#numberUserLeMax").val() === "") {
            alert("Các trường thông tin không được phép để trống ")
        } else if ($("#numberUserTaiMax").val() > 1000 || $("#numberUserXiuMax").val() > 1000 || $("#numberUserChanMax").val() > 1000 || $("#numberUserLeMax").val() > 1000) {
            alert("Số bot tối đa là 1000 một bên");
        } else if (moneyMax < moneyMin) {
            alert("Mức cược tối đa phải lớn hơn Mức cược tối thiểu");
        } else {
            updateSetBotKuabet(moneyMin, moneyMax, $("#numberUserTaiMax").val(), $("#numberUserXiuMax").val(), $("#numberUserChanMax").val(), $("#numberUserLeMax").val());
            getBotInfo();
        }
    });

    $("#set_bot_Tai").click(function () {
        updateSetBotKuabet(moneyMinGlobal, moneyMaxGlobal, numberUserTaiMaxGlobal + 100, numberUserXiuMaxGlobal, numberUserChanMaxGlobal, numberUserLeMaxGlobal);
        getBotInfo();
        document.getElementById("set_bot_Tai").disabled = true;
        document.getElementById("set_bot_xiu").disabled = true;
    });

    $("#set_bot_xiu").click(function () {
        updateSetBotKuabet(moneyMinGlobal, moneyMaxGlobal, numberUserTaiMaxGlobal, numberUserXiuMaxGlobal + 100);
        getBotInfo();
        document.getElementById("set_bot_Tai").disabled = true;
        document.getElementById("set_bot_xiu").disabled = true;
    });

    $("#set_bot_same").click(function () {
        if (numberUserTaiMaxGlobal > numberUserXiuMaxGlobal) {
            console.log(1);
            updateSetBotKuabet(moneyMinGlobal, moneyMaxGlobal, numberUserXiuMaxGlobal, numberUserXiuMaxGlobal, numberUserChanMaxGlobal, numberUserLeMaxGlobal);
        } else {
            console.log(2);
            updateSetBotKuabet(moneyMinGlobal, moneyMaxGlobal, numberUserTaiMaxGlobal, numberUserTaiMaxGlobal, numberUserChanMaxGlobal, numberUserLeMaxGlobal);
        }
        getBotInfo();
        document.getElementById("set_bot_Tai").disabled = false;
        document.getElementById("set_bot_xiu").disabled = false;
        document.getElementById("set_bot_chan").disabled = false;
        document.getElementById("set_bot_le").disabled = false;
    })
    ;

    $("#moneyMin, #moneyMax").on('keyup', function(){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    });

    $("#cancel").click(function () {
        $("#moneyMin").val("");
        $("#moneyMax").val("");
        $("#numberUserTaiMax").val("");
        $("#numberUserXiuMax").val("");
        $("#numberUserChanMax").val("");
        $("#numberUserLeMax").val("");
    });

    $("#send_msg").click(function () {
        console.log($('#bot_list').find(":selected").text());
        if ($("#content_msg").val() == "") {
            alert("Chưa nhập nội dung");
            return false;
        } else if ($('#bot_list').find(":selected").text() == "") {
            alert("Chưa chọn bot chat");
        } else {
            sendMsg($('#bot_list').find(":selected").text(), $("#content_msg").val());
        }
    });


    function sendMsg(nickname, message) {

        console.log(nickname)
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/chatAjax") ?>",
            data: {
                nickname: nickname,
                content: message,
            }, success: function (result) {
                if (result == 0) {
                    alert("Lỗi không xác định")
                } else if (result != null) {
                    $("#content_msg").val("");
                }
            }
        })
    }

    var i = 0;

    function myLoop(message, arrListMsg) {//  create a loop function
        setTimeout(function () {   //  call a 3s setTimeout when the loop is called
            //console.log('hello + ' + i);
            //  your code here
            if (i < 5) {
                sendListMsg(message[i], arrListMsg[i])//  if the counter < 5, call the loop function
                myLoop(message, arrListMsg);             //  ..  again which will trigger another
            }
            i++;
        }, 1000)//  ..  setTimeout()
    }

    function sendListMsg(message, name) {
        console.log(message, arrListMsgName);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/chatAjax") ?>",
            data: {
                nickname: name,
                content: message,
            }, success: function (result) {
                if (result == 0) {
                    alert("Lỗi không xác định")
                } else if (result != null) {
                    $("#content_msg").val("");
                }
            }
        })
    }

    function updateSetBotKuabet(moneyMin, moneyMax, numberUserTaiMax, numberUserXiuMax, numberUserChanMax, numberUserLeMax) {
        console.log(moneyMin, moneyMax, numberUserTaiMax, numberUserXiuMax, numberUserChanMax, numberUserLeMax);
        // @todo update later
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/updateSetBotKuabet") ?>",
            data: {
                moneyMin: moneyMin,
                moneyMax: moneyMax,
                numberUserTaiMax: numberUserTaiMax,
                numberUserXiuMax: numberUserXiuMax,
                numberUserChanMax: numberUserChanMax,
                numberUserLeMax: numberUserLeMax
            }, success: function (result) {
                if (result == 0) {
                    alert("Lỗi không xác định");
                } else if (result != null) {
                    // alert("Bạn đã setbot thành công");
                    $("#moneyMin").val("");
                    $("#moneyMax").val("");
                    $("#numberUserTaiMax").val("");
                    $("#numberUserXiuMax").val("");
                    $("#numberUserChanMax").val("");
                    $("#numberUserLeMax").val("");
                }
            }
        })
    }
    function setStatusBeCang(result) {
        return;
        if(result.tai_xiu_be_cang === 'tai' && $('#autoTai:checked').length == 0) {
            $('#autoTai').trigger('click');
        } else
        if(result.tai_xiu_be_cang === 'xiu' && $('#autoXiu:checked').length == 0) {
            $('#autoXiu').trigger('click');
        } 
        if(result.tai_xiu_be_cang === 'auto' && $('#auto:checked').length == 0) {
            $('#auto').trigger('click');
        }
        let kqBeCang = 'Auto';
        if(result.tai_xiu_be_cang?.toLowerCase() == 'tai') {
            kqBeCang = 'Tài';
        }
        if(result.tai_xiu_be_cang?.toLowerCase() == 'xiu') {
            kqBeCang = 'Xỉu';
        }
        document.getElementById("ket_qua_be_cang").innerText = kqBeCang;
        document.getElementById("numberHuTx").innerText = commaSeparateNumber(result.fund_tx_auto);
    }


    // var formatter = new Intl.NumberFormat('en-US', {
    //     style: 'currency',
    //     currency: 'USD',
    //     maximumFractionDigits: 0,
    //     minimumFractionDigits: 0,
    // });

    function renderRowUser(rows) {
        let html = "<table style='font-size: 12px;' border='1\1' class='table table-bordered table-striped mb-0'>";
        html += "<thead >";
        html += '<th style="width: 10px; padding: 0">STT</th>';
        html += "<th style='padding: 0'>Tên</th>";
        html += "<th style='padding: 0'>Tiền cược</th>";
        html += "<th style='padding: 0'>Lãi (lỗ)</th>";
        html += "<th style='padding: 0'>Số dư</th>";
        html += "</thead>";
        html += "<tbody >";
        if(rows?.length) {
            rows.sort(function (a, b) {
                return b.money - a.money;
            });
            rows.map((item, index) => {
                console.log("item===", item);
                html += "<tr class='List-item'>";
                html += `<th style='padding: 0' style='color: #e74c3c'>${index+1}</th>`;
                html += "<td style='padding: 0'>" + item.username + "</td>";
                html += "<td style='padding: 0'>" + commaSeparateNumber(item.money) + "</td>";
                html += "<td style='padding: 0'>" + commaSeparateNumber(item.reportMoneyToday) + "</td>";
                html += "<td style='padding: 0'>" + commaSeparateNumber(item.totalMoney) + "</td>";
                html += "</tr>";
            });
        }
        html += "</tbody>";
        html += "</table>";
        return html;
    }

    function chatAndListUser(rows) {
        if (rows != null) {
            const rowTai = rows.filter((item) => item.cuaDat === 1);
            const rowXiu = rows.filter((item) => item.cuaDat === 0);
            const rowChan = rows.filter((item) => item.cuaDat === 2);
            const rowLe = rows.filter((item) => item.cuaDat === 3);
            document.getElementById("user_list_tai").innerHTML = renderRowUser(rowTai);
            document.getElementById("user_list_xiu").innerHTML = renderRowUser(rowXiu);
            document.getElementById("user_list_chan").innerHTML = renderRowUser(rowChan);
            document.getElementById("user_list_le").innerHTML = renderRowUser(rowLe);
        }
    }

    function inforSetBot(rows) {
        if(rows.numberUserTaiMax > rows.numberUserXiuMax) {
            $('.set-bot-tai').addClass('set-bot-checked');
            $('.set-bot-same').removeClass('set-bot-checked');
            $('.set-bot-xiu').removeClass('set-bot-checked');
            document.getElementById("set_bot_Tai").disabled = true;
            document.getElementById("set_bot_xiu").disabled = true;
        } else if (rows.numberUserTaiMax < rows.numberUserXiuMax) {
            $('.set-bot-tai').removeClass('set-bot-checked');
            $('.set-bot-same').removeClass('set-bot-checked');
            $('.set-bot-xiu').addClass('set-bot-checked');
            //document.getElementById("set_bot_Tai").disabled = true;
            //document.getElementById("set_bot_xiu").disabled = true;
        } else {
            $('.set-bot-tai').removeClass('set-bot-checked');
            $('.set-bot-same').addClass('set-bot-checked');
            $('.set-bot-xiu').removeClass('set-bot-checked');
            document.getElementById("set_bot_Tai").disabled = false;
            document.getElementById("set_bot_xiu").disabled = false;
        }

        rows.numberUserChanMax = rows.numberUserChan;
        rows.numberUserLeMax = rows.numberUserLe;

        moneyMaxGlobal = rows.moneyMax;
        moneyMinGlobal = rows.moneyMin;
        numberUserTaiMaxGlobal = rows.numberUserTaiMax;
        numberUserXiuMaxGlobal = rows.numberUserXiuMax;
        numberUserChanMaxGlobal = rows.numberUserChanMax;
        numberUserLeMaxGlobal = rows.numberUserLeMax;

        if (rows != null) {
            var html = "<table border='1\1' class='table table-bordered table-striped mb-0'>";
            html += "<thead >";
            html += "<th>Mức cược tối thiếu</th>";
            html += "<th>Mức cược tối đa</th>";
            html += "<th>Số người đặt Tài tối đa</th>";
            html += "<th>Số người đặt Xỉu tối đa </th>";
            html += "<th>Số người đặt Chẵn tối đa</th>";
            html += "<th>Số người đặt Lẻ tối đa</th>";
            html += "<th>Tổng Bot</th>";
            html += "</thead>";
            html += "<tbody >";
            //html += "<tbody>";
            html += "<tr class='List-item'>";
            html += "<td>" + commaSeparateNumber(rows.moneyMin) + "</td>";
            html += "<td>" + commaSeparateNumber(rows.moneyMax) + "</td>";
            html += "<td>" + "~" + rows.numberUserTaiMax + "</td>";
            html += "<td>" + "~" + rows.numberUserXiuMax + "</td>";
            html += "<td>" + "~" + rows.numberUserChanMax + "</td>";
            html += "<td>" + "~" + rows.numberUserLeMax + "</td>";
            html += "<td>" + "~" + (rows.numberUserXiuMax + rows.numberUserTaiMax + rows.numberUserChanMax + rows.numberUserLeMax) + "</td>";
            html += "</tr>";
            html += "</tbody>";
            html += "</table>";
            document.getElementById("bot_info").innerHTML = html;
        }
    }

    function listBot(buildings) {
        var ob = $("#bot_list");
        if (rows != null) {
            for (var i = 0; i < buildings.length; i++) {
                var val = buildings[i];
                var text = buildings[i];
                ob.prepend("<option value=" + val + ">" + text + "</option>");
            }
        }
    }


    function loadMessage(listmessage) {

        /*        if (listmessage.length > 10)
                    listmessage.splice(0, listmessage.length - 10)*/
        return;

        const result = listmessage.map((ms, index) => {
            if (ms.nickname !== $('#bot_list').find(":selected").text()) {
                return `<div style="background-color: #5d59a6; margin: 3px 5px; padding: 3px 10px; float: left; border-radius: 10px; color: white; display: inline;">
                    ${(ms.nickname.length > 0) ? (ms.nickname + ": ") : ""} ${ms.mesasge}
                </div>
                <div style=" display: block; clear: left; "></div>
                `;
            } else {
                return `<div style="background-color: #6d8737; margin: 3px 5px; padding: 3px 10px; float: right; border-radius: 10px; color: white; display: inline;">
                    ${(ms.nickname.length > 0) ? (ms.nickname + ": ") : ""} ${ms.mesasge}
                </div>
                <div style=" display: block; clear: right; "></div>
                `;
            }

        }).join(" ");
        document.getElementById('message_block').innerHTML = result;
    }

    window.addEventListener("load", myInit, true);

    function myInit() {
        showResultSetTX();
        getBotInfo();
    };

    /**
     * Call api lấy kết quả bẻ càng
     *
     * */
    function showResultSetTX() {
        return;
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("admin/user/getResultBecangTaixiu") ?>",
            success: function (result) {
                obj = JSON.parse(result);
                let data
                if (obj.tai_xiu_be_cang == 0) {
                    // becangtaixiu("auto");
                    alert("Lỗi showResultSetTX không xác định");
                } else if (obj.tai_xiu_be_cang != null) {
                    setStatusBeCang(obj);
                }
            }
        })
    }

    /**
     * Xem thông tin của bot đang được set như nào
     * */
    function getBotInfo() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("admin/user/getInforSetBotKuabet") ?>",
            success: function (result) {
                if (result == 0) {
                    // alert("Lỗi getBotInfo không xác định")
                } else if (result != null) {
                    obj = JSON.parse(result);
                    if (obj.errorCode == 0) {
                        inforSetBot(obj);
                    }
                }
            }
        })
    }


    /**
     * Lấy danh sách bot chat
     */
    (function getListBotChat() {
        $.ajax({
            url: "<?php echo base_url("admin/user/getListBotChatTaixiuAjax") ?>",
            type: "GET",
            success: function (result) {
                if (result == 0) {
                    // alert("Lỗi getListBotChat không xác định")
                } else if (result != null) {
                    obj = JSON.parse(result);
                    if (obj.errorCode == 0) {
                        listBot(obj.getListChatUsers);
                    }
                }
            },
            complete: setTimeout(function () {
                getListBotChat();
            }, 86400000),
            timeout: 3000
        })
    })();

    function becangtaixiu(type) {
        return;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/becangtaixiuajax") ?>",
            data: {
                acbe: type,
                nohu: "auto",
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                // obj = JSON.parse(result);
                if (result == 0) {
                    // alert("lỗi becangtaixiu không xác định")
                } else if (result == 1) {
                    // showResultSetTX();
                    let kqBeCang = 'Auto';
                    if(type?.toLowerCase() == 'tai') {
                        kqBeCang = 'Tài';
                    }
                    if(type?.toLowerCase() == 'xiu') {
                        kqBeCang = 'Xỉu';
                    }
                    document.getElementById("ket_qua_be_cang").innerText = kqBeCang;

                }

            }
        })
    }

    


    $("#autoTai").click(function () {
        //let isMobileSecure = <?= $this->session->userdata('isMobileSecure') ?>;
        //if (isMobileSecure == 1) $("#bsModal3").modal('show');
        becangtaixiu("tai");
        $("#errorvin").html("");
        // }
    });

   

    $("#autoXiu").click(function () {
        //let isMobileSecure = <?//= $this->session->userdata('isMobileSecure') ?>//;
        //if (isMobileSecure == 1) $("#bsModal4").modal('show');
        becangtaixiu("xiu");
        $("#errorvin").html("");

    });

   

    $("#auto").click(function () {
        //let isMobileSecure = <?//= $this->session->userdata('isMobileSecure') ?>//;
        //if (isMobileSecure == 1) $("#bsModal4").modal('show');
        becangtaixiu("auto");
        $("#errorvin").html("");

    });

    $("#truotp").click(function () {
        becangxiu();
    });

    $(document).ready(function () {
        $("#actionname").change(function () {
            if ($("#actionname").val() == "Admin") {
                $("#autoXiu").show();
            } else if ($("#actionname").val() == "EventVP") {
                $("#autoXiu").hide();
            }
        });
        $('#tienchuyen').on('paste', function (e) {
            let pastedData = e.originalEvent.clipboardData.getData('text');
            let money = parseInt(pastedData);
            if (isNaN(money) || money <= 0) {
                alert("Vui lòng nhập số lớn hơn 0");
                e.preventDefault();
            }
        });
        $("#tienchuyen").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    });
    var format = function (num) {
        var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    $("#tienchuyen").keyup(function (e) {
        $(this).val(($(this).val()));
        $("#numchuyen").text(format($(this).val()));

    });

    $("#auto_chat_xiu").click(function () {
        var randomItem = chatMessageXiu[Math.floor(Math.random() * chatMessageXiu.length)];
        var randomItem1 = chatMessageXiu[Math.floor(Math.random() * chatMessageXiu.length)];
        var randomItem2 = chatMessageXiu[Math.floor(Math.random() * chatMessageXiu.length)];
        var randomItem3 = chatMessageXiu[Math.floor(Math.random() * chatMessageXiu.length)];
        var randomItem4 = chatMessageXiu[Math.floor(Math.random() * chatMessageXiu.length)];
        var randomItemName = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName1 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName2 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName3 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName4 = chatName[Math.floor(Math.random() * chatName.length)];
        //var lstMsg = randomItem + ";" + randomItem1 + ";" + randomItem2 + ";" + randomItem3 + ";" + randomItem4;
        arrListMsg = [];
        arrListMsg.push(randomItem);
        arrListMsg.push(randomItem1);
        arrListMsg.push(randomItem2);
        arrListMsg.push(randomItem3);
        arrListMsg.push(randomItem4);
        arrListMsgName = [];
        arrListMsgName.push(randomItemName);
        arrListMsgName.push(randomItemName1);
        arrListMsgName.push(randomItemName2);
        arrListMsgName.push(randomItemName3);
        arrListMsgName.push(randomItemName4);
        i = 0;
        myLoop(arrListMsg, arrListMsgName);
    });

    $("#auto_chat_tai").click(function () {
        var randomItem = chatMessageTai[Math.floor(Math.random() * chatMessageTai.length)];
        var randomItem1 = chatMessageTai[Math.floor(Math.random() * chatMessageTai.length)];
        var randomItem2 = chatMessageTai[Math.floor(Math.random() * chatMessageTai.length)];
        var randomItem3 = chatMessageTai[Math.floor(Math.random() * chatMessageTai.length)];
        var randomItem4 = chatMessageTai[Math.floor(Math.random() * chatMessageTai.length)];
        //var lstMsg = randomItem + ";" + randomItem1 + ";" + randomItem2 + ";" + randomItem3 + ";" + randomItem4;
        arrListMsg = [];
        arrListMsg.push(randomItem);
        arrListMsg.push(randomItem1);
        arrListMsg.push(randomItem2);
        arrListMsg.push(randomItem3);
        arrListMsg.push(randomItem4);
        var randomItemName = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName1 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName2 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName3 = chatName[Math.floor(Math.random() * chatName.length)];
        var randomItemName4 = chatName[Math.floor(Math.random() * chatName.length)];
        arrListMsgName = [];
        arrListMsgName.push(randomItemName);
        arrListMsgName.push(randomItemName1);
        arrListMsgName.push(randomItemName2);
        arrListMsgName.push(randomItemName3);
        arrListMsgName.push(randomItemName4);
        i = 0;
        myLoop(arrListMsg, arrListMsgName);
    });

    $("#setBotFake").click(function () {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/setBotFakeAjax") ?>",
            data: {
                numberBotTaiFake: $("#numberBotTaiFake").val(),
                numberBotXiuFake: $("#numberBotXiuFake").val(),
            },
            success: function (result) {
                // console.log(result);
				alert("Set Bot Fake Thành Công!");

                
            }
        })
    });

    $("#setLaiLo").click(function () {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/updateHuTaiXiu") ?>",
            data: {
                minHu: $("#numberMinLo").val(),
                maxHu: $("#numberMaxLo").val(),
                hu: $("#numberMinLo").val(),
            },
            success: function (result) {
                // console.log(result);
                alert("Set hũ thành công!");
            }
        })
    });

    $("#resethu").click(function () {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/updateHuTaiXiu") ?>",
            data: {
                minHu: $("#numberMinLo").val(),
                maxHu: $("#numberMaxLo").val(),
                hu: 99,
            },
            success: function (result) {
                // console.log(result);
                alert("Set hũ thành công!");
            }
        })
    });
    var chatName = [
        "thiencau",
        "trongnghia",
        "ngoitrongtolet",
        "gaothettenem",
        "buonchaomi",
        "congckuapong",
        "cheolencotdien",
        "thehienty",
        "thoxaymac",
        "quanrach",
        "conbao",
        "sobayy",
        "chiataynhe",
        "buoncuoi",
        "neuemcothai",
        "dungkhai",
        "hanhphucc",
        "suynghituong",
        "chaytheocon",
        "chomeoxinh",
        "tuongdolaem",
        "cuoctinhbuon",
        "lagicuanhau",
        "cuongiay",
        "dienthoaii",
        "xinhnhuai",
        "emyeuba",
        "tuoitrelam",
        "thehe8x",
        "thoidaitre",
        "thaosusu",
        "dusaoem",
        "maitrong",
        "anxinhdep",
        "mytontom",
        "vitdauto",
        "trangthuy",
        "caohang",
        "duongquoctuan",

    ];

    var chatMessageXiu = ["hup 3l xiu ",
        "xỉu bú",
        "XỈU BÚ",
        "chen xiu 500k",
        "xỉu lượm",
        "XỈU LƯỢM",
        "đã bảo xỉu mà",
        "ĐÃ BẢO XỈU MÀ",
        "hup 2m xiu ngot vl",
        "xỉu húp",
        "XỈU HÚP",
        "ma xiu ngon v",
        "xỉu đẹp luôn",
        "XỈU ĐẸP LUÔN",
        "fan xiu gio tay",
        "xỉu đẹp",
        "XỈU ĐẸP",
        "xiu tuong tra lai an",
        "húp xỉu",
        "HÚP XỈU",
        "chi thich nan xiu ae a",
        "bú xỉu",
        "BÚ XỈU",
        "nay toan an xiu ve bo",
        "lượm xỉu",
        "LƯỢM XỈU",
        "bup 2m xiu ngot that",
        "ăn xỉu 1m",
        "ĂN XỈU 1M",
        "ăn xỉu 2m",
        "ĂN XỈU 2M",
        "ăn xỉu 3m",
        "ĂN XỈU 3M",
        "ăn xỉu 4m",
        "ĂN XỈU 4M",
        "ăn xỉu 5m",
        "ĂN XỈU 5M",
        "ăn xỉu 10m",
        "ĂN XỈU 10M",
        "chết mẹ tay xỉu",
        "CHẾT MẸ TAY XỈU",
        "bú xỉu 100k",
        "BÚ XỈU 100K",
        "lại xỉu rồi ",
        "BÚ XỈU 200K",
        "bu 200 xiu cac o oi",
        "ơ xỉu kìa ",
        "BÚ XỈU 300K",
        "chen 200 xiu ae oi",
        "xỉu đẹp",
        "BÚ XỈU 500K",
        "LƯỢM XỈU 1M",
        "an 200 xiu cac bac oi",
        "má nó lại xỉu ",
        "LƯỢM XỈU 2M",
        "lum 200 xiu kia",
        "xỉu rồi ae ơi",
        "LƯỢM XỈU 3M",
        "bú xỉu ngon k",
        "LƯỢM XỈU 5M",
        "xỉu hợp lý",
        "má xỉu đẹp",
        "HÚP XỈU 1M",
        "HÚP XỈU 2M",
        "HÚP XỈU 5M",
        "HÚP XỈU 500K",
        "húp xỉu...",
        "XỈU RỒI",
        "lại xỉu rồi ",
        "ơ xỉu kìa ",
        "HÚP XỈU 200K",
        "xỉu đẹp",
        "HÚP XỈU 500K",
        "bú xỉu 200k",
        "LẠI XỈU RỒI ",
        "bú xỉu 300k",
        "Ơ XỈU KÌA ",
        "bú xỉu 500k",
        "XỈU ĐẸP",
        "lượm xỉu 1m",
        "lượm xỉu 2m",
        "MÁ NÓ LẠI XỈU ",
        "lượm xỉu 3m",
        "XỈU RỒI AE ƠI",
        "lượm xỉu 5m",
        "BÚ XỈU NGON K",
        "XỈU HỢP LÝ",
        "húp xỉu 1m",
        "MÁ XỈU ĐẸP",
        "húp xỉu 2m",
        "húp xỉu 5m",
        "húp xỉu 500k",
        "BÚ XỈU HỢP LÝ",
        "HÚP XỈU..",
        "xỉu rồi",
        "TẤT TAY XỈU",
        "húp xỉu 100k",
        "LẠI XỈU RỒI ",
        "húp xỉu 200k",
        "Ơ XỈU KÌA ",
        "húp xỉu 500k",
        "XỈU ĐẸP",
        "má nó lại xỉu ",
        "MÁ NÓ LẠI XỈU",
        "xỉu rồi ae ơi",
        "XỈU RỒI AE ƠI",
        "bú xỉu ngon k",
        "BÚ XỈU NGON K",
        "xỉu hợp lý",
        "XỈU HỢP LÝ",
        "má xỉu đẹp",
        "MÁ XỈU ĐẸP",
        "bú xỉu hợp lý",
        "BÚ XỈU HỢP LÝ",
        "húp xỉu...",
        "HÚP XỈU...",
        "dã chuẩn xỉu",
        "DÃ CHUẨN XỈU",
        "HÚP XỈU",
        "Huppppppppp xiu",
        "đâm xỉu nhé ae",
        "xiu duoc luon?",
        "Ma no ra xiu duoc",
        "XỈU NÀY CÁC ÔNG",
        "xiu roi toang vl.",
        "Ma toang vi xiu ",
        "bú xỉu",
        "Ma xiu cay that ",
        "sinh nhật xỉu",
        "SINH NHẬT XỈU",
        "Liem xiu 5m",
        "ko xỉu thì sao",
        "KO XỈU THÌ SAO",
        "Liem xiu 3m",
        "chuẩn xỉu...",
        "CHUẨN XỈU...",
        "Liem xiu 2m",
        "Liem xiu 1m",
        "Liem xiu 500k",
        "Liem xiu 300k",
        "Liem xiu 200k",
        "Liem xiu 100k",
        "xiu bu 5m",
        "XỈU CỦA CÁC ÔNG ĐÓ...",
        "xiu bu 3m",
        "xiu bu 2m",
        "xiu bu 1m",
        "xiu bu 500k",
        "xiu bu 300k",
        "xiu bu 200k",
        "húp xỉu",
        "xiu bu 100k",
        "Chuan xiu Hup 5m",
        "chuẩn xỉu khỏi nghĩ",
        "Chuan xiu Hup 3m",
        "Chuan xiu Hup 2m",
        "bụp mạnh xỉu vào",
        "CẦN LẮM XỈU XỈU",
        "Chuan xiu Hup 1m",
        "THEO TÔI PHANG XỈU",
        "Chuan xiu Hup 500k",
        "Chuan xiu Hup 300k",
        "Chuan xiu Hup 200k",
        "Chuan xiu Hup 100k",
        "Tuyet voi xiu ",
        "BÚ XỈU",
        "Chuan xiu chua cac ong",
        "húp xỉu",
        "HÚP XỈU",
        "xiu chuan chua cac bo",
        "xiu Ngot nhu nuoc lo",
        "Chuan me xiu ",
        "xiu thom qua ",
        "Liem",
        "Hup",
        "Bu",
        "xiu a.... Ngon",
        "Tay xiu qua chuan",
        "Ve bo nho tay xiu",
        "xiu hup ngot ",
        "Ma chuan xiu ",
        "Ra xiu thom qua ad",
        "An tieng xiu tinh nguoi",
        "Ra xiu toang han",
        "Dcu xiu luon?",
        "xiu thom that",
        "Hup xiu!!!",
        "Dcu lai xiu a.",
        "Ma may lai xiu",
        "Ra xiu thi toi cmnr...",
        "Theo bon may vao xiu toang vl!!!",
        "xiu lon xiu lam",
        "xiu nam xiu lon ",
        "xiu cc gi lam ",
        "Deo tin noi la xiu",
        "Dm xiu cc",
        "Bay Cu cai nha sau tay xiu",
        "dm AD cho xa bo sau tieng xiu roi ",
        "Ma xiu ngu lon ",
        "nhẹ nhàng ăn 1m xỉu",
        "NHẸ NHÀNG ĂN 1M XỈU",
        "Ma may xiu luon duoc",
        "húp 2m xỉu ngọt vl",
        "HÚP 2M XỈU NGỌT VL",
        "Chet tuoi vi tieng xiu r",
        "MÁ XỈU NGON V",
        "FAN XỈU GIƠ TAY",
        "Nhoc lon voi tieng xiu",
        "XỈU TƯỞNG TRẢ LẠI ĂN",
        "xiu thom qua ad",
        "CHỈ THÍCH NẶN XỈU AE À",
        "lụm 300 xỉu kìa",
        "NAY TOÀN ĂN XỈU VỀ BỜ",
        "bo may chet vi tieng xiu roi ",
        "BỤP 2M XỈU NGỌT THẬT",
        "Dkm ad lai xiu ",
        "Ma no xiu luon duoc",
        "Dcu ad the ma ra xiu",
        "xiu sao no lai ra xiu duoc?",
        "LOL xiu that kia",
        "xiu Dep vlon ",
        "xiu chuan luon ad",
        "xiu dep vay",
        "Lay duoc con xe sau tieng xiu",
        "Ra xiu thom luon",
        "Ra xiu xa bo cmnr!!!",
        "May no ve xiu ve Bo",
        "Ve xiu that luon",
        "Oang xiu...",
        "xiu dep that ",
        "Ma no xiu roi ",
        "Chuan xiu",
        "Ong may keu ra xiu ma",
        "Chuan xiu",
        "má xỉu ngon v",
        "xiu Chuan luon",
        "fan xỉu giơ tay",
        "Da bao xiu ma ",
        "xỉu tưởng trả lại ăn",
        "Chuan xiu luon",
        "chỉ thích nặn xỉu ae à",
        "Ko nghe tao keu xiu a",
        "nay toàn ăn xỉu về bờ",
        "tao bao xiu roi ",
        "bụp 2m xỉu ngọt thật",
        "Bo may da bao xiu ma",
        "chuan xiu...",
        "tao bảo xỉu rồi ",
        "TAO BẢO XỈU RỒI ",
        "ko xiu thi sao",
        "Ko nghe tao kêu xỉu à",
        "KO NGHE TAO KÊU XỈU À",
        "sinh nhat xiu",
        "Chuẩn xỉu luôn",
        "CHUẨN XỈU LUÔN",
        "Đã bảo xỉu mà ",
        "ĐÃ BẢO XỈU MÀ ",
        "xỉu Chuẩn luôn",
        "XỈU CHUẨN LUÔN",
        "Chuẩn xỉu",
        "CHUẨN XỈU",
        "Ông mày kêu ra xỉu mà",
        "ÔNG MÀY KÊU RA XỈU MÀ",
        "Chuẩn xỉu",
        "CHUẨN XỈU",
        "xỉu thơm thật",
        "MÁ NÓ XỈU RỒI ",
        "Dcu xỉu luôn?",
        "XỈU ĐẸP THẬT ",
        "Ra xỉu toang hẳn",
        "OẲNG XỈU...",
        "Ăn tiếng xỉu tỉnh người",
        "VỀ XỈU THẬT LUÔN",
        "Ra xỉu thơm quá ad",
        "MAY NÓ VỀ XỈU VỀ BỜ",
        "Má chuẩn xỉu ",
        "RA XỈU XA BỜ CMNR!!!",
        "hup xiu",
        "xỉu húp ngọt ",
        "xiu dep nay hup di",
        "xỉu Ngon luôn",
        "RA XỈU THƠM LUÔN",
        "Về bờ nhờ tay xỉu",
        "LẤY ĐƯỢC CON XE SAU TIẾNG XỈU",
        "XỈU ĐẸP VẬY",
        "Bạc kết chuẩn xỉu ",
        "XỈU CHUẨN LUÔN AD",
        "xỉu à.... Ngon",
        "RA XỈU LÀ ỔN RỒI ",
        "ko xiu cua buoi",
        "Bú",
        "XỈU ĐẸP VLON",
        "Húp",
        "LOL XỈU THẬT KÌA",
        "Liếm",
        "TẠI SAO NÓ LẠI RA XỈU ĐƯỢC?",
        "ko xiu toang han",
        "xỉu thơm quá ",
        "DCU AD THẾ MÀ RA XỈU",
        "xiu manh me len",
        "Chuẩn mẹ xỉu ",
        "MÁ NÓ XỈU LUÔN ĐƯỢC",
        "xỉu Ngọt như nước lờ",
        "DKM AD LẠI XỈU ",
        "me no k xiu ra dao",
        "xỉu chuẩn chưa các bố",
        "BỐ MÀY CHẾT VÌ TIẾNG XỈU RỒI ",
        "Chuẩn xỉu chưa các ông",
        "BÚ XỈU THƠM",
        "Tuyệt vời xỉu ",
        "XỈU THƠM QUÁ AD",
        "Chuẩn xỉu Húp 100k",
        "NHỌC LỒN VỚI TIẾNG XỈU ",
        "da chuan xiu",
        "Chuẩn xỉu Húp 200k",
        "TẤT TAY XỈU LẠI BÚ ",
        "tat tay xiu",
        "Liếm xỉu 300k",
        "CHẾT TƯƠI VÌ TIẾNG XỈU R",
        "hup xiu...",
        "Liếm xỉu 500k",
        "MÁ MÀY XỈU LUÔN ĐƯỢC",
        "Liếm xỉu 1m",
        "MÁ XỈU NGU LỒN ",
        "Liếm xỉu 2m",
        "ĐM AD CHO XA BỜ SAU TIẾNG XỈU RỒI ",
        "Bay Cụ cái nhà sau tay xỉu",
        "BAY CỤ CÁI NHÀ SAU TAY XỈU",
        "ma xiu dep",
        "Đm xỉu cc",
        "ĐM XỈU CC",
        "xiu hop ly",
        "Đéo tin nổi là xỉu",
        "ĐÉO TIN NỔI LÀ XỈU",
        "xiu chac",
        "xỉu cc gì lắm ",
        "XỈU CC GÌ LẮM ",
        "bu xiu ngon k",
        "xỉu nằm xỉu lốn ",
        "XỈU NẰM XỈU LỐN ",
        "xiu roi ae oi",
        "xỉu lồn xỉu lắm",
        "XỈU LỒN XỈU LẮM",
        "ma no lai xiu ",
        "Theo bọn mày vào xỉu toang vl!!!",
        "THEO BỌN MÀY VÀO XỈU TOANG VL!!!",
        "Ra xỉu thì toi cmnr...",
        "RA XỈU THÌ TOI CMNR...",
        "xiu dep",
        "Má mày lại xỉu",
        "MÁ MÀY LẠI XỈU",
        "o xiu kia ",
        "Dcu lại xỉu à.",
        "DCU LẠI XỈU À.",
        "lai xiu roi ",
        "Húp xỉu!!!",
        "HÚP XỈU!!!",
        "tat tay xiu",
        "Má nó xỉu rồi ",
        "XỈU THƠM THẬT",
        "hup xiu...",
        "xỉu đẹp thật ",
        "DCU XỈU LUÔN?",
        "bu xiu hop ly",
        "Oẳng xỉu...",
        "RA XỈU TOANG HẲN",
        "Về xỉu thật luôn",
        "ĂN TIẾNG XỈU TỈNH NGƯỜI",
        "ra xiu chac",
        "May nó về xỉu về Bờ",
        "RA XỈU THƠM QUÁ AD",
        "ma xiu dep",
        "Ra xỉu xa bờ cmnr!!!",
        "MÁ CHUẨN XỈU ",
        "xiu hop ly ",
        "XỈU HÚP NGỌT ",
        "xiu chac",
        "Ra xỉu thơm luôn",
        "XỈU NGON LUÔN",
        "bu xiu ngon k",
        "Lấy được con xe sau tiếng xỉu",
        "VỀ BỜ NHỜ TAY XỈU",
        "xiu roi ae oi",
        "xỉu đẹp vậy",
        "TAY XIU QUÁ CHUẨN",
        "ma no lai xiu ",
        "xỉu chuẩn luôn ad",
        "BẠC KẾT CHUẨN XỈU ",
        "XỈU À.... NGON",
        "xiu dep",
        "xỉu Đẹp vlon",
        "BÚ",
        "o xiu kia ",
        "LOL xỉu thật kìa",
        "HÚP",
        "lai xiu roi ",
        "Tại sao nó lại ra xỉu được?",
        "LIẾM",
        "hup xiu 500k",
        "Dcu ad thế mà ra xỉu",
        "XỈU THƠM QUÁ ",
        "hup xiu 200k",
        "Má nó xỉu luôn được",
        "CHUẨN MẸ XỈU ",
        "hup xiu 100k",
        "Dkm ad lại xỉu ",
        "XỈU NGỌT NHƯ NƯỚC LỜ",
        "xiu roi",
        "bố mày chết vì tiếng xỉu rồi ",
        "XỈU CHUẨN CHƯA CÁC BỐ",
        "hup nhe xiu",
        "bú xỉu thơm",
        "CHUẨN XỈU CHƯA CÁC ÔNG",
        "hup xiu 500k",
        "xỉu thơm quá ad",
        "TUYỆT VỜI XỈU ",
        "hup xiu 5m",
        "Nhọc lồn với tiếng xỉu ",
        "CHUẨN XỈU HÚP 100K",
        "hup xiu 2m",
        "Tất tay xỉu lại bú ",
        "CHUẨN XỈU HÚP 200K",
        "hup xiu 1m",
        "Chết tươi vì tiếng xỉu r",
        "CHUẨN XỈU HÚP 300K",
        "Má mày xỉu luôn được",
        "CHUẨN XỈU HÚP 500K",
        "gap doi xiu",
        "Má xỉu ngu lồn ",
        "CHUẨN XỈU HÚP 1M",
        "luom xiu 5m",
        "đm AD cho xa bờ sau tiếng xỉu rồi ",
        "CHUẨN XỈU HÚP 2M",
        "luom xiu 3m",
        "Liếm xỉu 3m",
        "CHUẨN XỈU HÚP 3M",
        "luom xiu 2m",
        "Liếm xỉu 5m",
        "CHUẨN XỈU HÚP 5M",
        "luom xiu 1m",
        "Má xỉu cay thật ",
        "XỈU BÚ 100K",
        "bu xiu 500k",
        "Đcụ nhà ad cho ra xỉu",
        "XỈU BÚ 200K",
        "bu xiu 300k",
        "Má toang vì xỉu ",
        "XỈU BÚ 300K",
        "bu xiu 200k",
        "xỉu rồi toang vl.",
        "XỈU BÚ 500K",
        "bu xiu 100k",
        "Má nó ra xỉu được",
        "XỈU BÚ 1M",
        "chet me tay xiu",
        "xỉu được luôn?",
        "XỈU BÚ 2M",
        "Huppppppppp xỉu",
        "XỈU BÚ 3M",
        "an xiu 10m",
        "xỉu bú 5m",
        "XỈU BÚ 5M",
        "an xiu 5m",
        "Liếm xỉu 100k",
        "LIẾM XỈU 100K",
        "an xiu 4m",
        "Liếm xỉu 200k",
        "LIẾM XỈU 200K",
        "an xiu 3m",
        "Chuẩn xỉu Húp 300k",
        "LIẾM XỈU 300K",
        "an xiu 2m",
        "Chuẩn xỉu Húp 500k",
        "LIẾM XỈU 500K",
        "an xiu 1m",
        "Chuẩn xỉu Húp 1m",
        "LIẾM XỈU 1M",
        "100% xiu",
        "Chuẩn xỉu Húp 2m",
        "LIẾM XỈU 2M",
        "luom xiu",
        "Chuẩn xỉu Húp 3m",
        "LIẾM XỈU 3M",
        "bu xiu",
        "Chuẩn xỉu Húp 5m",
        "LIẾM XỈU 5M",
        "hup xiu",
        "xỉu bú 100k",
        "MÁ XỈU CAY THẬT ",
        "xiu dep",
        "xỉu bú 200k",
        "ĐCỤ NHÀ AD CHO RA XỈU",
        "xiu dep luon",
        "xỉu bú 300k",
        "MÁ TOANG VÌ XỈU ",
        "xiu hup",
        "xỉu bú 500k",
        "XỈU RỒI TOANG VL.",
        "da bao xiu ma",
        "xỉu bú 1m",
        "MÁ NÓ RA XỈU ĐƯỢC",
        "xiu luom",
        "xỉu bú 2m",
        "XỈU ĐƯỢC LUÔN?",
        "xiu bu",
        "xỉu bú 3m",
        "HUPPPPPPPPP XỈU",
    ];

    var chatMessageTai = ["hup 3l tai ",
        "tài bú",
        "TÀI BÚ",
        "chen tai 500k",
        "tài lượm",
        "TÀI LƯỢM",
        "đã bảo tài mà",
        "ĐÃ BẢO TÀI MÀ",
        "hup 2m tai ngot vl",
        "tài húp",
        "TÀI HÚP",
        "ma tai ngon v",
        "tài đẹp luôn",
        "TÀI ĐẸP LUÔN",
        "fan tai gio tay",
        "tài đẹp",
        "TÀI ĐẸP",
        "tai tuong tra lai an",
        "húp tài",
        "HÚP TÀI",
        "chi thich nan tai ae a",
        "bú tài",
        "BÚ TÀI",
        "nay toan an tai ve bo",
        "lượm tài",
        "LƯỢM TÀI",
        "bup 2m tai ngot that",
        "ăn tài 1m",
        "ĂN TÀI 1M",
        "ăn tài 2m",
        "ĂN TÀI 2M",
        "ăn tài 3m",
        "ĂN TÀI 3M",
        "ăn tài 4m",
        "ĂN TÀI 4M",
        "ăn tài 5m",
        "ĂN TÀI 5M",
        "ăn tài 10m",
        "ĂN TÀI 10M",
        "chết mẹ tay tài",
        "CHẾT MẸ TAY TÀI",
        "bú tài 100k",
        "BÚ TÀI 100K",
        "lại tài rồi ",
        "BÚ TÀI 200K",
        "bu 200 tai cac o oi",
        "ơ tài kìa ",
        "BÚ TÀI 300K",
        "chen 200 tai ae oi",
        "tài đẹp",
        "BÚ TÀI 500K",
        "LƯỢM TÀI 1M",
        "an 200 tai cac bac oi",
        "má nó lại tài ",
        "LƯỢM TÀI 2M",
        "lum 200 tai kia",
        "tài rồi ae ơi",
        "LƯỢM TÀI 3M",
        "bú tài ngon k",
        "LƯỢM TÀI 5M",
        "tài hợp lý",
        "má tài đẹp",
        "HÚP TÀI 1M",
        "HÚP TÀI 2M",
        "HÚP TÀI 5M",
        "HÚP TÀI 500K",
        "húp tài...",
        "TÀI RỒI",
        "lại tài rồi ",
        "ơ tài kìa ",
        "HÚP TÀI 200K",
        "tài đẹp",
        "HÚP TÀI 500K",
        "bú tài 200k",
        "LẠI TÀI RỒI ",
        "bú tài 300k",
        "Ơ TÀI KÌA ",
        "bú tài 500k",
        "TÀI ĐẸP",
        "lượm tài 1m",
        "lượm tài 2m",
        "MÁ NÓ LẠI TÀI ",
        "lượm tài 3m",
        "TÀI RỒI AE ƠI",
        "lượm tài 5m",
        "BÚ TÀI NGON K",
        "TÀI HỢP LÝ",
        "húp tài 1m",
        "MÁ TÀI ĐẸP",
        "húp tài 2m",
        "húp tài 5m",
        "húp tài 500k",
        "BÚ TÀI HỢP LÝ",
        "HÚP TÀI..",
        "tài rồi",
        "TẤT TAY TÀI",
        "húp tài 100k",
        "LẠI TÀI RỒI ",
        "húp tài 200k",
        "Ơ TÀI KÌA ",
        "húp tài 500k",
        "TÀI ĐẸP",
        "má nó lại tài ",
        "MÁ NÓ LẠI TÀI",
        "tài rồi ae ơi",
        "TÀI RỒI AE ƠI",
        "bú tài ngon k",
        "BÚ TÀI NGON K",
        "tài hợp lý",
        "TÀI HỢP LÝ",
        "má tài đẹp",
        "MÁ TÀI ĐẸP",
        "bú tài hợp lý",
        "BÚ TÀI HỢP LÝ",
        "húp tài...",
        "HÚP TÀI...",
        "dã chuẩn tài",
        "DÃ CHUẨN TÀI",
        "HÚP TÀI",
        "Huppppppppp tai",
        "đâm tài nhé ae",
        "tai duoc luon?",
        "Ma no ra tai duoc",
        "TÀI NÀY CÁC ÔNG",
        "tai roi toang vl.",
        "Ma toang vi tai ",
        "bú tài",
        "Ma tai cay that ",
        "sinh nhật tài",
        "SINH NHẬT TÀI",
        "Liem tai 5m",
        "ko tài thì sao",
        "KO TÀI THÌ SAO",
        "Liem tai 3m",
        "chuẩn tài...",
        "CHUẨN TÀI...",
        "Liem tai 2m",
        "Liem tai 1m",
        "Liem tai 500k",
        "Liem tai 300k",
        "Liem tai 200k",
        "Liem tai 100k",
        "tai bu 5m",
        "TÀI CỦA CÁC ÔNG ĐÓ...",
        "tai bu 3m",
        "tai bu 2m",
        "tai bu 1m",
        "tai bu 500k",
        "tai bu 300k",
        "tai bu 200k",
        "húp tài",
        "tai bu 100k",
        "Chuan tai Hup 5m",
        "chuẩn tài khỏi nghĩ",
        "Chuan tai Hup 3m",
        "Chuan tai Hup 2m",
        "bụp mạnh tài vào",
        "CẦN LẮM TÀI TÀI",
        "Chuan tai Hup 1m",
        "THEO TÔI PHANG TÀI",
        "Chuan tai Hup 500k",
        "Chuan tai Hup 300k",
        "Chuan tai Hup 200k",
        "Chuan tai Hup 100k",
        "Tuyet voi tai ",
        "BÚ TÀI",
        "Chuan tai chua cac ong",
        "húp tài",
        "HÚP TÀI",
        "tai chuan chua cac bo",
        "tai Ngot nhu nuoc lo",
        "Chuan me tai ",
        "tai thom qua ",
        "Liem",
        "Hup",
        "Bu",
        "tai a.... Ngon",
        "Tay tai qua chuan",
        "Ve bo nho tay tai",
        "tai hup ngot ",
        "Ma chuan tai ",
        "Ra tai thom qua ad",
        "An tieng tai tinh nguoi",
        "Ra tai toang han",
        "Dcu tai luon?",
        "tai thom that",
        "Hup tai!!!",
        "Dcu lai tai a.",
        "Ma may lai tai",
        "Ra tai thi toi cmnr...",
        "Theo bon may vao tai toang vl!!!",
        "tai lon tai lam",
        "tai nam tai lon ",
        "tai cc gi lam ",
        "Deo tin noi la tai",
        "Dm tai cc",
        "Bay Cu cai nha sau tay tai",
        "dm AD cho xa bo sau tieng tai roi ",
        "Ma tai ngu lon ",
        "nhẹ nhàng ăn 1m tài",
        "NHẸ NHÀNG ĂN 1M TÀI",
        "Ma may tai luon duoc",
        "húp 2m tài ngọt vl",
        "HÚP 2M TÀI NGỌT VL",
        "Chet tuoi vi tieng tai r",
        "MÁ TÀI NGON V",
        "FAN TÀI GIƠ TAY",
        "Nhoc lon voi tieng tai",
        "TÀI TƯỞNG TRẢ LẠI ĂN",
        "tai thom qua ad",
        "CHỈ THÍCH NẶN TÀI AE À",
        "lụm 300 tài kìa",
        "NAY TOÀN ĂN TÀI VỀ BỜ",
        "bo may chet vi tieng tai roi ",
        "BỤP 2M TÀI NGỌT THẬT",
        "Dkm ad lai tai ",
        "Ma no tai luon duoc",
        "Dcu ad the ma ra tai",
        "Tai sao no lai ra tai duoc?",
        "LOL tai that kia",
        "tai Dep vlon ",
        "tai chuan luon ad",
        "tai dep vay",
        "Lay duoc con xe sau tieng tai",
        "Ra tai thom luon",
        "Ra tai xa bo cmnr!!!",
        "May no ve tai ve Bo",
        "Ve tai that luon",
        "Oang tai...",
        "tai dep that ",
        "Ma no tai roi ",
        "Chuan tai",
        "Ong may keu ra tai ma",
        "Chuan tai",
        "má tài ngon v",
        "tai Chuan luon",
        "fan tài giơ tay",
        "Da bao tai ma ",
        "tài tưởng trả lại ăn",
        "Chuan tai luon",
        "chỉ thích nặn tài ae à",
        "Ko nghe tao keu tai a",
        "nay toàn ăn tài về bờ",
        "tao bao tai roi ",
        "bụp 2m tài ngọt thật",
        "Bo may da bao tai ma",
        "chuan tai...",
        "tao bảo tài rồi ",
        "TAO BẢO TÀI RỒI ",
        "ko tai thi sao",
        "Ko nghe tao kêu tài à",
        "KO NGHE TAO KÊU TÀI À",
        "sinh nhat tai",
        "Chuẩn tài luôn",
        "CHUẨN TÀI LUÔN",
        "Đã bảo tài mà ",
        "ĐÃ BẢO TÀI MÀ ",
        "tài Chuẩn luôn",
        "TÀI CHUẨN LUÔN",
        "Chuẩn tài",
        "CHUẨN TÀI",
        "Ông mày kêu ra tài mà",
        "ÔNG MÀY KÊU RA TÀI MÀ",
        "Chuẩn tài",
        "CHUẨN TÀI",
        "tài thơm thật",
        "MÁ NÓ TÀI RỒI ",
        "Dcu tài luôn?",
        "TÀI ĐẸP THẬT ",
        "Ra tài toang hẳn",
        "OẲNG TÀI...",
        "Ăn tiếng tài tỉnh người",
        "VỀ TÀI THẬT LUÔN",
        "Ra tài thơm quá ad",
        "MAY NÓ VỀ TÀI VỀ BỜ",
        "Má chuẩn tài ",
        "RA TÀI XA BỜ CMNR!!!",
        "hup tai",
        "tài húp ngọt ",
        "tai dep nay hup di",
        "tài Ngon luôn",
        "RA TÀI THƠM LUÔN",
        "Về bờ nhờ tay tài",
        "LẤY ĐƯỢC CON XE SAU TIẾNG TÀI",
        "TÀI ĐẸP VẬY",
        "Bạc kết chuẩn tài ",
        "TÀI CHUẨN LUÔN AD",
        "tài à.... Ngon",
        "RA TÀI LÀ ỔN RỒI ",
        "ko tai cua buoi",
        "Bú",
        "TÀI ĐẸP VLON",
        "Húp",
        "LOL TÀI THẬT KÌA",
        "Liếm",
        "TẠI SAO NÓ LẠI RA TÀI ĐƯỢC?",
        "ko tai toang han",
        "tài thơm quá ",
        "DCU AD THẾ MÀ RA TÀI",
        "tai manh me len",
        "Chuẩn mẹ tài ",
        "MÁ NÓ TÀI LUÔN ĐƯỢC",
        "tài Ngọt như nước lờ",
        "DKM AD LẠI TÀI ",
        "me no k tai ra dao",
        "tài chuẩn chưa các bố",
        "BỐ MÀY CHẾT VÌ TIẾNG TÀI RỒI ",
        "Chuẩn tài chưa các ông",
        "BÚ TÀI THƠM",
        "Tuyệt vời tài ",
        "TÀI THƠM QUÁ AD",
        "Chuẩn tài Húp 100k",
        "NHỌC LỒN VỚI TIẾNG TÀI ",
        "da chuan tai",
        "Chuẩn tài Húp 200k",
        "TẤT TAY TÀI LẠI BÚ ",
        "tat tay tai",
        "Liếm tài 300k",
        "CHẾT TƯƠI VÌ TIẾNG TÀI R",
        "hup tai...",
        "Liếm tài 500k",
        "MÁ MÀY TÀI LUÔN ĐƯỢC",
        "Liếm tài 1m",
        "MÁ TÀI NGU LỒN ",
        "Liếm tài 2m",
        "ĐM AD CHO XA BỜ SAU TIẾNG TÀI RỒI ",
        "Bay Cụ cái nhà sau tay tài",
        "BAY CỤ CÁI NHÀ SAU TAY TÀI",
        "ma tai dep",
        "Đm tài cc",
        "ĐM TÀI CC",
        "tai hop ly",
        "Đéo tin nổi là tài",
        "ĐÉO TIN NỔI LÀ TÀI",
        "tai chac",
        "tài cc gì lắm ",
        "TÀI CC GÌ LẮM ",
        "bu tai ngon k",
        "tài nằm tài lốn ",
        "TÀI NẰM TÀI LỐN ",
        "tai roi ae oi",
        "tài lồn tài lắm",
        "TÀI LỒN TÀI LẮM",
        "ma no lai tai ",
        "Theo bọn mày vào tài toang vl!!!",
        "THEO BỌN MÀY VÀO TÀI TOANG VL!!!",
        "Ra tài thì toi cmnr...",
        "RA TÀI THÌ TOI CMNR...",
        "tai dep",
        "Má mày lại tài",
        "MÁ MÀY LẠI TÀI",
        "o tai kia ",
        "Dcu lại tài à.",
        "DCU LẠI TÀI À.",
        "lai tai roi ",
        "Húp tài!!!",
        "HÚP TÀI!!!",
        "tat tay tai",
        "Má nó tài rồi ",
        "TÀI THƠM THẬT",
        "hup tai...",
        "tài đẹp thật ",
        "DCU TÀI LUÔN?",
        "bu tai hop ly",
        "Oẳng tài...",
        "RA TÀI TOANG HẲN",
        "Về tài thật luôn",
        "ĂN TIẾNG TÀI TỈNH NGƯỜI",
        "ra tai chac",
        "May nó về tài về Bờ",
        "RA TÀI THƠM QUÁ AD",
        "ma tai dep",
        "Ra tài xa bờ cmnr!!!",
        "MÁ CHUẨN TÀI ",
        "tai hop ly ",
        "TÀI HÚP NGỌT ",
        "tai chac",
        "Ra tài thơm luôn",
        "TÀI NGON LUÔN",
        "bu tai ngon k",
        "Lấy được con xe sau tiếng tài",
        "VỀ BỜ NHỜ TAY TÀI",
        "tai roi ae oi",
        "tài đẹp vậy",
        "TAY XIU QUÁ CHUẨN",
        "ma no lai tai ",
        "tài chuẩn luôn ad",
        "BẠC KẾT CHUẨN TÀI ",
        "TÀI À.... NGON",
        "tai dep",
        "tài Đẹp vlon",
        "BÚ",
        "o tai kia ",
        "LOL tài thật kìa",
        "HÚP",
        "lai tai roi ",
        "Tại sao nó lại ra tài được?",
        "LIẾM",
        "hup tai 500k",
        "Dcu ad thế mà ra tài",
        "TÀI THƠM QUÁ ",
        "hup tai 200k",
        "Má nó tài luôn được",
        "CHUẨN MẸ TÀI ",
        "hup tai 100k",
        "Dkm ad lại tài ",
        "TÀI NGỌT NHƯ NƯỚC LỜ",
        "tai roi",
        "bố mày chết vì tiếng tài rồi ",
        "TÀI CHUẨN CHƯA CÁC BỐ",
        "hup nhe tai",
        "bú tài thơm",
        "CHUẨN TÀI CHƯA CÁC ÔNG",
        "hup tai 500k",
        "tài thơm quá ad",
        "TUYỆT VỜI TÀI ",
        "hup tai 5m",
        "Nhọc lồn với tiếng tài ",
        "CHUẨN TÀI HÚP 100K",
        "hup tai 2m",
        "Tất tay tài lại bú ",
        "CHUẨN TÀI HÚP 200K",
        "hup tai 1m",
        "Chết tươi vì tiếng tài r",
        "CHUẨN TÀI HÚP 300K",
        "Má mày tài luôn được",
        "CHUẨN TÀI HÚP 500K",
        "gap doi tai",
        "Má tài ngu lồn ",
        "CHUẨN TÀI HÚP 1M",
        "luom tai 5m",
        "đm AD cho xa bờ sau tiếng tài rồi ",
        "CHUẨN TÀI HÚP 2M",
        "luom tai 3m",
        "Liếm tài 3m",
        "CHUẨN TÀI HÚP 3M",
        "luom tai 2m",
        "Liếm tài 5m",
        "CHUẨN TÀI HÚP 5M",
        "luom tai 1m",
        "Má tài cay thật ",
        "TÀI BÚ 100K",
        "bu tai 500k",
        "Đcụ nhà ad cho ra tài",
        "TÀI BÚ 200K",
        "bu tai 300k",
        "Má toang vì tài ",
        "TÀI BÚ 300K",
        "bu tai 200k",
        "tài rồi toang vl.",
        "TÀI BÚ 500K",
        "bu tai 100k",
        "Má nó ra tài được",
        "TÀI BÚ 1M",
        "chet me tay tai",
        "tài được luôn?",
        "TÀI BÚ 2M",
        "Huppppppppp tài",
        "TÀI BÚ 3M",
        "an tai 10m",
        "tài bú 5m",
        "TÀI BÚ 5M",
        "an tai 5m",
        "Liếm tài 100k",
        "LIẾM TÀI 100K",
        "an tai 4m",
        "Liếm tài 200k",
        "LIẾM TÀI 200K",
        "an tai 3m",
        "Chuẩn tài Húp 300k",
        "LIẾM TÀI 300K",
        "an tai 2m",
        "Chuẩn tài Húp 500k",
        "LIẾM TÀI 500K",
        "an tai 1m",
        "Chuẩn tài Húp 1m",
        "LIẾM TÀI 1M",
        "100% tai",
        "Chuẩn tài Húp 2m",
        "LIẾM TÀI 2M",
        "luom tai",
        "Chuẩn tài Húp 3m",
        "LIẾM TÀI 3M",
        "bu tai",
        "Chuẩn tài Húp 5m",
        "LIẾM TÀI 5M",
        "hup tai",
        "tài bú 100k",
        "MÁ TÀI CAY THẬT ",
        "tai dep",
        "tài bú 200k",
        "ĐCỤ NHÀ AD CHO RA TÀI",
        "tai dep luon",
        "tài bú 300k",
        "MÁ TOANG VÌ TÀI ",
        "tai hup",
        "tài bú 500k",
        "TÀI RỒI TOANG VL.",
        "da bao tai ma",
        "tài bú 1m",
        "MÁ NÓ RA TÀI ĐƯỢC",
        "tai luom",
        "tài bú 2m",
        "TÀI ĐƯỢC LUÔN?",
        "tai bu",
        "tài bú 3m",
        "HUPPPPPPPPP TÀI",
    ];

</script>


<script type = "text/javascript">

// Let us open a web socket
 
var ws = null;

doconnect();

function doconnect(){
  try {
    ws = new WebSocket("<?php echo web_socket() ?>taixiukubet") // ket noi ws server
    // ws = new WebSocket("wss://oxy.club:/taixiu"); // ket noi ws server
  } catch (error) {
      doconnect();
  }
  ws.onclose = function() { 
     doconnect();
    //    alert("Connection is closed..."); 
    };
}

ws.onmessage = function (evt) {  // khi nhan message
   var received_msg = evt.data;
   var res = JSON.parse(received_msg);
   if("1"===(res["code"])){ // nhan theo event code  ex: 1 la update time 
    //    console.log(res);
   }else if("2"===(res["code"])){ // 2 la update listuser
     let arr = [];
     showMoney(res.reportResponses[0]);
     showCau(res.resultStats);
   }
};

ws.onclose = function() { 
    doconnect();
};
function showCau(result) {
    if(result) {
        const cau = result.split(",");

        const buildCau = `
        <div style="background: red; padding-left: 10px; padding-right: 10px">
            ${cau.map((item) => {
                if(item ==="T") {
                    return `<img src="<?php echo public_url('admin/images/icons/cau-tai.png') ?>"/>`;
                } else if(item ==="X") {
                    return `<img src="<?php echo public_url('admin/images/icons/cau-xiu.png') ?>"/>`;
                }
                return ""

            })}
        </div>
        `;
    $("#cau").html(buildCau.replaceAll(',', ''));
    }
}
function buildResult(obj) {
    const {dice1, dice2, dice3} = obj;
    if (dice1 && dice2 && dice3) {
        const result = `
        <div class="result-dice">
            <img src="<?php echo public_url() ?>/admin/crown/images/dice/${dice1}.png" >
            <img src="<?php echo public_url() ?>/admin/crown/images/dice/${dice2}.png" >
            <img src="<?php echo public_url() ?>/admin/crown/images/dice/${dice3}.png" >
        </div>
    `;
    $("#real_time").html(result);
    }
}
function showMoney(obj) {
    document.getElementById("tien_ca_bot_tai").innerText = commaSeparateNumber(obj.moneyTaiFull);
    //document.getElementById("moneyTaiFull").innerText = " | " + commaSeparateNumber(obj.moneyTaiFull);
    document.getElementById("tien_ca_bot_xiu").innerText = commaSeparateNumber(obj.moneyXiuFull);
	document.getElementById("tien_ca_bot_chan").innerText = commaSeparateNumber(obj.moneyChanFull);
	document.getElementById("tien_ca_bot_le").innerText = commaSeparateNumber(obj.moneyLeFull);
    //document.getElementById("moneyXiuFull").innerText = " | " + commaSeparateNumber(obj.moneyXiuFull);
    document.getElementById("phien_id").innerText = obj.phienId;
    // document.getElementById("total_money_phien").innerText = commaSeparateNumber(obj.moneyXiuFull + obj.moneyTaiFull);
    document.getElementById("number_user_real").innerText = obj.nguoiChoiBetTai + obj.nguoiChoiBetXiu;
    document.getElementById("number_user_chan").innerText = obj.numberUserAndBotBetChan;
    document.getElementById("number_user_le").innerText = obj.numberUserAndBotBetLe;
	document.getElementById("number_user_tai").innerText = obj.numberUserAndBotBetTai;
    document.getElementById("number_user_xiu").innerText = obj.numberUserAndBotBetXiu;
    if (obj.bettingRound) {
        $('#time_wait_new_round').hide();
        document.getElementById("real_time").innerText = obj.realTime;
        $('#tai').attr("src", "<?php echo public_url() ?>/admin/images/tai.png");
        $('#tai').attr("style", "scale: 1");
        $('#xiu').attr("src", "<?php echo public_url() ?>/admin/images/xiu.png");
        $('#xiu').attr("style", "scale: 1");
        $('#chan').attr("src", "<?php echo public_url() ?>/admin/images/chan.png");
        $('#chan').attr("style", "scale: 1");
        $('#le').attr("src", "<?php echo public_url() ?>/admin/images/le.png");
        $('#le').attr("style", "scale: 1");
    } else {
        $('#time_wait_new_round').show();
        if(obj.sessionResult == 'TAI') {
            $('#tai').attr("src", "<?php echo public_url() ?>/admin/crown/images/gif/TAI.gif");
            $('#tai').attr("style", "scale: 2");
        } else if(obj.sessionResult == 'XIU') {
            $('#xiu').attr("src", "<?php echo public_url() ?>/admin/crown/images/gif/XIU.gif");
            $('#xiu').attr("style", "scale: 2");
        } 
        if(obj.sessionResult == 'TAI' || obj.sessionResult == 'XIU') {
            chan_le = obj.dice1 + obj.dice2 + obj.dice3;
            if (chan_le % 2 == 0) {
                $('#chan').attr("src", "<?php echo public_url() ?>/admin/crown/images/gif/CHAN.gif");
                $('#chan').attr("style", "scale: 2");
            } else {
                $('#le').attr("src", "<?php echo public_url() ?>/admin/crown/images/gif/LE.gif");
                $('#le').attr("style", "scale: 2");
            }
        }
        buildResult(obj);
        becangtaixiu("auto"); //TODO testing
        showResultSetTX();
        document.getElementById("time_wait_new_round").innerText = obj.realTime;
    }
    rows = obj.contributors;
    setUserTaiXiuPlay(obj);
    setUserChanLePlay(obj);
    // showTienLoLai(obj);
    chatAndListUser(rows);
    loadMessage( obj.lstMsg);
}

function setUserTaiXiuPlay(obj) {
    document.getElementById("user_tai").innerText = commaSeparateNumber(obj.moneyTai.toString());
    document.getElementById("user_xiu").innerText = commaSeparateNumber(obj.moneyXiu.toString());
}

function setUserChanLePlay(obj) {
    document.getElementById("user_chan").innerText = commaSeparateNumber(obj.moneyChan.toString());
    document.getElementById("user_le").innerText = commaSeparateNumber(obj.moneyLe.toString());
}

function showTienLoLai(obj) {
    $totalTai = obj.moneyTai - obj.moneyXiu;
    $totalXiu = obj.moneyXiu - obj.moneyTai;
    document.getElementById("tien_lo_lai_xiu").innerText = commaSeparateNumber($totalTai);
    document.getElementById("tien_lo_lai_tai").innerText = commaSeparateNumber($totalXiu);
}

</script>

<style>
    .set-bot-xiu,
    .set-bot-same,
    .set-bot-tai {
        position: relative;
    }
    .set-bot-xiu>input,
    .set-bot-same>input,
    .set-bot-tai>input{
        width: 70px;
        padding: 3px;
        background-color: #2980b9;
    }
    .set-bot-checked>input.btn-primary:disabled:hover,
    .set-bot-checked>input.btn-primary:focus,
    .set-bot-checked>input {
        background-color: #f9fa55 !important; 
        color: black !important;
       
    }
    
    .padding-setbot {
        padding: 0px 40px 0px 40px
    }
    .result-dice {
        width: 100%;
        height: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        justify-content: center;
        padding: 15px;
    }
    .anyClass {
        height: 150px;
        overflow-y: scroll;
    }

    .message_inputField {
        margin-right: 4px;

    }
    #phien_id::before {
        content: '#'
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
        border-radius: 10px 10px 0 0;
        margin-left: 10px;
        padding: 15px;
        background-color: white;
    }

    .rightContainer {
        flex: 2;
        background-color: #4bcffa;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 10px;
    }

    .blockTop {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-bottom: 15px;
        border-radius: 10px;

    }
    .icon_tai {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(233 167 167 / 27%);
        text-align: center;
        border: solid red 3px;
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
    .column_flex{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px
    }
    .row_be_cang {
        display: flex;
        width: 100%;
        overflow: hidden;
        justify-content: space-around;
        text-align: center;
        border: solid rgb(246 198 12) 2px;
        background: black;
    }
    .row_list_user {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
    .row_list_user thead {
        background-color: #ffc801;
    }
    .row_list_user table {
        border: solid #ffc801 1px;
    }
    .row_list_user tbody {
        background-color: white;
    }
    .winning {
        background-image: url("<?php echo public_url('admin/images/txthuong.gif') ?>");
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: 65%;
        width: 100%;
    }
    .winning>img {
        animation: zoom-in-zoom-out 1s ease infinite;
    }
    @keyframes zoom-in-zoom-out {
        0% {
            transform: scale(1, 1);
        }
        50% {
            transform: scale(1.5, 1.5);
        }
        100% {
            transform: scale(1, 1);
        }
    }
    .tx-label {
        height: 60px;
        margin-bottom: 10px;
        z-index: 0;
    }
    .row_list_user>div {
        width: 100%;
    }
    .row_be_cang>input[type=radio] {
        scale: 2;
    }
    .time_pending_round {
        position: absolute;
        right: 5px;
        top: 5px;
        color: white;
        width: 25px;
        border-radius: 100%;
        background: red;
        height: 25px;
    }
    .blockTop .button:focus {
        background: #009b0c;
        color: #fff;
        border: none;
    }

    .blockTop .button {
        background: #5bc0defa;
        height: 36px;
        color: #fff;
    }

    .button {
        height: 32px;
        padding: 5px;
        border: #0E0E0E;
        border-radius: 5px;
    }

    .button:active {
        background: #45ffbf;
        color: #fff;
    }

    .button:hover {
        opacity: 0.8;
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
        height: 550px;
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

    .modal.in .modal-dialog {
        margin-top: 100px;
    }
    
   @media only screen and (max-width: 720px) {
        .kyTinhVcl {
            width: 100%;
        }
    } 
</style>