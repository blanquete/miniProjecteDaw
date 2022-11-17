const time = document.getElementById("time");

console.log(time.innerHTML);
const interval = setInterval(() => {
    const local = new Date();
    time.innerHTML = local.toLocaleTimeString();
}, 1000);
