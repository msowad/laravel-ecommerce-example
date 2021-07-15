<div class="menu-button-container">
  <button class="mdc-button mdc-menu-button">
    <i class="mdi mdi-bell"></i>
    @if ($count > 0)
      <span class="count-indicator">
        <span class="count">{{ $count }}</span>
      </span>
    @endif
  </button>
  <div class="mdc-menu mdc-menu-surface" tabindex="-1">
    <div class="d-flex justify-content-between align-items-center border-darken-1 menu-header">
      <h6 class="title word-nowrap"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Going to be out of stock
      </h6>
      @if ($count > 0)
        <button wire:click="dismissAll" class="btn-responsive mdc-icon-button material-icons mr-3">
          done
        </button>
      @endif
    </div>
    <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
      @forelse ($products as $product)
        <a href="{{ route('dashboard.product.edit', $product->product->id) }}" class="mdc-list-item" role="menuitem">
          <div class="item-thumbnail">
            <img src="{{ $product->photo->url }}" alt="user">
          </div>
          <div class="item-content d-flex align-items-start flex-column justify-content-center">
            <h6 class="item-subject font-weight-normal">{{ $product->product->name }}</h6>
            <small class="text-muted"> {{ $product->qty }} </small>
          </div>
        </a>
      @empty
        <p class="text-center">No new notification</p>
      @endforelse
    </ul>
  </div>

</div>
