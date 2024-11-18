document.addEventListener('DOMContentLoaded',function(){
    document.querySelector('#eyes').addEventListener('click',function(){
        this.classList.toggle('show-password');
        let x = document.querySelector('input[name="password"]');
        console.log(x.type)
        if(x.type === "password"){
            x.type = "text";
        }else{
            x.type = "password";
        }
    })
})
