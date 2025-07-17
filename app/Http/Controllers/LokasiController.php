<?php

namespace App\Http\Controllers;

use App\Models\lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = lokasi::all();
        return view('lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_lokasi' => 'required|string|max:255']);
        lokasi::create(['nama_lokasi' => $request->nama_lokasi]);
        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, lokasi $lokasi)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $lokasi->update(['name' => $request->name]);
        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(lokasi $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}

