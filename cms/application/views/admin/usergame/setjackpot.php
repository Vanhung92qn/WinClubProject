<title>Set Nổ Hũ</title>
<div class="line"></div>
<?php if($role == false): ?>
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
        <script
            src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget">
            <div class="formRow" style="min-height: 577px;">
                <div class="row">
                    <div
                             style="color: #750b09;
                                font-weight: bold;
                                    ">
                         <h3 class="js-typejackpottitle"
                            style="color: #750b09;
                                text-align: center;
                                font-weight: bold;
                                font-size: 40px;
                                text-transform: uppercase;
                                    ">NỔ HŨ
                        </h3>
                        <div class="set_slot" style="width: 100%;
                                    display: grid;
                                    grid-template: auto / auto auto auto;
                                    grid-gap: 10px;
                                    border: 1px solid #900b01;
                                    border-radius: 5px;
                                    align-content: stretch;
                                    background: #ffffff73;
                                    padding: 30px 0;
                                    box-shadow: 0 0 0 1px rgb(0 16 14 / 3%), 0 8px 16px -4px rgb(135 33 18)
                        ">
                            <form class="list_filter form" style="border: 1px solid;" action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Fast & Furious</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="1" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" style="background-color: aqua" slot-id="1" type="button" value="SET"></div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="1" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="1" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem1" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input name="nickname" class="form-control" id="nickname1" placeholder="Nhập nick name" type="text" onblur="myFunction(1)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s1_100" name="typeMoney1" value="100">
                                        <label for="s1_100">100</label><br>
                                        <input type="radio" id="s1_1000" name="typeMoney1" value="1000">
                                        <label for="s1_1000">1000</label><br>
                                        <input type="radio" id="10000" name="typeMoney1" value="10000">
                                        <label for="s1_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname1" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="1" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Lady Night</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="2" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="2" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="2" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="2" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem2" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname2" placeholder="Nhập nick name" type="text" onblur="myFunction(2)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s2_100" name="typeMoney2" value="100">
                                         <label for="s2_100">100</label><br>
                                         <input type="radio" id="s2_1000" name="typeMoney2" value="1000">
                                         <label for="s2_1000">1000</label><br>
                                         <input type="radio" id="s2_10000" name="typeMoney2" value="10000">
                                         <label for="s2_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname2" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button"  name="sethu" slot-id="2" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Cao bồi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="3" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="3" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="3" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="3" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem3" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname3" placeholder="Nhập nick name" type="text" onblur="myFunction(3)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s3_100" name="typeMoney3" value="100">
                                         <label for="s3_100">100</label><br>
                                         <input type="radio" id="s3_1000" name="typeMoney3" value="1000">
                                         <label for="s3_1000">1000</label><br>
                                         <input type="radio" id="s3_10000" name="typeMoney3" value="10000">
                                         <label for="s3_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname3" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="3" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Liên Minh Huyền Thoại</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="4" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="4" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="4" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="4" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem4" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname4" placeholder="Nhập nick name" type="text" onblur="myFunction(4)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s4_100" name="typeMoney4" value="100">
                                         <label for="s4_100">100</label><br>
                                         <input type="radio" id="s4_1000" name="typeMoney4" value="1000">
                                         <label for="s4_1000">1000</label><br>
                                         <input type="radio" id="s4_10000" name="typeMoney4" value="10000">
                                         <label for="s4_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname4" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="4" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Halloween</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="5" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="5" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="5" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="5" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem5" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname5" placeholder="Nhập nick name" type="text" onblur="myFunction(5)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s5_100" name="typeMoney5" value="100">
                                         <label for="s5_100">100</label><br>
                                         <input type="radio" id="s5_1000" name="typeMoney5" value="1000">
                                         <label for="s5_1000">1000</label><br>
                                         <input type="radio" id="s5_10000" name="typeMoney5" value="10000">
                                         <label for="s5_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname5" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="5" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Thần Bài Macao</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="6" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="6" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="6" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="6" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem6" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input name="nickname"  class="form-control" id="nickname6" placeholder="Nhập nick name" type="text" onblur="myFunction(6)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s6_100" name="typeMoney6" value="100">
                                         <label for="s6_100">100</label><br>
                                         <input type="radio" id="s6_1000" name="typeMoney6" value="1000">
                                         <label for="s6_1000">1000</label><br>
                                         <input type="radio" id="s6_10000" name="typeMoney6" value="10000">
                                         <label for="s6_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname6" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="6" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Sexy Dance</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="7" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="7" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="7" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="7" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem7" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input name="nickname"  class="form-control" id="nickname7" placeholder="Nhập nick name" type="text" onblur="myFunction(7)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s7_100" name="typeMoney7" value="100">
                                         <label for="s7_100">100</label><br>
                                         <input type="radio" id="s7_1000" name="typeMoney7" value="1000">
                                         <label for="s7_1000">1000</label><br>
                                         <input type="radio" id="s7_10000" name="typeMoney7" value="10000">
                                         <label for="s7_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname7" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="7" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Big City Boy</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="8" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="8" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="8" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="8" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem8" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname8" placeholder="Nhập nick name" type="text" onblur="myFunction(8)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s8_100" name="typeMoney8" value="100">
                                         <label for="s8_100">100</label><br>
                                         <input type="radio" id="s8_1000" name="typeMoney8" value="1000">
                                         <label for="s8_1000">1000</label><br>
                                         <input type="radio" id="s8_10000" name="typeMoney8" value="10000">
                                         <label for="s8_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname8" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="8" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Bồng lai các</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="9" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="9" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="9" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="9" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem9" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname9" placeholder="Nhập nick name" type="text" onblur="myFunction(9)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s9_100" name="typeMoney9" value="100">
                                         <label for="s9_100">100</label><br>
                                         <input type="radio" id="s9_1000" name="typeMoney9" value="1000">
                                         <label for="s9_1000">1000</label><br>
                                         <input type="radio" id="s9_10000" name="typeMoney9" value="10000">
                                         <label for="s9_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname9" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="9" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>Rượu Whisky</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="10" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="10" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="10" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="10" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem10" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname10" placeholder="Nhập nick name" type="text" onblur="myFunction(10)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s10_100" name="typeMoney10" value="100">
                                         <label for="s10_100">100</label><br>
                                         <input type="radio" id="s10_1000" name="typeMoney10" value="1000">
                                         <label for="s10_1000">1000</label><br>
                                         <input type="radio" id="s10_10000" name="typeMoney10" value="10000">
                                         <label for="s10_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname10" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="10" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                           
                            <form class="list_filter form" style="border: 1px solid;"  action="" method="">
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3"><label >Tên Slot</label></div>
                                        <div class="col-sm-6">
                                            <span>MiniPoker</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow" >
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Tỷ lệ hút</label></div>
                                        <div class="col-sm-6"><input name="tylehut" class="form-control" slot-id="11" placeholder="Nhập tỷ lệ (%)" type="text" ><input name="set" slot-id="11" style="background-color: aqua" type="button" value="SET"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >TK Set</label></div>
                                        <div class="col-sm-6">
                                        <ul class="Type-check">
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="11" type="radio" name="typeUser" value="fake" checked="checked">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>BOT</span>
                                            </label>
                                            </li>
                                            <li class="Type-check-item">
                                            <label class="Type-check-item-label">
                                                <input class="Type-check-item-label__input js-action-qa-item" slot-id="11" type="radio" name="typeUser" value="real">
                                                <span class="Type-check-item-label-content">
                                                <em class="Type-check-item-label-content__ico"></em>THẬT</span>
                                            </label>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="formRow" id="nicknameItem11" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Nickname</label></div>
                                        <div class="col-sm-6"><input  name="nickname" class="form-control" id="nickname11" placeholder="Nhập nick name" type="text" onblur="myFunction(11)"></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"><label >Phòng</label></div>
                                        <div class="col-sm-6">
                                        <input type="radio" id="s11_100" name="typeMoney11" value="100">
                                         <label for="s11_100">100</label><br>
                                         <input type="radio" id="s11_1000" name="typeMoney11" value="1000">
                                         <label for="s11_1000">1000</label><br>
                                         <input type="radio" id="s11_10000" name="typeMoney11" value="10000">
                                         <label for="s11_10000">10000</label>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: center;"><label id="errorname11" style="color: #c80603;"></label></div>
                                    </div>
                                </div>

                                <div class="formRow">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <input style="width: 100%;
                                                        font-size: 16px;
                                                        background: #b42121;
                                                        max-height: 77px;
                                                        height: 57px;" type="button" name="sethu" slot-id="11" value="SET NỔ" class="button blueB">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
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

