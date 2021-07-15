@section('title')
    Contact Detail
@endsection

@section('contacts')
    active
@endsection
<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner p-relative">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
                @include('admin.progress-indicator')
                <div>
                    <h6 class="card-title card-padding px-3 py-4">Contact</h6>
                </div>

                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="">
                            <h1 class="m-0 mdc-typography--headline4">
                                {{ $contact->name }}
                            </h1>
                            <h1 class="m-0 mdc-typography--headline6">
                                {{ $contact->email }}
                            </h1>
                        </div>
                        <div class="">
                            {{ dataTableDate($contact->created_at) }}
                            <br>
                            {{ dataTableTime($contact->created_at) }}
                        </div>
                    </div>
                    <hr>
                    <h5 class="mdc-typography--body1">
                        {{ $contact->body }}
                    </h5>
                </div>

            </div>
        </div>
    </div>
</div>
