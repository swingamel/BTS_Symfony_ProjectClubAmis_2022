$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});

function liste(){
    var id = document.getElementById(inscription_action).selectedIndex;

    var opts = document.getElementById(inscription_action).options;

    console.log(option[id]);

}
