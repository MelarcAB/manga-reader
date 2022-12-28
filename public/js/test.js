function confirmDelete(button) {
    event.preventDefault();
    swal({
        title: "Seguro que quieres eliminar la publicación?",
        text: "Una vez eliminada no se podrá recuperar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Eliminando!", {
                icon: "success",
            });
            // En lugar de hacer un return true, usamos el método submit del formulario
            button.form.submit();
        }
    });
}