// IP_api = "http://localhost";
// api_path = "/DevOps_Article/Article - Server/Apis/v1";

// base_api = IP_api + api_path;

base_api = "http://52.47.74.242/api";

addQuestion = async function(){
    event.preventDefault();

    const question = document.getElementById("question");
    const answer = document.getElementById("answer");

    const data = {
        question: question.value,
        answer: answer.value
    };

    try {
        const response = await axios.post(base_api + "/addQuestion.php", data);
        console.log(response.data); 
        window.location.href = "home.html";
    } catch (error) {
        console.error("Error:", error);
    }
}