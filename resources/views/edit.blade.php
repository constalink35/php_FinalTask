@extends('layouts.app')

@section('content')

    <div class="row d-flex justify-content-center">
        <div class="col-9">
            <div class="card text-center card-max">
                <img src="{{asset($picture->bigpict)??asset('img\default.jpg')}}" class="card-img-top card-img-big"
                     alt="...">
                <div class="card-body">

                    <p class="card-text"><small class="text-muted">Просмотров: {{$picture->count_view}}</small></p>

                    <form action="{{route('update',$picture->id)}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="description">Введите комментарии к изображению:</label>
                            <textarea class="form-control" rows="2"
                                      name="description">{{old('description')??$picture->descript??''}}</textarea>
                        </div>
                        <div class="form-group ">
                            <label for="Tags">Введите теги разделяя их запятой:</label>
                            <textarea  data-role="tagsinput" class="form-control" name="tags"rows="1" >{{old('tags')??$strtags??''}}</textarea>
                        </div>
                        <a href="/home" class="btn btn-outline-primary">На главную</a>
                        @auth

                            @if ($picture->user_id == Auth::id())
                                <button type="submit" class="btn btn-outline-success">Сохранить</button>
                                <a href="/delete/{{$picture->id}}" class="btn btn-outline-danger">Удалить</a>
                            @endif
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>



@endsection

