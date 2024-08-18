<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Proyek</h1>
        <form action="<?php echo site_url('ProyekController/processAdd'); ?>" method="post">
            <div class="form-group">
                <label for="namaProyek">Nama Proyek:</label>
                <input type="text" id="namaProyek" name="namaProyek" required>
            </div>
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" id="client" name="client" required>
            </div>
            <div class="form-group">
                <label for="tglMulai">Tanggal Mulai:</label>
                <input type="datetime-local" id="tglMulai" name="tglMulai" required>
            </div>
            <div class="form-group">
                <label for="tglSelesai">Tanggal Selesai:</label>
                <input type="datetime-local" id="tglSelesai" name="tglSelesai" required>
            </div>
            <div class="form-group">
                <label for="pimpro">PIMPRO:</label>
                <input type="text" id="pimpro" name="pimpro" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan">
            </div>
            <div class="form-group">
                <label for="lokasiId">Lokasi:</label>
                <select id="lokasiId" name="lokasiId[]" multiple required>
                    <?php if (!empty($lokasi) && is_array($lokasi)): ?>
                        <?php foreach ($lokasi as $loc): ?>
                            <option value="<?php echo $loc['id']; ?>"><?php echo $loc['namaLokasi']; ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No lokasi available</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Tambah Proyek</button>
            </div>
        </form>
        <a href="<?php echo site_url('ProyekController/dataProyekView'); ?>">Kembali ke Data Proyek</a>
    </div>
</body>
</html>
