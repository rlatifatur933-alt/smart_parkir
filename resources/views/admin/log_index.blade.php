@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', sans-serif;">
    <h2 style="font-weight: 700; color: #1e293b;">
        <i class="bi bi-shield-lock-fill" style="color: #0284c7;"></i> Log Aktivitas Sistem
    </h2>
    
    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Waktu</th>
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">User ID</th>
                    <th style="padding: 12px 20px; text-align: left; border-bottom: 2px solid #e2e8f0;">Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px; color: #64748b;">{{ $log->waktu }}</td>
                    <td style="padding: 15px 20px;">#USER-0{{ $log->id_user }}</td>
                    <td style="padding: 15px 20px; font-weight: 600;">{{ $log->aktivitas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection