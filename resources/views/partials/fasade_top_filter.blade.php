<!-- store top filter -->
<?php
$catalog_filter =  $request->session()->get('catalog_filter')
?>


        <div style="margin-bottom: 30px;">
            <div class="pull-left">

                <div class="sort-filter">
                    <p class="text-uppercase">Сортировать по:</p>
                    <select class="input" name="sort_by">
                        <option value="updated_at" @if($catalog_filter['sort_by']== 'updated_at') selected @endif>Новизне</option>
                        <option value="price" @if($catalog_filter['sort_by']== 'price') selected @endif>Цене</option>
                    </select>
                    <button type="submit" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="pull-left">
                <div class="page-filter">
                    <p class="text-uppercase">Товаров на странице:</p>
                    <select class="input" name="count_product">
                        <option value="15" @if($catalog_filter['count_product']== '15') selected @endif>15</option>
                        <option value="30"@if($catalog_filter['count_product']== '30') selected @endif>30</option>
                        <option value="45"@if($catalog_filter['count_product']== '45') selected @endif>45</option>
                    </select>
                    <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="pull-left">
                <div class="page-filter">
                    <p class="text-uppercase">Магазин</p>
                    <select class="input" name="sort_shop">
                        <option value="all" @if($catalog_filter['shop']== 'all') selected @endif>Все</option>
                        @foreach($shops as $shop)
                            <option value="{{$shop->name}}"@if($catalog_filter['shop']== $shop->name) selected @endif>{{$shop->name}}</option>
                        @endforeach
                    </select>
                    <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
        </div>


<!-- /store top filter -->