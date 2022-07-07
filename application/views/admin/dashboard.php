<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <?php if ($msg):?>

  <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
    <?php echo $msg?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php endif;?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>


  <div class="d-flex flex-row justify-content-between">
    <h2>Section title</h2>
    <div>
      <a type="button" class="btn btn-primary" href="<?php echo base_url("admin/trash_view/") ?>"><i
          class="bi bi-trash3"></i></a>
      <a type="button" class="btn btn-primary" href="<?php echo base_url("admin/add_view/") ?>">Shto user <i
          class="bi bi-person-plus"></i></a>
    </div>
  </div>
  <?php if ($users):?>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <?php foreach($users[0] as $key=> $val): ?>
          <th scope="col">
            <?php echo$key ?>
          </th>
          <?php endforeach; ?>
          <th>Actions</th>

        </tr>
      </thead>
      <tbody >
        <?php foreach($users as $user):?>
        <tr>
          <?php foreach($user as $k => $v):?>
          <td>
            <?php echo $v ?>
          </td>
          <?php endforeach; ?>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
              <a href="<?php echo base_url("admin/edit_view/" .$user->id) ?>" type="button" class="btn
                btn-warning">Edit</a>
              <a type="button" class="btn btn-danger" onclick='return confirm("Do you want to delete")'
                href="<?php echo base_url("admin/trash/" .$user->id) ?>">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <?php endif ?>
</main>

