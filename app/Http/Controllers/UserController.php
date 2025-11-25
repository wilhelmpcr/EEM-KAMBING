<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = user::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Upload Foto - PERBAIKI INI
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = user::findOrFail($id);
        return view('admin.user.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    // app/Http/Controllers/UserController.php - Update method
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'            => 'required|string',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|max:2048',
            'remove_photo'    => 'nullable',
        ]);

        // Handle hapus foto
        if ($request->has('remove_photo')) {
            if ($user->profile_picture && \Illuminate\Support\Facades\Storage::exists('public/' . $user->profile_picture)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $user->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        // Handle upload foto baru
        if ($request->hasFile('profile_picture')) {
            // Hapus file lama jika ada
            if ($user->profile_picture && \Illuminate\Support\Facades\Storage::exists('public/' . $user->profile_picture)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $user->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        { $user = user::findOrFail($id);

            $user->delete();
            return redirect()->route('user.index')->with('succes', 'Perubahan Data Dihapus');}
    }
}
