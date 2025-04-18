@extends('AE.layouts')

@section('title', 'Product')
@section('description', 'MS productPage')
@section('name', 'ANAHEIM ELECTRONICS')
@section('index.css')
<link href="{{ asset('product.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<div class="product_main">
    <div class="mobilesuit">
        <img src="{{ asset('storage/photos/' . $product->img_path) }}" alt="{{ $product->name }}">
        <p>{{ $product->name }}</p>
        <p>$ {{ $product->price }}</p>
    </div>
    <article>
        <p>{{ $product->description }}</P>
    </article>
</div>
{{-- 以下、個数選択と購入ボタンコード --}}
<section class="button">
<form action="{{ route('cart.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label for="quantity">Quantity:</label>
        <select id="quantity" name="quantity">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Add to Cart</button>
    </form>
</section>

<section class="comment">
    <h2>レビューとコメント</h2>
    @if ($comments)
        @foreach ($comments as $comment)
        <div>        
            <section class="review-display">
                <div id="starRate" class="stars">
                    @php
                        $totalStars = 5;
                    @endphp
                    @for ($i = 1; $i <= $totalStars; $i++)
                        <span class="{{ $i <= $comment->review ? 'selected' : '' }}">☆</span>
                    @endfor
                </div>
            <p>{{ $comment->comment }}</p>
        </div>
        @endforeach
        <div class="pagination">
            {{ $comments->links() }}
        </div>
    @else
        <p>コメントはまだありません。</p>
    @endif

</section>

<section class="comment-form">
    <h2>コメントを投稿する</h2>
    <form action="{{ route('comment.store',  ['id' => $product->id])}}" method="POST">
        @csrf
        <div id="starRating" class="stars">
            ☆☆☆☆☆
        </div>
        <input type="hidden" name="review" id="review" value="">
        <div>
            <label for="comment">コメント：</label>
            <textarea name="comment" id="comment" rows="4" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const starsDiv = document.getElementById('starRating');
        const reviewInput = document.getElementById('review');
        const stars = starsDiv.textContent.trim().split('');

        function updateStars(rating) {
            starsDiv.innerHTML = '';
            stars.forEach((star, index) => {
                const span = document.createElement('span');
                span.textContent = star; 
                span.classList.add('star');
                if (index < rating) {
                    span.classList.add('selected');
                }

                span.addEventListener('click', () => {
                    const newRating = index + 1;
                    updateStars(newRating); 
                    reviewInput.value = newRating; 
                });

                starsDiv.appendChild(span);
            });
        }

        updateStars(0);
    });
</script>
@endsection

@section('subcontent')
<ul class="MSlist">
    @foreach ($products as $product)
    <li>
        <img src="{{ asset('storage/photos/' . $product->img_path) }}" alt="{{ $product->name }}">
        <p><a href="/AE/product/{{ $product->id }}">{{ $product->name }}</a></p>
        <p>Price:$ {{ $product->price }}</p>
    </li>
    @endforeach
</ul>
@endsection