<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <form class="mt-3" method="POST" action="<?php echo base_url("admin/add");?>">
        <div class="mb-3">
            <label for="name" class="form-label">Emer</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Mbiemer</label>
            <input type="text" class="form-control" name="surname" id="surname">
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="femer" name="gender" value="Femer" checked>Femer
            <label class="form-check-label" for="femer"></label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="mashkull" name="gender" value="Mashkull">Mashkull
            <label class="form-check-label" for="mashkull"></label>
        </div>
        <div>
            <input type="file" name="image" class=" mt-3" size="20" />
        </div>
        <input type="hidden" class="btn btn-primary" name="id"></input>
        <input type="submit" class="btn btn-primary mt-3" name="submit"></input>

    </form>
</main>