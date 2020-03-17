@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-9">
        <div class="card">
            <div class="card-header">Загрузка файлов</div>

            <div class="card-body">

                <form action="/store" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="description">Введите комментарии к изображению:</label>
                        <textarea class="form-control" rows="3" name="description">{{old('description')??''}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="Tags">Введите теги разделяя их запятой:</label>
                        <textarea  data-role="tagsinput" class="form-control" name="tags"rows="1" >{{old('tags')??''}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" id="fileUpload" class="custom-file-input" name="fileUpload[]" multiple >
                            <label class="custom-file-label" for="fileUpload" data-browse="Обзор...">Выберите файлы</label>
                        </div>

                        <small id="fileHelp" class="form-text text-muted">Выберите файлы изображения для загрузки.
                            Размер файла не должен превышать 2MB.</small>
                    </div>


                    @auth

                        <button type="submit" class="btn btn-outline-success">Загрузить</button>
                    @endauth

            </div>
        </div>
        </div>
@endsection
