<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Location</title>
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
        .form-group input {
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
        <h1>Update Location</h1>
        <?php if (!empty($id)): ?>
            <form action="<?php echo site_url('apicontroller/processUpdate'); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo isset($id) ? htmlspecialchars($id) : ''; ?>">
                
                <div class="form-group">
                    <label for="namaLokasi">Nama Lokasi:</label>
                    <input type="text" id="namaLokasi" name="namaLokasi" value="<?php echo isset($namaLokasi) ? htmlspecialchars($namaLokasi) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="negara">Negara:</label>
                    <input type="text" id="negara" name="negara" value="<?php echo isset($negara) ? htmlspecialchars($negara) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi:</label>
                    <input type="text" id="provinsi" name="provinsi" value="<?php echo isset($provinsi) ? htmlspecialchars($provinsi) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" id="kota" name="kota" value="<?php echo isset($kota) ? htmlspecialchars($kota) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        <?php else: ?>
            <p>No data found or invalid data format.</p>
        <?php endif; ?>
    </div>
</body>
</html>
