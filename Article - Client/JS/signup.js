base_api = "http://52.47.74.242/api";

signup = async function(){
    event.preventDefault();

    const fullname = document.getElementById("fullname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    // Data to send
    const data = {
        fullname: fullname.value,
        email: email.value,
        password: password.value
    };

    try {
        const response = await axios.post(base_api + "/signup.php", data);
        console.log(response.data); 
        window.location.href = "home.html";
    } catch (error) {
        console.error("Error:", error);
    }
}
