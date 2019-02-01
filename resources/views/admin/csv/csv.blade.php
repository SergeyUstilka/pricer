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
                <div>
                    <button id="payment-button" type="submit" class="btn btn-md btn-primary">
                        Загрузить
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection