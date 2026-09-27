@props(['review', 'user' => null])


<div class="col-12 p-2">
    <div class="reviewCard border rounded bg-white-color p-3">
        <div class="d-flex align-items-start">
            {{-- User Image --}}
            <div class="reviewCard_userImg rounded-circle flex-shrink-0 me-3" style="width: 60px; 
            height: 60px; 
            background-image: url('{{ optional($review)->profile_image ? asset($review->profile_image) : asset('img/profile-picture.png') }}'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;">
            </div>

            <div class="flex-grow-1">
                <p class="reviewCard_userName m-0">
                    <a href="{{ route('user.show', $review->getUsername()) }}"
                        class="btnUnderline fw-bold text-decoration-none">
                        {{ $review->name }}
                    </a>
                    <span class="text-secondary ms-2 fs-7">
                        {{ $review->created_at->diffForHumans() }}
                    </span>
                </p>

                <div class="d-flex align-items-center my-1">
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->pivot->rating)
                        <i class="fas fa-star text-warning"></i>
                        @else
                        <i class="far fa-star text-warning"></i>
                        @endif
                        @endfor
                </div>

                <p class="reviewCard_comment text-secondary m-0 w-100">
                    {{ $review->pivot->comment }}
                </p>
            </div>
        </div>
    </div>
</div>