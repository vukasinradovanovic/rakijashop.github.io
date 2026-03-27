import { initDashboardUser } from "./partials/users/dahboardUser";
import { initDashboardProduct } from "./partials/products/dashboardProduct";
import { initDashboardSortAndFilter } from "./partials/questions/dashboardSortAndFilter";
import { initDashboardsearchData } from "./partials/searchData/dashboardSearchData";
import { initDashboardReadTrigger } from "./partials/questions/dashboardReadTrigger";
import { initDashboardCategoryProducts } from "./partials/categories/dashboardCategoryProducts";

$(document).ready(function () {

    // Questions sort and filter
    initDashboardSortAndFilter();

    // Users search and update 
    initDashboardUser();

    // Products search and update
    initDashboardProduct();

    // Product categories CRUD
    initDashboardCategoryProducts();

    // Search data
    initDashboardsearchData();

    // Questions read trigger
    initDashboardReadTrigger();
});