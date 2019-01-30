@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>@if ($product->id) Редактировать @else Создать@endif </strong>товар
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <div class="panel-body">
                    <form action="@if ($product->id) {{route('admin.product.update',compact('product'))}} @else {{route('admin.product.store')}} @endif" method="post" class="">
                    @if ($product->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                        <div class="form-group">
                            <label  class=" form-control-label">Название</label>
                            <input type="text" id="nf-name" name="name" @if ($product->id) value="{{$product->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label  class=" form-control-label">Цена</label>
                            <input type="text" id="nf-email" name="price" @if ($product->id) value="{{$product->price}}" @endif  class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Категория</label>
                                    <select name="cat_id" class="form-control">
                                        @foreach($categories as $category)
                                            @if ($product->cat_id == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->name}} - {{$category->id}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}} - {{$category->id}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Магазин</label>
                                    <select name="shop_id" class="form-control">
                                        @foreach($shops as $shop)
                                            @if ($product->cat_id == $shop->id)
                                                <option value="{{$shop->id}}" selected>{{$shop->name}} - {{$shop->id}}</option>
                                            @else
                                                <option value="{{$shop->id}}">{{$shop->name}} - {{$shop->id}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class=" form-control-label">Еденицы измерения</label>
                            <input type="text"  name="unit" @if ($product->id) value="{{$product->unit}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea type="text" id="nf-password" name="desription" class="form-control">@if ($product->id) {{$product->desription}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($product->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.product.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection