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

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username'     => 'required|string|max:50|unique:tb_user,username', // ✅ UBAH user MENJADI tb_user
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:admin,petugas,owner',
        ], [
            'username.unique' => 'Username sudah digunakan, silakan gunakan username lain.'
        ]);
    
        \App\Models\User::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'username'     => $validated['username'],
            'password'     => \Hash::make($validated['password']), 
            'role'         => $validated['role'],
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

    Route::put('/admin/tarif/{id}', function (\Illuminate\Http\Request $request, $id) {
        $tarif = Tarif::where('id_tarif', $id)->firstOrFail();
        
        $validated = $request->validate([
            'jenis_kendaraan' => 'required|string',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);
        
        $tarif->update($validated);
        
        return redirect('/admin/tarif')->with('sukses', 'Tarif berhasil diperbarui!');
    })->name('admin.tarif.update');

    Route::delete('/admin/tarif/{id}', function ($id) {
        Tarif::where('id_tarif', $id)->delete();
        return redirect()->back()->with('sukses', 'Tarif berhasil dihapus!');
    })->name('admin.tarif.destroy');

    // Route CRUD Area Parkir
    Route::get('/admin/area', function () {
        $areas = AreaParkir::all();
        
        // Hitung statistik per area
        $areaStats = $areas->map(function($area) {
            // Transaksi masuk (status = 'masuk')
            $masuk = Transaksi::where('id_area', $area->id_area)
                ->where('status', 'masuk')
                ->count();
            
            // Transaksi keluar (status = 'keluar')
            $keluar = Transaksi::where('id_area', $area->id_area)
                ->where('status', 'keluar')
                ->count();
            
            // Total pendapatan (dari transaksi keluar)
            $pendapatan = Transaksi::where('id_area', $area->id_area)
                ->where('status', 'keluar')
                ->sum('biaya_total');
            
            return [
                'id' => $area->id_area,
                'nama' => $area->nama_area,
                'kapasitas' => $area->kapasitas,
                'terisi' => $area->terisi,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'pendapatan' => $pendapatan
            ];
        });
        
        return view('admin.area_index', compact('areaStats'));
    })->name('admin.area.index');
    
    Route::post('/admin/area', function (\Illuminate\Http\Request $request) {
        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi'    => 0,
        ]);
        return redirect('/admin/area')->with('sukses', 'Area parkir berhasil ditambahkan!');
    })->name('admin.area.store');
    
    Route::put('/admin/area/{id}', function (\Illuminate\Http\Request $request, $id) {
        $area = AreaParkir::where('id_area', $id)->firstOrFail();
        
        $validated = $request->validate([
            'nama_area' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);
        
        // Cek apakah kapasitas baru kurang dari yang terisi
        if ($request->kapasitas < $area->terisi) {
            return redirect()->back()->with('error', 'Kapasitas tidak boleh kurang dari kendaraan yang sedang parkir (' . $area->terisi . ')');
        }
        
        $area->update($validated);
        
        return redirect('/admin/area')->with('sukses', 'Area parkir berhasil diperbarui!');
    })->name('admin.area.update');
    
    Route::delete('/admin/area/{id}', function ($id) {
        $area = AreaParkir::where('id_area', $id)->first();
        
        if ($area && $area->terisi > 0) {
            return redirect()->back()->with('error', 'Area tidak bisa dihapus karena masih ada kendaraan yang parkir!');
        }
        
        AreaParkir::where('id_area', $id)->delete();
        return redirect()->back()->with('sukses', 'Area parkir berhasil dihapus!');
    })->name('admin.area.destroy');
    
    // Route untuk halaman detail area
    Route::get('/admin/area/detail/{id}', function ($id) {
        $area = AreaParkir::where('id_area', $id)->firstOrFail();
        
        // Statistik
        $masuk = Transaksi::where('id_area', $id)
            ->where('status', 'masuk')
            ->count();
        
        $keluar = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->count();
        
        $pendapatan = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->sum('biaya_total');
        
        // Kendaraan sedang parkir (masuk)
        $kendaraanMasuk = Transaksi::where('id_area', $id)
            ->where('status', 'masuk')
            ->with(['kendaraan', 'user'])
            ->orderBy('waktu_masuk', 'desc')
            ->get();
        
        // Kendaraan yang sudah keluar (semua)
        $kendaraanKeluar = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->with(['kendaraan', 'user'])
            ->orderBy('waktu_keluar', 'desc')
            ->get();
        
        return view('admin.area_detail', compact(
            'area',
            'masuk',
            'keluar',
            'pendapatan',
            'kendaraanMasuk',
            'kendaraanKeluar'
        ));
    })->name('admin.area.detail');

    // Route kendaraan 
    Route::get('/admin/kendaraan', function () {
        $kendaraan = Kendaraan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.kendaraan_index', compact('kendaraan'));
    })->name('admin.kendaraan.index');

    Route::get('/admin/kendaraan/{id}/detail', function ($id) {
        $kendaraan = Kendaraan::with('user')->findOrFail($id);
        
        // Ambil riwayat transaksi kendaraan ini
        $riwayatTransaksi = Transaksi::with(['area', 'user'])
            ->where('id_kendaraan', $id)
            ->orderBy('waktu_masuk', 'desc')
            ->get();
        
        // ✅ CEK STATUS PARKIR SAAT INI
        $sedangParkir = Transaksi::where('id_kendaraan', $id)
            ->where('status', 'masuk')
            ->exists();
        
        // Ambil petugas yang pernah menginput kendaraan ini
        $petugasList = Transaksi::with('user')
            ->where('id_kendaraan', $id)
            ->whereNotNull('id_user')
            ->select('id_user')
            ->distinct()
            ->get()
            ->pluck('user.nama_lengkap')
            ->filter()
            ->unique()
            ->values();
        
        return view('admin.kendaraan_detail', compact(
            'kendaraan', 
            'riwayatTransaksi', 
            'petugasList',
            'sedangParkir' // ✅ KIRIM VARIABEL BARU
        ));
    })->name('admin.kendaraan.detail');
    
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
            $query->where(function($q) {
                $q->where('aktivitas', 'like', '%Login%')
                  ->orWhere('aktivitas', 'like', '%Logout%')
                  ->orWhere('aktivitas', 'like', '%login%')
                  ->orWhere('aktivitas', 'like', '%logout%');
            });
        } elseif (request('jenis') == 'parkir') {
            $query->where(function($q) {
                $q->where('aktivitas', 'like', '%Kendaraan%')
                  ->orWhere('aktivitas', 'like', '%kendaraan%')
                  ->orWhere('aktivitas', 'like', '%masuk%')
                  ->orWhere('aktivitas', 'like', '%keluar%');
            });
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
            ->where(function($q) {
                $q->where('aktivitas', 'like', '%Login%')
                  ->orWhere('aktivitas', 'like', '%login%')
                  ->orWhere('aktivitas', 'like', '%Logout%')
                  ->orWhere('aktivitas', 'like', '%logout%');
            })
            ->count();
        $totalParkirHariIni = LogAktivitas::whereDate('waktu_aktivitas', today())
            ->where(function($q) {
                $q->where('aktivitas', 'like', '%Kendaraan%')
                  ->orWhere('aktivitas', 'like', '%kendaraan%')
                  ->orWhere('aktivitas', 'like', '%masuk%')
                  ->orWhere('aktivitas', 'like', '%keluar%');
            })
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
        $transaksiAktif = Transaksi::where('status', 'masuk')->with(['kendaraan', 'area'])->get();
        $kendaraanAktif = $transaksiAktif->count(); 
        
        // ✅ TAMBAHKAN DATA AREA
        $areas = AreaParkir::all();

        return view('petugas.dashboard', compact(
            'kendaraanAktif', 
            'transaksiAktif',
            'areas' // ✅ Kirim variabel areas
        )); 
    })->name('petugas.dashboard');

    // Route untuk cetak struk keluar (Petugas)
    Route::get('/petugas/cetak_struk/{id}', function ($id) {
        $transaksi = Transaksi::with(['kendaraan', 'area', 'user', 'tarif'])
            ->where('id_parkir', $id)
            ->firstOrFail();
        
        return view('petugas.cetak_struk', compact('transaksi'));
    })->name('petugas.cetak.struk');

    // Route untuk detail area petugas
    Route::get('/petugas/area/{id}', function ($id) {
        $area = AreaParkir::where('id_area', $id)->firstOrFail();
        
        $masuk = Transaksi::where('id_area', $id)
            ->where('status', 'masuk')
            ->count();
        
        $keluar = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->count();
        
        $pendapatan = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->sum('biaya_total');
        
        $kendaraanMasuk = Transaksi::where('id_area', $id)
            ->where('status', 'masuk')
            ->with(['kendaraan', 'user'])
            ->orderBy('waktu_masuk', 'desc')
            ->get();
        
        $kendaraanKeluar = Transaksi::where('id_area', $id)
            ->where('status', 'keluar')
            ->with(['kendaraan', 'user'])
            ->orderBy('waktu_keluar', 'desc')
            ->get();
        
        return view('petugas.area_detail', compact(
            'area',
            'masuk',
            'keluar',
            'pendapatan',
            'kendaraanMasuk',
            'kendaraanKeluar'
        ));
    })->name('petugas.area.detail');

    // Route untuk cek plat nomor
    Route::get('/parkir/cek-plat/{platNomor}', function ($platNomor) {
        $sudahParkir = Kendaraan::where('plat_nomor', strtoupper($platNomor))
            ->whereHas('transaksi', function($query) {
                $query->where('status', 'masuk');
            })
            ->exists();
        
        return response()->json([
            'sudahParkir' => $sudahParkir
        ]);
    });

