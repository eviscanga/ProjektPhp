<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <?php if($users):?>
  <form class="mt-3" method="POST" enctype="multipart/form-data" action="<?php echo base_url("admin/edit");?>">
    <?php foreach ($users as $user):?>
    <div class="mb-3">
      <label for="name" class="form-label">Emer</label>
      <input type="text" class="form-control" name="name" id="name" value="<?php echo $user->name?>">
    </div>
    <div class="mb-3">
      <label for="surname" class="form-label">Mbiemer</label>
      <input type="text" class="form-control" name="surname" id="surname" value="<?php echo $user->surname?>">
    </div>
    <div class="mb-3">
      <label for="bio" class="form-label">Pershkrimi</label>
      <textarea type="text" class="form-control" name="bio" id="bio">
    <?php echo $user->bio?>
    </textarea>
    </div>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="femer" name="gender" value="Femer" <?php
        if($user->gender=="Femer"){echo "checked";}?> >F
      <label class="form-check-label" for="femer"></label>
    </div>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="mashkull" name="gender" value="Mashkull" <?php
        if($user->gender=="Mashkull"){echo "checked";}?>>M
      <label class="form-check-label" for="mashkull"></label>
    </div>
    <input type="file" name="image" class=" mt-3" size="20" id="uploaded_image" />
    <div class="image-container">
      <img src="<?php echo base_url("./assets/uploads/" .$user->image);?>" id="image-preview" class="mt-3">
      <a type="button" id="image" class="btn" onclick='return confirm("Do you want to delete")'
        href="<?php echo base_url("admin/deleteImg/" .$user->id) ?>"><i class="fa-solid fa-x"></i></a>
      <button type="button" class="btn btn-primary" data-bs-target="#modal" data-bs-toggle="modal">
        <i class="bi bi-pencil"></i>
      </button>
    </div>
    <div>
      <input type="hidden" class="btn btn-primary" name="id" value="<?php echo $user->id?>"></input>
      <input type="hidden" class="btn btn-primary" name="filename" id="filename" value="<?php echo $user->image?>"></input>
      <input type="submit" class="btn btn-primary mt-3" name="submit"></input>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Crop Image</h5>
            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <div class="row">
                <div class="col-md-8">
                  <img src="<?php echo base_url("./assets/uploads/" .$user->image);?>" id="sample_image" />
                </div>
                <div class="col-md-4">
                  <div class="preview"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="crop" class="btn btn-primary">Crop</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </form>

  <?php endif; ?>
</main>



<!-- CK editori -->
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('bio');
</script>
<!-- Cropper -->
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<script src="https://unpkg.com/cropperjs"></script>
<script>


  let myModalEl = document.getElementById('myModal2');
  const myModal2 = new bootstrap.Modal(myModalEl);

  // let myModal2 = new bootstrap.Modal('#myModal2');

  var image = document.getElementById('sample_image');
  var crop = document.getElementById('crop');
  var uploaded_image = document.getElementById('uploaded_image');
  var cropper;

  uploaded_image.addEventListener('change', function (event) {
    var files = event.target.files;

    var done = function (url) {
      image.src = url;
      // $('#crop').attr('disabled',false);
      // $('#crop').html('Crop');
      // crop.setAttribute('disabled', '');
      crop.disabled = false;
      crop.innerHTML= 'Crop';
      myModal2.show();

    };

    if (files && files.length > 0) {
      reader = new FileReader();
      reader.onload = function (event) {
        done(reader.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });

  myModalEl.addEventListener('shown.bs.modal', function() {

    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview: '.preview'
    });
  });

  myModalEl.addEventListener('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
  });

  crop.addEventListener('click', function (e) {
    // crop.attr('disabled', 'disabled');
    // crop.html('<i class="fa fa-circle-o-notch fa-spin"></i> Wait...');
    
    crop.disabled = false;
    crop.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Wait...';
    canvas = cropper.getCroppedCanvas({
      width: 400,
      height: 400
    });

  
    canvas.toBlob(function (blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function () {
        var file = uploaded_image.value.split("\\");
        var imageName = file[file.length-1];
        var base64data = reader.result;
        var xhttp = new XMLHttpRequest();
        var theUrl = "<?php echo base_url("./admin/cropImg/")?>";
        xhttp.open("POST", theUrl, true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // Response
            var response = this.responseText;
            console.log(response);
            document.getElementById("filename").value = response;
            myModal2.hide();
          }
        };
        var data = {
          image: base64data,
          x:cropper.cropBoxData.left,
          y:cropper.cropBoxData.top,
          w:cropper.cropBoxData.width,
          h:cropper.cropBoxData.height,
          name: imageName 
        };
        xhttp.send(JSON.stringify(data));
      };
    });
  });


</script>
<!-- Drag and drop -->