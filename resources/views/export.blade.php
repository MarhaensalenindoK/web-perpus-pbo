<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
</head>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .header {
        background-color: #eee;
    }

    .odd {
        background-color: #f9f9f9;
    }

    .even {
        background-color: #fff;
    }
</style>

<body>
    <div style="padding-bottom: 24px; text-align:center;">
        <h2>Laporan Peminjaman</h2>
    </div>
    <table border="1">
        <thead>
            <tr class="header">
                <th>No.</th>
                <th>Nama peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr class="odd">
                <td>{{$loop->iteration}}</td>
                <td>{{$loan->member->name}}</td>
                <td>{{$loan->book->title}}</td>
                <td>{{\Carbon\Carbon::parse($loan->loan_date)->locale('id')->isoFormat('D MMMM Y')}}</td>
                
                @if($loan->return_date)
                <td>{{\Carbon\Carbon::parse($loan->return_date)->locale('id')->isoFormat('D MMMM Y')}}</td>
                @else
                <td> - </td>
                @endif
                
                @if($loan->status == 'loaned')
                <td>Dipinjam</td>
                @else
                <td>Sudah Dikembalikan</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>