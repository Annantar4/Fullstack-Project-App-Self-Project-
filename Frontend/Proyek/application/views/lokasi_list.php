<h2>Daftar Lokasi</h2>
<a href="<?= site_url('lokasi/create') ?>">Tambah Lokasi</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Lokasi</th>
        <th>Aksi</th>
    </tr>
    <?php foreach($lokasi as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama_lokasi'] ?></td>
        <td>
            <a href="<?= site_url('lokasi/edit/'.$row['id']) ?>">Edit</a>
            <a href="<?= site_url('lokasi/delete/'.$row['id']) ?>" onclick="return confirm('Yakin?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
