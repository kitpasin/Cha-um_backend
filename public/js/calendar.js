const disable_by_date = document.querySelector('#disable_by_date').value
const disable_by_day = document.querySelector('#disable_by_day').value
const special_holiday = document.querySelector('#special_holiday').value
let datetime_selected = ""

disableTimeSelect();
function disableTimeSelect(){
    var time_canbook = document.querySelectorAll('.time')
    if(time_canbook.length > 0){
        const timenow = new Date()
        const currentTime = ("0" + timenow.getHours()).slice(-2) + ":" + ("0" + timenow.getMinutes()).slice(-2)
        let oneTimeUse = 0
        for (let i = 0; i < time_canbook.length; i++) {
            time_canbook[i].classList.remove('active')
            time_canbook[i].classList.remove('disable')
            if(datetime_selected){
                if(datetime_selected.getDate() == timenow.getDate() && currentTime > time_canbook[i].getAttribute('data-time')){
                    time_canbook[i].classList.add('disable')
                } else {
                    if(oneTimeUse == 0){
                        time_canbook[i].classList.add('active')
                        oneTimeUse = 1
                    }
                }
            }
        }
    }
}

function changeDate (e) {
    let today = document.querySelector('.calendar-today')
    let set_active = e.closest('.number-item')
    if(today){
        today.classList.remove('calendar-today')
    }
    if(set_active){
        set_active.classList.toggle('calendar-today')
    }
}

