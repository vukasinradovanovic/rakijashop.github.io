/**
 * Initializes the user navigation button functionality.
 * 
 * This function:
 * 1. Toggles the dropdown menu of user profile icon with animation.
 * 2. Hides dropdown menu when it is clicked outside of the dropdown itself.
 */

export function initUserNavButton() {

    // Duration of animation
    let animationDur = 200;

    // Dropdown meni for profile with animation
    $(document).on('click', ".profile-icon", function() {
        $(".dropdown-menu").stop(true, true).slideToggle(animationDur); // 200ms 
    });

    // Closing of dropdown profile with cloasing animation
    $(document).click(function (event) {
        if (!$(event.target).closest(".profile-container").length) {
            $(".dropdown-menu").stop(true, true).slideUp(animationDur); 
        }
    });
}