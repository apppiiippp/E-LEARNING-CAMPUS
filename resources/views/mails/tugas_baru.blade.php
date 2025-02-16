<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tugas Baru</h2>
    <p>Anda mendapatkan tugas baru. Berikut detailnya:</p>

    <table>
        <tr>
            <th>Judul</th>
            <td>{{ $title }}</td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $description }}</td>
        </tr>
        <tr>
            <th>Deadline</th>
            <td>{{ $deadline }}</td>
        </tr>
    </table>

    <p>Segera selesaikan tugas ini sebelum tenggat waktu.</p>

    <div class="footer">
        <p>&copy; 2025 E-Learning Campus. Semua Hak Dilindungi.</p>
    </div>
</div>

</body>
</html>
