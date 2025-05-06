@extends('layouts.master3')
@section('content')
    <div class="block md:flex md:justify-between px-5 py-10 gap-4">
        <!-- KIRI: Video -->
        <div class="md:w-2/5 bg-white rounded-lg shadow p-7">
            <h3 class="text-lg font-bold mb-4">Absensi Siswa</h3>
            <div class="-mt-3 md:mt-4">
                <div id="video-container" class="relative w-full rounded-lg">
                    <video id="video" autoplay
                        class="w-full h-64 md:h-[380px] border-2 border-gray-500 bg-black rounded-lg"></video>
                    <canvas id="canvas" class="absolute top-0 z-10 left-0 w-full h-full"></canvas>
                </div>
                <div id="hasilPresensi" class="mt-2 md:mt-7 hidden text-center">
                    <h2 id="namaPresensi" class="text-sm md:text-base font-bold text-blue-500"></h2>
                    <p class="font-medium text-gray-500 text-sm md:text-base">Berhasil Presensi</p>
                </div>
            </div>
        </div>

        <!-- KANAN: Tabel -->
        <div class="md:w-2/3 md:px-6 md:mt-0 mt-3">
            <h2 class="text-lg md:text-2xl font-bold mb-4">Absensi Siswa Kelas <span>{{ $kelasAktif->nama_kelas }}</span>
            </h2>
            <div class="bg-white rounded-lg shadow p-4 ">
                <h3 class="text-lg font-semibold mb-4">Data Presensi Siswa</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-center">
                                <th class="py-2 px-4">No</th>
                                <th class="py-2 px-4">NIS</th>
                                <th class="py-2 px-4">Nama Siswa</th>
                                <th class="py-2 px-4">Jenis Kelamin</th>
                                <th class="py-2 px-4">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody id="presensiTableBody">
                            @foreach ($presensiHariIni as $index => $item)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} text-slate-700">
                                    <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 text-center">{{ $item->nis_siswa }}</td>
                                    <td class="py-2 px-4 text-center">{{ $item->siswa->nama_siswa }}</td>
                                    <td class="py-2 px-4 text-center">{{ $item->siswa->jenis_kelamin }}</td>
                                    <td class="py-2 px-4 text-center">{{ $item->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>
    <script src="{{ asset('cam_js/js/presensi.js') }}"></script>
    <script>
        // Variabel dari controller (jadwal id & array NIS siswa kelas aktif)
        const jadwalId = @json($jadwal->id);
        window.kelasAktifNIS = @json($nisDariKelas);

        // Fungsi refresh tabel presensi
        function updateTabelPresensi() {
            fetch(`/presensi/kelas/${jadwalId}/data`)
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById("presensiTableBody");
                    tbody.innerHTML = "";

                    data.forEach((item, index) => {
                        const row = `
                            <tr class="${index % 2 === 0 ? 'bg-white' : 'bg-gray-50'}">
                                <td class="py-2 px-4 text-center">${index + 1}</td>
                                <td class="py-2 px-4 text-center">${item.nis_siswa}</td>
                                <td class="py-2 px-4 text-center">${item.siswa?.nama_siswa ?? '-'}</td>
                                <td class="py-2 px-4 text-center">${item.siswa?.jenis_kelamin ?? '-'}</td>
                                <td class="py-2 px-4 text-center">${item.status}</td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                });
        }

        // Refresh otomatis tiap 5 detik
        setInterval(updateTabelPresensi, 5000);
    </script>
@endpush
