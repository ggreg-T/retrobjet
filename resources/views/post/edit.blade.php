<!-- @extends('layouts.app')
@section('content')
<br>

<h1>ÉDITER UN POST</h1>
<br><br>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @foreach ($errors->all() as $error)
            <span class="block text-red-500">{{ $error }}</span>
        @endforeach

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <x-label for="title" value="Titre du post" />
            <x-input id="title" name="title" :value="$post->title" />

            <x-label for="content" value="Contenu du post" />
            <textarea id="content" name="content">{{ $post->content }}</textarea>

            <x-label for="image" value="Image du post" />
            <x-input type="file" id="image" name="image"/>

            <x-label for="category" value="Categorie du post" />

            <select name="category" id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id === $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>

            <x-button style="display: block !important" class="mt-10">Modifier mon post</x-button>
        </form>
    </div>
    @endsection -->

 <!-- AUTRE MÉTHODE  -->
 @extends('layouts.app')
@section('content')
<br>

<h1>ÉDITER UN POST</h1>
<br><br>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    @foreach ($errors->all() as $error)
    <span class="block text-red-500">{{ $error }}</span>
    @endforeach

    <form action="{{ route('updatePost', $post->id) }}" method="get" enctype="multipart/form-data">
        @csrf
        <!-- nom objet  -->
        <label for="nom_objet" value="Titre du post">
            <input id="nom_objet" name="nom_objet" :value="$post->nom_objet" >
        </label>
        <!-- description  -->
        <label for="description" value="description du post">
            <textarea id="description" name="description">{{ $post->description }}</textarea>
        </label>

        <!-- image  -->
        <label for="image" value="{{ $post['image'] }}" >
        <input type="file" id="image" name="image" >
        </label>

        <!-- categorie  -->
        <label for="category" value="Categorie du post">

            <select name="category" id="category">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id === $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <div class="inputBx">
            <input type="submit" value="Valider">
        </div>
    </form>
</div>
