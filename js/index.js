function cb(response) {
    const div = document.getElementById('number-access-div');
    const span = document.getElementById('number-access');
    div.classList.remove('d-none');
    span.innerHTML = response.value;
}