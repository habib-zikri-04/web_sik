<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Santri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = Jadwal::with(['kelas', 'pengajar'])->get();

        if ($jadwals->isEmpty()) {
            $this->command->warn('Tidak ada jadwal, absensi tidak dibuat.');
            return;
        }

        foreach ($jadwals as $jadwal) {

            // =====================
            // SESI 0 (MENGAJI UMUM)
            // =====================
            if ($jadwal->sesi === 0) {
                $users = User::whereIn('role', ['santri', 'guru', 'civitas'])->get();
            }

            // =====================
            // SESI KELAS
            // =====================
            else {
                $users = collect();

                // santri sesuai kelas
                if ($jadwal->kelas_id) {
                    $santriUsers = Santri::where('kelas_id', $jadwal->kelas_id)
                        ->with('user')
                        ->get()
                        ->pluck('user');

                    $users = $users->merge($santriUsers);
                }

                // pengajar jadwal
                if ($jadwal->pengajar) {
                    $users->push($jadwal->pengajar->user);
                }
            }

            foreach ($users->unique('id') as $user) {

                // skip kalau sudah ada
                if (Absensi::where('jadwal_id', $jadwal->id)
                    ->where('user_id', $user->id)
                    ->exists()) {
                    continue;
                }

                // 90% hadir
                $status = rand(1, 100) <= 90 ? 'hadir' : 'alpa';

                // waktu absen
                $tanggal = Carbon::parse($jadwal->tanggal);
                $mulai   = Carbon::parse($jadwal->jam_mulai);
                $selesai = Carbon::parse($jadwal->jam_selesai);

                $waktuAbsen = $tanggal
                    ->copy()
                    ->setTimeFrom($mulai)
                    ->addMinutes(rand(0, $mulai->diffInMinutes($selesai)));

                Absensi::create([
                    'jadwal_id'   => $jadwal->id,
                    'user_id'     => $user->id,
                    'role'        => $user->role,
                    'status'      => $status,
                    'waktu_absen' => $waktuAbsen,
                ]);
            }
        }

        $this->command->info('Seeder absensi realistis berhasil dibuat.');
    }
}
