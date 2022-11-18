const time = document.getElementById('time');
let local = new Date();
time.innerHTML = local.toLocaleTimeString();
const interval = setInterval(() => {
    local = new Date();
    time.innerHTML = local.toLocaleTimeString();
}, 1000);
