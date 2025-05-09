document.addEventListener("DOMContentLoaded", function () {

    const openModalBtn = document.getElementById('ej5btn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('modal5');
    // const modal = document.getElementsByClassName("modal");

    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    document.getElementById("ej2btn").addEventListener("click", function () {
        const ej_result = document.getElementById("ej_2");
        const name = "Marco Gabriel Oegg";
        const age = 33;
        const result = `<p>${name}</p><p>${age}</p>`;
        ej_result.innerHTML = result;
    });

    document.getElementById("ej3btn").addEventListener("click", function () {
        const ej_result = document.getElementById("ej_3");
        const name = document.getElementById("name").value;
        const salary = document.getElementById("salary").value;
        const result = `<p>${name}</p><p>${salary}</p>`;
        ej_result.innerHTML += result;
    });

    document.getElementById("ej4btn").addEventListener("click", function () {
        const ej_result = document.getElementById("ej_4");
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const result = `<p>${name}</p><p>${email}</p>`;
        ej_result.innerHTML = result;
    });

    document.getElementById("submitEx5").addEventListener("click", function () {
        const ej_result = document.getElementById("ej_5");
        const name = document.getElementById("modalName");
        const email = document.getElementById("modalEmail");
        const result = `<p>${name.value}</p><p>${email.value}</p>`;
        ej_result.innerHTML = result;
        modal.style.display = 'none';
    });

});