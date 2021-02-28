/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import { Toast,Tooltip,Popover } from "bootstrap";
// start the Stimulus application
import './styles/bootstrap.scss';
import './styles/app.scss';
import 'feather-icons/dist/feather.min';
const feather = require('feather-icons')
// Dropdown Sidebar Menu
let sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
for(var i = 0; i < sidebarItems.length; i++) {
    let sidebarItem = sidebarItems[i];
    sidebarItems[i].querySelector('.sidebar-link').addEventListener('click', function(e) {
        e.preventDefault();

        let submenu = sidebarItem.querySelector('.submenu');

        if(submenu.classList.contains('active')) submenu.classList.remove('active');
        else submenu.classList.add('active');
    })
}

// Navbar Toggler
let sidebarToggler = document.querySelectorAll(".sidebar-toggler");
for (var i = 0; i < sidebarToggler.length; i++) {
    let toggler = sidebarToggler[i];
    toggler.addEventListener('click', () => {
        let sidebar = document.getElementById('sidebar');
        if(sidebar.classList.contains('active')) sidebar.classList.remove('active');
        else sidebar.classList.add('active');
    });
}

// Perfect Scrollbar INit
if(typeof PerfectScrollbar == 'function') {
    const container = document.querySelector(".sidebar-wrapper");
    const ps = new PerfectScrollbar(container);
}

window.onload = function() {

    var w = window.innerWidth;
    if(w < 768) {
        console.log('widthnya ', w)
        document.getElementById('sidebar').classList.remove('active');
    }
}
feather.replace()




