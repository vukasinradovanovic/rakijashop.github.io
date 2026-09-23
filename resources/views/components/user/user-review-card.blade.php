@props(['review'])
<div class="col-12 p-2">
    <div class="reviewCard border rounded bg-white-color p-2">
        <div class="d-flex flex-row align-items-start">
            <div class="reviewCard_userImg rounded-circle col-2 p-2 me-2"
                style="background-image: url('{{optional( $review->userImg)->img ? asset('storage/' .  $review->userImg->img) : asset('img/profile-picture.png') }}');">
            </div>
            <div class="col-10">
                <p class="reviewCard_userName m-0"><a href="{{ route('user.show', $review->getUsername()) }}" class="btnUnderline">{{  $review->name }} </a><span class="text-secondary ms-2">{{ $review->created_at->diffForHumans() }}</span></p>
                <div class="d-flex flex-row">
                    @for ($i=1; $i<=5; $i++)
                     @if ($i <= $review->pivot->rating)
                         <i class="fas fa-star text-warning"></i>
                     @else
                         <i class="far fa-star text-warning"></i>
                     @endif
                 @endfor 
                 </div>
                <p class="reviewCard_comment text-secondary m-0 mt-1 w-100">{{ $review->pivot->comment }}</p>
            
            </div>

        </div>
    </div>
</div>