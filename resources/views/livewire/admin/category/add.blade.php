@section('category-add')
    active
@endsection
@section('title')
    Add Category
@endsection
<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                @include('admin.progress-indicator')
                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">Add Category</h6>
                        <a href="{{ route('dashboard.category') }}" class="">All</a>
                    </div>
                    <div class="template-demo">
                        <form wire:submit.prevent='submit'>
                            @include('livewire.admin.category.form-partial')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
