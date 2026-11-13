<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Voucher - NusaCart</title>
</head>
<body>
    <h1>Daftar Voucher (Login sebagai: {{ auth()->user()->name ?? 'Guest' }} - Role: {{ auth()->user()->role ?? '-' }})</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px;">
        <tr>
            <th>Kode Voucher</th>
            <th>Diskon</th>
            <th>Aksi</th>
        </tr>
        @foreach($vouchers as $voucher)
        <tr>
            <td>{{ $voucher->code }}</td>
            <td>{{ $voucher->discount }}</td>
            <td>
                <!-- Tombol Hapus HANYA MUNCUL jika role-nya admin -->
                @if(auth()->user() && auth()->user()->role == 'admin')
                    <form action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                @else
                    <span style="color: gray;">Tidak ada akses Hapus</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>