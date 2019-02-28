const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];

const now = new Date();

lineN = 1;
colN = 1;


function arraySearch(arr,val) {
    for (var i=0; i<arr.length; i++)
        if (arr[i] === val)
            return i;
    return false;
}



function isInt(n){
    return (n%1 === 0);
}

function isBisextile(n){
    if(isInt(n/4) && !isInt(n/100)){
        return true;
    }
    else{
        if(isInt(n/100) && isInt(n/400)){
            return true;
        }
    }
    return false;
}

function updateDate(){
    month = monthNames[today.getMonth()];
    year = today.getFullYear();
    $('#currMonth').text(month+' '+year);
}

thonedays = [0,2,4,6,7,9,11];
otherDays = [3,5,8,10];


function getNbDays(){
    if(tempDate.getMonth() === 1){
        if(isBisextile(today.getFullYear())){
            return 29;
        }
        return 28;
    }
    else{
        if(thonedays.includes(tempDate.getMonth())){
            return 31;
        }
        else{
            return 30;
        }
    }
}

function updateCalendar(){
    $("#calendar").html(defaultTable);
    tempDate = new Date();
    tempDate.setFullYear(today.getFullYear());
    tempDate.setMonth(today.getMonth());
    tempDate.setDate(1);
    nbDays = getNbDays();
    currDay = tempDate.getDay();
    for(lineN = 1; lineN <= 6; lineN++){
        colN= 1;
        if(currDay === 0) currDay = 7;
        currLine = $('#line' + lineN);
        if(lineN === 1){
            while(colN < currDay){
                newLine = document.createElement('td');
                $(newLine).addClass('unselectable');
                $(newLine).attr('id', 'l'+lineN+'c'+colN);
                currLine.append(newLine);
                colN++
            }
        }

            while(colN <= 7){
                if(tempDate.getDate() <= getNbDays() && tempDate.getMonth() === today.getMonth()) {
                    newLine = document.createElement('td');
                    $(newLine).attr('id', 'l' + lineN + 'c' + colN);
                    $(newLine).text(tempDate.getDate());
                    $(newLine).addClass('calendar');
                    if(tempDate.getFullYear() < now.getFullYear()){
                        $(newLine).addClass('unselectable');
                    }
                    else{
                        if(tempDate.getFullYear() === now.getFullYear()){
                            if(tempDate.getMonth() < now.getMonth()){
                                $(newLine).addClass('unselectable');
                            }
                            else{
                                if(tempDate.getMonth() === now.getMonth()){
                                    if(tempDate.getDate() < today.getDate()){
                                        $(newLine).addClass('unselectable');
                                    }
                                }
                            }
                        }
                    }

                    currLine.append(newLine);
                    tempDate.setDate(tempDate.getDate() + 1);
                    currDay = tempDate.getDay();
                }
                else{
                    newLine = document.createElement('td');
                    $(newLine).addClass('unselectable');
                    $(newLine).attr('id', 'l'+lineN+'c'+colN);
                    currLine.append(newLine);
                }
                colN++;
            }
    }


}

$(document).ready(function () {
    today = new Date();
    today.toLocaleDateString('fr-FR', {  weekday: 'long' });
    defaultTable = $("#calendar").html().toString();
    updateCalendar();
    updateDate();

    $('body').on('click', '#prev', function (event) {
        event.preventDefault();
       today.setMonth(today.getMonth()-1);
        updateCalendar();
       updateDate();
    });

    $('body').on('click', '#next', function (event) {
        event.preventDefault();
        today.setMonth(today.getMonth()+1);
        updateCalendar();
        updateDate();
    });

    $('#calendar').on('click', 'td', function () {
        var clicked = $(this);
        if(!clicked.hasClass('unselectable')){
            var nbGris = $('#line1 .unselectable').length;
            var temp = $(this).attr('id');
            currMonth = $("#currMonth");
            temp = temp.split('');
            var day = (temp[1]-1)*7 + (temp[3]-nbGris);
            $("#displayDate").html('Vous avez sélectionné le '+day+" "+currMonth.html());
            var monthName = currMonth.html().split(' ')[0];
            var monthNo = arraySearch(monthNames, monthName)+1;
            if(monthNo < 9) monthNo = "0"+monthNo;
            if(day < 9) day = "0"+day;
            var currYear = currMonth.html().split(' ')[1];
            var input = $("#inputDate");
            var value = currYear+"-"+monthNo+"-"+day+" 00:00:00";
            input.attr('value', value);
        }
    });
});