function attachDeleteEvent() {
    $(document)
        .off("submit", ".delete-form")
        .on("submit", ".delete-form", function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Konfirmasi Hapus Data",
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "bg-red-600 text-white",
                    cancelButton: "bg-gray-300 text-gray-700",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
}

$(document).ready(function () {
    attachDeleteEvent(); // Panggil saat halaman pertama dimuat
});
