@extends('layout.main-layout')

@section('section')


    @foreach ($posts as $post)

      <post
      :title= "'{{ $post -> title}}'"
      :content= "'{{ $post -> content}}'"
      :likes= "{{ $post -> likes}}"
      >
      </post>

    @endforeach

@endsection
