<x-app-layout>
   @include("userheader")   
   <form action="{{route('posts.search')}}" method="post">
   <div class="input-group rounded m-lg-2 float-lg-end mt-1" style="max-width:18em" >
    @csrf
    <input type="search" name="q" class="mx-1 form-control rounded" placeholder="Aramak için birşeyler yaz..." aria-label="Search" aria-describedby="search-addon" />
    <button class="btn-spec btn-blue rounded"><i class="fa fa-search"></i></button>
  </div>
</form>
    <div class="py-10">
        <div class="max-w-7xl">
            <div class="container-fluid bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                @include('addpost')  
             
                @foreach ($posts as $post) 
                <div class="col-12 col-md-4 col-lg-3">               
                <div id="div{{$post->id}}" class="mx-auto mb-2 card m-lg-2 p-2 border" >

                                <a href="{{route('postview')}}/?id={{$post->id}}">
                        <img class="card-img-top text-color-gray" width="250px" src="{{$post->imageurl}}">İçeriği Düzenle...</img>
                                </a>
                        <div class="card-body p-1">
                            <b>İçerik Adı</b> <h5 class="card-title">{{$post->name}}</h5>
                            <b>Konusu</b><p class="card-text"> {{$post->description}}</p>                                                  
                        </div>
                        <div class="d-flex gap-1">
                            <button class="btn-spec btn-green" data-bs-toggle="modal" data-bs-target="#uploadModal"  data-bs-id="{{"#div".$post->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                              </svg>
                            </button>
                            <button class="btn-spec btn-red" data-bs-toggle="modal" data-bs-target="#confirmModal"  data-bs-id="{{"#div".$post->id}}">x</button>
                          </div>
                        <p><small class="text-muted  float-end">{{$post->updated_at}}</small></p>
                </div>
                </div>
                @endforeach    
              </div>              
    </div>
    </div>
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