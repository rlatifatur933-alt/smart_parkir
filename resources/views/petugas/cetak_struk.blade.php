<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Struk Parkir - {{ $transaksi->kendaraan->plat_nomor }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', monospace;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .struk-container {
            max-width: 350px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        .header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 11px;
            color: #666;
            margin: 3px 0;
        }
        
        .content {
            margin-bottom: 15px;
        }
        
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 11px;
        }
        
        .row .label {
            color: #666;
        }
        
        .row .value {
            font-weight: bold;
            text-align: right;
        }
        
        .divider {
            border-top: 2px dashed #333;
            margin: 15px 0;
        }
        
        .total {
            text-align: center;
            margin: 15px 0;
        }
        
        .total .label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .total .amount {
            font-size: 20px;
            font-weight: bold;
            color: #11998e;
        }
        
        .footer {
            text-align: center;
            border-top: 2px dashed #333;
            padding-top: 15px;
            font-size: 10px;
            color: #666;
        }
        
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: #11998e;
            color: white;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        @media print {
            @page {
                margin: 0;
                size: auto;
            }
            
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .buttons {
                display: none !important;
            }
            
            .struk-container {
                box-shadow: none;
                max-width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="struk-container">
        <div class="header">
            <h2>🅿️ SMART PARKIR</h2>
            <p>STRUK PEMBAYARAN PARKIR</p>
            <p>{{ now()->format('d M Y, H:i') }}</p>
        </div>
        
        <div class="content">
            <div class="row">
                <span class="label">Plat Nomor</span>
                <span class="value">: {{ $transaksi->kendaraan->plat_nomor }}</span>
            </div>
            <div class="row">
                <span class="label">Jenis Kendaraan</span>
                <span class="value">: {{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</span>
            </div>
            <div class="row">
                <span class="label">Area Parkir</span>
                <span class="value">: {{ $transaksi->area->nama_area ?? '-' }}</span>
            </div>
            
            <div class="divider"></div>
            
            <div class="row">
                <span class="label">Waktu Masuk</span>
                <span class="value">: {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="row">
                <span class="label">Waktu Keluar</span>
                <span class="value">: {{ \Carbon\Carbon::parse($transaksi->waktu_keluar)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="row">
                <span class="label">Durasi Parkir</span>
                <span class="value">: {{ $transaksi->durasi_jam }} Jam</span>
            </div>
            <div class="row">
                <span class="label">Tarif</span>
                <span class="value">: Rp {{ number_format($transaksi->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}/jam</span>
            </div>
            
            <div class="divider"></div>
            
            <div class="total">
                <div class="label">TOTAL BAYAR</div>
                <div class="amount">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan Smart Parkir</p>
            <p>Petugas: {{ $transaksi->user->nama_lengkap ?? '-' }}</p>
        </div>
    </div>
    
    <div class="buttons">
        <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">← Tutup</a>
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Struk</button>
    </div>
</body>
</html>