function responsive() {
    var x = document.getElementById("content");
    if (x.classList.contains("hidden")) {
        x.classList.remove("hidden");
    } else {
        x.classList.add("hidden");
    }
}
