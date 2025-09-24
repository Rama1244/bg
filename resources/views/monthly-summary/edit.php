<?php
ob_start();
?>

<div class="form-container">
    <h2 style="margin-bottom: 25px; text-align: center; color: #495057;">
        Edit Data - <?= htmlspecialchars($summary->bulan) ?>
    </h2>
    
    <form method="POST" action="/monthly-summary/<?= $summary->id ?>">
        
        <div class="form-group">
            <label for="bulan">Bulan:</label>
            <input type="text" id="bulan" name="bulan" value="<?= htmlspecialchars($summary->bulan) ?>" readonly style="background-color: #f8f9fa;">
        </div>
        
        <div class="form-group">
            <label for="nominal">Nominal (Rp):</label>
            <input type="number" id="nominal" name="nominal" value="<?= $summary->nominal ?>" step="0.01" min="0" required 
                   placeholder="0.00">
        </div>
        
        <div class="form-group">
            <label for="hutang">Hutang (Rp):</label>
            <input type="number" id="hutang" name="hutang" value="<?= $summary->hutang ?>" step="0.01" min="0" required 
                   placeholder="0.00">
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="/" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
// Real-time calculation preview
function updatePreview() {
    const nominal = parseFloat(document.getElementById('nominal').value) || 0;
    const hutang = parseFloat(document.getElementById('hutang').value) || 0;
    const total = nominal - hutang;
    
    let previewElement = document.getElementById('preview-total');
    if (!previewElement) {
        previewElement = document.createElement('div');
        previewElement.id = 'preview-total';
        previewElement.style.cssText = 'margin-top: 15px; padding: 10px; background: #f8f9fa; border-radius: 5px; text-align: center; font-weight: bold;';
        document.querySelector('.form-container form').appendChild(previewElement);
    }
    
    previewElement.innerHTML = `Preview Total: <span style="color: ${total >= 0 ? '#28a745' : '#dc3545'}">Rp ${total.toLocaleString('id-ID', {minimumFractionDigits: 2})}</span>`;
}

document.getElementById('nominal').addEventListener('input', updatePreview);
document.getElementById('hutang').addEventListener('input', updatePreview);

// Initialize preview
document.addEventListener('DOMContentLoaded', updatePreview);
</script>

<?php
$content = ob_get_clean();
$title = 'Edit Data - ' . $summary->bulan;
include __DIR__ . '/../layouts/app.php';
?>