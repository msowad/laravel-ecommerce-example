<li class="p-relative sub-menu-container">
  <a href="{{ route('shop') }}" class="sub-menu-root @yield('shop') btn btn-white my-md-2 shadow-0 mx-lg-1">Shop
  </a>
  @if ($categories->count() > 0)
    <ul class="sub-menu bg-white shadow-1-strong py-2 rounded-3">
      @foreach ($categories as $category)
        <li class="p-relative"><a href="{{ route('category', $category->slug) }}"
            class="btn btn-white shadow-0">{{ $category->name }}
            @if ($category->subCategories->count() > 0)
              <i class="fa arrow fa-chevron-right ml-1"></i>
            @endif
          </a>
          @if ($category->subCategories->count() > 0)
            <ul class="sub-menu bg-white shadow-1-strong rounded-3 py-2">
              @foreach ($category->subCategories as $subCategory)
                <li class="p-relative"><a href="{{ route('category', $subCategory->slug) }}"
                    class="btn btn-white shadow-0">{{ $subCategory->name }}
                    @if ($subCategory->subCategories->count() > 0)
                      <i class="fa arrow fa-chevron-right ml-1"></i>
                    @endif
                  </a>
                  @if ($subCategory->subCategories->count() > 0)
                    <ul class="sub-menu bg-white shadow-1-strong rounded-3 py-2">
                      @foreach ($subCategory->subCategories as $subSubCategory)
                        <li>
                          <a href="{{ route('category', $subSubCategory->slug) }}"
                            class="btn btn-white shadow-0">{{ $subSubCategory->name }}</a>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  @endif
</li>
