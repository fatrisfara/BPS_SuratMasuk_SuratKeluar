<?= $this->extend('kepala_bps/templates/index'); ?>


<?= $this->section('page-content'); ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900"></h1>

            <div class="card shadow px-5 py-4">
                <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-8">
                <img class="card-img-top p-2" src="<?= empty(user()->foto) ? '/img/default.jpg' : '/uploads/profile/' . user()->foto; ?>" alt="Image profile" height="290">
           
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-14">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span class="badge badge-info"> <?= $role; ?></span></li>
                            <li class="list-group-item "><i class="fa fa-user mr-2 "></i><?= user()->username; ?></li>
                            <li class="list-group-item"><i class="fa fa-calendar mr-1"></i> terdaftar sejak. <?php $date = date_create($user->created_at);
                            echo (date_format($date, "d F Y H:i:s")) ?></li>
                            <li class="list-group-item"></li>
                        </ul>
                        </br>
                        </br>
                        </br>
                            <button data-toggle="modal" data-target="#edit-profile" type="button" class="btn btn-user btn-block" style="background-color: darkcyan; color: #fff;" data-id="<">Ubah Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Edit Profile -->
    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: darkcyan; color: #fff;">
                    <h5 class="modal-title text-white">Ubah Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/simpanProfile/<?= $user->id; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" id="userid">
                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                            <input type="file" name="foto" id="foto" class="form-control p-1">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $user->username ?>" readonly>
                            <div class="invalid-feedback"></div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-simpan" style="background-color: darkcyan; color: #fff;">Simpan data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function() {
        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required.");

        $("#formUser").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    metodku: true
                },
                username: {
                    required: true,
                    minlength: 3,
                    metodku: true
                },
                role: {
                    required: true,
                    valueNotEquals: "default"
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
        });
    });
</script>
<?= $this->endSection(); ?>