<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
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
            text-align: center;
        }
        .container button {
            padding: 10px 15px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Are you sure you want to delete this location?</h1>
        <p><strong>Location ID:</strong> <?php echo $id; ?></p>
        <p><strong>Nama Lokasi:</strong> <?php echo $namaLokasi; ?></p>
        <form action="<?php echo site_url('Apicontroller/processDelete'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Delete</button>
            <a href="<?php echo site_url('Apicontroller/getData'); ?>">Cancel</a>
        </form>
    </div>
</body>
</html>
