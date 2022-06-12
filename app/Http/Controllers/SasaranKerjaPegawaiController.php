<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SasaranKerjaPegawai;

class SasaranKerjaPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['skp'] = SasaranKerjaPegawai::orderBy('id', 'desc')->paginate(5);
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required'
        ]);
        $skp = new SasaranKerjaPegawai;
        $skp->nama = $request->nama;
        $skp->nip = $request->nip;
        $skp->jabatan = $request->jabatan;
        $skp->save();
        return redirect()->route('pegawai.index')->with('success', 'Sasaran Kerja Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SasaranKerjaPegawai $pegawai)
    {
        return view('show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SasaranKerjaPegawai $pegawai)
    {
        return view('edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
        ]);
        $skp = SasaranKerjaPegawai::find($id);
        $skp->nama = $request->nama;
        $skp->nip = $request->nip;
        $skp->jabatan = $request->jabatan;
        $skp->save();
        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SasaranKerjaPegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index');
    }
}
