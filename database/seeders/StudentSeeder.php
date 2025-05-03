<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // delete all data from students
        DB::table('students')->truncate();

        // import all data from excel file in root directory at folder data-source filaname data-siswa.csv
        // read data
        $filename = './datasource/data-siswa.csv';
        if (($fd = fopen($filename, 'r')) !== false) {
            $i = 0;
            while(($data = fgetcsv($fd, null)) !== false) {
                if ($i > 0) {

                    $nama = $data[1];
                    $nisn = $data[2];
                    $jk = $data[3];
                    $ttl = $data[4];
                    $agama = $data[5];
                    $kelas = $data[6];

                    $student = new Student();
                    $student->nama = $nama;
                    $student->nisn = $nisn;
                    $student->jk = $jk;
                    $student->ttl = $ttl;
                    $student->kelas = $kelas;
                    $student->agama = $agama;
                    $student->save();

                    print_r("[INPUT SISWA] Mengentri $nama... ke kelas $kelas\r\n");


                }
                $i++;
            }
            fclose($fd);
        } else {
            print_r("Tidak bisa membaca file $filename");
        }
    }
}
