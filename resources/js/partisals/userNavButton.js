/**
 * Initializes the user navigation button functionality.
 *
 * This keeps support for legacy markup only and avoids interfering with
 * Bootstrap's native dropdown behavior used by the current navbar.
 */

export function initUserNavButton() {
    const animationDur = 200;

    // Legacy selectors from old header markup.
    const triggerSelector = '.profile-icon';
    const containerSelector = '.profile-container';
    const menuSelector = '.profile-container .dropdown-menu';

    // If legacy markup doesn't exist, do nothing and let Bootstrap handle modern dropdowns.
    if (!document.querySelector(triggerSelector) || !document.querySelector(containerSelector)) {
        return;
    }

    $(document).off('click.userNavLegacy', triggerSelector);
    $(document).off('click.userNavLegacyClose');

    $(document).on('click.userNavLegacy', triggerSelector, function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(menuSelector).stop(true, true).slideToggle(animationDur);
    });

    $(document).on('click.userNavLegacyClose', function (event) {
        if (!$(event.target).closest(containerSelector).length) {
            $(menuSelector).stop(true, true).slideUp(animationDur);
        }
    });
}