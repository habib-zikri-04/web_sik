<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\Subject;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['kelas', 'pengajar', 'subject'])->orderByDesc('tanggal')->orderBy('jam_mulai');
        
        // Filter by date if provided
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        
        // Filter by kelas if provided
        if ($request->has('kelas_id') && $request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }
        
        $jadwals = $query->paginate(20);
        $kelasList = Kelas::orderBy('nama')->get();
        
        return view('admin.jadwal.index', compact('jadwals', 'kelasList'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama')->get();
        $pengajars = Pengajar::orderBy('nama')->get();
        $subjects = Subject::orderBy('nama')->get();
        
        return view('admin.jadwal.create', compact('kelas', 'pengajars', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'pengajar_id' => 'nullable|exists:pengajars,id',
            'subject_id' => 'required|exists:subjects,id',
            'ruang' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'sesi' => 'nullable|integer|min:0|max:3',
        ]);

        // Auto-determine sesi from jam_mulai if not provided
        if (!isset($validated['sesi'])) {
            $validated['sesi'] = $this->determineSesi($validated['jam_mulai']);
        }

        $jadwal = Jadwal::create($validated);

        return redirect()->route('admin.jadwal.show', $jadwal)
            ->with('success', 'Jadwal berhasil dibuat! QR Code siap digunakan.');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['kelas', 'pengajar', 'subject']);
        
        // Generate QR Code for this jadwal
        $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'presensi.scan',
            now()->addMinutes(10),
            ['jadwal_id' => $jadwal->id]
        );
        
        $qrCode = QrCode::size(300)->generate($url);
        
        return view('admin.jadwal.show', compact('jadwal', 'qrCode'));
    }

    public function edit(Jadwal $jadwal)
    {
        $kelas = Kelas::orderBy('nama')->get();
        $pengajars = Pengajar::orderBy('nama')->get();
        $subjects = Subject::orderBy('nama')->get();
        
        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'pengajars', 'subjects'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'pengajar_id' => 'nullable|exists:pengajars,id',
            'subject_id' => 'required|exists:subjects,id',
            'ruang' => 'nullable|string|max:50',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'sesi' => 'nullable|integer|min:0|max:3',
        ]);

        if (!isset($validated['sesi'])) {
            $validated['sesi'] = $this->determineSesi($validated['jam_mulai']);
        }

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }

    /**
     * Determine sesi based on jam_mulai
     */
    private function determineSesi(string $jamMulai): int
    {
        $hour = (int) substr($jamMulai, 0, 2);
        
        if ($hour < 9) return 0;      // Mengaji
        if ($hour < 11) return 1;     // Sesi 1
        if ($hour < 14) return 2;     // Sesi 2
        return 3;                      // Sesi 3
    }
}
