<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Civitas;
use App\Models\Subject;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('email', 'ILIKE', "%{$search}%");
            });
        }
        
        $users = $query->orderByDesc('created_at')->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('nama')->get();
        $kelasList = Kelas::orderBy('nama')->get();
        
        return view('admin.users.create', compact('subjects', 'kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:santri,guru,civitas'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        // Create role-specific record
        switch ($validated['role']) {
            case 'santri':
                Santri::create([
                    'user_id' => $user->id,
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                    'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                    'kelas_id' => $validated['kelas_id'] ?? null,
                ]);
                break;
                
            case 'guru':
                Pengajar::create([
                    'user_id' => $user->id,
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                    'subject_id' => $validated['subject_id'] ?? null,
                ]);
                break;
                
            case 'civitas':
                Civitas::create([
                    'user_id' => $user->id,
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                ]);
                break;
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun ' . ucfirst($validated['role']) . ' berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        $user->load(['santri', 'pengajar', 'civitas']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load(['santri', 'pengajar', 'civitas']);
        $subjects = Subject::orderBy('nama')->get();
        $kelasList = Kelas::orderBy('nama')->get();
        
        return view('admin.users.edit', compact('user', 'subjects', 'kelasList'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
        ]);

        // Update user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Update role-specific record
        switch ($user->role) {
            case 'santri':
                $user->santri?->update([
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                    'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                    'kelas_id' => $validated['kelas_id'] ?? null,
                ]);
                break;
                
            case 'guru':
                $user->pengajar?->update([
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                    'subject_id' => $validated['subject_id'] ?? null,
                ]);
                break;
                
            case 'civitas':
                $user->civitas?->update([
                    'nama' => $validated['name'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                ]);
                break;
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }
        
        // Delete role-specific records first
        $user->santri?->delete();
        $user->pengajar?->delete();
        $user->civitas?->delete();
        
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus!');
    }
}
