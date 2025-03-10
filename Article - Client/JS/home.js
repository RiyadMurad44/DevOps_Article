// const base_api = "http://localhost/DevOps_Article/Article - Server/Apis/v1";
base_api = "http://52.47.74.242/api";

async function fetchAndDisplayQuestions() {
    try {
        const response = await axios.get(base_api + "/getQuestions.php");

        console.log("API Response:", response.data); // Debugging line

        if (response.data.success) {
            const questions = response.data.data;

            const container = document.querySelector('.features-container');
            
            questions.forEach(question => {

                const featureBox = document.createElement('div');
                featureBox.classList.add('feature-box');
                
                featureBox.innerHTML = `
                    <h3>${question.question}</h3>
                    <p>${question.answer}</p>
                `;
                
                container.appendChild(featureBox);
            });
        } else {
            console.error("Error:", response.data.message);
        }
    } catch (error) {
        console.error("Error fetching questions:", error);
    }
}

window.onload = fetchAndDisplayQuestions;
