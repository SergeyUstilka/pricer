@extends('layouts.admin')
@section('content')

<div class="panel panel-default">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <div class="card-header">
                    <p>Товар: <b><a href="{{route('admin.product.edit',compact('product'))}}" target="_blank">{{$product->name}}</a></b></p>
                    <p>Категория:   {{$product->category->name}}</p>
                </div>
                <div class="panel-heading">Загурзить фото</div>
                <div class="panel-body">
                    <form action="{{route('admin.photo.store',['product'=>$product])}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Выберите фото</label>
                            <input  required name="images[]" multiple type="file"  aria-required="true" aria-invalid="false">
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
</div>

<div class="panel panel-default" style="padding: 30px 15px;">
    <div class="panel-heading">Загруженные фотографии товара</div>
    <div class="panel-body easypiechart-panel" style="position: relative;">

    @if (isset($product->photos[0]))
    <form method="post"  action="{{route('admin.photo.update', ['product'=>$product,'photo'=>$product->photos[0]])}}">
        <input name="_method" value="PUT" hidden >
        @csrf

    <div class="row" style="margin-top: 30px;">
        @foreach($product->photos as $photo)
            <div class="col-xs-6 col-md-3" >
                <div class="panel panel-default">
                        @if($photo->main_photo)
                            <div class="form-group">
                                <div class="radio">
                                    <lable><input type="radio"  value="{{$photo->id}}" name="main_photo" checked >Главная </lable>
                                </div>
                                <p style="padding: 20px 0 0 0; text-align: center">
                                    <a href="#" data-url="{{route('admin.photo.destroy',['product'=>$product, 'photo' => $photo])}}" class="btn btn-md btn-danger delete-data">
                                        Удалить
                                    </a>
                                </p>
                            </div>
                        @else
                            <div class="form-group">
                                <div class="radio">
                                    <lable><input type="radio" value="{{$photo->id}}" name="main_photo" >Сделать главной </lable>
                                </div>
                                <p style="padding: 20px 0 0 0; text-align: center">
                                    <a href="#" data-url="{{route('admin.photo.destroy',compact('product', 'photo'))}}" class="btn btn-md btn-danger delete-photo">
                                        Удалить
                                    </a>
                                </p>
                            </div>
                        @endif
                        <img src="{{asset('/storage/img/'.$photo->name)}}" alt="" style="display: inline-block;width:100%;padding: 15px;">

                    </div>
                </div>
        @endforeach

    </div>
        <button type="submit" class="btn btn-md btn-success">Обновить</button>
    </form>
    </div>

    </div>
</div>
    @endif
    <script>
        window.onload = function (){

            $('.delete-photo').click(function (event) {
            console.log($(this));
            event.preventDefault();
            var url = $(this).data('url');
            var row = $(this).parent().parent().parent().parent();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                method: 'DELETE',
                success: function () {
                    row.css('display', 'none');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
        };
    </script>
@endsection