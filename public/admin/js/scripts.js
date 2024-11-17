const BASEPATH = document.querySelector("meta[name='BASEPATH']").getAttribute("content");
const STORAGE_BASE = document.querySelector("meta[name='STORAGE_BASE']").getAttribute("content");

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

const btn =document.querySelector("#LogoutButton")
    btn.addEventListener("click",()=>{
    const form =document.querySelector("#LogoutForm")
    form.submit();
})