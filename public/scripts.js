setInterval(function () {
    const value = document.getElementById("value-lumber");
    const income = document.getElementById("income-lumber");
    value.innerText = String(parseInt(value.innerText) + parseInt(income.innerText));
}, 1_000);

setInterval(function () {
    const value = document.getElementById("value-stone");
    const income = document.getElementById("income-stone");
    value.innerText = String(parseInt(value.innerText) + parseInt(income.innerText));
}, 1_000);
