@extends('layout.main-layout')

@section('section')

    <post
      :creator="true"
    >

    </post>

    @foreach ($posts as $post)

      <post
        :id= "{{ $post -> id}}"
        :title= "'{{ $post -> title}}'"
        :content= "'{{ $post -> content}}'"
        :likes= "{{ $post -> likes}}"
        :creator= "false"
      >
      </post>

    @endforeach

@endsection
