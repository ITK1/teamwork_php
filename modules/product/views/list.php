<div style="display: flex; justify-content: space-between; margin-bottom: 25px;">
    <div style="display: flex; gap: 10px">
        <form action="index.php" method="GET" style="display: flex; gap: 10px">
            <input type="hidden" name="module" value="product">
            <input type="hidden" name="action" value="list">
            <input
                type="text"
                name="search"
                class="input-control"
                placeholder="Tìm theo SKU hoặc tên..."
                style="width: 300px"
                value="<?= $_GET['search'] ?? '' ?>"
            />
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>
    <button class="btn btn-primary" onclick="openModal('addModal')">
        <i class="fas fa-plus"></i> Thêm sản phẩm
    </button>
</div>

<div class="card">
    <table class="table-custom" id="productTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình</th>
                <th>Tên sản phẩm</th>
                <th>SKU</th>
                <th>Danh mục</th>
                <th>ĐVT</th>
                <th>Giá nhập</th>
                <th>Tồn kho</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): foreach ($products as $item): ?>
                <tr>
                    <td style="font-weight: 700"><?= htmlspecialchars($item['id']); ?></td>
                    <td>
                        <img
                            src="<?= !empty($item['image']) ? 'uploads/products/' . $item['image'] : 'https://via.placeholder.com/80' ?>"
                            class="img-product"
                            alt="SP"
                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"
                        />
                    </td>
                    <td style="font-weight: 700; color: var(--text-dark)">
                        <?= htmlspecialchars($item['name']); ?>
                    </td>
                    <td><span class="sku-badge"><?= htmlspecialchars($item['sku']); ?></span></td>
                    <td><?= htmlspecialchars($item['category_name'] ?? $item['category_id']); ?></td>
                    <td><?= htmlspecialchars($item['unit']); ?></td>
                    <td style="font-weight: 700"><?= number_format($item['price_import']); ?> đ</td>
                    <td style="font-weight: 800; color: var(--primary)"><?= htmlspecialchars($item['quantity']); ?></td>
                    <td>
                        <button
                            class="btn"
                            style="color: var(--primary); background: none"
                            onclick='openUpdateModal(<?= json_encode($item); ?>)'
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="index.php?module=product&action=delete&id=<?= $item['id']; ?>" 
                           class="btn" style="color: #ef4444; background: none"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="9" style="text-align:center">Không tìm thấy sản phẩm nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination">
        <a href="#" class="page-item active">1</a>
    </div>
</div>

<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>THÊM SẢN PHẨM MỚI</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('addModal')"></i>
        </div>
        <form action="index.php?module=product&action=add" method="POST" enctype="multipart/form-data" class="form-grid">
            <div class="form-group full-width">
                <label>Tên sản phẩm *</label>
                <input type="text" name="name" required />
            </div>
            <div class="form-group">
                <label>Mã SKU *</label>
                <input type="text" name="sku" required />
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Đơn vị</label>
                <input type="text" name="unit" placeholder="Cái, Kg..." required />
            </div>
            <div class="form-group">
                <label>Giá nhập</label>
                <input type="number" name="price_import" />
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image" accept="image/*" />
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background: #e2e8f0" onclick="closeModal('addModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="updateModal">
    <div class="modal-box" style="border-top: 5px solid var(--primary)">
        <div class="modal-header">
            <h2>CẬP NHẬT SẢN PHẨM</h2>
            <i class="fas fa-times close-modal" onclick="closeModal('updateModal')"></i>
        </div>
        <form action="index.php?module=product&action=update" method="POST" enctype="multipart/form-data" class="form-grid">
            <input type="hidden" name="id" id="update_id" />
            <div class="form-group full-width">
                <label>Tên sản phẩm *</label>
                <input type="text" name="name" id="update_name" required />
            </div>
            <div class="form-group">
                <label>Mã SKU *</label>
                <input type="text" name="sku" id="update_sku" required />
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id" id="update_category">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Giá nhập</label>
                <input type="number" name="price_import" id="update_price" />
            </div>
            <div class="form-group">
                <label>Đơn vị</label>
                <input type="text" name="unit" id="update_unit" />
            </div>
            <div class="form-group">
                <label>Hình ảnh mới (để trống nếu giữ nguyên)</label>
                <input type="file" name="image" accept="image/*" />
            </div>
            <div class="modal-footer full-width">
                <button type="button" class="btn" style="background: #e2e8f0" onclick="closeModal('updateModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
// Hàm mở Modal và điền dữ liệu tự động cho Update
function openUpdateModal(product) {
    document.getElementById('update_id').value = product.id;
    document.getElementById('update_name').value = product.name;
    document.getElementById('update_sku').value = product.sku;
    document.getElementById('update_category').value = product.category_id;
    document.getElementById('update_price').value = product.price_import;
    document.getElementById('update_unit').value = product.unit;
    
    document.getElementById('updateModal').classList.add('active');
}

function openModal(id) { document.getElementById(id).classList.add('active'); }
function closeModal(id) { document.getElementById(id).classList.remove('active'); }
</script>