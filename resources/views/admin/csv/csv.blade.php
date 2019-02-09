@extends('layouts.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.')}}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Загрузка каталога</li>
        </ol>
    </div><!--/.row-->
    @if ($message = Session::get('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="row">
            <div class="col-md-3 "style="margin-top: 40px;">
                <a href="tesco.csv" class="btn btn-lg btn-primary">Скачать файл с сервера</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="panel-heading">Загрузка CSV</div>
            <div class="panel-body">
                <form action="{{route('admin.csv.store')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label >Магазин</label>
                        <select name="shop_id" class="form-control">
                            @foreach($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}} - {{$shop->id}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Выберите csv</label>
                        <input  required name="csv_files[]" multiple type="file"  aria-required="true" aria-invalid="false">
                    </div>
                    <div class="form-group">
                        <label>Описание файла</label>
                        <textarea name="description" id="" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-md btn-primary">
                            Загрузить
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Название магазина</th>
                            <th>Описание набора товаров</th>
                            <th>Статус</th>
                            <th>Путь к файлу</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($csv_files as $csv_file)
                            <tr>
                                <td>{{$csv_file->id}}</td>
                                <td>{{$csv_file->name}}</td>
                                <td>
                                    @foreach($shops as $shop)
                                        @if($shop->id == $csv_file->shop_id)
                                            {{$shop->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$csv_file->description}}</td>
                                <td>{{$csv_file->active}}</td>
                                <td> {{app_path().'/../public/storage/csv/'}} </br>{{$csv_file->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-md btn-warning disactivate-csv @if($csv_file->active == 0)hidden @endif" data-url="{{route('admin.disactivate_csv')}}"
                                       data-csv_id="{{$csv_file->id}}">Деактивировать</a>
                                    <a href="#" type="button" class="btn btn-md btn-primary activate-csv @if($csv_file->active == 1) hidden @endif" data-url="{{route('admin.activate_csv')}}"
                                           data-csv="{{$csv_file->name}}" data-shop="{{$csv_file->shop_id}}" data-csv_id="{{$csv_file->id}}">Активировать</a>
                                    <br>
                                    <br>
                                    <button type="#" class="btn btn-md btn-danger delete-data" data-url="{{route('admin.csv.destroy',['csv'=>$csv_file])}}">Удалить</button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection