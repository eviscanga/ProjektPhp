
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>


  <div class="d-flex flex-row justify-content-between">
    <h2>Section title</h2>
    <div>
      <a type="button" class="btn btn-primary" href="<?php echo base_url("admin/trash_view/") ?>"><i
          class="bi bi-trash3"></i></a>
      <a type="button" class="btn btn-primary" href="<?php echo base_url("admin/add_view/") ?>">Shto menu<i class="bi bi-list"></i></a>
    </div>
  </div>
  <?php if ($menu):?>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <?php foreach($menu[0] as $key=> $val): ?>
          <th scope="col">
            <?php echo$key ?>
          </th>
          <?php endforeach; ?>
          <th>Actions</th>

        </tr>
      </thead>
      <tbody >
        <?php foreach($menu as $menu):?>
        <tr>
          <?php foreach($menu as $k => $v):?>
          <td>
            <?php echo $v ?>
          </td>
          <?php endforeach; ?>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
              <a href="<?php echo base_url("admin/edit_items_view/" .$menu->id) ?>" type="button" class="btn
                btn-warning">Edit</a>
              <a type="button" class="btn btn-danger" onclick='return confirm("Do you want to delete")'
                >Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <?php endif ?>
</main>

