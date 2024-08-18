<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Proyek</title>
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
        .actions button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><a href="<?php echo site_url('ProyekController/showAddForm'); ?>">Tambah Proyek Baru</a></h2>
        </div>
        <h1>Data Proyek</h1>
        <div class="actions">
            <a href="<?php echo site_url('Apicontroller/getData'); ?>">Lihat Data Lokasi</a>
        </div>
        <?php if (!empty($proyek) && is_array($proyek)): ?>
            <?php foreach ($proyek as $data): ?>
                <div class="item">
                    <div>
                        <span class="label">ID:</span> <?php echo isset($data['id']) ? $data['id'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Nama Proyek:</span> <?php echo isset($data['namaProyek']) ? $data['namaProyek'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Client:</span> <?php echo isset($data['client']) ? $data['client'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Tanggal Mulai:</span> <?php echo isset($data['tglMulai']) ? $data['tglMulai'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Tanggal Selesai:</span> <?php echo isset($data['tglSelesai']) ? $data['tglSelesai'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">PIMPRO:</span> <?php echo isset($data['pimpro']) ? $data['pimpro'] : 'N/A'; ?>
                    </div>
                    <div>
                        <span class="label">Keterangan:</span> <?php echo isset($data['keterangan']) ? $data['keterangan'] : 'N/A'; ?>
                    </div>
                    <div class="proyek">
                        <span class="label">Lokasi:</span>
                        <?php if (!empty($data['lokasi']) && is_array($data['lokasi'])): ?>
                            <?php 
                            $lokasi_names = array_map(function($item) {
                                return isset($item['namaLokasi']) ? $item['namaLokasi'] : 'N/A';
                            }, $data['lokasi']);
                            echo implode(', ', $lokasi_names);
                            ?>
                        <?php else: ?>
                            <span>No lokasi data found.</span>
                        <?php endif; ?>
                    </div>
                    <div class="actions">
                        <a href="<?php echo site_url('ProyekController/showUpdateForm/'.$data['id']); ?>">Update</a>
                        <a href="<?php echo site_url('ProyekController/confirmDelete/'.$data['id']); ?>">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No data found or invalid data format.</p>
        <?php endif; ?>
    </div>
</body>
</html>
