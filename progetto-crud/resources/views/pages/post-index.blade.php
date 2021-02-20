@extends('layout.main-layout')

@section('section')


    @foreach ($posts as $post)

      <post
      :id= "{{ $post -> id}}"
      :title= "'{{ $post -> title}}'"
      :content= "'{{ $post -> content}}'"
      :likes= "{{ $post -> likes}}"
      >
      </post>

    @endforeach

@endsection
