@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
            <i class="bi bi-tags-fill" style="color: #0284c7; margin-right: 8px;"></i> Manajemen Tarif Parkir
        </h2>
        <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Atur harga tarif per jam untuk setiap jenis kendaraan.</p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 25px;">
        
        <form action="{{ route('admin.tarif.store') }}" method="POST" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            @csrf
            <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Tarif per Jam (Rp)</label>
                    <input type="number" name="tarif_per_jam" placeholder="Contoh: 2000" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                </div>
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-plus-lg"></i> Simpan Tarif
                </button>
            </div>
        </form>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8fafc;">
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">ID</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Jenis Kendaraan</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Tarif / Jam</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tarif as $t)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px; color: #64748b;">{{ $t->id_tarif }}</td>
                    <td style="padding: 15px 20px; font-weight: 600; text-transform: capitalize;">{{ $t->jenis_kendaraan }}</td>
                    <td style="padding: 15px 20px; color: #059669; font-weight: bold;">Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}</td>
                    <td style="padding: 15px 20px; text-align: center;">
                        <form action="{{ route('admin.tarif.destroy', $t->id_tarif) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 9pt; cursor: pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection