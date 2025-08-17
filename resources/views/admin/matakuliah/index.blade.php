<table>
    <thead>
        <tr>
            <th>Nama MK</th>
            <th>Kode MK</th>
            <th>Bobot SKS</th>
            <th>Total ECTS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mataKuliahs as $mk)
        <tr>
            <td>{{ $mk->nama_mk }}</td>
            <td>{{ $mk->kode_mk }}</td>
            <td>{{ $mk->bobot_sks }}</td>
            <td>{{ $mk->total_ects }}</td> <td></td>
        </tr>
        @endforeach
    </tbody>
</table>