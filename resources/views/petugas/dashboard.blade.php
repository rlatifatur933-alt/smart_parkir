@extends('layouts.main')

@section('content')
<div style="padding: 20px;">
    <h2>Dashboard Petugas Parkir</h2>

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <h5>Input Kendaraan Masuk</h5>
        <form action="{{ route('parkir.masuk') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 10px; align-items: end;">
                <input type="text" name="plat_nomor" placeholder="Plat Nomor" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <select name="jenis_kendaraan" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                </select>
                <select name="id_area" class="form-control" required>
                    <option value="">-- Pilih Area --</option>
                    @foreach(\App\Models\AreaParkir::all() as $area)
                        <option value="{{ $area->id_area }}">
                            {{ $area->nama_area }} (Terisi: {{ $area->terisi }}/{{ $area->kapasitas }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" style="padding: 8px 15px; background: #0284c7; color: white; border: none; border-radius: 4px; cursor: pointer;">Parkir Masuk</button>
            </div>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead style="background: #f8fafc;">
            <tr>
                <th style="padding: 12px; border: 1px solid #ddd;">Plat Nomor</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Jenis</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Waktu Masuk</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiAktif ?? [] as $t)
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d/m/Y H:i') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <a href="{{ route('petugas.cetak.struk', $t->id_parkir) }}" target="_blank" style="padding: 5px 10px; background: #10b981; color: white; text-decoration: none; border-radius: 4px;">Cetak</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 20px; text-align: center; border: 1px solid #ddd;">Belum ada data kendaraan parkir.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection