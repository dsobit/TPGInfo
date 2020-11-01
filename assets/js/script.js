let i = 0;
$(document).ready(function () {
    setInterval(updateClock, 1000);
    updateCalendar();
    setInterval(updateCalendar, 36000000);
    updateprogressbar();
    setInterval(updateprogressbar, 60000);
    updatemenu();
    setInterval(updateCalendar, 36000000);
    updatemenu();
    setInterval(updatemenu, 36000000);
    updateweather(updatemenu, 36000000);
});

function updateClock() {
    let currentTime = new Date();
    let currentHours = currentTime.getHours();
    let currentMinutes = currentTime.getMinutes();
    let currentSeconds = currentTime.getSeconds();
    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
    let currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + "";
    $("#clock").html(currentTimeString);
}

function updateCalendar() {
    const monthNames = ["Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni",
        "Juuli", "August", "September", "Oktoober", "November", "Detsember"
    ];
    let currentDated= new Date();
    let currentDate = currentDated.getDate();
    let currentMonth= currentDated.getMonth();
    let currentYear= currentDated.getFullYear();
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
            let hournow = new Date().getHours();
            let minutenow = new Date().getMinutes();

            response = response.split(' ').join(',').split(':').join(',').split(',');
            let lastminute = (parseInt(response[0])*60)+parseInt(response[1]);
            let nextminute = (parseInt(response[2])*60)+parseInt(response[3]);
            let nowminute = parseInt(hournow)*60+parseInt(minutenow);
            let timeleft = (nextminute-nowminute);

            let percentage = 100-(timeleft/(nextminute-lastminute)*100);
            document.getElementById("progressper").textContent = (timeleft+" min");
            setProgress(percentage);
        }
    });
}

function setProgress(percent) {
    let circle = document.querySelector('circle');
    let radius = circle.r.baseVal.value;
    let circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;
    circle.style.strokeDashoffset = circumference - percent / 100 * circumference;
}


function updatemenu() {
    let x;
    $.ajax({
        type: "POST",
        url: 'ajax_handler.php',
        data: "function=getmenu",
        dataType: "json",
        encoding: 'UTF-8',
        success: function(response) {
            x = response
            let i;
            //let day = new Date();
            //let n = day.getDay();
            //n = 5;
            //console.log(n);
            //if(0<n<5){
                for (i = 0; i < x.length; i++) {
                    if(x[i] !== ""){
                        let node = document.createElement("p1");
                        let texted = document.createTextNode(x[i].replace(/&nbsp;/g, ' '));
                        node.appendChild(texted);
                        node.appendChild(document.createElement("br"));
                        document.getElementById("menu").appendChild(node);
                    }
                }
            //}
        }
    });
}

function updateweather(){
    let x;
    $.ajax({
        type: "POST",
        url: 'ajax_handler.php',
        data: "function=getweather",
        dataType: "json",
        encoding: 'UTF-8',
        success: function (response) {
            x = response
            let i;
            for (i = 0; i < x.length; i++) {
                let tmpid = "tmp"+(i+1);
                let dateid = "date"+(i+1);
                let imageid = "ilmpic"+(i+1);
                document.getElementById(tmpid).innerHTML = x[i][0]+"°C";
                document.getElementById(dateid).innerHTML = x[i][1];
                console.log("assets/svg/weathericons/"+x[i][3]);
                document.getElementById(imageid).src = "assets/svg/weathericons/"+x[i][3];
            }

        }
    });
}


