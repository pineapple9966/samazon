<div class="container ml-3">
  <h2>受注管理</h2>
  <div class="d-flex flex-column">
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.orders.index') }}">受注一覧</a>
      </label>
  </div>

  <h2>商品管理</h2>
  <div class="d-flex flex-column">
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.major_categories.index') }}">親カテゴリ管理</a>
    </label>
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.categories.index') }}">カテゴリ管理</a>
    </label>
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.products.index') }}">商品一覧</a>
    </label>
    <label class="samazon-sidebar-category-label">CSV一括登録</label>
  </div>

  <h2>顧客管理</h2>
  <div class="d-flex flex-column">
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.users.index') }}">顧客一覧</a>
    </label>
  </div>

  <h2>その他</h2>
  <div class="d-flex flex-column">
    <label class="samazon-sidebar-category-label">新着情報管理</label>
    <label class="samazon-sidebar-category-label">管理ユーザー管理</label>
    <label class="samazon-sidebar-category-label">
      <a href="{{ route('admin.logout') }}">
        ログアウト
      </a>
    </label>
  </div>
</div>