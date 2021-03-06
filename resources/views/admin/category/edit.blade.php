@extends('layouts.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.')}}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active"><a href="{{route('admin.product.index')}}">Категории</a></li>
            <li class="active">@if ($category->id) Редактирование @else Создание@endif категории</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>@if ($category->id) Редактировать @else Создать@endif </strong>категорию
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <div class="panel-body">
                    <form action="@if ($category->id) {{route('admin.category.update',compact('category'))}} @else {{route('admin.category.store')}} @endif" method="post" class="">
                    @if ($category->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                        <div class="form-group">
                            <label  class=" form-control-label">Название</label>
                            <input type="text" id="nf-name" name="name" @if ($category->id) value="{{$category->name}}" @endif  class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Описание</label>
                            <textarea type="text" id="nf-password" name="description" class="form-control">@if ($category->id) {{$category->description}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($category->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection