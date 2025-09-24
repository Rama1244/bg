<?php

namespace App\Http\Controllers;

use App\Models\MonthlySummary;

class MonthlySummaryController
{
    public function index()
    {
        $summaries = MonthlySummary::all();
        $total = 0;
        
        foreach ($summaries as $summary) {
            $total += ($summary->nominal - $summary->hutang);
        }
        
        return $this->view('monthly-summary.index', [
            'summaries' => $summaries,
            'total' => $total
        ]);
    }
    
    public function edit($id)
    {
        $summary = MonthlySummary::find($id);
        
        if (!$summary) {
            header('HTTP/1.0 404 Not Found');
            echo 'Data tidak ditemukan';
            exit;
        }
        
        return $this->view('monthly-summary.edit', [
            'summary' => $summary
        ]);
    }
    
    public function update($id)
    {
        $summary = MonthlySummary::find($id);
        
        if (!$summary) {
            header('HTTP/1.0 404 Not Found');
            echo 'Data tidak ditemukan';
            exit;
        }
        
        $summary->nominal = floatval($_POST['nominal'] ?? 0);
        $summary->hutang = floatval($_POST['hutang'] ?? 0);
        
        if ($summary->save()) {
            header('Location: /');
            exit;
        } else {
            echo 'Gagal menyimpan data';
        }
    }
    
    private function view($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../../../resources/views/' . str_replace('.', '/', $view) . '.php';
        
        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            return ob_get_clean();
        } else {
            return "View tidak ditemukan: $view";
        }
    }
}