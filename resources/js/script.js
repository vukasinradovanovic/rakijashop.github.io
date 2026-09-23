import $ from 'jquery';
import { initUserNavButton } from "./partisals/userNavButton";
import { initFilterForm }    from "./partisals/filterForm";
import { initReviews } from './partisals/products/reviews';

$(document).ready(function () {

    // Initialize user navigation button functionality
    initUserNavButton();

    // Initialize product filter form functionality
    initFilterForm();

    // Initialize product reviews functionality
    initReviews();
});