import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Enable Bootstrap JS components (dropdowns, collapse, etc.)
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