function CalendarControl() {
    const calendar = new Date();
    const calendarControl = {
        localDate: new Date(),
        prevMonthLastDate: null,
        calWeekDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        calMonthName: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
        ],
        daysInMonth: function (month, year) {
            return new Date(year, month, 0).getDate();
        },
        firstDay: function () {
            return new Date(calendar.getFullYear(), calendar.getMonth(), 1);
        },
        lastDay: function () {
            return new Date(calendar.getFullYear(), calendar.getMonth() + 1, 0);
        },
        firstDayNumber: function () {
            return calendarControl.firstDay().getDay() + 1;
        },
        lastDayNumber: function () {
            return calendarControl.lastDay().getDay() + 1;
        },
        getPreviousMonthLastDate: function () {
            let lastDate = new Date(calendar.getFullYear(), calendar.getMonth(), 0).getDate();
            return lastDate;
        },
        navigateToPreviousMonth: function () {
            if(calendar.getMonth() > new Date().getMonth() || (calendar.getMonth() <= new Date().getMonth() && calendar.getFullYear() > new Date().getFullYear())){
                calendar.setMonth(calendar.getMonth() - 1);
                calendarControl.attachEventsOnNextPrev();
            }
        },
        navigateToNextMonth: function () {
            calendar.setMonth(calendar.getMonth() + 1);
            calendarControl.attachEventsOnNextPrev();
        },
        navigateToCurrentMonth: function () {
            let currentMonth = calendarControl.localDate.getMonth();
            let currentYear = calendarControl.localDate.getFullYear();
            calendar.setMonth(currentMonth);
            calendar.setYear(currentYear);
            calendarControl.attachEventsOnNextPrev();
        },
        displayYear: function () {
            let yearLabel = document.querySelector(".calendar .calendar-year-label");
            yearLabel.innerHTML = calendar.getFullYear();
        },
        displayMonth: function () {
            let monthLabel = document.querySelector(
                ".calendar .calendar-month-label"
            );
            monthLabel.innerHTML = calendarControl.calMonthName[calendar.getMonth()];
        },
        selectDate: function (e) {
            calendar.setDate(e.target.textContent)
            datetime_selected = calendar
            disableTimeSelect()
        },
        plotSelectors: function () {
            document.querySelector(
                ".calendar"
            ).innerHTML += `<div class="calendar-inner"><div class="calendar-controls">
          <div class="calendar-prev"><a ><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M88.2 3.8L35.8 56.23 28 64l7.8 7.78 52.4 52.4 9.78-7.76L45.58 64l52.4-52.4z"/></svg></a></div>
          <div class="calendar-year-month">
          <div class="calendar-month-label"></div>
          <div>-</div>
          <div class="calendar-year-label"></div>
          </div>
          <div class="calendar-next"><a ><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M38.8 124.2l52.4-52.42L99 64l-7.77-7.78-52.4-52.4-9.8 7.77L81.44 64 29 116.42z"/></svg></a></div>
          </div>

          <div class="calendar-body"></div></div>`;
        },
        plotDayNames: function () {
            for (let i = 0; i < calendarControl.calWeekDays.length; i++) {
                document.querySelector(
                    ".calendar .calendar-body"
                ).innerHTML += `<div>${calendarControl.calWeekDays[i]}</div>`;
            }
        },
        countDayName: function (currentNumber) {
            if(currentNumber >= 7){
                currentNumber = 1
            } else {
                currentNumber ++
            }
            return currentNumber
        },
        checkDateIsCurrent: function(date) {
            return (date < new Date().getDate() && calendar.getMonth() == new Date().getMonth() && new Date().getFullYear() === calendar.getFullYear())
        },
        checkDateIsDisabled: function(date) {
            return (disable_by_date.indexOf(',' + date + ',') >= 0)
        },
        checkDayIsDisabled: function(date) {
            return disable_by_day.indexOf(',' + calendarControl.calWeekDays[date-1].toLowerCase() + ',') >= 0
        },
        checkIsSpecialHoliday: function(date) {
            const currentDayInMonth = ("0" + (calendar.getMonth()+1)).slice(-2) + "-" + ("0" + date).slice(-2)
            return special_holiday.indexOf(',' + currentDayInMonth + ',') >= 0
        },
        plotDates: function () {
            document.querySelector(".calendar .calendar-body").innerHTML = "";
            calendarControl.plotDayNames();
            calendarControl.displayMonth();
            calendarControl.displayYear();
            let count = 1;
            let prevDateCount = 0;
            let plotPrevDay = ''

            calendarControl.prevMonthLastDate = calendarControl.getPreviousMonthLastDate();
            let prevMonthDatesArray = [];
            let calendarDays = calendarControl.daysInMonth(
                calendar.getMonth() + 1,
                calendar.getFullYear()
            );
            // dates of current month
            let currentDate = calendarControl.firstDayNumber()
            for (let i = 1; i < calendarDays; i++) {
                plotPrevDay = ""
                if (i < calendarControl.firstDayNumber()) {
                    prevDateCount += 1;
                    document.querySelector(
                        ".calendar .calendar-body"
                    ).innerHTML += `<div class="prev-dates"></div>`;
                    prevMonthDatesArray.push(calendarControl.prevMonthLastDate--);
                } else {
                    if(calendarControl.checkDateIsCurrent(count)|| calendarControl.checkDateIsDisabled(count) || calendarControl.checkDayIsDisabled(currentDate) || calendarControl.checkIsSpecialHoliday(count)){
                        plotPrevDay = "prev-dates"
                    }
                    document.querySelector(".calendar .calendar-body")
                    .innerHTML += `<div class="number-item ${plotPrevDay}" data-num=${count}><a class="dateNumber" onclick="changeDate(this)">${count++}</a></div>`;
                    currentDate = calendarControl.countDayName(currentDate)
                }
            }
            //remaining dates after month dates
            for (let j = 0; j < prevDateCount + 1; j++) {
                plotPrevDay = ""
                if(calendarControl.checkDateIsCurrent(count)|| calendarControl.checkDateIsDisabled(count) || calendarControl.checkDayIsDisabled(currentDate) || calendarControl.checkIsSpecialHoliday(count)){
                    plotPrevDay = "prev-dates"
                }
                document.querySelector(
                    ".calendar .calendar-body"
                ).innerHTML += `<div class="number-item ${plotPrevDay}" data-num=${count}><a class="dateNumber" onclick="changeDate(this)">${count++}</a></div>`;
                currentDate = calendarControl.countDayName(currentDate)
            }
            calendarControl.highlightToday();
            calendarControl.plotPrevMonthDates(prevMonthDatesArray);
            calendarControl.plotNextMonthDates();
        },
        attachEvents: function () {
            let prevBtn = document.querySelector(".calendar .calendar-prev a");
            let nextBtn = document.querySelector(".calendar .calendar-next a");
            let todayDate = document.querySelector(".calendar .calendar-today-date");
            let dateNumber = document.querySelectorAll(".calendar .dateNumber");
            prevBtn.addEventListener("click", calendarControl.navigateToPreviousMonth);
            nextBtn.addEventListener("click", calendarControl.navigateToNextMonth);
            if(todayDate){
                todayDate.addEventListener("click", calendarControl.navigateToCurrentMonth);
            }
            for (var i = 0; i < dateNumber.length; i++) {
                dateNumber[i].addEventListener("click", calendarControl.selectDate, false);
            }
        },
        highlightToday: function () {
            let currentMonth = calendarControl.localDate.getMonth() + 1;
            let changedMonth = calendar.getMonth() + 1;
            let currentYear = calendarControl.localDate.getFullYear();
            let changedYear = calendar.getFullYear();
            if (
                currentYear === changedYear &&
                currentMonth === changedMonth &&
                document.querySelectorAll(".number-item")
            ) {
                document.querySelectorAll(".number-item")[calendar.getDate() - 1].classList.add("calendar-today");
            }
        },
        plotPrevMonthDates: function (dates) {
            dates.reverse();
            for (let i = 0; i < dates.length; i++) {
                if (document.querySelectorAll(".prev-dates")) {
                    document.querySelectorAll(".prev-dates")[i].textContent = dates[i];
                }
            }
        },
        plotNextMonthDates: function () {
            let childElemCount = document.querySelector('.calendar-body').childElementCount;
            //7 lines
            if (childElemCount > 42) {
                let diff = 49 - childElemCount;
                calendarControl.loopThroughNextDays(diff);
            }
            //6 lines
            if (childElemCount > 35 && childElemCount <= 42) {
                let diff = 42 - childElemCount;
                calendarControl.loopThroughNextDays(42 - childElemCount);
            }
        },
        loopThroughNextDays: function (count) {
            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    document.querySelector('.calendar-body').innerHTML += `<div class="next-dates">${i}</div>`;
                }
            }
        },
        attachEventsOnNextPrev: function () {
            calendarControl.plotDates();
            calendarControl.attachEvents();
        },
        init: function () {
            calendarControl.plotSelectors();
            calendarControl.plotDates();
            calendarControl.attachEvents();
            document.querySelector('.calendar-today .dateNumber').click()
        }
    };
    calendarControl.init();
}

const calendarControl = new CalendarControl();
