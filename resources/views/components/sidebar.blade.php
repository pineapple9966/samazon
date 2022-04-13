<div class="container">
  @foreach ($categories as $major_category_name => $subcategories)
    <h2>{{ $major_category_name }}</h2>
    @foreach ($subcategories as $category)
      <label class="samazon-sidebar-category-label"><a href="{{ route('products.index', $category->id) }}">{{ $category->name }}</a></label>
    @endforeach
  @endforeach
</div>