<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // delete all data users
        DB::table('users')->truncate();
        // add new admin users
        $admin = new User();
        $admin->email = 'adminsks@smkncampalagian.sch.id';
        $admin->role = 0;
        $admin->name = 'Administrator';
        $admin->password = '12345678';
        $admin->save();


        // insert students users
        $this->insertStudentsCredentials();
    }


    private function insertStudentsCredentials(): void
    {
        // read all students data
        $students = DB::table('students')->get();
        foreach ($students as $student) {
            $nama = $student->nama;
            $id = $student->id;
            $lowername = strtolower($nama);
            $fixed = str_replace(' ', '_', $lowername);
            $email = $fixed . $id . '@smkncampalagian.sch.id';
            $pass = 'smkncampalagian_keren';
            $role = 1;

            $uc = new User();
            $uc->name = $nama;
            $uc->email = $email;
            $uc->password = $pass;
            $uc->role = $role;
            $uc->save();
            print_r("[CREATE STUDENT ID] Membuat ID untuk $nama ...\r\n");
        }
    }
}
