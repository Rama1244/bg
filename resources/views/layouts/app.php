<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Rekap Bulanan' ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        .currency {
            text-align: right;
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }
        
        .edit-btn {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            display: inline-block;
            transition: background-color 0.2s;
        }
        
        .edit-btn:hover {
            background: #0056b3;
        }
        
        .total-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .total-amount {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        
        .total-label {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #495057;
        }
        
        input[type="number"], input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        
        input:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            margin: 5px;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 0.9rem;
            }
            
            .currency {
                font-size: 0.85rem;
            }
            
            .total-amount {
                font-size: 2rem;
            }
            
            .edit-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
        
        @media (max-width: 480px) {
            th, td {
                padding: 8px 5px;
                font-size: 0.8rem;
            }
            
            .edit-btn {
                padding: 5px 10px;
                font-size: 0.75rem;
            }
            
            .total-amount {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Rekap Bulanan</h1>
            <p>Sistem Pencatatan Nominal dan Hutang Bulanan</p>
        </div>
        
        <?= $content ?? '' ?>
    </div>
    
    <script>
        // Auto-calculate total when values change
        function updateTotal() {
            const rows = document.querySelectorAll('tr[data-nominal][data-hutang]');
            let total = 0;
            
            rows.forEach(row => {
                const nominal = parseFloat(row.getAttribute('data-nominal')) || 0;
                const hutang = parseFloat(row.getAttribute('data-hutang')) || 0;
                total += (nominal - hutang);
            });
            
            const totalElement = document.getElementById('total-amount');
            if (totalElement) {
                totalElement.textContent = 'Rp ' + total.toLocaleString('id-ID', {minimumFractionDigits: 2});
            }
        }
        
        // Format currency inputs
        function formatCurrency(input) {
            let value = input.value.replace(/[^\d.-]/g, '');
            if (value) {
                input.value = parseFloat(value).toLocaleString('id-ID', {minimumFractionDigits: 2});
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script>
</body>
</html>