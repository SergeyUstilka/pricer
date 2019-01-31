<ul class="category-list">
    <li @if(!isset($current_category) && strripos($_SERVER['REQUEST_URI'],'catalog'))id="current_category" @endif><a
                href="{{route('catalog')}}">Все товары</a></li>
    @foreach($categories as $category)
        <li
                @if(isset($current_category)&&  $current_category == $category)id="current_category" @endif
        >
            <a href="{{route('catalog',compact('category'))}}">{{$category->name}} <span>({{count($category->products)}}</span>)</a>
        </li>
    @endforeach
</ul>
