document.getElementById("signup").addEventListener("click", () => {
    alert("click");
    var fullnameValue = document.getElementById('fullname').value;
    var emailValue = document.getElementById('email').value;
    var phoneValue = document.getElementById('phone').value;
    var addressValue = document.getElementById('address').value;
    var usernameValue = document.getElementById('username').value;
    var passwordValue = document.getElementById('password').value;
    var confirmPasswordValue = document.getElementById('confirmpassword').value;

    let data = {

        fullnameValue: fullnameValue,
        emailValue: emailValue,
        phoneValue: phoneValue,
        addressValue: addressValue,
        usernameValue: usernameValue,
        passwordValue: passwordValue,
        confirmPasswordValue: confirmPasswordValue,

    }
    var xhr = new XMLHttpRequest();
    xhr.open(
        "POST",
        "../../MVC/API/index.php?type=dangki",
        true
    );
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
        }
    }
    console.log(data);
    xhr.send(JSON.stringify(data));
})