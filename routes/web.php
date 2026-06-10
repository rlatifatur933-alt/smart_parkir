<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\LogAktivitas;
use App\Models\Kendaraan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route admin
    Route::get('/admin/dashboard', function () {
        $totalUser = User::count();
        $totalArea = AreaParkir::count();
        $users = User::all();
        $areas = AreaParkir::orderBy('nama_area')->get();
        
        // ✅ TAMBAHKAN INI: Ambil 5 transaksi terakhir
        $transaksiTerakhir = Transaksi::with(['kendaraan', 'area'])
            ->latest('created_at')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUser', 
            'totalArea', 
            'users',
            'areas',
            'transaksiTerakhir' // ✅ Kirim variabel ini
        ));
    })->name('admin.dashboard');

    Route::get('/admin/user', function () {
        $semuaUser = User::all(); 
        
        return view('admin.user_index', compact('semuaUser'));
    })->name('admin.user.index');

    Route::get('/admin/user/create', function () {
        return view('admin.user_create');
    })->name('admin.user.create');

    Route::post('/admin/user', function (\Illuminate\Http\Request $request) {

        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:user,username', 
            'password'     => 'required',
            'role'         => 'required',
        ]);

        \App\Models\User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'password'     => \Hash::make($request->password), 
            'role'         => $request->role,
            'status_aktif' => 1, 
        ]);

        return redirect('/admin/user')->with('sukses', 'User baru berhasil ditambahkan!');
    })->name('admin.user.store');

    Route::get('/admin/user/{id}/edit', function ($id) {
        $user = User::where('id_user', $id)->firstOrFail();
        return view('admin.user_edit', compact('user'));
    })->name('admin.user.edit');

    Route::put('/admin/user/{id}', function (\Illuminate\Http\Request $request, $id) {
        $user = User::where('id_user', $id)->firstOrFail();
        
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'role'         => $request->role,
            'status_aktif' => $request->status_aktif,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => \Hash::make($request->password)
            ]);
        }

        return redirect('/admin/user')->with('sukses', 'Data user berhasil diperbarui!');
    })->name('admin.user.update');

    Route::delete('/admin/user/{id}', function ($id) {
        $user = User::where('id_user', $id)->first();
        
        if ($user) {
            $user->delete();
        }
    
        return redirect()->back()->with('sukses', 'Data user berhasil dihapus!');
    })->name('admin.user.destroy');

    // Route CRUD Tarif Parkir
    Route::get('/admin/tarif', function () {
        $tarif = Tarif::all();
        return view('admin.tarif_index', compact('tarif'));
    })->name('admin.tarif.index');

    Route::post('/admin/tarif', function (\Illuminate\Http\Request $request) {
        Tarif::create($request->all());
        return redirect('/admin/tarif')->with('sukses', 'Tarif berhasil ditambah!');
    })->name('admin.tarif.store');

    Route::delete('/admin/tarif/{id}', function ($id) {
        Tarif::where('id_tarif', $id)->delete();
        return redirect()->back()->with('sukses', 'Tarif berhasil dihapus!');
    })->name('admin.tarif.destroy');

    // Route CRUD Area Parkir
    Route::get('/admin/area', function () {
        $area = \App\Models\AreaParkir::all();
        return view('admin.area_index', compact('area'));
    })->name('admin.area.index');

    Route::post('/admin/area', function (\Illuminate\Http\Request $request) {
        \App\Models\AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi'    => 0, // Default awal 0
        ]);
        return redirect('/admin/area')->with('sukses', 'Area parkir berhasil ditambahkan!');
    })->name('admin.area.store');

    Route::delete('/admin/area/{id}', function ($id) {
        \App\Models\AreaParkir::where('id_area', $id)->delete();
        return redirect()->back()->with('sukses', 'Area parkir berhasil dihapus!');
    })->name('admin.area.destroy');

    // Route kendaraan 
    Route::get('/admin/kendaraan', function () {
        $kendaraan = Kendaraan::all();
        return view('admin.kendaraan_index', compact('kendaraan'));
    })->name('admin.kendaraan.index');
    
    Route::post('/admin/kendaraan', function (\Illuminate\Http\Request $request) {
        Kendaraan::create([
            'plat_nomor'      => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna,
            'pemilik'         => $request->pemilik,
            'id_user'         => auth()->id(), // Mengambil ID user yang sedang login
        ]);
        
        return redirect()->back()->with('sukses', 'Data kendaraan berhasil ditambah!');
    })->name('admin.kendaraan.store');

    Route::put('/admin/kendaraan/{id}', function (\Illuminate\Http\Request $request, $id) {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->firstOrFail();
        
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'required|string|max:100',
        ]);
        
        $kendaraan->update($validated);
        
        return redirect('/admin/kendaraan')->with('sukses', 'Data kendaraan berhasil diperbarui!');
    })->name('admin.kendaraan.update');
    
    Route::delete('/admin/kendaraan/{id}', function ($id) {
        Kendaraan::where('id_kendaraan', $id)->delete();
        return redirect()->back();
    })->name('admin.kendaraan.destroy');

    Route::get('/admin/log', function () {
        $query = LogAktivitas::with('user')->orderBy('waktu_aktivitas', 'desc');
        
        // Filter jenis aktivitas
        if (request('jenis') == 'login') {
            $query->where('aktivitas', 'like', '%Login%')
                  ->orWhere('aktivitas', 'like', '%Logout%');
        } elseif (request('jenis') == 'parkir') {
            $query->where('aktivitas', 'like', '%Kendaraan%');
        }
        
        // Filter tanggal
        if (request('tanggal')) {
            $query->whereDate('waktu_aktivitas', request('tanggal'));
        }
        
        // Filter user
        if (request('user_id')) {
            $query->where('id_user', request('user_id'));
        }
        
        $logs = $query->paginate(20);
        
        // Statistik
        $totalLogs = LogAktivitas::count();
        $totalLoginHariIni = LogAktivitas::whereDate('waktu_aktivitas', today())
            ->where('aktivitas', 'like', '%Login%')
            ->count();
        $totalParkirHariIni = LogAktivitas::whereDate('waktu_aktivitas', today())
            ->where('aktivitas', 'like', '%Kendaraan%')
            ->count();
        $totalUserAktif = LogAktivitas::whereDate('waktu_aktivitas', today())
            ->distinct('id_user')
            ->count('id_user');
        
        $users = User::all();
        
        return view('admin.log_index', compact(
            'logs', 
            'totalLogs', 
            'totalLoginHariIni', 
            'totalParkirHariIni', 
            'totalUserAktif',
            'users'
        ));
    })->name('admin.log.index');

