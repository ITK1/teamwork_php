<main class="main-content">
    <div class="grid-stats">
    <div class="stat-card blue">
        <p class="stat-title">Tổng sản phẩm</p>
        <div class="stat-value"><?= number_format($stats['total_products'] ?? 0) ?> <span class="stat-unit">SKU</span></div>
        <i class="fas fa-boxes stat-bg-icon"></i>
    </div>

    <div class="stat-card green">
        <p class="stat-title">Nhập kho tháng </p>
        <div class="stat-value"><?= number_format($stats['import_this_month'] ?? 0) ?><span class="stat-unit">phiếu</span></div>
        <i class="fas fa-file-import stat-bg-icon"></i>
    </div>

    <div class="stat-card red">
        <p class="stat-title">Xuất kho tháng</p>
        <div class="stat-value"><?= number_format($stats['export_this_month'] ?? 0) ?> <span class="stat-unit">phiếu</span></div>
        <i class="fas fa-file-export stat-bg-icon"></i>
    </div>

    <div class="stat-card yellow">
        <p class="stat-title">Tồn kho</p>
        <div class="stat-value" style="color: #f59e0b;"><?= $stats['low_stock_count'] ?? 0 ?> <span class="stat-unit">SKU</span></div>
        <i class="fas fa-exclamation-triangle stat-bg-icon"></i>
    </div>
</div>

    <div class="dashboard-grid">
        <div class="card">
            <div class="card-header">
                <h3>
                    <i class="fas fa-triangle-exclamation" style="color: #f59e0b; margin-right: 8px"></i>
                    TỒN KHO THẤP
                </h3>
            </div>
            <table class="table-custom">
                <tbody>
                    <?php if (!empty($low_stock)): foreach($low_stock as $ls): ?>
                    <tr>
                        <td style="font-weight: 600; color: var(--text-dark)">
                            <?= htmlspecialchars($ls['name']) ?>
                            <br />
                            <small style="color: var(--text-light)"><?= htmlspecialchars($ls['sku']) ?></small>
                        </td>
                        <td style="color: #ef4444; font-weight: 800; text-align: right">
                            <?= $ls['quantity'] ?> <?= htmlspecialchars($ls['unit']) ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="2" style="text-align: center; padding: 20px;">Kho hàng ổn định</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>
                    <i class="fas fa-clock-rotate-left" style="color: var(--primary); margin-right: 8px"></i>
                    HOẠT ĐỘNG GẦN ĐÂY
                </h3>
                
            </div>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Loại</th>
                        <th>Sản phẩm</th>
                        <th style="text-align: right">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_activities)): foreach($recent_activities as $ra): ?>
                    <tr>
                        <td style="color: var(--text-light); font-size: 12px; font-weight: 600;">
                            <?= date('H:i d/m', strtotime($ra['created_at'])) ?>
                        </td>
                        <td>
                            <span class="badge-status <?= strtolower($ra['type']) ?>" 
                                  style="padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; 
                                         background: <?= $ra['type'] == 'IN' ? '#dcfce7' : '#fee2e2' ?>; 
                                         color: <?= $ra['type'] == 'IN' ? '#166534' : '#991b1b' ?>;">
                                <?= $ra['type'] == 'IN' ? 'NHẬP' : 'XUẤT' ?>
                            </span>
                        </td>
                        <td style="font-weight: 700; color: var(--text-dark)">
                            <?= htmlspecialchars($ra['product_name']) ?>
                        </td>
                        <td style="text-align: right; font-weight: 800; color: <?= $ra['type'] == 'IN' ? '#10b981' : '#f43f5e' ?>;">
                            <?= $ra['type'] == 'IN' ? '+' : '-' ?><?= number_format($ra['quantity']) ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="4" style="text-align: center; padding: 20px;">Chưa có giao dịch kho</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>