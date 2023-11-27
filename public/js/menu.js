const button = document.getElementById('dropdownBtn');
const dropdownOptions = document.getElementById('dropdownOptions');
const options = document.querySelectorAll('.option')
dropdownOptions.style.display = "none";

button.addEventListener('click', () => {
    if(dropdownOptions.style.display === 'none'){
        button.style.borderRadius = '5px 5px 0 0';
        dropdownOptions.style.display = 'flex';
        document.querySelector('.fa-chevron-down').style.transform = 'rotate(180deg)';
    } else {
        button.style.borderRadius = '5px';
        dropdownOptions.style.display = 'none';
        document.querySelector('.fa-chevron-down').style.transform = 'rotate(0deg)';
    }
})

options.forEach((curEl) => {
    curEl.addEventListener('click', () => {
        options.forEach((el) => el.classList.remove('selected'))
        sortArr()
    })
})

const renderList = (arr) => {
    document.getElementById('list').innerHTML = ''
    for(let i = 0; i < arr.length; i++){
        document.getElementById('list').innerHTML += `
        <div>
        <h2>${arr[i].name}</h2>
        <p>${(arr[i].rightHanded) ? 'right handed' : 'left handed'}</p>
        <p>${arr[i].age} years old</p>
        </div>
        `
    }
}

window.onclick = function(event) {
    if (!event.target.matches('#dropdownBtn')) {
        button.style.borderRadius = '5px';
        dropdownOptions.style.display = 'none';
        document.querySelector('.fa-chevron-down').style.transform = 'rotate(0deg)';
    }
}

function showMenu(e){
    const img = e.querySelector('img#myImg').src
    const content = e.closest(".column").querySelector("input[name='content-food']").value
    const html = `
    <div className="imgContent" style="display: flex; padding: 0.5rem 0.5rem 0.5rem 0.5rem;">
        <img src="${img}" style="width: 50%"/>
        <div className="details" style="width: 47%; padding-left: 2rem; text-align: left;">
            ${content}
        </div>
    </div>`
    Swal.fire({
        html: html,
        width: 1100,
	height: 1000,
        showConfirmButton: false,
        showCloseButton: true,
        backdrop: "no-repeat rgb(0 0 0 / 44%)",
    })
}
