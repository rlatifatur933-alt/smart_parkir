@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
            <i class="bi bi-geo-alt-fill" style="color: #0284c7; margin-right: 8px;"></i> Manajemen Area Parkir
        </h2>
        <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Kelola data lokasi dan kapasitas area parkir.</p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 25px;">
        
        <form action="{{ route('admin.area.store') }}" method="POST" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            @csrf
            <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div style="flex: 2; min-width: 200px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Nama Area</label>
                    <input type="text" name="nama_area" placeholder="Contoh: Blok A" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Kapasitas</label>
                    <input type="number" name="kapasitas" placeholder="Contoh: 50" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                </div>
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-plus-lg"></i> Simpan Area
                </button>
            </div>
        </form>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8fafc;">
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">ID</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Nama Area</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Kapasitas</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Terisi</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($area as $a)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px; color: #64748b;">{{ $a->id_area }}</td>
                    <td style="padding: 15px 20px; font-weight: 600;">{{ $a->nama_area }}</td>
                    <td style="padding: 15px 20px;">{{ $a->kapasitas }}</td>
                    <td style="padding: 15px 20px;">
                        <span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-weight: bold; color: #475569;">
                            {{ $a->terisi }}
                        </span>
                    </td>
                    <td style="padding: 15px 20px; text-align: center;">
                        <form action="{{ route('admin.area.destroy', $a->id_area) }}" method="POST">
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