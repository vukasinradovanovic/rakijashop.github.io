import { Modal } from 'bootstrap';
export function initReviews() {
    
    let selectedRating = 0;

    $('.star').on('mouseenter', function () {
        const rating = $(this).data('value');
        updateStars(rating);
    });

    $('.star').on('mouseleave', function () {
        updateStars(selectedRating);
    });

    $('.star').on('click', function () {
        selectedRating = $(this).data('value');
        $('#rating').val(selectedRating);
        updateStars(selectedRating);
    });

    function updateStars(rating) {
        $('.star').each(function () {
            const value = $(this).data('value');
            if (value <= rating) {
                $(this)
                    .removeClass('far')
                    .addClass('fas');
            } else {
                $(this)
                    .removeClass('fas')
                    .addClass('far');
            }
        });
    }
    if ($('#validation-errors').data('has-errors')) {
        const modalEl = document.getElementById('reviewModal');
            if (modalEl) {
                     const modal = Modal.getOrCreateInstance(modalEl);
                    modal.show();
            }
    }
}