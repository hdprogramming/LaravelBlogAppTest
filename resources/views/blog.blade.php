<x-app-layout>
    @php
    function strclip($string)
    {
    if(strlen($string)>10)
    return substr($string,0,10)."...";
    else 
    return $string;
    }
    @endphp

    <div class="shadow p-3">
        <div class="row">
           <div style="max-width:150px" class="col"><img src="{{$selectedpost->imageurl}}"></div>
           <div class="col-8">
            <label class="text-black-100">{{$selectedpost->name}}</label>
            <br><label class="text-black-100">{{strclip($selectedpost->description)}}</label>
          </div>
      </div> 
         </div>
         <div class="p-2">       
            <div class="max-w-7xl mx-auto">
                
                <div  class="p-2 bg-white dark:bg-gray-800">
                    <div id="content" class="cas">                 
                    {!!$selectedpost->content!!}
                </div>  
        </div>
            <div class="p-1 bg-white">
        <button class="btn-spec btn-green" type="button" data-bs-toggle="collapse" data-bs-target="#editbox1" aria-expanded="false" aria-controls="editbox1">
            Editle
          </button>
            </div>
        </div>
        </div>
         <div id="editbox1" class="collapse" > 
            <div class=" bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                
        <div id="editor"> 
        
        </div>
        <input class="m-1 btn-spec btn-green float-end" type="submit" id="save" value="Kaydet">
</div>
        </div>
    
    
    <script>
        var editor;
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder:  {
                    uploadUrl: "{{ route('posts.uploadimage', ['_token' => csrf_token()]) }}",
                }
            })
            .then( newEditor => {
        editor = newEditor;
    } )            
            .catch(error => {
                console.error(error);
            });
            
    const saveButton = document.querySelector( '#save' );
    $('document').ready(function(e){
                var data=$("#content").html();
                editor.setData(data);
    });
    saveButton.addEventListener( 'click', evt => {
        const editorData = editor.getData();
        let id="{{$selectedpost->id}}";
        $.ajax({
      url: "{{route('posts.save')}}",
      type: 'post',
      data: {'id':id,'content':editorData},
      success: function(response) {
        if(response.success) {
          editor.setData(response.content);
          $("#content").html(response.content);
          } else {
          alert(response.message);
        }
      },
      error: function(response) {
        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
      }
    });
    })
    </script>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">userposts</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif  

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>