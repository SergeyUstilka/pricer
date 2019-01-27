<ul class="category-list">
    @foreach($categories as $category)
    <li><a href="{{route('catalog',compact('category'))}}">{{$category->name}}</a></li>
    @endforeach
</ul>
