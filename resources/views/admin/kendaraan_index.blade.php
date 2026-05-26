@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', sans-serif;">
    <h2 style="font-weight: 700; color: #1e293b;">
        <i class="bi bi-car-front-fill" style="color: #0284c7;"></i> Manajemen Kendaraan
    </h2>

    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
        <form action="{{ route('admin.kendaraan.store') }}" method="POST" style="margin-bottom: 30px;">
            @csrf
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <input type="text" name="plat_nomor" placeholder="Plat Nomor" required style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; flex: 1;">
                <input type="text" name="jenis_kendaraan" placeholder="Jenis" required style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; flex: 1;">
                <input type="text" name="warna" placeholder="Warna" required style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; flex: 1;">
                <input type="text" name="pemilik" placeholder="Nama Pemilik" required style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; flex: 1;">
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">Simpan</button>
            </div>
        </form>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Plat Nomor</th>
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Jenis</th>
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Warna</th>
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Pemilik</th>
                    <th style="padding: 12px 20px; text-align: center; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraan as $k)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px; font-weight: 600;">{{ $k->plat_nomor }}</td>
                    <td style="padding: 15px 20px;">{{ $k->jenis_kendaraan }}</td>
                    <td style="padding: 15px 20px;">{{ $k->warna }}</td>
                    <td style="padding: 15px 20px;">{{ $k->pemilik }}</td>
                    <td style="padding: 15px 20px; text-align: center;">
                        <form action="{{ route('admin.kendaraan.destroy', $k->id_kendaraan) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection