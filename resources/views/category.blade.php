@foreach ($categories as $major_category_name => $subcategories)
  <h4>{{ $major_category_name }}</h4>
  <ul>
    @foreach ($subcategories as $category)
      <li><a href="{{ route('products.index', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
  </ul>
@endforeach