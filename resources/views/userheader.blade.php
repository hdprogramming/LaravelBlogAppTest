<x-slot name="header"> 
 

    <div class=container-fluid>   
    <div class="row"> 
        <div class="col-lg-2 col-md-3 col-4">   
    @if(Auth::user()->profilepic)
    <a href="{{route('profile.edit')}}">
    <img class="image rounded-circle" src="{{asset(Auth::user()->profilepic)}}" alt="profile_image" style="width: 100px;height: 100px;"
    >
    </a>
    @endif
        </div>
        <div class="col-lg-10 col-md-7 col-8">
            <div class="container position-relative" style="left:-5%" >
            <div class="row">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ Auth::user()->name }}
    </h2></div>
    <div class="row">
    <h4 class="text-m text-gray-500 dark:text-gray-200 leading-tight">
        {{ Auth::user()->description }}
    </h4>
    </div>
    </div>
    </div>
    </div> 
    </div>
</x-slot>