<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Kategori;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Transaksi filter
        $query = Transaksi::with('kategori')
            ->where('user_id', $userId)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        $transaksis = (clone $query)->latest()->get();
        
        $totalPemasukan = $transaksis->where('tipe', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksis->where('tipe', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Data for Chart (Expenses grouped by category)
        $chartData = [
            'labels' => [],
            'data' => []
        ];
        $expensesByCategory = (clone $query)->where('tipe', 'pengeluaran')
            ->selectRaw('kategori_id, SUM(jumlah) as total')
            ->groupBy('kategori_id')
            ->get();
            
        foreach ($expensesByCategory as $expense) {
            $chartData['labels'][] = $expense->kategori->nama;
            $chartData['data'][] = $expense->total;
        }

        return view('transaksi.index', compact('transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo', 'month', 'year', 'chartData'));
    }

    public function create()
    {
        $userId = auth()->id();
        $kategoris = Kategori::where('user_id', $userId)->get();
        return view('transaksi.create', compact('kategoris'));
    }

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

    public function show(Transaksi $transaksi)
    {
        //
    }

    public function edit(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== auth()->id()) {
            abort(403);
        }
        $kategoris = Kategori::where('user_id', auth()->id())->get();
        return view('transaksi.edit', compact('transaksi', 'kategoris'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        if ($transaksi->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|integer',
        ]);

        $transaksi->update($request->all());
        
        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diubah!');
    }

    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== auth()->id()) {
            abort(403);
        }

        $transaksi->delete();
        
        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus!');
    }
}
