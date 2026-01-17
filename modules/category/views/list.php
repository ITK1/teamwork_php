<div style="display: flex; justify-content: space-between; margin-bottom: 25px;">
    <h2>QUẢN LÝ DANH MỤC</h2>
    <button class="btn btn-primary" onclick="openModal('addCategoryModal')">
        <i class="fas fa-plus"></i> Thêm danh mục
    </button>
</div>

<div class="card">
    <table class="table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Phân cấp</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): foreach ($categories as $cat): 
                $isChild = !is_null($cat['parent_id']) && $cat['parent_id'] > 0;
            ?>
                <tr>
                    <td><?= $cat['id']; ?></td>
                    <td style="font-weight: 700; color: var(--text-dark)">
                        <?= $isChild ? '<span style="color:#cbd5e1; margin-left:20px;">|-- </span>' : '' ?>
                        <?= htmlspecialchars($cat['name']); ?>
                    </td>
                    <td>
                        <span class="sku-badge" style="<?= $isChild ? 'background:#f1f5f9; color:#475569' : 'background:#e0f2fe; color:#0369a1' ?>">
                            <?= $isChild ? 'Danh mục con' : 'Danh mục cha' ?>
                        </span>
                    </td>
                    <td>
                        <span class="sku-badge" style="background: <?= $cat['status'] == 1 ? '#dcfce7' : '#fee2e2' ?>; color: <?= $cat['status'] == 1 ? '#166534' : '#991b1b' ?>">
                            <?= $cat['status'] == 1 ? 'Đang hoạt động' : 'Đang ẩn' ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn" style="color: var(--primary); background: none" 
                                onclick='openUpdateCategoryModal(<?= json_encode($cat); ?>)'>
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" style="text-align:center">Chưa có danh mục nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="addCategoryModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>THÊM DANH MỤC MỚI</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('addCategoryModal')"></i>
        </div>
        <form action="index.php?module=category&action=add" method="POST" class="form-grid">
            <div class="form-group full-width">
                <label>Tên danh mục *</label>
                <input type="text" name="name" required />
            </div>
            <div class="form-group">
                <label>Danh mục cha</label>
                <select name="parent_id">
                    <option value="0">-- Là danh mục cha --</option>
                    <?php foreach ($categories as $p): if(is_null($p['parent_id'])): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('addCategoryModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu danh mục</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="updateCategoryModal">
    <div class="modal-box" style="border-top: 5px solid var(--primary)">
        <div class="modal-header">
            <h2>CẬP NHẬT DANH MỤC</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('updateCategoryModal')"></i>
        </div>
        <form action="index.php?module=category&action=update" method="POST" class="form-grid">
            <input type="hidden" name="id" id="edit_cat_id">
            <div class="form-group full-width">
                <label>Tên danh mục *</label>
                <input type="text" name="name" id="edit_cat_name" required />
            </div>
            <div class="form-group">
                <label>Danh mục cha</label>
                <select name="parent_id" id="edit_cat_parent">
                    <option value="0">-- Là danh mục cha --</option>
                    <?php foreach ($categories as $p): if(is_null($p['parent_id'])): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" id="edit_cat_status">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('updateCategoryModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUpdateCategoryModal(cat) {
    document.getElementById('edit_cat_id').value = cat.id;
    document.getElementById('edit_cat_name').value = cat.name;
    document.getElementById('edit_cat_parent').value = cat.parent_id || 0;
    document.getElementById('edit_cat_status').value = cat.status;
    document.getElementById('updateCategoryModal').classList.add('active');
}
function openModal(id) { document.getElementById(id).classList.add('active'); }
function closeModal(id) { document.getElementById(id).classList.remove('active'); }
</script>