<div class="header-search">
    <form action="/search" method="post">
        @csrf
        <input class="input search-input" type="text" placeholder="Название товара" id="search_product"  autocomplete="off" name="data">
        <select class="input search-categories" name="category_id">
            <option value="">Все категории</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button class="search-btn"><i class="fa fa-search"></i></button>
    </form>
    <div id="clever_result"></div>
</div>