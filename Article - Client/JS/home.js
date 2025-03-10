// IP_api = "http://localhost";
// api_path = "/DevOps_Article/Article - Server/Apis/v1";

// base_api = IP_api + api_path;

base_api = "http://52.47.74.242/api";

let allQuestions = [];

async function fetchAndDisplayQuestions() {
    try {
        const response = await axios.get(base_api + "/getQuestions.php");

        if (response.data.success) {
            allQuestions = response.data.data; // Store questions globally

            displayQuestions(allQuestions); // Display questions initially
        } else {
            console.error("Error:", response.data.message);
        }
    } catch (error) {
        console.error("Error fetching questions:", error);
    }
}

function displayQuestions(questions) {
    const container = document.querySelector('.features-container');
    container.innerHTML = "";

    questions.forEach(question => {
        const featureBox = document.createElement('div');
        featureBox.classList.add('feature-box');

        featureBox.innerHTML = `
            <h3>${question.question}</h3>
            <p>${question.answer}</p>
        `;

        container.appendChild(featureBox);
    });
}

function searchQuestions() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const filteredQuestions = allQuestions.filter(q => 
        q.question.toLowerCase().includes(searchInput) || 
        q.answer.toLowerCase().includes(searchInput)
    );
    displayQuestions(filteredQuestions); // Update UI with filtered questions
}

document.getElementById('searchInput').addEventListener('input', searchQuestions);

window.onload = fetchAndDisplayQuestions;