.Type-check {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.Type-check-item {
  flex: 1;
}

.Type-check-item-label {
    width: 100%;
    margin: 0;
}

.Type-check-item-label__input {
  position: absolute;
}
.set_slot span {
    font-size: 20px;
}
.Type-check-item-label-content {
  background-image: linear-gradient(#f9f9f9, #f2f2f2, #eee);
  border: 2px solid #b8b8b8;
  border-radius: 7px;
  box-sizing: border-box;
  cursor: pointer;
  display: block;
  font-size: 15px;
  font-weight: bold;
  padding: 9px 16px 9px 40px;
  position: relative;
  color: #49180a;
}

.Type-check-item-label-content__ico {
  display: block;
  left: 14px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
}

.Type-check-item-label-content__ico::before {
  border: 2px solid #8f8f8f;
  border-radius: 14px;
  box-sizing: border-box;
  content: '';
  display: block;
  height: 20px;
  width: 20px;
}

.Type-check-item-label__input:checked + .Type-check-item-label-content {
  background: #ffa05d;
  border-color: #370204;
}

.Type-check-item-label__input + .Type-check-item-label-content .Type-check-item-label-content__ico {
  background: #fff;
  border-radius: 50%;
  display: block;
  left: 14px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
}

.Type-check-item-label__input:checked + .Type-check-item-label-content .Type-check-item-label-content__ico::before {
  background: #370204;
  border-color: #370204;
}

.Type-check-item-label__input:checked + .Type-check-item-label-content .Type-check-item-label-content__ico::after {
  background: #fff;
  border-radius: 14px;
  content: '';
  display: block;
  height: 8px;
  left: 6px;
  margin-top: -4px;
  position: absolute;
  top: 50%;
  width: 8px;
}
</style>

<script>
    const GAMENAME = {
        1: 'FastAndFurious',
        2: 'LadyNight',
        3: 'Cowboy',
        4: 'LienMinh',
        5: 'Halloween',
        6: 'LasVegas',
        7: 'SexyDance',
        8: 'BigCityBoy',
        9: 'BongLaiCac',
        10: 'CANDY',
        11: 'MiniPoker',
    }
    $("input[name=sethu]").click(function () {
        const slotId = $(this).attr('slot-id');
        $("#spinner").show();
        var moneyPot = "";
        var nickname = "";
        if ($(`input[name=typeUser][slot-id=${slotId}]:checked`).val() == 'real') {
            if($(`#nickname${slotId}`).val() == ""){
                $(`#errorname${slotId}`).html("Bạn chưa nhập nick name");
                return false;
            }
            nickname =  $(`#nickname${slotId}`).val();
            moneyPot = 100000;
        } else {
            // if($("#moneyPot").val() == ""){
            //     $("#errorname").html("Bạn chưa nhập số tiền hũ");
            //     return false;
            // }
            // moneyPot = $("#moneyPot").val();
            nickname = botName[Math.floor(Math.random() * botName.length)];
        }
        const typeMoney = $(`input[name=typeMoney${slotId}]:checked`).val();
        if(!typeMoney) {
            $(`#errorname${slotId}`).html("Bạn chưa chọn phòng");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/setjackpotajax')?>",
            data: {
                gamename : GAMENAME[slotId],
                typejackpot : 1,
                nickname: nickname,
                typeUser: $(`input[slot-id=${slotId}][name=typeUser]:checked`).val(),
                moneyPot: moneyPot,
                typeMoney,
                act: 'add'
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result.success) {
                    alert(`SET JACKPOT ${GAMENAME[slotId]} THÀNH CÔNG`);
                }
            }, error: function () {
                $("#spinner").hide();
                $(`#errorname${slotId}`).html("Hệ thống quá tải. Vui long thử lại sau");
            },timeout : 20000
        });
    });

    function myFunction(slotId) {
        if(slotId) {

            $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/SetNohu/checknickname") ?>",
            data: {
                nickname: $(`#nickname${slotId}`).val()
            },
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if (res == -2) {
                    $(`#errorname${slotId}`).html("Hệ thống gián đoạn");
                }
                else if (res == -1) {
                    $(`#errorname${slotId}`).html("Nick name không tồn tại");
                }
                else if (res == 0) {
                    $(`#errorname${slotId}`).html("Tài khoản thường");

                }
                else if (res == 1) {
                    $(`#errorname${slotId}`).html("Tài khoản đại lý");
                }
                else if (res == 2) {
                    $(`#errorname${slotId}`).html("Tài khoản đại lý");
                }
                else if (res == 100) {
                    $(`#errorname${slotId}`).html("Tài khoản thường");
                }
            },error: function(){
                $(`#errorname${slotId}`).html("Kết nối không ổn định.Vui lòng thử lại sau");
                },
            timeout:30000
        });
        }
    }


    $("input[name=nickname]").keyup(function (e) {
        $(this).val(($(this).val()));
        $("#numchuyen").text($(this).val());
    });

    $("input[name=nickname]").keyup(function (e) {
        $(this).val(($(this).val()));
        $(".js-nicknametxt").text($(this).val());
    });

    $('#typejackpot').on('change', function () {
        console.log($(this).find('option').filter(':selected').text());
        $(".js-typejackpottitle").text($(this).find('option').filter(':selected').text());
    });

    $(".js-action-qa-item").click(function () {
        const slotId = $(this).attr('slot-id');
        if (this.value == 'fake') {
            $(`#nicknameItem${slotId}`).slideUp();
        } else {
            $(`#nicknameItem${slotId}`).slideDown();
        }
    });
    $(document).ready(function () {
        $("#spinner").show();

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/getTyleHut')?>",
            data: {},
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result) {
                    for(const id in GAMENAME) {
                        $(`input[name=tylehut][slot-id=${id}]`).val(result[GAMENAME[id]])
                    }
                }
            }, error: function () {
                $("#spinner").hide();
                $(`#errorname`).html("Hệ thống quá tải. Vui long thử lại sau");
            },timeout : 20000
        });
        $('input[name=tylehut]').on('keydown', function (e){
            if (e.key.length === 1 && !e.key.match(/[0-9]/) && !['Backspace', 'Tab', 'Enter', 'Delete'].includes(e.key)) {
                e.preventDefault();
            }
        });
        $('input[name=set]').click(function() {
            const slotId = $(this).attr('slot-id');
            const fee = $(this).prev().val();
            const gamename = GAMENAME[slotId];
            console.log(gamename, fee, slotId);
            if(!isNaN(fee) && fee >= 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('usergame/setTyleHut')?>",
                    data: {
                        gamename,
                        fee,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $("#spinner").hide();
                        if(result.success) {
                            alert(`Set tỷ lệ ${gamename === 'CANDY'? 'Rượu Whisky' : gamename} thành công`);
                        } else {
                            alert("Set tỷ lệ hút KHÔNG thành công");
                        }
                    }, error: function () {
                        $("#spinner").hide();
                        $(`#errorname`).html("Hệ thống quá tải. Vui long thử lại sau");
                    },timeout : 20000
                });
            }
        })
    })

    var botName = [
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
        "loveletter",
        "hinconcon",
        "ruoiconxinhxan",
        "kurtlove",
        "huyenthao",
        "thanhhoa62",
        "pappai",
        "macxin",
        "hoahongnhung",
        "danngocha",
        "leovsmoon",
        "hoaquynhnha",
        "Jackmarion",
        "lanhmotchut",
        "thuchanhha",
        "hamamoi",
        "lontalonton",
        "quysuna",
        "sinhhoc",
        "toanvangioi",
        "lolangqua",
        "lamgigio",
        "ngoaihinh",
        "cocnuocngot",
        "cocnuocchanh",
        "hakutexinh",
        "haxinhxan",
        "daybuoctoc",
        "tocdendep",
        "tocnhuom",
        "capxach",
        "dieuhoa",
        "ngontay",
        "banchan",
        "matdayqua",
        "doidepcuaem",
        "doigiaycuaanh",
        "tinhdoita",
        "bongdentip",
        "kinhnghiem",
        "thapdemtimnhau",
        "sotsachonhau",
        "nangvang",
        "ngayheohon",
        "khepmilai",
        "chuyenbuonqua",
        "giacmocuaem",
        "tensokhanh",
        "luyenthuyenca",
        "banhgian",
        "dentroiqua",
        "laptop",
        "datrangmatxinh",
        "trungtinhde",
        "Jinmarkboy",
        "Petalia",
        "gamoqua",
        "ngoquaah",
        "lechualon",
        "moitinhdamsau",
        "titanic",
        "honeyyeu",
        "chongvoichacon",
        "cuccu22",
        "cupon15",
        "thaigiam55",
        "dauphuthoi",
        "somaqua55",
        "chickenband",
        "noigidiem",
        "daigiavn",
        "chihuahua",
        "1dem3phat",
        "muanuadem",
        "nemchuaran",
        "vungbaotap",
        "vitluoc",
        "meyeudau",
        "chandat",
        "vualuabip",
        "thitcho",
        "banmaixanh",
        "chienbinh",
        "combinhdan",
        "heoquy",
        "melove",
        "chembodau",
        "xuanhiep1188",
        "thaichien11",
        "omaichanh",
        "huutung357",
        "soieday",
        "gadaychandi",
        "echommang",
        "maxcoffee",
    ];
</script>
