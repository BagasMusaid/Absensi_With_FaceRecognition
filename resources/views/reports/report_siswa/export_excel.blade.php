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
