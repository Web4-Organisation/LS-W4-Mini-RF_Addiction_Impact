<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Addiction Impact Predictor</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; max-width: 600px; margin: auto; }
        form { display: flex; flex-direction: column; gap: 10px; }
        label { font-weight: bold; }
        input, select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result { margin-top: 20px; padding: 15px; border-radius: 4px; }
        .result.yes { background-color: #ffdddd; border: 1px solid #f5c6cb; }
        .result.no { background-color: #d4edda; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

    <h1>Social Media Addiction Impact Predictor</h1>
    <p>This form predicts if social media use is likely to impact academic performance.</p>

    <form action="index.php" method="post">
        <label for="Gender">Gender:</label>
        <select id="Gender" name="Gender" required>
            <option value="Female">Female</option>
            <option value="Male">Male</option>
            <option value="Other">Other</option>
        </select>

        <label for="Academic_Level">Academic Level:</label>
        <select id="Academic_Level" name="Academic_Level" required>
            <option value="Undergraduate">Undergraduate</option>
            <option value="Graduate">Graduate</option>
            <option value="High School">High School</option>
        </select>

        <label for="Most_Used_Platform">Most Used Platform:</label>
        <select id="Most_Used_Platform" name="Most_Used_Platform" required>
            <option value="Instagram">Instagram</option>
            <option value="Facebook">Facebook</option>
            <option value="Twitter">Twitter</option>
            <option value="TikTok">TikTok</option>
            <option value="Snapchat">Snapchat</option>
            <option value="Other">Other</option>
        </select>

        <label for="Relationship_Status">Relationship Status:</label>
        <select id="Relationship_Status" name="Relationship_Status" required>
            <option value="Single">Single</option>
            <option value="In a relationship">In a relationship</option>
        </select>

        <label for="Age">Age:</label>
        <input type="number" id="Age" name="Age" value="20" required>

        <label for="Avg_Daily_Usage_Hours">Average Daily Usage (Hours):</label>
        <input type="number" step="0.1" id="Avg_Daily_Usage_Hours" name="Avg_Daily_Usage_Hours" value="5.0" required>

        <label for="Sleep_Hours_Per_Night">Sleep Hours Per Night:</label>
        <input type="number" id="Sleep_Hours_Per_Night" name="Sleep_Hours_Per_Night" value="6" required>

        <label for="Mental_Health_Score">Mental Health Score (1-10):</label>
        <input type="number" id="Mental_Health_Score" name="Mental_Health_Score" min="1" max="10" value="7" required>

        <label for="Addicted_Score">Addiction Score (1-10):</label>
        <input type="number" id="Addicted_Score" name="Addicted_Score" min="1" max="10" value="8" required>

        <label for="Conflicts_Over_Social_Media">Conflicts Over Social Media (0 for No, 1 for Yes):</label>
        <input type="number" id="Conflicts_Over_Social_Media" name="Conflicts_Over_Social_Media" min="0" max="1" value="0" required>

        <button type="submit">Predict</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'Gender' => $_POST['Gender'],
            'Academic_Level' => $_POST['Academic_Level'],
            'Most_Used_Platform' => $_POST['Most_Used_Platform'],
            'Relationship_Status' => $_POST['Relationship_Status'],
            'Age' => (int)$_POST['Age'],
            'Avg_Daily_Usage_Hours' => (float)$_POST['Avg_Daily_Usage_Hours'],
            'Sleep_Hours_Per_Night' => (int)$_POST['Sleep_Hours_Per_Night'],
            'Mental_Health_Score' => (int)$_POST['Mental_Health_Score'],
            'Addicted_Score' => (int)$_POST['Addicted_Score'],
            'Conflicts_Over_Social_Media' => (int)$_POST['Conflicts_Over_Social_Media'],
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json
",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = @file_get_contents('http://127.0.0.1:5000/predict', false, $context);

        if ($result === FALSE) {
            echo '<div class="result yes"><strong>Error:</strong> Could not connect to the prediction service. Please make sure the Python backend is running.</div>';
        } else {
            $response = json_decode($result, true);
            if (isset($response['prediction'])) {
                if ($response['prediction'] == 1) {
                    echo '<div class="result yes"><strong>Prediction:</strong> Yes, social media use is likely to have an impact on academic performance.</div>';
                } else {
                    echo '<div class="result no"><strong>Prediction:</strong> No, social media use is not likely to have an impact on academic performance.</div>';
                }
            } else {
                echo '<div class="result yes"><strong>Error:</strong> Invalid response from the prediction service.</div>';
            }
        }
    }
    ?>

</body>
</html>
