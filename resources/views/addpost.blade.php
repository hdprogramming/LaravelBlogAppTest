

<div class="cardwidth mx-auto m-lg-2 p-2" style="width:15rem ;cursor:pointer">
  <img class="card-img-top imageadd" width="80%" src="/add-image.svg" data-bs-toggle="modal" data-bs-target="#uploadModal"></img>
 
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Paylaşım Formu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
               
          <div class="mb-3">
              <label for="preview" class="form-label">Resim Önizleme</label>
              <img id="preview" src="#" alt="Resim Önizleme" class="img-fluid" style="display: none;">
            </div>
          <div class="mb-3">
            <label for="image" class="form-label">Resim Seç</label>
            <input class="form-control" type="file" id="image" accept="image/*">
          </div>
         
          <div class="mb-3">
            <label for="name" class="form-label">Ad</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label">Konu</label>
            <textarea class="form-control" id="description"></textarea>
          </div>
         
          <button type="submit" id="postbtn" class="btn btn-primary" data-bs-dismiss="modal"></button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Onay Kutusu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bu gönderiyi silmek istediğinizden eminmisiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Çık</button>
        <button type="button" class="btn btn-primary" id="deletebtn" data-bs-dismiss="modal">Sil</button>
      </div>
    </div>
  </div>
</div>
<script>
  var mode;
  var id;
    $(document).ready(function () {   
    $('#uploadModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          id=button.data('bs-id');    
          if(id)
          {
          mode=id.substr(4);
          var topDiv=$('div').first();
          var postDiv=topDiv.find(id);
          var content = postDiv.find('.card-text').text();
          var name = postDiv.find('.card-title').text();         
          var srcValue = postDiv.find('.card-img-top').attr('src');
          $('#description').text(content);
          $('#name').val(name);
          $('#preview').attr('src',srcValue);
          $("#postbtn").text("Güncelle");
          $('#preview').attr('style',"width:100px;max-height:100px;display:inherit");
          }
        else
         {
          mode=0;
          $("#postbtn").text("Ekle");
          $('#preview').attr('style',"display:none");         
         }
      });
      $('#confirmModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          id=button.data('bs-id');  
  });
  });
  
</script>
<script>
 
  function postfunc(id,mode)
  {
    const formData = new FormData();    
    formData.append('image', document.getElementById('image').files[0]);
    formData.append('name', document.getElementById('name').value);
    formData.append('description', document.getElementById('description').value);
    
    var urlto;
    if(mode=="add")
    urlto="{{route("posts.add")}}";
    else if(mode=="edit")
    {
      formData.append('id', id.substr(4));
      urlto="{{route("posts.update")}}";
    } 
    else if(mode=="del")
    {
    formData.append('id', id.substr(4));
    urlto="{{route("posts.delete")}}";
    }
    $.ajax({
      url: urlto,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if(response.success) {
          window.location.href = response.redirect;
          } else {
          alert(response.message);
        }
      },
      error: function(response) {
        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
      }
    });
    
  }  
  // Resim önizleme işlevi
  document.getElementById('image').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
    }

    reader.readAsDataURL(file);
  });

  $("#deletebtn").on('click',function(){
            postfunc(id,"del");
          })
  document.getElementById('postbtn').addEventListener('click', function(event) {
    event.preventDefault(); 
    if(mode==0)
    postfunc(id,"add");
    else
    {
      postfunc(id,"edit");        
    }  
  });
</script>
<script>
  // Resim önizleme işlevi
  
  $(document).ready(
    function(){
    document.getElementById('image').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
      preview.style.maxWidth="250px";
    }

    reader.readAsDataURL(file);
  });

});
</script>

