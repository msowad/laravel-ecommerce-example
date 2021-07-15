@if (!auth()->user()->email_verified_at && !session()->has('mail_success_msg'))
    <button class="btn mb-4 w-100 btn-warning" wire:click="resendCode">
        <i class="small-font mr-2 fa fa-exclamation-triangle" aria-hidden="true"></i>
        You haven't verify your email. Your order will not successfully placed
        untill you
        verify
        your email. Click here to resend verification email.
    </button>
@endif

@if (session()->has('mail_success_msg'))
    <button type="button" class="btn btn-secondary mb-4 btn-block" wire:click="resendCode">
        {{ session('mail_success_msg') }}
    </button>
@endif
