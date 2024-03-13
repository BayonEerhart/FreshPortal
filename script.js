function openModal() {
    var myModal = new bootstrap.Modal(document.getElementById('email-fail'));
    myModal.show();
    history.pushState({}, "", "index.php");
}