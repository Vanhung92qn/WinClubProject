<!-- head -->
<?php $this->load->view('admin/sale/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="horControlB menu_action">
        <ul>
            <li>
                <div onclick="onShowEditModal(0)">
                    <img src="<?php echo public_url('admin') ?>/images/icons/control/16/add.png">
                    <span style="line-height: 36px;">Thêm mới đại lý mua bán</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="widget">
        <div class="title">
            <h6>Danh sách đại lý mua - bán</h6>
        </div>
        <table style="table-layout: fixed" class="table table-bordered" id="saleList">
        </table>
    </div>
    <div class="pagination">

    </div>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="infoModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModal">Đại lý mua bán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div><input type="text" class="form-control" style="display: none;" id="dl_id_master"/>
                            </div>
                        </div>
                        <div>
                            <div><label class="title">ID </label></div>
                            <div><input type="text" class="form-control" id="dl_id"/></div>
                        </div>
                        <div>
                            <div><label class="title">Tên đầy đủ</label></div>
                            <div><input type="text" class="form-control" id="fullname"/></div>
                        </div>
                        <div>
                            <div><label class="title">Tên đăng nhập trong game</label></div>
                            <div><input type="text" class="form-control" id="username"/></div>
                        </div>
                        <div>
                            <div><label class="title">Tên nickname trong game</label></div>
                            <div><input type="text" class="form-control" id="nickname"/></div>
                        </div>
                        <div>
                            <div><label class="title">Số điện thoại</label></div>
                            <div><input type="text" class="form-control" id="phone"/></div>
                        </div>
                        <div>
                            <div><label class="title">Khu vực</label></div>
                            <div><input type="text" class="form-control" id="khuvuc"/></div>
                        </div>
                        <div>
                            <div><label class="title">ID telegram</label></div>
                            <div><input type="text" class="form-control" id="tele"/></div>
                        </div>
                        <div>
                            <div><label class="title">Link facebook</label></div>
                            <div><input type="text" class="form-control" id="facebook"/></div>
                        </div>
                        <div>
                            <div><label class="title">Link zalo</label></div>
                            <div><input type="text" class="form-control" id="zalo"/></div>
                        </div>
                        <div>
                            <div><label class="title">Tên ngân hàng dùng</label></div>
                            <div><input type="text" class="form-control" id="bank"/></div>
                        </div>
                        <div>
                            <div><label class="title">Số tài khoản ngân hàng</label></div>
                            <div><input type="text" class="form-control" id="banknumber"/></div>
                        </div>
                        <div>
                            <div><label class="title">Tên chủ tài khoản ngân hàng</label></div>
                            <div><input type="text" class="form-control" id="bankname"/></div>
                        </div>
                        <div>
                            <div><label class="title">Ghi chú thêm về (nếu có)</label></div>
                            <div><input type="text" class="form-control" id="note"/></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button blueB" onClick="onSaveEditSale()">Lưu</button>
                        <button type="button" class="button blueB" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
             aria-hidden="true">
            <input type="text" class="form-control" style="display: none;" id="dl_id_delete"/>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModal">Xóa đại lý mua bán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div><label class="title">Bạn có muốn xóa đại lý này ?</label></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button blueB" onClick="onDeleteSale()">Xóa</button>
                        <button type="button" class="button blueB" data-dismiss="modal">Không</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="clear mt30"></div>

<script>
    let saleData = [];
    let headerTable = {
        "dl_id": "ID đại lý ",
        "fullname": "Tên đầy đủ",
        "username": "Tên đăng nhập",
        "nickname": "Tên nickname",
        "phone": "Số điện thoại",
        "khuvuc": "Khu vực",
        "tele": "Telegram",
        "facebook": "Link FB",
        "zalo": "Link zalo",
        "bank": "Tên ngân hàng",
        "banknumber": "Số tài khoản ngân hàng",
        "bankname": "Tên chủ tài khoản ngân hàng",
        "note": "Ghi chú",
    }

    function init() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('sale/fetch')?>",
            success: function (response) {
                let tbl = $('#saleList')
                let data = JSON.parse(response);
                let body = '<tbody>';
                if (data && data.length > 0) {
                    saleData = data;
                    let head = '<thead class="filter"><tr>'
                    let showAction = true;
                    for (let i = 0; i < data.length; i++) {
                        body += '<tr style="height: 20px;">'
                        let rId = '';
                        for (const key in data[i]) {
                            if (key !== 'id') {
                                let headName = headerTable[key] ? headerTable[key] : key
                                if (i === 0) {
                                    head += '<td class="p-2">' + headName + '</td>';
                                }
                                body += '<td style="overflow-wrap: break-word;">' + data[i][key] + '</td>';
                            } else {
                                rId = data[i][key];
                            }
                        }
                        if (showAction) {
                            if (i === 0) {
                                head += '<td>'
                                head += 'Hành Động'
                                head += '</td>'
                            } else {
                                body += '<td>'
                                body += '<button onClick=onShowEditModal("' + rId + '") class="button blueB" style="margin: 10px">Sửa</button>'
                                body += '<button onClick=onShowDeleteModal("' + rId + '") class="button blueB" style="margin: 10px">Xóa</button>'
                                body += '</td>'
                            }

                        }
                        body += '</tr>'

                    }
                    tbl.append(head + '</tr></thead>')
                    tbl.append(body)
                }
            }
        });
    }

    function onShowEditModal(id) {
        $('#dl_id_master').val(id)
        for (const key in headerTable) {
            $('#' + key).val('')
        }

        if (saleData && saleData.length > 0) {
            let editItem = saleData.find(i => i.id === id);
            if (editItem) {
                for (const key in editItem) {
                    $('#' + key).val(editItem[key])
                    if (key === 'id') {
                        $('#dl_id_master').val(editItem[key]);
                    }
                }
            }
        }
        $('#editModal').modal('show')
    }


    function onSaveEditSale() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('sale/save')?>",
            data: {
                id: $("#dl_id_master").val(),
                dl_id: $("#dl_id").val(),
                fullname: $("#fullname").val(),
                username: $("#username").val(),
                nickname: $("#nickname").val(),
                phone: $("#phone").val(),
                khuvuc: $("#khuvuc").val(),
                tele: $("#tele").val(),
                facebook: $("#facebook").val(),
                zalo: $("#zalo").val(),
                bank: $("#bank").val(),
                banknumber: $("#banknumber").val(),
                bankname: $("#bankname").val(),
                note: $("#note").val()
            },
            dataType: 'json',
            success: function (response) {
                $('#editModal').modal('hide')
            },
            error: function (e) {
                alert(e);
            }
        });
    }

    function onShowDeleteModal(id) {
        if (saleData && saleData.length > 0) {
            let editItem = saleData.find(i => i.id === id);
            if (editItem) {
                $('#dl_id_delete').val(editItem['id']);
            }
        }
        $('#deleteModal').modal('show')
    }

    function onDeleteSale(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('sale/delete')?>",
            data: {
                id: $("#dl_id_delete").val()
            },
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                $('#deleteModal').modal('hide')
            },
            error: function (e) {
                alert(e);
            }
        });
    }


    init();

</script>

