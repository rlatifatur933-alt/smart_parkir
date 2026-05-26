<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Transaksi;
use App\Models\Tarif;

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
        
        return view('admin.dashboard', compact('totalUser', 'totalArea', 'users'));
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
        $kendaraan = \App\Models\Kendaraan::all();
        return view('admin.kendaraan_index', compact('kendaraan'));
    })->name('admin.kendaraan.index');
    
    Route::post('/admin/kendaraan', function (\Illuminate\Http\Request $request) {
        \App\Models\Kendaraan::create([
            'plat_nomor'      => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna,
            'pemilik'         => $request->pemilik,
            'id_user'         => auth()->id(), // Mengambil ID user yang sedang login
        ]);
        
        return redirect()->back()->with('sukses', 'Data kendaraan berhasil ditambah!');
    })->name('admin.kendaraan.store');
    
    Route::delete('/admin/kendaraan/{id}', function ($id) {
        \App\Models\Kendaraan::where('id_kendaraan', $id)->delete();
        return redirect()->back();
    })->name('admin.kendaraan.destroy');

    Route::get('/admin/log', function () {
        $logs = \App\Models\LogAktivitas::orderBy('waktu', 'desc')->get();
        return view('admin.log_index', compact('logs'));
    })->name('admin.log.index');

//Route petugas
    Route::get('/petugas/dashboard', function () {
        $kendaraanAktif = Transaksi::where('status', 'parkir')->count(); 
        
        $transaksiAktif = Transaksi::with('kendaraan')->where('status', 'parkir')->get();

        return view('petugas.dashboard', compact('kendaraanAktif', 'transaksiAktif'));
    })->name('petugas.dashboard');

// Route owner
    Route::get('/owner/dashboard', function () {
        $totalPendapatan = Transaksi::sum('biaya_total');
        
        $transaksiSelesai = Transaksi::whereNotNull('waktu_keluar')->orderBy('waktu_keluar', 'desc')->get();

        return view('owner.dashboard', compact('totalPendapatan', 'transaksiSelesai'));
    })->name('owner.dashboard');


Route::post('/parkir/masuk', [TransaksiController::class, 'parkirMasuk'])->name('parkir.masuk');
Route::post('/parkir/keluar/{id}', [TransaksiController::class, 'parkirKeluar'])->name('parkir.keluar');