document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.querySelector('.sidebar');
    var toggleSidebar = document.getElementById('toggleSidebar');
    var closeSidebarBtn = document.getElementById('closeSidebarBtn');

    toggleSidebar.addEventListener('click', function () {
        sidebar.classList.toggle('active');
    });

    closeSidebarBtn.addEventListener('click', function () {
        sidebar.classList.remove('active');
    });
});
