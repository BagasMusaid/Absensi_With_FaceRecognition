function togglePassword() {
    const passwordInput = document.getElementById("password");
    const openEye = document.getElementById("openEye");
    const closedEye = document.getElementById("closedEye");

    // Ganti tipe input antara password dan text
    const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    if (type === "text") {
        closedEye.classList.add("hidden");
        openEye.classList.remove("hidden");
    } else {
        openEye.classList.add("hidden");
        closedEye.classList.remove("hidden");
    }
}

function togglePasswordNew() {
    const passwordInputNew = document.getElementById("passwordNew");
    const openEyeNew = document.getElementById("openEyeIcon");
    const closedEyeNew = document.getElementById("closedEyeIcon");

    // Ganti tipe input antara password dan text
    const type =
        passwordInputNew.getAttribute("type") === "password"
            ? "text"
            : "password";
    passwordInputNew.setAttribute("type", type);

    if (type === "text") {
        closedEyeNew.classList.add("hidden");
        openEyeNew.classList.remove("hidden");
    } else {
        openEyeNew.classList.add("hidden");
        closedEyeNew.classList.remove("hidden");
    }
}
