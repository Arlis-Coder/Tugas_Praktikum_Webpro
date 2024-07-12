<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data TIF B'22
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .custom-modal-width {
            max-width: 1000px; 
        }
        .container {
            max-width: 1200px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mt-3">
            <h2 class="text-center">DATA TEKNIK INFORMATIKA B</h2>
            <h3 class="text-center">UNISSULA</h3>
            <br>
        </div>
        <div class="card">
            <div class="card-header bg-black text-white">
                Data Teknik Informatika B
            </div>
            <div class="card-body">
                <!-- LOKASI TEXT PENCARIAN DAN TOMBOL TAMBAH DATA -->
                <div class="d-flex justify-content-between mb-3">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> Tambah Data</button>
                    <form action="" method="get" class="d-flex flex-grow-1 justify-content-end">
                        <div class="input-group" style="max-width: 400px;">
                            <input type="text" class="form-control" value="<?php echo $katakunci ?>" name="katakunci" placeholder="Masukkan Kata Kunci" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2"> <i class="bi bi-search"></i></button>
                            <button class="btn btn-secondary" type="button" id="button-refresh" onclick="refreshPage()"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </form>
                </div><hr>
            </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog custom-modal-width">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Siswa</h5>
                                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formSiswa" action="<?php echo site_url('siswa/simpan') ?>" method="post">
                                    <input type="hidden" name="id" id="inputId">
                                    <div class="mb-3 row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama Siswa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama" id="inputNama" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputWali" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="wali" id="inputWali" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select name="kelamin" id="inputKelamin" class="form-select" required>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="alamat" id="inputAlamat" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataSiswa as $k => $v) {
                            $nomor = $nomor + 1;
                        ?>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td><?php echo $v['nama'] ?></td>
                                <td><?php echo $v['wali'] ?></td>
                                <td><?php echo $v['jenis_kelamin'] ?></td>
                                <td><?php echo $v['alamat'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['id'] ?>)"><i class="bi bi-pencil"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $v['id'] ?>)"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $linkPagination = $pager->links();
                $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
                $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
                echo $linkPagination;
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function hapus(id) {
            if (confirm('Apakah Anda Yakin Menghapus Data Ini?')) {
                window.location = "<?php echo site_url('siswa/hapus') ?>/" + id;
            }
        }

        function edit(id) {
            $.ajax({
                url: "<?php echo site_url('siswa/edit') ?>/" + id,
                type: "get",
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj.id != '') {
                        $('#inputId').val(obj.id);
                        $('#inputNama').val(obj.nama);
                        $('#inputWali').val(obj.wali);
                        $('#inputKelamin').val(obj.jenis_kelamin);
                        $('#inputAlamat').val(obj.alamat);
                    }
                }
            });
        }

        function refreshPage() {
            window.location.href = "<?php echo site_url('siswa'); ?>";
        }

        $('.tombol-tutup').on('click', function() {
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputWali').val('');
            $('#inputKelamin').val('');
            $('#inputAlamat').val('');
        });
    </script>
</body>
</html>

