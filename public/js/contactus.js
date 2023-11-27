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

var btnSend = document.querySelector('#btnSend')
if(btnSend){
    btnSend.addEventListener('click', function(){
        var data = {
            name: document.querySelector('input[name="name"]'),
            email: document.querySelector('input[name="email"]'),
            phone: document.querySelector('input[name="phone"]'),
            message: document.querySelector('textarea[name="message"]'),
        }
        if(data.name.value === ""){
            Swal.fire({
                title: 'Please enter your name.',
                icon: 'info',
                confirmButtonColor: '#B17035',
            })
            return false
        }
        if(data.email.value === "" || data.email.value.indexOf('@') < 0){
            Swal.fire({
                title: 'Please enter your email for contact us.',
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
        onContactus(data)
    })
}

async function onContactus(_data){
    var param = {
        name: _data.name.value,
        email: _data.email.value,
        phone: _data.phone.value,
        message: _data.message.value,
    }
    var lazyload = document.querySelector(".body-load")
    lazyload.classList.add("active")
    const url = `/api/sendContact`
    const response = await fetch(url, {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-Token': document.querySelector('[name="csrf-token"]').content
        },
        body: JSON.stringify(param)
    });
    const content = await response.json();
    if(response.ok){
        lazyload.classList.remove("active")
        Swal.fire({
            title: content.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 1000
        })
        _data.name.value = ""
        _data.email.value = ""
        _data.phone.value = ""
        _data.message.value = ""
    } else {
        Swal.fire({
            title: 'Please try again.',
            icon: 'error',
            showConfirmButton: false,
            timer: 1000
        })
    }
}
