<title>Quản Lý Giftcode</title>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>Danh sách chiến dịch</h6>
        </div>
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        <div id="spinner" class="spinner" style="display:none;">
            <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading" />
        </div>
        <div>
            Tạo mới chiến dịch <input style="margin: 15px" id="campainName"><button id="createCampain" type="submit"><span style="color: #fff">Tạo mới</span></button>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
                <tr style="height: 20px;">
                    <td style="width:80px;">STT</td>
                    <td>Tên hiển thị</td>
                    <td>Tổng</td>
                    <td>Đã sử dụng</td>
                    <td>Chưa sử dụng</td>
                    <td>Thêm giftcode</td>
                    <td>Hành động</td>
                </tr>
            </thead>
            <tbody id="logdongbang">
                <?php $i = 1; ?>
                <?php 
                foreach ($listtype as $row) : ?>
                    <tr>
                        <td class="textC"><?php echo $i; ?></td>
                        <td>
                            <form action="<?php echo admin_url('giftcode/giftcodeadmin'); ?>" method="POST" target="_blank">
                                <input type="hidden" name="filtercampaign" value="1">
                                <input type="hidden" name="typegiftcode" value="<?php echo $row->id; ?>">
                                <button type="submit" style="background:none;border:none;padding:0;color:blue;text-decoration:underline;cursor:pointer;">
                                    <?php echo $row->campaignName ?>
                                </button>
                            </form>
                        </td>
                        <td><?php echo @(int)$row->total ?></td>
                        <td><?php echo @(int)$row->used; ?></td>
                        <td><?php echo @(int)$row->unused ?></td>
                        <td align="center">
                            <form action="<?php echo admin_url('giftcode/adminadd'); ?>" method="POST">
                                <input type="hidden" name="typegiftcode" value="<?php echo $row->id; ?>">
                                <button type="submit" style="background:none;border:none;padding:0;color:blue;text-decoration:underline;cursor:pointer;">
                                    <img src="<?php echo public_url('admin') ?>/images/icons/color/plus.png" />
                                </button>
                            </form>
                        </td>
                        <td class="option">
                            <button style="background: none !important" name="delete" value="<?php echo $row->id ?>" title="Xóa" class="tipS verify_action">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png" />
                            </button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#createCampain").click(function() {
            const campaignName = $("#campainName").val();
            if (!campaignName.trim()) { // Check if campaignName is not empty
                alert("Tên chiến dịch là bắt buộc.");
                return; // Stop the function from proceeding
            }
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/addtypeajax') ?>",
                data: {
                    typeName: campaignName
                },
                dataType: 'json',
                success: function(result) {
                    $("#spinner").hide();
                    if (result == 0) {
                        $("#resultsearch").html("Tạo mới chiến dịch không thành công");
                    } else {
                        alert("Tạo mới chiến dịch thành công");
                        window.location.href = '<?php echo admin_url('giftcode/addcampain') ?>'
                    }
                },
                error: function() {
                    $("#spinner").hide();
                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                },
                timeout: 40000
            });
        });
        $("button[name=delete]").click(function() {
            const type = $(this).val();
            
            // Add confirmation dialog
            if (confirm("Bạn có chắc chắn muốn xóa chiến dịch này?")) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('giftcode/deletetypeajax') ?>",
                    data: {
                        type
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#spinner").hide();
                        if (result == 0) {
                            alert("Xóa chiến dịch KHÔNG thành công");
                        } else {
                            alert("Xóa chiến dịch thành công");
                            window.location.href = '<?php echo admin_url('giftcode/addcampain') ?>'
                        }
                    },
                    error: function() {
                        $("#spinner").hide();
                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng thử lại sau!");
                    },
                    timeout: 40000
                });
            }
        });
    })
</script>