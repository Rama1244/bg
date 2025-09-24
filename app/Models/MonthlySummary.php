<?php

namespace App\Models;

class MonthlySummary
{
    protected $fillable = ['bulan', 'nominal', 'hutang'];
    
    public $id;
    public $bulan;
    public $nominal;
    public $hutang;
    
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
    
    public static function all()
    {
        $pdo = self::getConnection();
        $stmt = $pdo->query("SELECT * FROM monthly_summaries ORDER BY id");
        $results = [];
        
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = new self($row);
        }
        
        return $results;
    }
    
    public static function find($id)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM monthly_summaries WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($row) {
            return new self($row);
        }
        
        return null;
    }
    
    public function save()
    {
        $pdo = self::getConnection();
        
        if ($this->id) {
            $stmt = $pdo->prepare("UPDATE monthly_summaries SET bulan = ?, nominal = ?, hutang = ? WHERE id = ?");
            return $stmt->execute([$this->bulan, $this->nominal, $this->hutang, $this->id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO monthly_summaries (bulan, nominal, hutang) VALUES (?, ?, ?)");
            $result = $stmt->execute([$this->bulan, $this->nominal, $this->hutang]);
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            return $result;
        }
    }
    
    public static function createTable()
    {
        $pdo = self::getConnection();
        $sql = "CREATE TABLE IF NOT EXISTS monthly_summaries (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            bulan VARCHAR(20) NOT NULL,
            nominal DECIMAL(15,2) DEFAULT 0.00,
            hutang DECIMAL(15,2) DEFAULT 0.00,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        
        return $pdo->exec($sql);
    }
    
    public static function seedData()
    {
        $months = [
            'September 2025', 'Oktober 2025', 'November 2025', 'Desember 2025',
            'Januari 2026', 'Februari 2026', 'Maret 2026', 'April 2026',
            'Mei 2026', 'Juni 2026', 'Juli 2026', 'Agustus 2026',
            'September 2026', 'Oktober 2026', 'November 2026', 'Desember 2026'
        ];
        
        $pdo = self::getConnection();
        
        // Check if data already exists
        $stmt = $pdo->query("SELECT COUNT(*) FROM monthly_summaries");
        if ($stmt->fetchColumn() > 0) {
            return; // Data already exists
        }
        
        foreach ($months as $month) {
            $summary = new self([
                'bulan' => $month,
                'nominal' => 0.00,
                'hutang' => 0.00
            ]);
            $summary->save();
        }
    }
    
    private static function getConnection()
    {
        static $pdo = null;
        
        if ($pdo === null) {
            $dbPath = __DIR__ . '/../../database/database.sqlite';
            $pdo = new \PDO('sqlite:' . $dbPath);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        
        return $pdo;
    }
    
    public function getTotalAttribute()
    {
        return $this->nominal - $this->hutang;
    }
}