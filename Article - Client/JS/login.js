// base_api = "http://localhost/DevOps_Article/Article - Server/Apis/v1";
base_api = "http://52.47.74.242/api";

login = async function(){
    event.preventDefault();

    const email = document.getElementById("email");
    const password = document.getElementById("password");

    // Data to send
    const data = {
        email: email.value,
        password: password.value
    };

    try {
        const response = await axios.post(base_api + "/login.php", data);
        console.log(response.data); 
        window.location.href = "home.html";
    } catch (error) {
        console.error("Error:", error);
    }
}
