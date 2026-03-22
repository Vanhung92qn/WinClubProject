<html>

<head>
    <?php $this->load->view('admin/head')?>
</head>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
<script src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/jquery.dataTables.min.css">
<body class="main-body">
    <div id="page-header" class="bg-gradient-9">


        <div id="header-logo" class="logo-bg">
            <a href="<?php echo admin_url('/') ?>" class="sideProfile">
                <div title="" class="profileFace">
                    <img src="<?php echo public_url('admin') ?>/images/bg2.png" width="50">
                    <?php if (isset($admin_info)) : ?>
                        <span><strong id="adminUserName"><?php echo $admin_info->UserName; ?></strong></span>
                    <?php endif; ?>
                </div>
            </a>
        </div>
        
        <div id="header-nav-left">
        
            <div class="userNav">
                <ul>
                    <li class="iconmenu">
                        <a>
                            <img src="<?php echo public_url('admin/images/menuicon.png') ?>">
                        </a>
                    </li>
                    <li><a target="_blank" href="<?php echo base_url('admin')?>">
                            <img src="<?php echo public_url('admin')?>/images/icons/light/home.png">
                            <span>Trang chủ</span>
                        </a></li>

                    <!-- Logout -->
                    <li><a href="<?php echo admin_url('admin/logout')?>">
                            <img alt="" src="<?php echo public_url('admin')?>/images/icons/topnav/logout.png">
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- #header-nav-left -->
        <a data-toggle="modal" data-target="#exampleModal1" id="notification" style="width: 50px; position: absolute;right: 0;justify-content: center;" class="notification"></a>
       <!-- Modal -->
    </div>
    <div id="page-sidebar">
        <?php $this->load->view('admin/left')?>
    </div>

    <div id="page-content-wrapper">
        <div id="page-content">
            <?php  $this->load->view($temp, $this->data);?>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" >
            <div class="modal-dialog" style="right: 65px; width: 300px; position: absolute; top: 21px;">
                <div class="modal-content" style="background: #7cffaa;">
                    <div class="modal-header" style="font-size: 15px; text-align: center; font-weight: bold; color: #d05600;">THÔNG BÁO MỚI
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li class="modal-body__item" style="background: #218400;"><a href='<?php echo base_url('/admin/report/rechargebycodepay') ?>' target="_self" id="notification1" class="notification"><i class="fa fa-university"></i>Nạp Tiền ngân hàng!</a></li>
                            <!-- <li class="modal-body__item" style="background: #bea700;"><a href='<?php echo base_url('/admin/report/rechargebyonepay') ?>' target="_self" id="notification2" class="notification"><i class="fa fa-columns"></i>Nạp tiền 1 PAY!</a></li> -->
                            <li class="modal-body__item" style="background: #6e56f1;"><a href='<?php echo base_url('/admin/report/rechargebymomo2') ?>' target="_self" id="notification3" class="notification"><i class="fa fa-credit-card"></i>Nạp tiền momo</a></li>
                            <li class="modal-body__item" style="background: #2a2735;"><a href='<?php echo base_url('/admin/report/rechargebyautocard') ?>' target="_self" id="notification4" class="notification"><i class="fa fa-credit-card"></i>Nạp tiền Thẻ cào</a></li>
                            <!-- <li class="modal-body__item" style="background: #567e5f;"><a href='<?php echo base_url('/admin/report/rechargebyonepay') ?>' target="_self" id="notification5" class="notification"><i class="fa fa-free-code-camp"></i>Mã OTP</a></li> -->
                            <li class="modal-body__item" style="background: #ff51a2;"><a href='<?php echo base_url('/admin/report/cashoutbybank') ?>' target="_self" id="notification6" class="notification"><i class="fa fa-solar-system"></i>Rút tiền qua cổng ngân hàng!</a></li>
                            <li class="modal-body__item" style="background: #ca0054;"><a href='<?php echo base_url('/admin/report/cashoutbycardmanual') ?>' target="_self" id="notification7" class="notification"><i class="fa fa-solar-system"></i>Rút tiền thẻ cào!</a></li>
                        </ul>
                    </div>
  
                </div>
            </div>
        </div>
    <link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/admin/css/toasty.css">

    <script type="text/javascript" src="<?php echo public_url()?>/js/toasty.js?_rev=001" defer></script>
    
    <script type="text/javascript" src="<?php echo public_url()?>/js/prism.js" defer></script>

    <script type="text/javascript" src="<?php echo public_url()?>/js/script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/admin/css/prism.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #page-sidebar {
            transition: all 0.3s ease;
        }
        #page-sidebar.hide-sidebar {
            width: 0;
        }
        #page-content.expand {
            margin-left: 0;
        }
        .notification {
            height: inherit;
            color: #454545;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            margin-right: 50px;
        }

        #exampleModal1 .notification {
            margin-right: 0;
            justify-content: flex-start;
        }

        #exampleModal1 .notification::after {
            right: -6px;
            top: -7px;
        }

        #exampleModal1 .notification::before {
            position: absolute;
            right: 13px;
            font-size: 22px;
        }

        .notification::after {
            min-width: 20px;
            height: 20px;
            content: attr(data-count);
            background-color: #ee012a;
            font-family: monospace;
            font-weight: bolt;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: #fff;
            position: absolute;
            top: 5px;
            right: 0;
            transition: .3s;
            opacity: 0;
            transform: scale(.5);
            will-change: opacity, transform;
        }


        .notification.show-count::after {
        opacity: 1;
        transform: scale(1);
        }

        .notification::before {
            content: "\f0f3";
            font-family: "FontAwesome";
            display: block;
            font-size: 27px;
        }

        .notification.notify::before {
        animation: bell 1s ease-out;
        transform-origin: center top;
        }

        @keyframes bell {
            0% {transform: rotate(35deg);}
            12.5% {transform: rotate(-30deg);}
            25% {transform: rotate(25deg);}
            37.5% {transform: rotate(-20deg);}
            50% {transform: rotate(15deg);}
            62.5% {transform: rotate(-10deg)}
            75% {transform: rotate(5deg)}
            100% {transform: rotate(0);}  
        }

        .modal-body__item {
            padding: 15px 9px;
            background: #7dff52;
            border-radius: 8px;
            margin: 5px 0;
            box-shadow: 0 5px 15px rgb(14 255 228 / 50%);
        }

        .modal-body__item a {
            color: #fff;
            font-weight: bold;
            padding-right: 40px;
        }

        .modal-body__item a:hover {
            text-decoration: none;
        }

        .modal-body__item a i {
            font-size: 40px;
            margin-right: 5px;
        }

        .modal-body__item:hover {
            box-shadow: 0 5px 15px rgb(255 255 255 / 92%);
            opacity: 0.8;
        }
        
    
    </style>

     <script>
		
		var ex = [];
		/*
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbybank"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
				var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.rutTien('Yêu cầu rút tiền qua ngân hàng!');
				}
			};
			return itemSocket;
		}());
		*/
		
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebybank"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
				var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.bank('Nạp tiền ngân hàng!');
				}
				
			   
			};
			return itemSocket;
		}());
		
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebymomosunvin"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
				var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.momo('Nạp Tiền mo mo');
				}
			   
			};
			return itemSocket;
		}());
		
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyonepay"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
			var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.onepay('Nạp tiền 1 PAY!');
				}
			   
			};
			return itemSocket;
		}());
		
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyonepayotp"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test 2');
			};
			itemSocket.onmessage = function (evt) {
				var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.otp('Thông báo Mã OTP');
				}
			};
			return itemSocket;
		}());

        ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbymomosunvin"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
			var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.onepay('Rút tiền momo!');
				}
			};
			return itemSocket;
		}());

        ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbybank"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
			var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.onepay('Rút tiền qua bank!');
				}
			};
			return itemSocket;
		}());

		/*
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>cashoutbycardmanual"); // ket noi ws server
			itemSocket.onopen = function (event) {
				// itemSocket.send('This is a test');
			};
			itemSocket.onmessage = function (evt) {
				var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.rutTien('Yêu cầu rút tiền qua thẻ cào!');
				}
			};
			return itemSocket;
		}());
		ex.push(function(){
			var itemSocket = new WebSocket("<?php echo web_socket() ?>rechargebyautocard"); // ket noi ws server
			itemSocket.onopen = function (event) {
				
			};
			itemSocket.onmessage = function (evt) {
			var received_msg = evt.data;
				var res = JSON.parse(received_msg);
				if("2"===(res["code"])){
					toasty.theCao('Nạp tiền thẻ cào');
				}
			   
			};
			return itemSocket;
		}());
		
		*/
        $(document).ready(function (){
            $('.iconmenu').click(() => {
                $('#page-sidebar').toggleClass('hide-sidebar');
                $('#page-content').toggleClass('expand');
            })
        });
    </script>

</body>

</html>
