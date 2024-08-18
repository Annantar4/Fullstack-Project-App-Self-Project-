<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Proyek</title>
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
        <h1>Update Proyek</h1>
        <form action="<?php echo site_url('ProyekController/processUpdate'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo isset($proyek['id']) ? htmlspecialchars($proyek['id']) : ''; ?>">
            
            <div class="form-group">
                <label for="namaProyek">Nama Proyek:</label>
                <input type="text" id="namaProyek" name="namaProyek" value="<?php echo isset($proyek['namaProyek']) ? htmlspecialchars($proyek['namaProyek']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" id="client" name="client" value="<?php echo isset($proyek['client']) ? htmlspecialchars($proyek['client']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="tglMulai">Tanggal Mulai:</label>
                <input type="datetime-local" id="tglMulai" name="tglMulai" value="<?php echo isset($proyek['tglMulai']) ? htmlspecialchars(date('Y-m-d\TH:i', strtotime($proyek['tglMulai']))) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="tglSelesai">Tanggal Selesai:</label>
                <input type="datetime-local" id="tglSelesai" name="tglSelesai" value="<?php echo isset($proyek['tglSelesai']) ? htmlspecialchars(date('Y-m-d\TH:i', strtotime($proyek['tglSelesai']))) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="pimpro">PIMPRO:</label>
                <input type="text" id="pimpro" name="pimpro" value="<?php echo isset($proyek['pimpro']) ? htmlspecialchars($proyek['pimpro']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan" value="<?php echo isset($proyek['keterangan']) ? htmlspecialchars($proyek['keterangan']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="lokasiId">Lokasi:</label>
                <select id="lokasiId" name="lokasiId[]" multiple required>
                    <?php if (!empty($lokasi) && is_array($lokasi)): ?>
                        <?php foreach ($lokasi as $loc): ?>
                            <option value="<?php echo $loc['id']; ?>" 
                                <?php echo (in_array($loc['id'], $selectedLokasi)) ? 'selected' : ''; ?>>
                                <?php echo $loc['namaLokasi']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No lokasi available</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Update Proyek</button>
            </div>
        </form>
        <a href="<?php echo site_url('ProyekController/dataProyekView'); ?>">Kembali ke Data Proyek</a>
    </div>
</body>
</html>
