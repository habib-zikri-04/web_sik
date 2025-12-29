<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\User;

class SantrisSeeder extends Seeder
{
    private function normalizeKelompok(string $nama): string
    {
        $nama = trim($nama);

        // Satukan penulisan "Berdayaguna" -> "Berdaya Guna"
        if (stripos($nama, 'Berdaya') !== false) {
            return 'Berdaya Guna';
        }

        // Ambil "Teknologi" saja, buang "Teknologi Mengulang - ..."
        if (stripos($nama, 'Teknologi') !== false) {
            return 'Teknologi';
        }

        return $nama;
    }

    public function run(): void
    {
        // Sumber: PDF Pembagian Kelompok SIK 1 Ganjil 2025-2026 (179 baris)
        $rows = [
            ['nim' => '2517010001', 'nama' => "Hibatullah Zharifah Madrikoto", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010002', 'nama' => "Rafikatun Hasanah", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010003', 'nama' => "Nelvi Harisa", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010004', 'nama' => "Gina Putri Yanti", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010005', 'nama' => "Shintia Putri Rahayu", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010006', 'nama' => "Muhamad Zafar Aprilio", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010007', 'nama' => "Irwansyah", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010008', 'nama' => "Febrina Islamia Zahri", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010009', 'nama' => "Fitri Nabila Siregar", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010010', 'nama' => "Alfarabi Ananda Putra", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010011', 'nama' => "Fifia Erdiyanti", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517010012', 'nama' => "Muhammad Rayhan", 'kelompok' => "Menjadi Imam"],
            ['nim' => '2517020001', 'nama' => "Hesty Syawallina", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020002', 'nama' => "Diva Irawan", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020003', 'nama' => "Putri Mandasari", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020004', 'nama' => "Alfinardi", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020005', 'nama' => "Kristna Jatma Lastri", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020006', 'nama' => "Zikra Mahendra", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020007', 'nama' => "Fadillah Rezki Vanya", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020008', 'nama' => "Nayla Wulan Sari", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020009', 'nama' => "Fahri Aswir", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020010', 'nama' => "Rhadistya Avindhyka Putri", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020011', 'nama' => "Chelsea Vanisa Putri", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020012', 'nama' => "Natasya", 'kelompok' => "Menginspirasi Semesta"],
            ['nim' => '2517020013', 'nama' => "Ditya Distharia Hasibuan", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020014', 'nama' => "Fadhilla Navisya", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020015', 'nama' => "Sifa Hairani", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020016', 'nama' => "Iwan Styawan", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020017', 'nama' => "Mulkan Ritonga", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020018', 'nama' => "Rofiatul Uliyah", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020019', 'nama' => "Shintia Rahmadani", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020020', 'nama' => "M. Batari Hasibuan", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020021', 'nama' => "Alya", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020022', 'nama' => "Raden Ayu Keylha Maharani", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020023', 'nama' => "Mhd Ridwan", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020024', 'nama' => "Fazira", 'kelompok' => "Cepat dan Adaptif"],
            ['nim' => '2517020025', 'nama' => "Marliani Putri", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020026', 'nama' => "Wulan Efrina", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020027', 'nama' => "Fitri Ramadhani", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020028', 'nama' => "Zikra Prawira Bastian", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020029', 'nama' => "Sofia", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020030', 'nama' => "Amaliya Azahra", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020031', 'nama' => "Syifa Mawaddah Rkt", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020032', 'nama' => "M. Khoirullah", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020033', 'nama' => "Arvi Rifqi Fisabilah", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020034', 'nama' => "Domika Putra", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020035', 'nama' => "Dina Kurnia", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020036', 'nama' => "Daffa Budiananta", 'kelompok' => "Solutif dan Edukatif"],
            ['nim' => '2517020037', 'nama' => "Faiz Rialdi Al Akbar", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020038', 'nama' => "Cindy Aulia Salsabila Harahap", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020039', 'nama' => "Yolanda Andhika", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020040', 'nama' => "Aisya Okta Ramadhani H", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020041', 'nama' => "Kuntum Khairah Ummah", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020042', 'nama' => "Ulandari Rahmadani", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020043', 'nama' => "Rahel Jumadil", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020044', 'nama' => "Muhammad Raja Malin Chandra", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020045', 'nama' => "Al Hadi", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020046', 'nama' => "Muhammad Rafly Hiyansah", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020047', 'nama' => "Radhitya Lutfi Sudrajat", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020048', 'nama' => "Muhammad Alvi", 'kelompok' => "Melayani dan Bertanggungjawab"],
            ['nim' => '2517020049', 'nama' => "Joko Santoso", 'kelompok' => "Jujur"],
            ['nim' => '2517020050', 'nama' => "Ferdyan Gesyfa", 'kelompok' => "Jujur"],
            ['nim' => '2517020051', 'nama' => "Ratu Aisyah", 'kelompok' => "Jujur"],
            ['nim' => '2517020052', 'nama' => "Eiffel Nailah Suanto", 'kelompok' => "Jujur"],
            ['nim' => '2517020053', 'nama' => "Nurhamida Rahmadani", 'kelompok' => "Jujur"],
            ['nim' => '2517020054', 'nama' => "Fauziah Rahmah", 'kelompok' => "Jujur"],
            ['nim' => '2517020055', 'nama' => "Alya Sazkia", 'kelompok' => "Jujur"],
            ['nim' => '2517020056', 'nama' => "Fachry Ad Daffa", 'kelompok' => "Jujur"],
            ['nim' => '2517020057', 'nama' => "Hanif Sahar Zulfa", 'kelompok' => "Jujur"],
            ['nim' => '2517020058', 'nama' => "Icha Alya Saputri", 'kelompok' => "Jujur"],
            ['nim' => '2517020059', 'nama' => "Arif Aryaguna", 'kelompok' => "Jujur"],
            ['nim' => '2517020060', 'nama' => "Naura Putri", 'kelompok' => "Jujur"],
            ['nim' => '2517020061', 'nama' => "Diego Milito", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020062', 'nama' => "Chairani Meiliawati", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020063', 'nama' => "Irfan Al Yusran", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020064', 'nama' => "Muhammad Gibran", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020065', 'nama' => "Tiwi Permata Sari", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020066', 'nama' => "Arfa Sari Siagian", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020067', 'nama' => "Nabil Habibi", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020068', 'nama' => "Alfath Habib", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020069', 'nama' => "Azizurahman Alvi", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020070', 'nama' => "Nahda Dzakira", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020071', 'nama' => "Kania Amanda", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020072', 'nama' => "M Habib Widiardi", 'kelompok' => "Imajinatif"],
            ['nim' => '2517020073', 'nama' => "Wike Mutia", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020074', 'nama' => "Najmi Shifa Ramadhani", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020075', 'nama' => "Hasbi Yatul Fiqri", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020076', 'nama' => "Muhammad Daffadin Akram", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020077', 'nama' => "M. Iqbal Pratama", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020078', 'nama' => "Aditia Rahman", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020079', 'nama' => "Muhammad Farel Al Hamidi", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020080', 'nama' => "Athiyah Sukma Gusnova", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020081', 'nama' => "Veni Putri Handayani", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020082', 'nama' => "Tasya Sri Aulia Siregar", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020083', 'nama' => "Zhufran Yassar", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020084', 'nama' => "Muhammad Fadhli Hanafi", 'kelompok' => "Berdaya Guna"],
            ['nim' => '2517020085', 'nama' => "Yuli Warni", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020086', 'nama' => "Hanipan Ardan Gustian", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020087', 'nama' => "Novita Sari Devi", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020088', 'nama' => "Giska Revalia", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020089', 'nama' => "Fachri Akbar", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020090', 'nama' => "Aisyah Mukhalimah Ningsih", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020091', 'nama' => "Hamdi Rahman", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020092', 'nama' => "Arrafiramadhan", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020093', 'nama' => "Deva Hidayat", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020094', 'nama' => "Hafiz Mulyadi", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020095', 'nama' => "Sayyidul Ihsan", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020096', 'nama' => "Khoirul Nur Ilham", 'kelompok' => "Saling Membesarkan"],
            ['nim' => '2517020097', 'nama' => "Fathir Risky Ramadhan", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020098', 'nama' => "M Raffah Isfahan", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020099', 'nama' => "Chelsie Dhola Cahyaningsih", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020100', 'nama' => "Lafifal Haki", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020101', 'nama' => "Jennadel Fharezky", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020102', 'nama' => "Hanifah Mardhiyah Rahmadhani", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020103', 'nama' => "Rasyidan Ghifari", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020104', 'nama' => "Nurul Ain", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020105', 'nama' => "Nurmasyitah Ardiani", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020106', 'nama' => "Muhammad Ikhsan", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020107', 'nama' => "Misbahurrido", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020108', 'nama' => "Naufal Zuhdi", 'kelompok' => "MenSaHaBaTi"],
            ['nim' => '2517020109', 'nama' => "Bilal Arifman Huda", 'kelompok' => "Sains"],
            ['nim' => '2517020110', 'nama' => "Rafli Marta", 'kelompok' => "Sains"],
            ['nim' => '2517020111', 'nama' => "Ahmad Fahri", 'kelompok' => "Sains"],
            ['nim' => '2517020112', 'nama' => "Hibatul Hirzi", 'kelompok' => "Sains"],
            ['nim' => '2517020113', 'nama' => "Meliya Delita", 'kelompok' => "Sains"],
            ['nim' => '2517020114', 'nama' => "Randi", 'kelompok' => "Sains"],
            ['nim' => '2517020115', 'nama' => "Azka Al Azkiya", 'kelompok' => "Sains"],
            ['nim' => '2517020116', 'nama' => "Afdillah Imron", 'kelompok' => "Sains"],
            ['nim' => '2517020117', 'nama' => "Naurah Mitha Shafira", 'kelompok' => "Sains"],
            ['nim' => '2517020118', 'nama' => "Rizky Ananda", 'kelompok' => "Sains"],
            ['nim' => '2517020119', 'nama' => "Pindola Bolfia", 'kelompok' => "Sains"],
            ['nim' => '2217020041', 'nama' => "Muhammad Alif Zulfasena", 'kelompok' => "Teknologi"],
            ['nim' => '2217020051', 'nama' => "Ilham Surya Ramadhan", 'kelompok' => "Teknologi"],
            ['nim' => '2217020162', 'nama' => "Geeta Aorora", 'kelompok' => "Teknologi"],
            ['nim' => '2217020164', 'nama' => "Zukri Ahmad", 'kelompok' => "Teknologi"],
            ['nim' => '2217020165', 'nama' => "Muhammad Raja Faiz", 'kelompok' => "Teknologi"],
            ['nim' => '2217020172', 'nama' => "Afiq Baihaqi Krisna Jati", 'kelompok' => "Teknologi"],
            ['nim' => '2217020174', 'nama' => "Alvin Alvianda", 'kelompok' => "Teknologi"],
            ['nim' => '2317020071', 'nama' => "Aldi Muslim", 'kelompok' => "Teknologi"],
            ['nim' => '2317020101', 'nama' => "Anggim Paddan Tambunan", 'kelompok' => "Teknologi"],
            ['nim' => '2317020107', 'nama' => "Nabil Adillah Supardy", 'kelompok' => "Teknologi"],
            ['nim' => '2317020125', 'nama' => "Gading Ruyung Zulyan", 'kelompok' => "Teknologi"],
            ['nim' => '2317020142', 'nama' => "Zunnahri", 'kelompok' => "Teknologi"],
            ['nim' => '2317020157', 'nama' => "Ferdian", 'kelompok' => "Teknologi"],
            ['nim' => '2317020159', 'nama' => "Alif Naufal Viabel Willatra", 'kelompok' => "Teknologi"],
            ['nim' => '2417020108', 'nama' => "Fauzan Azim", 'kelompok' => "Teknologi"],
            ['nim' => '2417020052', 'nama' => "M.Fadhil Sya Bani", 'kelompok' => "Teknologi"],
            ['nim' => '2417020048', 'nama' => "Mhd. Raihan Zaky", 'kelompok' => "Teknologi"],
            ['nim' => '2417020039', 'nama' => "Mhd. Fikri Aurizqullah", 'kelompok' => "Teknologi"],
            ['nim' => '2417010020', 'nama' => "Abdel Haq Muhammad El Haviki", 'kelompok' => "Teknologi"],
            ['nim' => '2417020070', 'nama' => "Rizky Al Hamid", 'kelompok' => "Teknologi"],
            ['nim' => '2417020094', 'nama' => "Rahil Mulia Efendi", 'kelompok' => "Teknologi"],
            ['nim' => '2417020093', 'nama' => "Hauzan Azzam", 'kelompok' => "Teknologi"],
        ];

        foreach ($rows as $r) {
            $kelompok = $this->normalizeKelompok($r['kelompok']);

            $kelas = Kelas::firstOrCreate(['nama' => $kelompok]);

            $email = $r['nim'] . '@santri.uinib';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $r['nama'],
                    'password' => Hash::make('password'), // dev only
                    'email_verified_at' => now(),
                ]
            );

            Santri::updateOrCreate(
                ['email' => $email],
                [
                    'user_id' => $user->id,
                    'kelas_id' => $kelas->id,
                    'nama' => $r['nama'],
                    'no_hp' => null,
                    'alamat' => null,
                    'jenis_kelamin' => null,
                ]
            );
        }
    }
}
