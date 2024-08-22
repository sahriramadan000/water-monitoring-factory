function updateTimeAndDate() {
    const now = new Date();
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

    document.getElementById('time').textContent = now.toLocaleTimeString('id-ID', timeOptions);
    document.getElementById('date').textContent = now.toLocaleDateString('id-ID', dateOptions);
}

setInterval(updateTimeAndDate, 1000);
updateTimeAndDate();
