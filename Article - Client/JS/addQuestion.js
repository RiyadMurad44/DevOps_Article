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