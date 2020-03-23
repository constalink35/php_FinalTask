@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach ($pictures as $picture)
        <div class="col-4">

                <div class="card text-center" >
                    <img src="{{asset($picture->smallpict)??asset('img\default.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{$picture->descript}}</p>
                            <p class="card-text">
                                <small class="text-muted"> Автор: {{$picture->name}} </small>
                                <small class="text-muted">Просмотров: {{$picture->count_view}}</small>
                            </p>




                        <a href="/pictures/{{$picture->id}}" class="btn btn-outline-info">Просмотр</a>

                        @auth
                            @if ($picture->user_id == Auth::id())
                                <a href="/edit/{{$picture->id}}" class="btn btn-outline-success">Редактировать</a>
                                <a href="/delete/{{$picture->id}}" class="btn btn-outline-danger">Удалить</a>
                            @endif
                        @endauth
                    </div>

                    <div class="card-body">
                        @foreach($picture->tags as $tag)
                            <a href="/tag/{{$tag->id}}" class="card-link">#{{$tag->name}} </a>
                        @endforeach
                        <p class="card-date"><small class="text-muted"> Опубликовано: {{$picture->created_at->diffForHumans()}}</small></p>
                    </div>
                </div>


        </div>
        @endforeach
    </div>
    <br>
    <hr>
    {{$pictures->links()}}


@endsection