// Route owner
    
    Route::middleware('auth')->prefix('owner')->name('owner.')->group(function () {
            
        // Dashboard Owner
        Route::get('/dashboard', function () {
            $areas = AreaParkir::all();
            
            $areaStats = $areas->map(function($area) {
                $totalPendapatan = Transaksi::where('id_area', $area->id_area)
                    ->where('status', 'keluar')
                    ->sum('biaya_total');
                
                $totalTransaksi = Transaksi::where('id_area', $area->id_area)
                    ->where('status', 'keluar')
                    ->count();
                
                $kendaraanAktif = Transaksi::where('id_area', $area->id_area)
                    ->where('status', 'masuk')
                    ->count();
                
                return [
                    'area' => $area,
                    'pendapatan' => $totalPendapatan,
                    'transaksi' => $totalTransaksi,
                    'aktif' => $kendaraanAktif
                ];
            });
            
            $totalPendapatan = Transaksi::where('status', 'keluar')->sum('biaya_total');
            $transaksiSelesai = Transaksi::whereNotNull('waktu_keluar')
                ->orderBy('waktu_keluar', 'desc')
                ->take(10)
                ->get();
        
            return view('owner.dashboard', compact('areaStats', 'totalPendapatan', 'transaksiSelesai'));
        })->name('dashboard');
        
        // Log Aktivitas Pemasukan
        Route::get('/log', function () {
            $query = Transaksi::with(['kendaraan', 'area', 'user'])
                ->orderBy('created_at', 'desc');
            
            if (request('start_date')) {
                $query->whereDate('created_at', '>=', request('start_date'));
            }
            if (request('end_date')) {
                $query->whereDate('created_at', '<=', request('end_date'));
            }
            if (request('status')) {
                $query->where('status', request('status'));
            }
            
            $transaksis = $query->get();
            
            $totalPendapatan = Transaksi::where('status', 'keluar')->sum('biaya_total');
            $pendapatanHariIni = Transaksi::where('status', 'keluar')
                ->whereDate('created_at', today())->sum('biaya_total');
            $pendapatanMingguIni = Transaksi::where('status', 'keluar')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('biaya_total');
            $pendapatanBulanIni = Transaksi::where('status', 'keluar')
                ->whereMonth('created_at', now()->month)->sum('biaya_total');
            
            return view('owner.log_index', compact(
                'transaksis',
                'totalPendapatan',
                'pendapatanHariIni',
                'pendapatanMingguIni',
                'pendapatanBulanIni'
            ));
        })->name('log'); 

        // Route untuk halaman detail area (Owner)
        Route::get('/area/detail/{id}', function ($id) {
            $area = AreaParkir::where('id_area', $id)->firstOrFail();
            
            // Statistik
            $masuk = Transaksi::where('id_area', $id)
                ->where('status', 'masuk')
                ->count();
            
            $keluar = Transaksi::where('id_area', $id)
                ->where('status', 'keluar')
                ->count();
            
            $pendapatan = Transaksi::where('id_area', $id)
                ->where('status', 'keluar')
                ->sum('biaya_total');
            
            // Kendaraan sedang parkir (masuk)
            $kendaraanMasuk = Transaksi::where('id_area', $id)
                ->where('status', 'masuk')
                ->with(['kendaraan', 'user'])
                ->orderBy('waktu_masuk', 'desc')
                ->get();
            
            // Kendaraan yang sudah keluar (semua)
            $kendaraanKeluar = Transaksi::where('id_area', $id)
                ->where('status', 'keluar')
                ->with(['kendaraan', 'user'])
                ->orderBy('waktu_keluar', 'desc')
                ->get();
            
            return view('owner.area_detail', compact(
                'area',
                'masuk',
                'keluar',
                'pendapatan',
                'kendaraanMasuk',
                'kendaraanKeluar'
            ));
        })->name('area.detail');
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