//Route petugas
    
    Route::get('/petugas/dashboard', function () {
        $transaksiAktif = Transaksi::where('status', 'masuk')->with('kendaraan')->get();
        
        $kendaraanAktif = $transaksiAktif->count(); 

        return view('petugas.dashboard', compact('kendaraanAktif', 'transaksiAktif'));
    })->name('petugas.dashboard');

    Route::get('/petugas/cetak_struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('petugas.cetak.struk');

// Route owner
    
    Route::middleware('auth')->prefix('owner')->name('owner.')->group(function () {
        
        // Dashboard Owner - Redirect ke Log Pemasukan
        Route::get('/dashboard', function () {
            return redirect()->route('owner.log');
        })->name('dashboard');
        
        // Log Aktivitas Pemasukan
        Route::get('/log', function () {
            $query = Transaksi::with(['kendaraan', 'area', 'user'])
                ->orderBy('created_at', 'desc');
            
            // Filter tanggal
            if (request('start_date')) {
                $query->whereDate('created_at', '>=', request('start_date'));
            }
            if (request('end_date')) {
                $query->whereDate('created_at', '<=', request('end_date'));
            }
            
            // Filter status
            if (request('status')) {
                $query->where('status', request('status'));
            }
            
            $transaksis = $query->get();
            
            // Statistik
            $totalPendapatan = Transaksi::where('status', 'keluar')->sum('biaya_total');
            $pendapatanHariIni = Transaksi::where('status', 'keluar')
                ->whereDate('created_at', today())
                ->sum('biaya_total');
            $pendapatanMingguIni = Transaksi::where('status', 'keluar')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('biaya_total');
            $pendapatanBulanIni = Transaksi::where('status', 'keluar')
                ->whereMonth('created_at', now()->month)
                ->sum('biaya_total');
            
            return view('owner.log_index', compact(
                'transaksis',
                'totalPendapatan',
                'pendapatanHariIni',
                'pendapatanMingguIni',
                'pendapatanBulanIni'
            ));
        })->name('log');
    });

// ========================================
// TRANSAKSI PARKIR ROUTES
// ========================================
Route::middleware('auth')->group(function () {
    Route::get('/parkir', [TransaksiController::class, 'index'])->name('parkir.index');
    Route::post('/parkir/masuk', [TransaksiController::class, 'parkirMasuk'])->name('parkir.masuk');
    Route::post('/parkir/keluar/{id_parkir}', [TransaksiController::class, 'parkirKeluar'])->name('parkir.keluar');
    Route::get('/petugas/cetak_struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('petugas.cetak.struk');
});