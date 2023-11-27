let regExp = new RegExp(/^[0-9]$/)
function regular(e){
    if(!regExp.test(e.key)){
        e.preventDefault();
    }
}
var for_number_class = document.querySelectorAll('input.number')
for_number_class.forEach(el => el.addEventListener('keypress', function (e){
    regular(e)
}))

function selectTime(e){
    let set_active = document.querySelector('.time.active')
    if(set_active){
        set_active.classList.remove('active')
    }
    e.classList.toggle('active')
}

function selectPeople(e){
    let set_active = document.querySelector('.number.active')
    if(set_active){
        set_active.classList.remove('active')
    }
    e.classList.toggle('active')
}

var btn_booking = document.querySelector('#btn_booking')
if(btn_booking){
    btn_booking.addEventListener('click', function(){
        let time_selected = document.querySelector('.time.active').getAttribute('data-time')
        let people_selected = document.querySelector('.number.active').getAttribute('data-people')
        let time = new Date(datetime_selected)
        if(time_selected.indexOf('.') >= 0){
            time.setHours(time_selected.split('.')[0], time_selected.split('.')[1], 00)
        } else if(time_selected.indexOf(':') >= 0){
            time.setHours(time_selected.split(':')[0], time_selected.split(':')[1], 00)
        } else {
            Swal.fire({
                title: "can't reserve.",
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        var data = {
            firstname: document.querySelector('input[name="firstname"]'),
            surname: document.querySelector('input[name="surname"]'),
            email: document.querySelector('input[name="email"]'),
            phone: document.querySelector('input[name="phone"]'),
            requests: document.querySelector('textarea[name="requests"]'),
            forgroup: document.querySelector('input[name="forgroup"]'),
            people_number: people_selected,
            time_selected: time
        }
        if(!document.querySelector('#accept_term').checked){
            Swal.fire({
                title: 'Please, Accept the Terms of Service to continue.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        if(data.firstname.value === ""){
            Swal.fire({
                title: 'Please enter your firstname.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        if(data.surname.value === ""){
            Swal.fire({
                title: 'Please enter your surname.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        if(data.email.value === "" || data.email.value.indexOf('@') < 0){
            Swal.fire({
                title: 'Please enter your email for receive booking details.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        if(data.phone.value === ""){
            Swal.fire({
                title: 'Please enter your phone.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        onBooking(data)
    })
}

async function onBooking(_data){
    var param = {
        firstname: _data.firstname.value,
        surname: _data.surname.value,
        email: _data.email.value,
        phone: _data.phone.value,
        requests: _data.requests.value,
        forgroup: _data.forgroup.value,
        people_number: _data.people_number,
        time_selected: _data.time_selected
    }
    var lazyload = document.querySelector(".body-load")
    lazyload.classList.add("active")
    const url = `/api/booking`
    const response = await fetch(url, {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-Token': document.querySelector('[name="csrf-token"]').content
        },
        body: JSON.stringify(param)
    });
    lazyload.classList.remove("active")
    if(response.ok){
        const content = await response.json();
        Swal.fire({
            title: content.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 1000
        })
        _data.firstname.value = ""
        _data.surname.value = ""
        _data.email.value = ""
        _data.phone.value = ""
        _data.requests.value = ""
        _data.forgroup.value = ""
        document.querySelector('#accept_term').checked = false
    } else {
        Swal.fire({
            title: 'Please try again.',
            icon: 'error',
            showConfirmButton: false,
            timer: 1000
        })
    }
}
