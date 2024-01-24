<tr>
    <td><?=$kelola->id;?></td>
    <td><?=$kelola->username;?></td>
    <td><?=empty($group) ? '' : $group[0]['name'];?>
    </td>

    </td>
    <td align="center">
        <a href="<?=base_url('admin/activateUser/' . $kelola->id . '/' . ($kelola->active == 1 ? 0 : 1));?>"
            class="btn btn-lg  btn-circle btn-active-users" title="Klik untuk Mengaktifkan atau Menonaktifkan">
            <?=$kelola->active == 1 ? '<i class="fas fa-check-circle text-success fa-lg"></i>' : '<i class="fas fa-times text-danger fa-lg"></i>';?>
        </a>
    </td>
</tr>