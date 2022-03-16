const base = location.protocol + '//' + location.host;

document.addEventListener('DOMContentLoaded', function() {

    btn_deleted = document.getElementsByClassName('btn-deleted');
    for (i = 0; i < btn_deleted.length; i++) {
        btn_deleted[i].addEventListener('click', delete_object)
    }

});


function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action;
    var title, text, icon;
    if (action == "delete") {
        title = "¿Estas seguro que quieres eliminador?";
        text = "Recuerda que esta acción eliminara la publicación de manera permanente.";
        icon = "warning";
    }
    swal({
            title: title,
            text: text,
            icon: icon,
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
            }
        });
}