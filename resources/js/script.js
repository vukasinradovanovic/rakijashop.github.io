import $ from 'jquery';
import { initUserNavButton } from "./partisals/userNavButton";
import { initFilterForm }    from "./partisals/filterForm";

$(document).ready(function () {

    // Initialize user navigation button functionality
    initUserNavButton();

    // Initialize product filter form functionality
    initFilterForm();
});