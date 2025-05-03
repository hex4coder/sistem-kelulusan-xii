<?php

namespace Database\Seeders;

use App\Models\Kelulusan;
use App\Models\Student;
use Illuminate\Database\Seeder;

class KelulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all data siswa
        $students = Student::all();

        // make kelulusan default is true
        $lulus = true;
        foreach($students as $student) {
            $k = new Kelulusan();
            $k->lulus = $lulus;
            $k->student_id = $student->id;
            $k->save();

            $nama = $student->nama;
            $ket = $lulus ? 'lulus' : 'tidak lulus';

            print_r("[ENTRY KELULUSAN] $nama dinyatakan $ket.\r\n");
        }


    }
}
