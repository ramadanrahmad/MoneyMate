<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Kategori;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $transaksis = Transaksi::with('kategori')->where('user_id', $userId)->latest()->get();
        
        $totalPemasukan = $transaksis->where('tipe', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksis->where('tipe', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.index', compact('transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = auth()->id();
        $kategoris = Kategori::where('user_id', $userId)->get();
        return view('transaksi.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|integer',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        Transaksi::create($data);
        
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
