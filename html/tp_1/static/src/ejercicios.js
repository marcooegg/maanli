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

    document.getElementById("ej1btn").addEventListener("click", function () {
        const ej_result = document.getElementById("ej_1");
        const result = "";
        ej_result.innerHTML = result;
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

    document.getElementById("ej6btn").addEventListener("click", function () {
        const ej6 = document.getElementById("ej_6");
        const modalEj6 = document.getElementById("modalEj6");
        
        ej6.innerHTML = result
    });

    document.getElementById("ej7btn").addEventListener("click", function () {
        const ej7 = document.getElementById("ej_7");
        ej7.innerHTML = result
    });

    document.getElementById("ej8btn").addEventListener("click", function () {
        const ej8 = document.getElementById("ej_8");
        ej8.innerHTML = result
    });

    document.getElementById("ej9btn").addEventListener("click", function () {
        const ej9 = document.getElementById("ej_9");
        ej9.innerHTML = result
    });

    document.getElementById("ej10btn").addEventListener("click", function () {
        const ej10 = document.getElementById("ej_10");
        ej10.innerHTML = result
    });

    document.getElementById("ej11btn").addEventListener("click", function () {
        const ej11 = document.getElementById("ej_11");
        ej11.innerHTML = result
    });

    document.getElementById("ej12btn").addEventListener("click", function () {
        const ej12 = document.getElementById("ej_12");
        ej12.innerHTML = result
    });

    document.getElementById("ej13btn").addEventListener("click", function () {
        const ej13 = document.getElementById("ej_13");
        ej13.innerHTML = result
    });

    document.getElementById("ej14btn").addEventListener("click", function () {
        const ej14 = document.getElementById("ej_14");
        ej14.innerHTML = result
    });
});