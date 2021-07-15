<form class="d-flex p-4">
    <input type="search" id="searchProduct" class="rounded form-control">
    <button class="btn btn__primary">
        <i wire:loading.class='d-none' class="fa fa-search" aria-hidden="true"></i>
        <div wire:loading.class.remove='d-none' class="spinner-border d-none spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </button>
    <button type="button" id="searchClose" class="btn btn-light btn-floating ml-3">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>
</form>
<script>
    $("#searchProduct").autocomplete({
        minLength: 3,
        source: "{{ route('searchTags') }}",
    });
    $("form").on('submit', function(e) {
        e.preventDefault();
        @this.search = $("#searchProduct").val();
    });

</script>
