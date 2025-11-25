<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\MultipleUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Daftar kolom yang bisa di filter sesusai name pada form
        $filterableColums = ['gender'];

        $searchableColums = ['first_name'];

        // Guana
        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColums)
        ->search($request, $searchableColums)
        ->paginate(10)->withQueryString();
        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        $pelanggan = Pelanggan::create($data);

        // Handle multiple file upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->store('pelanggan-files', 'public');

                MultipleUpload::create([
                    'filename' => $filename,
                    'ref_table' => 'pelanggan',
                    'ref_id' => $pelanggan->pelanggan_id
                ]);
            }
        }

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.show', $data);
    }

    /**
     *  Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan    = Pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();

        // Handle multiple file upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->store('pelanggan-files', 'public');

                MultipleUpload::create([
                    'filename' => $filename,
                    'ref_table' => 'pelanggan',
                    'ref_id' => $pelanggan->pelanggan_id
                ]);
            }
        }

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Hapus file terkait
        foreach ($pelanggan->files as $file) {
            if (Storage::exists('public/' . $file->filename)) {
                Storage::delete('public/' . $file->filename);
            }
            $file->delete();
        }

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /**
     * Delete single file
     */
    public function deleteFile(string $id)
    {
        $file = MultipleUpload::findOrFail($id);

        if (Storage::exists('public/' . $file->filename)) {
            Storage::delete('public/' . $file->filename);
        }

        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus!');
    }
}
