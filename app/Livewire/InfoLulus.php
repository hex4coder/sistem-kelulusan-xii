<?php

namespace App\Livewire;

use App\Models\Kelulusan;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class InfoLulus extends Component
{


    public $nisInput = '';
    public $nama = null;
    public $nis = null;
    public $hasilKelulusan = null;
    public $isLoading = false;
    public $currentProfile = null;

    public function mount() {
        if(Auth::user()->role > 0) {
            $this->currentProfile = Student::find(Auth::user()->id - 1);
        }
    }

    public function cekKelulusan()
    {
        $validatedData = Validator::make(['nisInput' => $this->nisInput], [
            'nisInput' => 'required|numeric|digits:8', // Contoh validasi: harus angka 10 digit
        ])->validate();

        $this->resetErrorBag();
        $this->nama = null;
        $this->nis = null;
        $this->hasilKelulusan = null;
        $this->isLoading = true;

        // Simulasi pengambilan data dari database (ganti dengan logika sebenarnya)
        $siswa = DB::table('students')
            ->where('nisn', $this->nisInput)
            ->first();

        if ($siswa) {
            if($siswa->id != $this->currentProfile->id) {

                $this->addError('nisInput', 'Anda tidak bisa mengecek NISN orang lain!');
            } else {
                $this->nama = $siswa->nama;
                $this->nis = $siswa->nisn;

                // Logika penentuan kelulusan (ganti dengan logika sebenarnya)
                // cek pada table kelulusan dengan id siswa tersebut
                $cekLulus = Kelulusan::where('student_id', $siswa->id)->first();
                if ($cekLulus->lulus) {
                    $this->hasilKelulusan = 'LULUS';
                } else {
                    $this->hasilKelulusan = 'TIDAK LULUS';
                }
            }
        } else {
            $this->addError('nisInput', 'NISN tidak ditemukan.');
        }

        $this->isLoading = false;
    }
    public function render()
    {
        return view('livewire.info-lulus');
    }
}
