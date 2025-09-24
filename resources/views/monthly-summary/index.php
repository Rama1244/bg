<?php
ob_start();
?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Hutang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($summaries as $summary): ?>
            <tr data-nominal="<?= $summary->nominal ?>" data-hutang="<?= $summary->hutang ?>">
                <td><?= htmlspecialchars($summary->bulan) ?></td>
                <td class="currency">Rp <?= number_format($summary->nominal, 2, ',', '.') ?></td>
                <td class="currency">Rp <?= number_format($summary->hutang, 2, ',', '.') ?></td>
                <td>
                    <a href="/monthly-summary/<?= $summary->id ?>/edit" class="edit-btn">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="total-section">
    <div class="total-label">Total (Nominal - Hutang)</div>
    <div class="total-amount" id="total-amount">
        Rp <?= number_format($total, 2, ',', '.') ?>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Rekap Bulanan - Dashboard';
include __DIR__ . '/../layouts/app.php';
?>