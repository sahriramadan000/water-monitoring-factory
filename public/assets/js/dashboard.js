document.querySelectorAll('.footer-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.footer-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});

function showChart(chartName, period) {
    document.querySelectorAll(`#${chartName}Daily, #${chartName}Weekly`).forEach(canvas => {
        canvas.style.display = 'none';
    });

    document.querySelector(`#${chartName}${capitalizeFirstLetter(period)}`).style.display = 'block';

    document.querySelectorAll(`.${chartName}Tab`).forEach(tab => {
        tab.classList.remove('active');
    });

    document.querySelector(`.${chartName}Tab[data-period="${period}"]`).classList.add('active');
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
