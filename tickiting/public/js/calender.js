

const daysTag1 = document.querySelector(".days1"),
currentDate1 = document.querySelector(".current-date1"),
prevNextIcon1 = document.querySelectorAll(".icons1 span");

// getting new date, current year and month
let date1 = new Date(),
currYear1 = date1.getFullYear(),
currMonth1 = date1.getMonth();

// storing full name of all months in array
const months1 = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

const renderCalendar1 = () => {
    let firstDayofMonth1 = new Date(currYear1, currMonth1, 1).getDay(), // getting first day of month
    lastDateofMonth1 = new Date(currYear1, currMonth1 + 1, 0).getDate(), // getting last date of month
    lastDayofMonth1 = new Date(currYear1, currMonth1, lastDateofMonth1).getDay(), // getting last day of month
    lastDateofLastMonth1 = new Date(currYear1, currMonth1, 0).getDate(); // getting last date of previous month
    let liTag1 = "";

    for (let i = firstDayofMonth1; i > 0; i--) { // creating li of previous month last days
        liTag1 += `<li class="inactive1">${lastDateofLastMonth1 - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth1; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday1 = i === date1.getDate() && currMonth1 === new Date().getMonth() 
                     && currYear1 === new Date().getFullYear() ? "active" : "";
        liTag1 += `<li class="${isToday1}">${i}</li>`;
    }

    for (let i = lastDayofMonth1; i < 6; i++) { // creating li of next month first days
        liTag1 += `<li class="inactive1">${i - lastDayofMonth1 + 1}</li>`
    }
    currentDate1.innerText = `${months1[currMonth1]} ${currYear1}`; // passing current mon and yr as currentDate text
    daysTag1.innerHTML = liTag1;
}
renderCalendar1();

prevNextIcon1.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth1 = icon.id === "prev1" ? currMonth1 - 1 : currMonth1 + 1;

        

        if(currMonth1 < 0 || currMonth1 > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date1 = new Date(currYear1, currMonth1);
            currYear1 = date1.getFullYear(); // updating current year with new date year
            currMonth1 = date1.getMonth(); // updating current month with new date month
        } else {
            date1 = new Date(); // pass the current date as date value
        }
        renderCalendar1(); // calling renderCalendar function
    });
});







///////////////////////////////////////////////////////////////////////////



