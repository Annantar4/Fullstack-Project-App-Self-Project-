<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, button {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Lokasi Baru</h1>
        <form action="<?php echo site_url('Apicontroller/createLocation'); ?>" method="POST">
            <label for="namaLokasi">Nama Lokasi:</label>
            <input type="text" id="namaLokasi" name="namaLokasi" required>

            <label for="negara">Negara:</label>
            <input type="text" id="negara" name="negara" required>

            <label for="provinsi">Provinsi:</label>
            <input type="text" id="provinsi" name="provinsi" required>

            <label for="kota">Kota:</label>
            <input type="text" id="kota" name="kota" required>

            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>
