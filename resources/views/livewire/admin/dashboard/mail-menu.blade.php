<div class="menu-button-container">
    <button class="mdc-button mdc-menu-button">
        <i class="mdi mdi-email"></i>
        @if ($count > 0)
            <span class="count-indicator">
                <span class="count">{{ $count }}</span>
            </span>
        @endif
    </button>
    <div class="mdc-menu mdc-menu-surface" tabindex="-1">
        <div class="d-flex justify-content-between align-items-center border-darken-1 menu-header">
            <h6 class="title d-flex align-items-center"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
            @if ($count > 0)
                <button wire:click="markAll" class="btn-responsive mdc-icon-button material-icons mr-3">
                    done
                </button>
            @endif
        </div>
        <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            @forelse ($mails as $mail)
                <a href="{{ route('dashboard.contacts_detail', $mail->id) }}" class="mdc-list-item" role="menuitem">
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="item-subject font-weight-normal">{{ substr($mail->body, 0, 30) }}</h6>
                        <small class="text-muted"> {{ $mail->created_at->diffForHumans() }} </small>
                    </div>
                </a>
            @empty
                <a href="{{ route('dashboard.contacts') }}">
                    <li class="mdc-list-item" role="menuitem">
                        No unread message see all
                    </li>
                </a>
            @endforelse
        </ul>
    </div>
</div>
