<table class="header" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25%" style="vertical-align: top; padding-right: 15px; padding-bottom: 10px">
            <img src="asset/images/logo-klaten.png" alt="Logo Perusahaan" class="logo" width="90px" height="100px">
        </td>
        <td width="75%" style="vertical-align: top; text-align: center">
            <h2 style="margin: 0; font-size: 15px;">PEMERINTAH KABUPATEN KLATEN</h2>
            <h1 style="margin: 0; font-size: 17px;">DINAS PENDIDIKAN</h1>
            <h2 style="margin: 0; font-size: 15px;">KORWIL PENDIDIKAN KECAMATAN KALIKOTES</h2>
            <h2 style="margin: 0; font-size: 15px;">SD NEGERI 1 NGEMPLAK</h2>
            <p style="margin: 0; font-size: 11px;">Alamat :Dukuh, Ngemplak, Kalikotes, Klaten, Email
                :sdnegeringemplak1@gmail.com</p>
            <p style="margin: 0; font-size: 10px;">NIS : 100170, NPSN : 20310189, NSS : 101031007017</p>
        </td>
    </tr>
</table>

<h2 style="text-align: center; font-size: 13px; margin-bottom: 20px; border-top: 1px solid #ddd; padding-top: 28px;">
    Laporan
    Data Siswa <br>SD Negeri 1
    Ngemplak</h2>
<table
    style="width: 100%; text-align: left; font-size: 14px; color: #4a4a4a; border-collapse: collapse; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <thead>
        <tr style="background-color: #e2e8f0;border-bottom: 1px solid #ddd; ">
            <th style="padding: 12px 8px; text-align: center;  font-size: 13px;">No</th>
            <th style="padding: 12px 8px; text-align: center; font-size: 13px;">Nama Siswa
            </th>
            <th style="padding: 12px 8px; text-align: center; font-size: 13px;">NIS</th>
            <th style="padding: 12px 8px; text-align: center;  font-size: 13px;">Kelas
            </th>
            <th style="padding: 12px 8px; text-align: center; font-size: 13px;">Jenis
                Kelamin</th>
            <th style="padding: 12px 8px; text-align: center; font-size: 13px;">Agama
            </th>
            <th style="padding: 12px 8px; text-align: center; font-size: 13px;">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $item)
            <tr style="border-bottom: 1px solid #f1f3f5; background-color: #fff;">
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $loop->iteration }}
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->nama_siswa }}
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->NIS }}
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->kelas->nama_kelas }}
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->jenis_kelamin }}</td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->agama }}
                </td>
                <td style="padding: 12px 8px; border-bottom: 1px solid #ddd; text-align: center; font-size: 11px;">
                    {{ $item->alamat }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
