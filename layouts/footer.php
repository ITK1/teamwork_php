      <script>
// Mở modal thêm mới
function openAddModal() {
    document.getElementById('modalTitle').innerText = "THÊM SẢN PHẨM MỚI";
    document.getElementById('productForm').reset();
    document.getElementById('prod_id').value = "";
    document.getElementById('productModal').classList.add('active');
}

// Mở modal cập nhật và đổ dữ liệu
function openEditModal(id, name, sku, cat, unit, price, status) {
    document.getElementById('modalTitle').innerText = "CẬP NHẬT SẢN PHẨM";
    document.getElementById('prod_id').value = id;
    document.getElementById('prod_name').value = name;
    document.getElementById('prod_sku').value = sku;
    document.getElementById('prod_category').value = cat;
    document.getElementById('prod_unit').value = unit;
    document.getElementById('prod_price').value = price;
    document.getElementById('prod_status').value = status;
    
    document.getElementById('productModal').classList.add('active');
}

function closeModal() {
    document.getElementById('productModal').classList.remove('active');
}

// Đóng khi click ra vùng xám
window.onclick = function(e) {
    if (e.target.classList.contains('modal-overlay')) { closeModal(); }
}
      </script>
  </body>
</html>