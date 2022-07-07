<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



  <div class="d-flex flex-row justify-content-between mt-3">
    <h2>Deleted users</h2>
    <div>
      <a type="button" class="btn btn-primary" href="<?php echo base_url("admin/index/") ?>">Users <i
          class="bi bi-person-plus"></i></a>
    </div>
  </div>
  <?php if ($users): ?>
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
      <tbody>
        <?php foreach($users as $user): ?>
        <tr>
          <?php foreach($user as $k => $v): ?>
          <td>
            <?php echo $v ?>
          </td>
          <?php endforeach; ?>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
              <a href="<?php echo base_url("admin/restore/" .$user->id) ?>" type="button" class="btn
                btn-primary">Restore</a>
              <a type="button" class="btn btn-danger" onclick='return confirm("Do you want to delete")'
                href="<?php echo base_url("admin/delete/" .$user->id) ?>">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <?php endif ?>
</main>