import { initDashboardUser } from "./partials/users/dahboardUser";
import { initDashboardSortAndFilter } from "./partials/questions/dashboardSortAndFilter";
import { initDashboardsearchData } from "./partials/searchData/dashboardSearchData";
import { initDashboardReadTrigger } from "./partials/questions/dashboardReadTrigger";

$(document).ready(function () {

    // Questions sort and filter
    initDashboardSortAndFilter();

    // Users search and update 
    initDashboardUser();

    // Search data
    initDashboardsearchData();

    // Questions read trigger
    initDashboardReadTrigger();
});