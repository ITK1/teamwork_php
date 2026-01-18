<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="margin: 0; color: var(--text-dark);">QUẢN LÝ XUẤT KHO</h2>
        <p style="margin: 5px 0 0 0; font-size: 13px; color: var(--text-light);">Lập phiếu và theo dõi lịch sử xuất hàng</p>
    </div>
    <button class="btn btn-primary" style="background: #f43f5e; border-color: #f43f5e;" onclick="openExportModal()">
        <i class="fas fa-minus-circle"></i> Tạo phiếu xuất kho
    </button>
</div>

<div class="card">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Thời gian</th>
                <th>Sản phẩm</th>
                <th>Loại</th>
                <th style="text-align: right;">Số lượng</th>
                <th style="text-align: right;">Đơn giá</th>
                <th style="text-align: right;">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($history) && is_array($history)): foreach($history as $h): ?>
                <tr>
                    <td style="color: var(--text-light); font-size: 12px;">
                        <?= date('H:i d/m/Y', strtotime($h['created_at'])) ?>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--text-dark)"><?= htmlspecialchars($h['product_name'] ?? 'N/A') ?></div>
                        <small style="color: #94a3b8;"><?= htmlspecialchars($h['note'] ?? '') ?></small>
                    </td>
                    <td><span style="background: #fee2e2; color: #e11d48; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 700;">XUẤT</span></td>
                    <td style="text-align: right; font-weight: 800; color: #f43f5e;">
                        -<?= number_format($h['quantity'] ?? 0) ?>
                    </td>
                    <td style="text-align: right;"><?= number_format($h['price'] ?? 0) ?> đ</td>
                    <td style="text-align: right; font-weight: 700;">
                        <?= number_format(($h['quantity'] ?? 0) * ($h['price'] ?? 0)) ?> đ
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" style="text-align: center; padding: 30px;">Chưa có dữ liệu xuất kho.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="exportModal">
    <div class="modal-box" style="border-top: 5px solid #f43f5e;">
        <div class="modal-header">
            <h2>LẬP PHIẾU XUẤT KHO</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('exportModal')"></i>
        </div>
        <form action="index.php?module=inventory_out&action=add" method="POST" class="form-grid" id="formExport">
            <div class="form-group full-width">
                <label>Sản phẩm xuất *</label>
                <select name="product_id" id="export_product_id" required>
                    <option value="">-- Tìm kiếm sản phẩm trong kho --</option>
                    <?php 
                    // Kiểm tra biến products trước khi lặp để tránh lỗi dòng 82
                    if(!empty($products) && is_array($products)): 
                        foreach($products as $p): 
                            // Ép kiểu dữ liệu để đảm bảo không bị lỗi Warning
                            $p_id = $p['id'] ?? 0;
                            $p_sku = $p['sku'] ?? 'N/A';
                            $p_name = $p['name'] ?? 'Không tên';
                            $p_qty = $p['quantity'] ?? 0;
                            $p_price = $p['price_import'] ?? 0;
                    ?>
                        <option value="<?= $p_id ?>" data-stock="<?= $p_qty ?>" data-price="<?= $p_price ?>">
                            <?= htmlspecialchars($p_sku) ?> - <?= htmlspecialchars($p_name) ?> (Tồn: <?= $p_qty ?>)
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Số lượng xuất *</label>
                <input type="number" name="quantity" id="export_qty" min="1" required />
            </div>

            <div class="form-group">
                <label>Giá xuất</label>
                <input type="number" name="price" id="export_price" required />
            </div>

            <div class="form-group full-width">
                <label>Ghi chú</label>
                <input type="text" name="note" placeholder="Lý do xuất hàng..." />
            </div>

            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background:#e2e8f0" onclick="closeModal('exportModal')">Hủy</button>
                <button type="submit" class="btn btn-primary" style="background: #f43f5e;">Xác nhận xuất</button>
            </div>
        </form>
    </div>
</div>

<script>
function openExportModal() {
    document.getElementById('exportModal').classList.add('active');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}

// Logic kiểm tra tồn kho và gợi ý giá
const productSelect = document.getElementById('export_product_id');
const priceInput = document.getElementById('export_price');

productSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if(this.value !== "") {
        priceInput.value = selectedOption.getAttribute('data-price');
    }
});

document.getElementById('formExport').addEventListener('submit', function(e) {
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    const stock = parseInt(selectedOption.getAttribute('data-stock') || 0);
    const qty = parseInt(document.getElementById('export_qty').value);

    if (qty > stock) {
        e.preventDefault();
        alert('❌ Lỗi: Kho chỉ còn ' + stock + ' sản phẩm. Không thể xuất ' + qty);
    }
});
</script>