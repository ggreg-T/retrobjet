@extends('layouts.app')
@section('content')
<!-- test image  -->
<img src="{{ URL::asset('/image/antique.jpg') }}">
<img src="{{ Storage::url($post->image)}}" class="cardimg" alt="...">

<h2 class="font-semibold tex-xl text-gray-800 ">
    {{ $post->name }}
</h2>

<p class="c-text">
    Date de parution du post le :{{ $post->created_at->format('d N Y')}}
</p>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <img src="{{ asset('/storage/').$post->image }}" alt="chat">
    <div>
        {{ $post->description }}
    </div>

    <!-- aller à la page édit  -->
    <div class="creer">
        <a href="{{ route('posts.edit', $post) }}" class="editer">Edit</a>
    </div>
</div>