<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Lokasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            position: relative;
        }
        h1 {
            text-align: center;
        }
        .item, .form-container {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
        }
        .proyek {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .form-container {
            border: none;
            padding: 0;
        }
        .form-container a {
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }
        .header {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .actions {
            text-align: right;
        }
        .actions a, .actions form {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><a href="<?php echo site_url('Apicontroller/showForm'); ?>">Tambah Lokasi Baru</a></h2>
        </div>
        <h1>Master Data Lokasi</h1>
        <div class="actions">
            <a href="<?php echo site_url('ProyekController/dataProyekView'); ?>">Lihat Data Proyek</a>
        </div>
        <?php if (!empty($locations) && is_array($locations)): ?>
            <?php foreach ($locations as $data): ?>
                <div class="item">
                    <div>
                        <span class="label">ID:</span> <?php echo isset($data['id']) ? $data['id'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Nama Lokasi:</span> <?php echo isset($data['namaLokasi']) ? $data['namaLokasi'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Negara:</span> <?php echo isset($data['negara']) ? $data['negara'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Provinsi:</span> <?php echo isset($data['provinsi']) ? $data['provinsi'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Kota:</span> <?php echo isset($data['kota']) ? $data['kota'] : 'N/A'; ?>
                    </div>
                    <div class="proyek">
                        <span class="label">Proyek:</span>
                        <?php if (!empty($data['proyek']) && is_array($data['proyek'])): ?>
                            <?php 
                            $proyek_names = array_map(function($item) {
                                return isset($item['namaProyek']) ? $item['namaProyek'] : 'N/A';
                            }, $data['proyek']);
                            echo implode(', ', $proyek_names);
                            ?>
                        <?php else: ?>
                            <span>No proyek data found.</span>
                        <?php endif; ?>
                    </div>
                    <div class="actions">
                        <a href="<?php echo site_url('Apicontroller/updateLocation/'.$data['id']); ?>">Update</a>
                        <a href="<?php echo site_url('Apicontroller/confirmDelete/'.$data['id']); ?>">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No data found or invalid data format.</p>
        <?php endif; ?>
    </div>
</body>
</html>
