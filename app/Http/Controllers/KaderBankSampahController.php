<?php

namespace App\Http\Controllers;

use App\Models\KaderBankSampah;
use App\Models\RefJabatanCommon;
use App\Models\RefBanjar;
use Illuminate\Http\Request;

class KaderBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banjarId = $request->input('banjar_id');
        
        // Start the query
        $query = KaderBankSampah::with(['jabatan', 'banjar']);

        // Apply filtering based on banjar_id if provided
        if ($banjarId) {
            $query->where('banjar_id', $banjarId);
        }

        // Get the filtered data
        $kader = $query->orderBy('banjar_id')->orderBy('jabatan_id')->get();
        $banjars = RefBanjar::all(); // Fetch all Banjars for the dropdown

        return view('bank_sampah.kader.index', compact('kader', 'banjars'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = RefJabatanCommon::whereIn('nama_jabatan', ['Ketua', 'Anggota'])->get();
        $banjar = RefBanjar::all();
        return view('bank_sampah.kader.create', compact('jabatan', 'banjar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateKader($request);

        $this->createKaderRecord($validatedData);

        return redirect()->route('bank_sampah.kader.index')
                         ->with('success', 'Kader Bank Sampah added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(KaderBankSampah $kaderBankSampah)
    {
        return view('bank_sampah.kader.show', compact('kaderBankSampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kader = KaderBankSampah::findOrFail($id);
        $jabatan = RefJabatanCommon::whereIn('nama_jabatan', ['Ketua', 'Anggota'])->get();
        $banjar = RefBanjar::all();
        return view('bank_sampah.kader.edit', compact('kader', 'jabatan', 'banjar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kader = KaderBankSampah::findOrFail($id);

        $validatedData = $this->validateKader($request);

        $this->updateKaderRecord($kader, $validatedData);

        return redirect()->route('bank_sampah.kader.index')
                         ->with('success', 'Kader Bank Sampah successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kader = KaderBankSampah::findOrFail($id);
        $kader->delete();

        return redirect()->route('bank_sampah.kader.index')
                         ->with('success', 'Kader Bank Sampah successfully deleted');
    }

    /**
     * Validate the Kader request data.
     */
    private function validateKader(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:ref_jabatan_common,id',
            'banjar_id' => 'required|exists:ref_banjar,id',
        ]);
    }

    /**
     * Create a new Kader Bank Sampah record.
     */
    private function createKaderRecord($validatedData)
    {
        KaderBankSampah::create([
            'nama' => $validatedData['nama'],
            'jabatan_id' => $validatedData['jabatan_id'],
            'banjar_id' => $validatedData['banjar_id'],
        ]);
    }

    /**
     * Update an existing Kader Bank Sampah record.
     */
    private function updateKaderRecord($kader, $validatedData)
    {
        $kader->update([
            'nama' => $validatedData['nama'],
            'jabatan_id' => $validatedData['jabatan_id'],
            'banjar_id' => $validatedData['banjar_id'],
        ]);
    }
}
