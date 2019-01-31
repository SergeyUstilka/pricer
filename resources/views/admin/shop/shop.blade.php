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
            <li class="active">Магазины</li>
        </ol>
    </div><!--/.row-->
    <div class="row" style="margin: 0px 0 20px 0;">
        <div class="col-md-3 "style="margin-top: 40px;">
            <a href="{{route('admin.shop.create')}}" class="btn btn-lg btn-warning">Создать новый</a>
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
                    @foreach($shops as $shop)
                        <tr>
                            <td>{{$shop->id}}</td>
                            <td>{{$shop->name}}</td>
                            <td>{{$shop->slug}}</td>
                            <td style="max-width: 300px;">{{$shop->description}}</td>
                            <td >
                                <div style="max-height: 200px; overflow: scroll;">
                                    <?php $i=1 ?>
                                    @foreach($shop->products as $product)
                                        <p>{{$i++}}) <a href="{{route('admin.product.edit',['product'=>$product])}}">{{$product->name}}</a></p>
                                    @endforeach
                                </div>

                            </td>
                            <td>
                                <a href="{{route('admin.shop.edit',['product'=>$shop])}}" type="button" class="btn btn-md btn-primary">Редактировать</a>
                                <br>
                                <br>
                                <button type="button" class="btn btn-md btn-danger delete-data" data-url="{{route('admin.shop.destroy',['shop'=>$shop])}}">Удалить</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
