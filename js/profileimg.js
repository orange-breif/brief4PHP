function triggerClick() {
    document.querySelector('#profileimage').click();
}

function displayImage(input) {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.querySelector('#profiledisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}