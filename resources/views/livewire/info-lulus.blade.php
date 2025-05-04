<div>
    <h1 class="text-2xl font-bold mb-4">Pengumuman Kelulusan Kelas XII</h1>

    <div wire:loading.delay.longer class="fixed top-0 left-0 w-full h-full bg-gray-200 opacity-75 z-50 flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500 border-solid"></div>
        <span class="ml-2">Memuat Hasil...</span>
    </div>

    @if ($nama)
        <div class="shadow-md rounded-md p-6">
            <h2 class="text-xl font-semibold mb-2">Data Siswa</h2>
            <p><strong>Nama:</strong> {{ $nama }}</p>
            <p><strong>NISN:</strong> {{ $nis }}</p>

            <h2 class="text-xl font-semibold mt-4 mb-2">Hasil Kelulusan</h2>

            @if ($isLoading)
                <div class="text-yellow-500 italic">Sedang memproses hasil... mohon tunggu.</div>
            @elseif ($hasilKelulusan === 'LULUS')
                <div class="text-green-500 font-bold text-xl">SELAMAT! Anda dinyatakan LULUS.</div>
                <p class="mt-2">Selamat atas keberhasilan Anda menyelesaikan pendidikan di Kelas XII. Semoga sukses selalu di masa depan!</p>
                @elseif ($hasilKelulusan === 'TIDAK LULUS')
                <div class="text-red-500 font-bold text-xl">MAAF, Anda dinyatakan TIDAK LULUS.</div>
                <p class="mt-2">Jangan berkecil hati. Tetap semangat dan jadikan ini sebagai pelajaran untuk meraih kesuksesan di kesempatan lain.</p>
                @else
                <div class="text-gray-500 italic">Hasil kelulusan akan diumumkan setelah proses selesai.</div>
            @endif
        </div>
    @else
        <div class="bg-white shadow-md rounded-md p-6">
            <h2 class="text-xl text-gray-700 font-semibold mt-4 mb-2">Selamat datang {{$currentProfile->nama}}</h2>
            <p class="text-gray-700">Silakan masukkan Nomor Induk Siswa Nasional(NISN) dan klik tombol di bawah untuk melihat hasil kelulusan Anda.</p>
            <div class="mt-4">
                <label for="nis" class="block text-gray-700 text-sm font-bold mb-2">Nomor Induk Siswa (NISN):</label>
                <input wire:model="nisInput" type="text" id="nis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan NISN Anda" autocomplete="off">
            </div>
            <button wire:click="cekKelulusan" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
                Cek Kelulusan
            </button>

            @error('nisInput')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
    @endif
</div>
