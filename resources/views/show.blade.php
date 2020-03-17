@extends('layouts.app')

@section('content')

    <div class="row d-flex justify-content-center">
        <div class="col-9">
            <div class="card text-center card-max">
                <img src="{{asset($picture->bigpict)??asset('img\default.jpg')}}" class="card-img-top card-img-big"
                     alt="...">
                <div class="card-body">
                    <p class="card-text">{{$picture->descript}}</p>
                    <p class="card-text">
                        <small class="text-muted">Автор: {{$picture->name}}</small>
                        <small class="text-muted">Просмотров: {{$picture->count_view}}</small>
                    </p>
                    <a href="/home" class="btn btn-outline-primary">На главную</a>
                    @auth
                        @if ($picture->user_id == Auth::id())
                            <a href="/edit/{{$picture->id}}" class="btn btn-outline-success">Редактировать</a>
                            <a href="/delete/{{$picture->id}}" class="btn btn-outline-danger">Удалить</a>
                        @endif
                    @endauth
                    <div class="card-body">
                    @foreach($tags as $tag)
                        <a href="/tag/{{$tag->id}}" class="card-link">#{{$tag->name}} </a>
                    @endforeach
                        <p class="card-date"><small class="text-muted"> Опубликовано: {{$picture->created_at->diffForHumans()}}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>



@endsection

