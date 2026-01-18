<div style="display: flex; justify-content: space-between; margin-bottom: 25px;">
    <h2>QUẢN LÝ NHÀ CUNG CẤP</h2>
    <button class="btn btn-primary" onclick="openModal('addSupplierModal')">
        <i class="fas fa-plus"></i> Thêm nhà cung cấp
    </button>
</div>

<div class="card">
    <table class="table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên nhà cung cấp</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($suppliers)): foreach ($suppliers as $s): ?>
                <tr>
                    <td><?= $s['id']; ?></td>
                    <td style="font-weight: 700; color: var(--text-dark)"><?= htmlspecialchars($s['name']); ?></td>
                    <td><?= htmlspecialchars($s['phone']); ?></td>
                    <td><?= htmlspecialchars($s['email']); ?></td>
                    <td><?= htmlspecialchars($s['address']); ?></td>
                    <td>
                        <span class="sku-badge" style="background: <?= $s['status'] == 1 ? '#dcfce7' : '#fee2e2' ?>;">
                            <?= $s['status'] == 1 ? 'Hoạt động' : 'Tạm ngưng' ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn" style="color: var(--primary); background: none" 
                                onclick='openUpdateSupplierModal(<?= json_encode($s); ?>)'>
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7" style="text-align:center">Chưa có dữ liệu nhà cung cấp.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="addSupplierModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>THÊM NHÀ CUNG CẤP</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('addSupplierModal')"></i>
        </div>
        <form action="index.php?module=supplier&action=add" method="POST" class="form-grid">
            <div class="form-group full-width">
                <label>Tên nhà cung cấp *</label>
                <input type="text" name="name" required />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" />
            </div>
            <div class="form-group full-width">
                <label>Địa chỉ</label>
                <input type="text" name="address" />
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('addSupplierModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="updateSupplierModal">
    <div class="modal-box" style="border-top: 5px solid var(--primary)">
        <div class="modal-header">
            <h2>CẬP NHẬT NHÀ CUNG CẤP</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('updateSupplierModal')"></i>
        </div>
        <form action="index.php?module=supplier&action=update" method="POST" class="form-grid">
            <input type="hidden" name="id" id="edit_sup_id">
            <div class="form-group full-width">
                <label>Tên nhà cung cấp *</label>
                <input type="text" name="name" id="edit_sup_name" required />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" id="edit_sup_phone" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit_sup_email" />
            </div>
            <div class="form-group full-width">
                <label>Địa chỉ</label>
                <input type="text" name="address" id="edit_sup_address" />
            </div>
            <div class="form-group full-width">
                <label>Trạng thái</label>
                <select name="status" id="edit_sup_status">
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm ngưng</option>
                </select>
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('updateSupplierModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUpdateSupplierModal(sup) {
    document.getElementById('edit_sup_id').value = sup.id;
    document.getElementById('edit_sup_name').value = sup.name;
    document.getElementById('edit_sup_phone').value = sup.phone;
    document.getElementById('edit_sup_email').value = sup.email;
    document.getElementById('edit_sup_address').value = sup.address;
    document.getElementById('edit_sup_status').value = sup.status;
    document.getElementById('updateSupplierModal').classList.add('active');
}
function openModal(id) { document.getElementById(id).classList.add('active'); }
function closeModal(id) { document.getElementById(id).classList.remove('active'); }
</script>