
        <div class="toolbar">
          <div class="search-box">
            <input
              type="text"
              id="searchInput"
              class="input-control"
              placeholder="Tìm theo SKU hoặc tên..."
            />
            <select class="input-control">
              <option value="">Tất cả danh mục</option>
              <option value="1">Vật liệu xây dựng</option>
              <option value="2">Dụng cụ điện</option>
            </select>
            <button class="btn btn-primary" onclick="filterTable()">
              Tìm kiếm
            </button>
          </div>
          <button class="btn btn-primary">
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
                <th>Cat ID</th>
                <th>ĐVT</th>
                <th>Giá nhập</th>
                <th>Tồn kho</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($product as $item): ?>
                <tr>
                    <td class="text-bold"><?= $item['id'] ?></td>
                    <td>
                      <img
                        src="https://via.placeholder.com/80"
                        class="img-product"
                        alt="SP"
                      />
                    </td>
                    <td class="text-bold"><?= $item['name'] ?></td>
                    <td><span class="sku-badge"><?= $item['sku'] ?></span></td>
                    <td>5</td>
                    <td>Cái</td>
                       <td class="text-bold"><?= $item['price_import'] ?></td>
                    <td class="text-bold"><?= $item['quantity'] ?></td>
                    <td><?= $item['created_at'] ?></td>
                    <td>
                      <button class="btn"><i class="fas fa-edit"></i></button>
                      <button class="btn"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
            <?php endforeach; ?>


              <!-- <tr>
                <td class="text-bold">1</td>
                <td>
                  <img
                    src="https://via.placeholder.com/80"
                    class="img-product"
                    alt="SP"
                  />
                </td>
                <td class="text-bold">Máy khoan Bosch GSB 550</td>
                <td><span class="sku-badge">BSH-550</span></td>
                <td>5</td>
                <td>Cái</td>
                <td class="text-bold">1,250,000đ</td>
                <td class="text-bold">120</td>
                <td>2024-05-10</td>
                <td>
                  <button class="btn"><i class="fas fa-edit"></i></button>
                  <button class="btn"><i class="fas fa-trash"></i></button>
                </td>
              </tr> -->
            </tbody>
          </table>

          <div class="pagination-container">
            <p class="text-bold">Hiển thị 1 - 10 / 150</p>
            <div class="pagination">
              <a href="#" class="page-item"
                ><i class="fas fa-chevron-left"></i
              ></a>
              <a href="#" class="page-item active">1</a>
              <a href="#" class="page-item">2</a>
              <a href="#" class="page-item"
                ><i class="fas fa-chevron-right"></i
              ></a>
            </div>
          </div>
        </div>
      </main>
    </div>

    <script src="script.js"></script>
  </body>
</html>

