
console.log("-MELARC-")
confirmDelete()
function confirmDelete() {
    swal({
        title: "Seguro que quieres eliminar la publicación?",
        text: "Una vez eliminada no se podrá recuperar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Se eliminará la publicación!", {
                    icon: "success",
                });
            } else {
            }
        });




}
