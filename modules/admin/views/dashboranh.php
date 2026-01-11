      <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-center mb-8">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Tổng quan kho</h1>
            <p class="text-gray-500">
              Chào mừng Admin, hôm nay có 5 phiếu nhập mới.
            </p>
          </div>
          <div class="flex items-center space-x-4">
            <span
              class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium"
            >
              <i class="fas fa-bell"></i> 3 Cảnh báo tồn thấp
            </span>
            <img
              src="https://ui-avatars.com/api/?name=Admin"
              class="w-10 h-10 rounded-full border-2 border-white shadow"
            />
          </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div
            class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 card-stats transition-all"
          >
            <p class="text-sm text-gray-500 uppercase font-bold">Tổng SKU</p>
            <p class="text-2xl font-bold text-gray-800">1,250</p>
          </div>
          <div
            class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 card-stats transition-all"
          >
            <p class="text-sm text-gray-500 uppercase font-bold">
              Nhập tháng này
            </p>
            <p class="text-2xl font-bold text-gray-800">450</p>
          </div>
          <div
            class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500 card-stats transition-all"
          >
            <p class="text-sm text-gray-500 uppercase font-bold">
              Xuất tháng này
            </p>
            <p class="text-2xl font-bold text-gray-800">312</p>
          </div>
          <div
            class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 card-stats transition-all"
          >
            <p class="text-sm text-gray-500 uppercase font-bold">
              Tồn kho thấp
            </p>
            <p class="text-2xl font-bold text-gray-800 text-yellow-600">12</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
          <div
            class="p-6 border-b border-gray-100 flex justify-between items-center"
          >
            <h3 class="font-bold text-gray-800 text-lg">
              Lịch sử giao dịch gần đây
            </h3>
            <button
              class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
            >
              Tải báo cáo
            </button>
          </div>
          <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
              <tr>
                <th class="p-4 font-semibold text-gray-600">Ngày</th>
                <th class="p-4 font-semibold text-gray-600">Loại</th>
                <th class="p-4 font-semibold text-gray-600">Sản phẩm</th>
                <th class="p-4 font-semibold text-gray-600">Số lượng</th>
                <th class="p-4 font-semibold text-gray-600">Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-gray-50 hover:bg-gray-50">
                <td class="p-4 text-gray-600">2023-10-27</td>
                <td class="p-4">
                  <span class="text-green-600 font-medium">NHẬP</span>
                </td>
                <td class="p-4 text-gray-800 font-medium">Thùng Carton A1</td>
                <td class="p-4">+ 100</td>
                <td class="p-4">
                  <span
                    class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs"
                    >Thành công</span
                  >
                </td>
              </tr>
              <tr class="border-b border-gray-50 hover:bg-gray-50">
                <td class="p-4 text-gray-600">2023-10-27</td>
                <td class="p-4">
                  <span class="text-red-600 font-medium">XUẤT</span>
                </td>
                <td class="p-4 text-gray-800 font-medium">Keo 502</td>
                <td class="p-4">- 20</td>
                <td class="p-4">
                  <span
                    class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs"
                    >Thành công</span
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>