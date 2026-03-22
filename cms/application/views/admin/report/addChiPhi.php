<title>Thêm Chi Phí Vận Hành</title>

<?php if($role == false): ?>
    <section class="content-header">
        <h1>
            Bạn chưa được phân quyền
        </h1>
    </section>
<?php else: ?>
    <section class="content-header">
        <h1>
            Thêm Chi phí vận hành
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <label class="col-sm-2  control-label" style="color: red" id="errorvin"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 control-label">Loại (vd:Marketing):</label>
                                <div class="col-sm-2">
                                    <input type="text" id="type" class="form-control" >
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 control-label">Chi phí:</label>
                                <input id="checknickname" type="hidden">
                                <div class="col-sm-2">
                                    <input type="text" id="expense" class="form-control">
                                </div>
                                <label id="lblnickname" style="color: blueviolet"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 control-label">Số tiền:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="amount" class="form-control">
                                </div>
                                <label id="numchuyen" style="color: blueviolet"></label>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-1">
                                    <input type="button" id="add_chi"
                                           value="Thêm" class="btn btn-primary pull-left">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

   
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

</style>

<script>

$(document).ready(function () {

    $("#add_chi").click(function () {
        var  money = $("#amount").val();
        if(money <= 0) {
            alert('Số tiền phải lớn hơn 0');
            return false
        }
        else {
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url("report/addChiPhiAjax") ?>",
                data: {
                    type: $("#type").val(),
                    amount: money,
                    expense :  $("#expense").val()
                },
                dataType: 'json',
                success: function (result) {
                    if(result == 0) {
                        alert("Thêm chi phí thành công");
                        window.location = "<?php echo admin_url("report/detailChiphi") ?>";
                    } else {
                        $("#errorvin").html("Thêm chi phí LỖI: " + result);
                    }
                }, error: function(error) {
                    $("#errorvin").html(error.responseText);
                }
            })
        }
    })

    $('#amount').on('paste', function (e) {
        let pastedData = e.originalEvent.clipboardData.getData('text');
        let money = parseInt(pastedData);
        if(isNaN(money) || money <= 0) {
            alert("Vui lòng nhập số lớn hơn 0");
            e.preventDefault();
        }
    });

    $("#amount").keydown(function (e) {
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
    var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};
$("#amount").keyup(function (e) {
    $(this).val(($(this).val()));
    $("#numchuyen").text(format($(this).val()));

});
});
</script>