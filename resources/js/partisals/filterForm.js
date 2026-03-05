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
