



      <!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hệ thống Quản lý Kho - WMS PRO</title>
     <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <aside class="sidebar">
        <div class="sidebar-logo">WMS PRO</div>
        <nav>
          <a href="?module=dashboard" class="nav-item active"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
          <a href="?module=product" class="nav-item"
            ><i class="fas fa-boxes"></i> Sản phẩm (SKU)</a
          >
          <a href="?module=category" class="nav-item"
            ><i class="fas fa-boxes"></i> Danh mục sản phẩm</a
          >
          <a href="?module=supplier" class="nav-item"
            ><i class="fas fa-truck-loading"></i> Nhà cung cấp</a
          >
          <a href="?module=inventory" class="nav-item"
            ><i class="fas fa-truck-loading"></i> Nhập kho</a
          >
          <a href="?module=inventory_out" class="nav-item"><i class="fas fa-dolly"></i> Xuất kho</a>
          <a href="#" class="nav-item"
            ><i class="fas fa-history"></i> Lịch sử kho</a
          >
        </nav>
      </aside>