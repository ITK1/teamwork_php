<div style="display: flex; justify-content: space-between; margin-bottom: 25px;">
    <h2>LỊCH SỬ NHẬP KHO</h2>
    <button class="btn btn-primary" onclick="openModal('importModal')">
        <i class="fas fa-download"></i> Tạo phiếu nhập hàng
    </button>
</div>

<div class="card">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Ngày nhập</th>
                <th>Sản phẩm</th>
                <th>Nhà cung cấp</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($history)): foreach($history as $h): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($h['created_at'])) ?></td>
                    <td><strong><?= htmlspecialchars($h['product_name']) ?></strong></td>
                    <td><?= htmlspecialchars($h['supplier_name']) ?></td>
                    <td style="color: #16a34a; font-weight: bold;">+<?= number_format($h['quantity']) ?></td>
                    <td><?= number_format($h['price']) ?> đ</td>
                    <td style="font-weight: 700;"><?= number_format($h['quantity'] * $h['price']) ?> đ</td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" style="text-align:center; padding: 20px;">Chưa có lịch sử nhập kho nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="importModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>PHIẾU NHẬP KHO MỚI</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('importModal')"></i>
        </div>
        <form action="index.php?module=inventory&action=add" method="POST" class="form-grid">
            <div class="form-group full-width">
                <label>Chọn sản phẩm nhập *</label>
                <select name="product_id" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php foreach($products as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['sku'] ?> - <?= $p['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nhà cung cấp *</label>
                <select name="supplier_id" required>
                    <option value="">-- Chọn nhà cung cấp --</option>
                    <?php foreach($suppliers as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Số lượng nhập *</label>
                <input type="number" name="quantity" min="1" required placeholder="0" />
            </div>
            <div class="form-group">
                <label>Đơn giá nhập (đ/ĐVT)</label>
                <input type="number" name="price" required placeholder="0" />
            </div>
            <div class="form-group full-width">
                <label>Ghi chú phiếu nhập</label>
                <input type="text" name="note" placeholder="Nhập ghi chú nếu có..." />
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('importModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Xác nhận nhập kho</button>
            </div>
        </form>
    </div>
</div>

<script>
// Dùng chung cho cả Inventory In và Out
function openImportModal() { openModal('importModal'); }
function openExportModal() { openModal('exportModal'); }

function openModal(id) { 
    const modal = document.getElementById(id);
    if(modal) modal.classList.add('active'); 
}

function closeModal(id) { 
    const modal = document.getElementById(id);
    if(modal) modal.classList.remove('active'); 
}
</script>