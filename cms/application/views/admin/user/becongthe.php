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
            <h6 style="color: #001f0f;">BẺ CỔNG THẺ</h6>
        </div>
        <h3><p id="resultAdd" style="color: #f00; text-align: center; position: absolute; left: 50%; top: 47px; transform: translate(-50%, 0);"></p></h3>
        <form class="list_filter form" action="" method="post">
            <div class="formRow">
                <table style='margin: 0 auto;'>
                    <tr>
                        <td>
						    <div class="radio-container">
								<input type="radio" id="vivu" name="congthe" value="1">
								<label for="vivu">VIVU</label>
								<input type="radio" id="tokyo" name="congthe" value="2">
								<label for="tokyo">TOKYO</label>
                                <input type="radio" id="nammuoi" name="congthe" value="3">
                                <label for="nammuoi">50/50 (VIVU/TOKYO)</label>
							</div>
                            
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
	  background-color: #099100;
	  display: inline-block;
	  border: 2px solid #099100;
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
	  background-color: white;
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
        getCongTheActive();
    });

    $("input[type='radio'][name='congthe']").change(function() {
		var congthe = $("input[type='radio'][name='congthe']:checked").val();
        console.log(congthe);
        var textNote = congthe == '1' ? 'VIVU' : congthe == '2' ? 'TOKYO' : '50:50 (VIVU/TOKYO)';
        if(!confirm("Bạn có chắc chắn bẻ sang cổng " + textNote)){
            return false;
        }

        if(this.checked) {
            setCongThe(congthe,'update');
        }

        
    });

    function setCongThe(congthe, type) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/setcongtheajax") ?>",
            data: {
                congnap: congthe,
                type:type
            },
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                setTimeout(() => {
                    getCongTheActive();
                }, 3000);
            }
            ,error: function(){
                $("#spinner").hide();
                //$("#resultAdd").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                setTimeout(() => {
                    getCongTheActive();
                }, 3000);
            },
            timeout:3000
        });
        
    }

    function getCongTheActive() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/user/setcongtheajax") ?>",
            cache: true,
            dataType: 'json',
            success: function (result) {
                console.log(result+'Đang bẻ cổng này');
				if(result === 1) {
					$("#vivu").prop('checked', true);
                    $("#resultAdd").css({"color": "#00801b"});
                    $("#resultAdd").html("Đang bẻ về Cổng VIVU!");
				} else if (result === 2) {
					$("#tokyo").prop('checked', true);
                    $("#resultAdd").css({"color": "#00801b"});
                    $("#resultAdd").html("Đang bẻ về Cổng TOKYO!");
				}else {
                    $("#nammuoi").prop('checked', true);
                    $("#resultAdd").css({"color": "#00801b"});
                    $("#resultAdd").html("Đang bẻ về Cổng 50/50!");
                }
            }
            ,error: function(){
                $("#spinner").hide();
            },
            timeout:3000
        });
    }

</script>
