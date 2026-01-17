      <script>
        // Đóng/Mở Modal
function openModal(modalId) { document.getElementById(modalId).classList.add("active"); }
function closeModal(modalId) { document.getElementById(modalId).classList.remove("active"); }

// Mở modal update và đổ dữ liệu mẫu
function openUpdateModal(id) {
    // Dữ liệu giả lập - Trong thực tế dùng Fetch API lấy từ DB
    document.getElementById("update_id").value = id;
    document.getElementById("update_name").value = "Máy khoan Bosch GSB 550";
    document.getElementById("update_sku").value = "BSH-550";
    document.getElementById("update_price").value = 1250000;
    openModal('updateModal');
}

// Tìm kiếm nhanh trong bảng
function filterTable() {
    let input = document.getElementById("searchInput").value.toUpperCase();
    let tr = document.getElementById("productTable").getElementsByTagName("tr");
    for (let i = 1; i < tr.length; i++) {
        let found = false;
        let td = tr[i].getElementsByTagName("td");
        for (let j = 0; j < td.length; j++) {
            if (td[j] && td[j].innerText.toUpperCase().indexOf(input) > -1) { found = true; }
        }
        tr[i].style.display = found ? "" : "none";
    }
}

// Đóng modal khi click ra ngoài vùng modal-box
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.classList.remove('active');
    }
}
      </script>
  </body>
</html>