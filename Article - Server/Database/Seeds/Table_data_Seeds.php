<?php
require_once("../../Models/Question.php");
require_once("../../Connection/connection.php");

function seedQuestions() {
    Question::init($GLOBALS['conn']);

    $sampleQuestions = [
        ["What is the main focus of the paper?", "The paper focuses on how Flickr achieved over 10 deployments per day, highlighting the importance of collaboration between development (Dev) and operations (Ops) teams to create a smooth, efficient deployment pipeline."],
        ["What challenges did Flickr face in scaling deployments?", "Flickr faced challenges with maintaining system stability, managing growing infrastructure, ensuring quick rollbacks in case of failures, and coordinating between the Dev and Ops teams."],
        ["How did Flickr improve communication between Dev and Ops teams?", "Flickr fostered closer cooperation between Dev and Ops teams by breaking down silos, encouraging shared responsibilities, and creating joint goals to improve deployment processes."],
        ["What role did automation play in Flickr's deployment process?", "Automation was crucial in reducing manual errors, speeding up the deployment process, and ensuring consistency in every deployment cycle, allowing for multiple deployments per day."],
        ["What tools did Flickr use to automate deployments?", "Flickr used custom internal tools, such as their own deployment scripts and configuration management tools like Puppet, to automate many deployment tasks and monitor system performance."],
        ["How did Flickr handle rapid rollbacks?", "Flickr implemented automated rollback mechanisms to ensure that in case of deployment failure, changes could be rolled back quickly, minimizing downtime."],
        ["What kind of culture did Flickr foster to support frequent deployments?", "Flickr fostered a culture of shared responsibility, trust, and collaboration between developers and operations staff, which was essential for rapid and reliable deployments."],
        ["How did Flickr deal with the risk of frequent deployments affecting system stability?", "Flickr addressed system stability by ensuring deployments were small and incremental, thoroughly testing each change, and closely monitoring the system after every deployment."],
        ["What is the concept of 'continuous integration' mentioned in the paper?", "Continuous integration refers to the practice of frequently integrating code changes into a shared repository, followed by automated testing to ensure the new changes don’t break the system."],
        ["What role did monitoring play in Flickr's deployment process?", "Monitoring was crucial for detecting issues quickly after a deployment, enabling the teams to respond rapidly to failures or performance issues before they affected users."],
        ["What deployment frequency did Flickr aim for, and why?", "Flickr aimed for over 10 deployments per day to rapidly deliver new features, improve system reliability, and quickly address issues as they arose."],
        ["What did '10+ deploys per day' mean for Flickr’s team?", "It meant that deployments were frequent, smaller in scope, and more manageable, ensuring that the team could quickly release features and fixes without disrupting users."],
        ["What practices did Flickr adopt to ensure deployment reliability?", "Flickr adopted practices like incremental deployments, thorough testing, automated rollback, and continuous monitoring to ensure deployments were reliable and non-disruptive."],
        ["How did Flickr reduce deployment failures?", "By deploying smaller changes, automating the testing process, and continuously monitoring the system, Flickr reduced the frequency and impact of deployment failures."],
        ["How did the paper describe the importance of DevOps?", "The paper described DevOps as essential for improving collaboration between development and operations teams, which ultimately led to more frequent and successful deployments."],
        ["What was the impact of frequent deployments on Flickr’s ability to innovate?", "Frequent deployments allowed Flickr to rapidly innovate by quickly releasing new features, experimenting with new ideas, and addressing user feedback without long delays."],
        ["How did Flickr handle the complexity of scaling its infrastructure?", "Flickr scaled its infrastructure by using automation tools, monitoring systems, and ensuring that the deployment process was robust enough to handle growing complexity."],
        ["What is the importance of having a 'deployment pipeline'?", "A deployment pipeline automates the process of moving code from development to production, ensuring a streamlined, efficient, and reliable deployment process."],
        ["Did Flickr face any cultural challenges with frequent deployments?", "Yes, initially there were challenges around resistance to change, but by building trust and promoting shared goals between Dev and Ops teams, these challenges were mitigated."],
        ["What were the key benefits of frequent deployments at Flickr?", "The key benefits included faster feature delivery, more reliable systems, the ability to quickly fix issues, and a collaborative environment between developers and operations teams."]
    ];

    foreach ($sampleQuestions as $q) {
        try {
            $question = $q[0];
            $answer = $q[1];

            // Check if the question already exists
            $checkSql = "SELECT COUNT(*) AS count FROM questions WHERE question = ?";
            $stmt = $GLOBALS['conn']->prepare($checkSql);
            $stmt->bind_param("s", $question);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            if ($result['count'] > 0) {
                echo "Skipped (already exists): $question\n";
                continue;
            }

            // Insert new question
            $inserted = Question::create($question, $answer);

            if ($inserted) {
                echo "Inserted: $question - $answer\n";
            } else {
                echo "Failed to insert: $question\n";
            }
        } catch (\Throwable $e) {
            echo "Error inserting data: " . $e->getMessage() . "\n";
        }
    }
}
?>
