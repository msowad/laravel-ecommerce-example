<div>
    @include("partial.resend-code")
    <table class="table table-main table-responsive table-active rounded-3">
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Final price</th>
            <th class="text-right">Action</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td class="image-td"><a
                        href="{{ route('product.detail', $order->product->slug) . '?attribute=' . $order->productDetails->id }}"
                        class="btn btn-transparent p-0 shadow-0">
                        <img src="{{  $order->productDetails->photo->url }}" class="img-fluid" alt="">
                    </a></td>
                <td>
                    <h4 class="small-font f-500 text-nowrap">{{ $order->product->name }}</h4>
                    <p class="smaller-font">${{ $order->productDetails->price }}</p>
                </td>
                <td>
                    <p class="small-font text-black f-300">{{ $order->qty }}</p>
                </td>
                <td>
                    <p class="small-font text-black f-300">${{ $order->productDetails->price * $order->qty }}</p>
                </td>
                <td class="text-right">
                    <button onClick="setProductId({{ $order->productDetails->id }})" data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal" data-mdb-toggle="tooltip"
                        title="{{ $order->review ? 'You have rate this product' : 'Rate this product' }}"
                        class="btn btn-floating btn-light btn-lg"><i
                            class="fas fa-star {{ $order->review ? 'text__primary' : '' }}"></i></button>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate and review</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rateForm">
                    <div class="modal-body">
                        <div class="p-4">
                            <div class="d-flex justify-content-center">
                                <i data-index="1" class="rating-star fas fa-star big-font mr-2"></i>
                                <i data-index="2" class="rating-star fas fa-star big-font mr-2"></i>
                                <i data-index="3" class="rating-star fas fa-star big-font mr-2"></i>
                                <i data-index="4" class="rating-star fas fa-star big-font mr-2"></i>
                                <i data-index="5" class="rating-star fas fa-star big-font"></i>
                            </div>
                            <p class="text-danger text-center mt-2 smaller-font" id="rating"></p>
                        </div>
                        <label class="form-label">Leave a reply</label>
                        <textarea wire:model.defer="comment" id="comment" cols="10" rows="3"
                            class="form-control"></textarea>
                        @error('comment')
                            <p class="text-danger smaller-font">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeModal" class="btn btn-danger" data-mdb-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn__primary">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let ratedIndex = 0
    let productId = 0

    document.querySelector("#rateForm").addEventListener('submit', (e) => {
        e.preventDefault()
        if (ratedIndex < 1) {
            document.querySelector("#rating").textContent = "Please rate this product."
            return;
        }
        Livewire.emit('giveRate', ratedIndex, productId);
    })

    Livewire.on('closeModal', () => {
        closeModal()
    })

    Livewire.on('setRate', (rate) => {
        ratedIndex = rate
        setStars(rate)
    })

    $(document).ready(function() {
        resetStarColors()

        $(".rating-star").click(function() {
            ratedIndex = parseInt($(this).data('index'))
        })

        $(".rating-star").mouseover(function() {
            resetStarColors()
            setStars(parseInt($(this).data('index')))
        })

        $(".rating-star").mouseleave(function() {
            resetStarColors()
            if (ratedIndex !== 0)
                setStars(ratedIndex)
        })
    })

    function resetStarColors() {
        $(".rating-star").removeClass('text__primary')
    }

    function setStars(limit) {
        for (let i = 0; i < limit; i++)
            $(`.rating-star:eq(${i})`).addClass('text__primary')
    }

    function setProductId(id) {
        productId = id
        ratedIndex = 0
        resetStarColors()
        document.querySelector("#rating").textContent = ""
        $("#comment").val('')
        Livewire.emit('showReview', id)
    }

    function closeModal() {
        $('#closeModal').click()
    }

</script>
