var i = 0;
$(document).ready(function () {
    setInterval(updateClock, 1000);
    updateCalendar();
    setInterval(updateCalendar, 36000000);
    setInterval(updateprogressbar, 1000);
});

function updateClock() {
    var currentTime = new Date();
    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + "";
    $("#clock").html(currentTimeString);
}

function updateCalendar() {
    const monthNames = ["Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni",
        "Juuli", "August", "September", "Oktoober", "November", "Detsember"
    ];
    var currentDated= new Date();
    var currentDate = currentDated.getDay();
    var currentMonth= currentDated.getMonth();
    var currentYear= currentDated.getFullYear();
    currentDate = (currentDate < 10 ? "0" : "") + currentDate;
    $("#date").html(currentDate);
    $("#month").html(monthNames[currentMonth]);
    $("#year").html(currentYear);
}


function updateprogressbar() {
    i++;
    document.getElementById("progressper").textContent = i;
    setProgress(i);
    if (i === 100)
        i=0;
}

function setProgress(percent) {
    var circle = document.querySelector('circle');
    var radius = circle.r.baseVal.value;
    var circumference = radius * 3 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;

    const offset = circumference - percent / 100 * circumference;
    circle.style.strokeDashoffset = offset;
}



