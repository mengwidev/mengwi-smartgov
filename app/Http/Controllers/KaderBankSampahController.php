<?php

namespace App\Http\Controllers;

use App\Models\CfgKaderBankSampah;
use App\Models\KaderBankSampah;
use App\Models\RefJabatanCommon;
use App\Models\RefBanjar;
use App\Models\RefMonth;
use Illuminate\Http\Request;

class KaderBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banjarId = $request->input('banjar_id');
        $months = RefMonth::all();

        // Start the query
        $query = KaderBankSampah::with(['jabatan', 'banjar']);

        // Apply filtering based on banjar_id if provided
        if ($banjarId) {
            $query->where('banjar_id', $banjarId);
        }

        // Get the filtered data as a collection
        $kader = $query->orderBy('banjar_id')->orderBy('jabatan_id')->get(); // Use get() here to retrieve data

        $banjars = RefBanjar::all(); // Fetch all Banjars for the dropdown

        return view('bank_sampah.kader.index', compact('kader', 'banjars', 'months'));
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

    public function printList(Request $request)
    {
        $banjarId = $request->get('banjar_id');
        $banjar = RefBanjar::find($banjarId); // Fetch the banjar for the selected filter
        
        // Fetch kader based on the filter
        $kader = KaderBankSampah::when($banjarId, function ($query) use ($banjarId) {
            return $query->where('banjar_id', $banjarId);
        })->with(['jabatan', 'banjar'])->get(); // Ensure to eager load related models

        return view('bank_sampah.kader.print.list', compact('kader', 'banjar'));
    }

    public function printWage(Request $request)
    {
        $banjarId = $request->get('banjar_id');
        $monthId = $request->get('month_id'); // Get month_id from the request

        // Fetch the banjar for the selected filter
        $banjar = $banjarId ? RefBanjar::find($banjarId) : null;

        // Fetch kader based on the filter
        $kader = KaderBankSampah::when($banjarId, function ($query) use ($banjarId) {
            return $query->where('banjar_id', $banjarId);
        })->with(['jabatan', 'banjar'])->get();

        // Fetch honor and tax from cfg_kader_bank_sampah
        $bankSampahConfig = CfgKaderBankSampah::first();

        // Fetch the month if month_id is selected
        $month = $monthId ? RefMonth::find($monthId) : null;

        // Pass months for dropdown selection in the view
        $months = RefMonth::all();

        return view('bank_sampah.kader.print.wage', compact('kader', 'banjar', 'bankSampahConfig', 'months', 'month', 'monthId'));
    }

}