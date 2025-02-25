document.addEventListener("DOMContentLoaded", function () {
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
