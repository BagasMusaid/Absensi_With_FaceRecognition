document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-form").forEach((form) => {
        form.addEventListener("submit", function (event) {
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
                    form.submit();
                }
            });
        });
    });
    const passwordButton = document.getElementById("toogle-password");
    passwordButton.addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const openEye = document.getElementById("openEye");
        const closedEye = document.getElementById("closedEye");
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);
        if (type === "text") {
            closedEye.classList.add("hidden");
            openEye.classList.remove("hidden");
        } else {
            openEye.classList.add("hidden");
            closedEye.classList.remove("hidden");
        }
    });
});
