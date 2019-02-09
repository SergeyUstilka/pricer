@extends('layouts.admin')
@section('content')
    <style>
        .form-group{
            display: inline-block;
        }
        .filter-list{
            margin: 30px 0;
        }
    </style>
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.')}}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Категории</li>
        </ol>
    </div><!--/.row-->
    <div class="row" style="margin: 0px 0 20px 0;">
        <div class="col-md-3 "style="margin-top: 40px;">
            <a href="{{route('admin.category.create')}}" class="btn btn-lg btn-warning">Создать новую</a>
        </div>
        <div class="col-md-3 "style="margin-top: 40px;">
            <a href="{{route('admin.make_default_category')}}" class="btn btn-lg btn-primary">Создать дефолтные категории</a>
        </div>
    </div>
    @if ($message = Session::get('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Slug</th>
                        <th >Описание</th>
                        <th>Товары</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td style="max-width: 300px;">{{$category->description}}</td>
                            <td >
                                <div style="max-height: 200px; overflow: scroll;">
                                    <?php $i=1 ?>
                                    @foreach($category->products as $product)
                                        <p>{{$i++}}) <a href="{{route('admin.product.edit',['product'=>$product])}}">{{$product->name}}</a></p>
                                    @endforeach
                                </div>

                            </td>
                            <td>
                                <a href="{{route('admin.category.edit',['product'=>$category])}}" type="button" class="btn btn-md btn-primary">Редактировать</a>
                                <br>
                                <br>
                                <button type="button" class="btn btn-md btn-danger delete-data" data-url="{{route('admin.category.destroy',['category'=>$category])}}">Удалить</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
