require('./bootstrap');

document.querySelector('.custom-file-input').addEventListener('change',function(e){
    var fileName = document.getElementById("fileUpload").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = fileName
})
