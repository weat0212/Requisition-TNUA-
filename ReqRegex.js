(function () {
    let phone = document.getElementById('phone'),
        regphone = /\d{9,10}/g;
    phone.addEvenListener('keyup', function(){
        if(regphone.test(phone.value)){
            phone.classList.remove('red');
            phone.classList.add('green');
        }else{
            phone.classList.remove('green');
            phone.classList.add('red');
        }
    })
})();