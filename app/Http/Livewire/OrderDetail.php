<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class OrderDetail extends Component
{
    public $orders;
    public $comment;
    public $review;

    protected $listeners = ['giveRate', 'showReview'];

    public function showReview($pid)
    {
        $this->review  = Review::where('user_id', auth()->id())->where('product_attr_id', $pid)->first();
        $this->comment = $this->review ? $this->review->comment : null;
        $rate          = $this->review ? $this->review->rate : 0;
        $this->emit('setRate', $rate);
    }

    public function giveRate($rate, $pid)
    {
        if ($pid < 1) {
            return;
        }

        $rate > 5 ?? $rate = 5;
        $rate < 1 ?? $rate = 1;
        $this->validate([
            'comment' => "required|max:200",
        ]);

        $arr = [
            'user_id'         => auth()->id(),
            'comment'         => $this->comment,
            'rate'            => $rate,
            'product_attr_id' => $pid,
        ];

        $this->review ? $this->review->update($arr) : Review::create($arr);

        $this->emit('closeModal');
    }

    public function resendCode()
    {
        resendVerifyCode();
    }

    public function render()
    {
        return view('livewire.order-detail');
    }
}
