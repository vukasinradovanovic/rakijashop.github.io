@props(['user'])
   <!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('reviews.store', ['locale' => app()->getLocale()]) }}" method="POST">
    @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">{{ __('reviews.form.title') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('reviews.form.close') }}"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="comment">{{ __('reviews.form.comment') }}</label>
                <textarea name="comment" id="comment" cols="30" rows="6" class="form-control">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="rating">{{ __('reviews.form.rating') }}</label>
                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="far fa-star fs-3 star text-warning" data-value="{{ $i }}"></i>
                    @endfor
                </div>
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">  
                <input type="hidden" name="rating" id="rating" value="{{ old('rating', 0) }}">
                @error('user_id')
                  <p class="error">{{ $message }}</p>
                @enderror
                @error('rating')
                    <p class="error">{{ $message }}</p>
                @enderror           
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('reviews.form.cancel') }}</button>
          <button type="submit" class="btn btnPrimary">{{ __('reviews.form.submit') }}</button>
        </div>
      </div>
    </form>
    </div>
  </div>