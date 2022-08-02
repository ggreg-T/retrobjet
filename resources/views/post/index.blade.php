@extends('layouts.app')
@section('content')



<!-- page d'accueil  -->

<div class="boutonMenu">

  <div class="creer">
    <a class="aindex"  href="{{ route('posts.create') }}">
      Créer un post
    </a>
  </div>

  <div class="creer">
    <a class="aindex" href="{{ route('dashboard') }}">
      Dashboard
    </a>
  </div>
</div>

<div class="galerie">

  @foreach ($posts as $post)

  @if(session('success'))
  <div>
    {{ session('success') }}
  </div>
  @endif
  <div class="item">

    <a href="{{ URL::asset('/image/k77.jpg') }}"><img src="{{ URL::asset('/image/k77.jpg') }}" class="cardimg" alt="..."></a>

    <div class="c-body">
      <h5 class="c-title">
        <strong>
        {{ $post->nom_objet}}
      </strong>
    </h5>

      <!-- <p class="c-text">
       
        
          {{ Str::limit($post->description, 50)}}
      </p> -->
      <p class="c-text">
      Par  <em>{{ $post->user->name }} </em> le  <em>{{ $post->created_at->format('d N Y')}} </em>
      </p>
   
      <a href="{{ route('posts.show', $post)}}" class="btn btn-primary">Voir</a>
    </div>

    <a href="{{ route('deletPost', $post->id)}}">
      Supprimmer
    </a>
  </div>
  @endforeach

</div>
@include('layouts.footer')
@endsection