<?=$this->extend('/admin/templates/index');?>

<?=$this->section('page-content');?>
<style>
    .rounded-left {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .rounded-right {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Pengguna</h1>
                                </div>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form class="user"
                                    action="<?= url_to('register') ?>"
                                    method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control form-control-user <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                            name="username"
                                            value="<?= old('username') ?>">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="id_jabatan">Pilih Jabatan</label>
                                        <select class="form-control" name="id_jabatan" id="id_jabatan">
                                            <?php foreach ($jabatanOptions as $jabatan): ?>
                                            <option
                                                value="<?= $jabatan['id_jabatan'] ?>">
                                                <?= $jabatan['nama_jabatan'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <label label for="password">Password</label>
                                    <label label for="password" style="margin-left: 280px ;">Repeat Password</label>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password"
                                                class="form-control form-control-user <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                                name="password"
                                                autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="pass_confirm"
                                                class="form-control form-control-user <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    </br>
                                    <button type="submit"
                                        class="btn btn-user btn-block"  
                                        style="background-color: darkcyan; color: #fff;">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>