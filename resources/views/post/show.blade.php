@extends('layouts.app')
@section('content')
<!-- test image  -->

<!-- <img src="{{ asset('/storage/').$post->image }}" alt="chat">
<img src="{{ Storage::url($post->image)}}" class="cardimg" alt="..."> -->
<img src="{{ URL::asset('/image/antique.jpg') }}">


<div class="detail">

    <h2 class="categ ">
        {{ $post->category->name }}
    </h2>

    <p class="c-text">
        Par <em>{{ $post->user->name }} </em>
    </p>
    <p class="c-text">
        Date de parution du post le : {{ $post->created_at->format('d N Y')}}
    </p>
   
    <p class="c-text">
        {{ $post->description }}
    </p>
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



    <!-- aller à la page édit  -->
    <a href="{{ route('posts.edit', $post) }}" class="editer">
        <div class="creer">
            Edit
        </div>
    </a>

    <!-- supprimer  -->
    <!-- <div class="inputBx">
        <a href="{{ route('posts.destroy', $post) }}"><input type="submit" value="Supprimer"></a>
    </div> -->
</div>
@endsection