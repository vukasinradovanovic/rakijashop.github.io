/**
 * Initializes the product filter form functionality.
 *
 * This function:
 * 1. Toggles the filter form body on mobile with a slide animation.
 * 2. Keeps the toggle button aria-expanded state in sync.
 * 3. Auto-submits the form when a select field changes (category / sort).
 */

export function initFilterForm() {

    const animationDur = 250;

    function updateRangeOutput($form, rangeName) {
        const min = $form.find(`[data-range="${rangeName}-min"]`).val();
        const max = $form.find(`[data-range="${rangeName}-max"]`).val();
        const suffix = rangeName === 'price' ? ' RSD' : rangeName === 'volume' ? ' ml' : '%';

        $form.find(`[data-range-output="${rangeName}"]`).text(`${min} - ${max}${suffix}`);
    }

    $('.filterForm').each(function () {
        const $form = $(this);
        ['price', 'volume', 'alcohol'].forEach(rangeName => updateRangeOutput($form, rangeName));
    });

    $(document).on('input', '.filterForm_range', function () {
        const $form = $(this).closest('.filterForm');
        const rangeName = $(this).data('range').replace(/-(min|max)$/, '');
        const minInput = $form.find(`[data-range="${rangeName}-min"]`);
        const maxInput = $form.find(`[data-range="${rangeName}-max"]`);

        if (Number(minInput.val()) > Number(maxInput.val())) {
            if ($(this).data('range').endsWith('-min')) {
                minInput.val(maxInput.val());
            } else {
                maxInput.val(minInput.val());
            }
        }

        updateRangeOutput($form, rangeName);
    });

    // Mobile toggle — slide body open / closed
    $(document).on('click', '.filterForm_toggleBtn', function () {
        const $btn  = $(this);
        const $form = $btn.closest('.filterForm');
        const $body = $form.find('.filterForm_body');

        $body.stop(true, true).slideToggle(animationDur, function () {
            const isOpen = $(this).is(':visible');
            $form.toggleClass('filterForm--open', isOpen);
            $btn.attr('aria-expanded', isOpen ? 'true' : 'false');
        });
    });

    // Auto-submit when a select inside the filter form changes
    $(document).on('change', '.filterForm_body .form-select', function () {
        $(this).closest('.filterForm_body').trigger('submit');
    });
}
