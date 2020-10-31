var i = 0;
$(document).ready(function () {
    setInterval(updateClock, 1000);
    updateCalendar();
    setInterval(updateCalendar, 36000000);
    updateprogressbar();
    setInterval(updateprogressbar, 60000);
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
    var currentDate = currentDated.getDate();
    var currentMonth= currentDated.getMonth();
    var currentYear= currentDated.getFullYear();
    currentDate = (currentDate < 10 ? "0" : "") + currentDate;
    $("#dateq").html(currentDate);
    $("#month").html(monthNames[currentMonth]);
    $("#year").html(currentYear);
}


function updateprogressbar() {
    $.ajax({
        type: "POST",
        url: 'ajax_handler.php',
        data: "function=gettime",
        success: function(response) {
            var hournow = new Date().getHours();
            var minutenow = new Date().getMinutes();

            response = response.split(' ').join(',').split(':').join(',').split(',');
            var lastminute = (parseInt(response[0])*60)+parseInt(response[1]);
            var nextminute = (parseInt(response[2])*60)+parseInt(response[3]);
            var nowminute = parseInt(hournow)*60+parseInt(minutenow);
            var timeleft = (nextminute-nowminute);

            var percentage = 100-(timeleft/(nextminute-lastminute)*100);
            document.getElementById("progressper").textContent = (timeleft+" min");
            setProgress(percentage);
        }
    });
}

function setProgress(percent) {
    var circle = document.querySelector('circle');
    var radius = circle.r.baseVal.value;
    var circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;

    const offset = circumference - percent / 100 * circumference;
    circle.style.strokeDashoffset = offset;
}


function updatemenu() {
    $.ajax({
        type: "POST",
        url: 'ajax_handler.php',
        data: "function=getmenu",
        success: function(response) {
            console.log(response[7]);
        }
    });
}


