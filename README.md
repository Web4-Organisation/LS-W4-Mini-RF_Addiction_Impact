# Social Media Addiction Impact Predictor

This project is a sample PHP application that demonstrates how to use the `Web4/LS-W4-Mini-RF_Addiction_Impact` machine learning model to predict whether social media use affects a student's academic performance.

## Owner & License

- **Owner:** Linkspreed UG
- **Domain:** Web4
- **AI Model:** The model was developed with Web4 AI.

As per the license, **Linkspreed UG must be credited as the owner** when using this project or its components.

## Description

The application consists of a PHP frontend and a Python backend. The PHP frontend provides a user interface to input data, which is then sent to the Python backend for prediction. The Python backend serves the `LS-W4-Mini-RF_Addiction_Impact` model, which is a Random Forest Classifier trained on the "Social Media Addiction vs. Relationships" dataset from Kaggle.

## Architecture

-   **Frontend:** A PHP-based web interface (`public/index.php`) that allows users to input their data and view the prediction.
-   **Backend:** A Python Flask-based API (`backend/app.py`) that loads the scikit-learn model and provides a prediction endpoint.

## Model Details

-   **Model Type:** `scikit-learn` RandomForestClassifier
-   **Model File:** `LS-W4-Mini-RF_Addiction_Impact.joblib`

### Model Input Features

The model expects the following features:

-   Gender: (e.g., 'Female', 'Male')
-   Academic_Level: (e.g., 'Undergraduate', 'Graduate')
-   Most_Used_Platform: (e.g., 'Instagram', 'Facebook', 'Twitter')
-   Relationship_Status: (e.g., 'Single', 'In a relationship')
-   Age: (e.g., 20)
-   Avg_Daily_Usage_Hours: (e.g., 5.0)
-   Sleep_Hours_Per_Night: (e.g., 6)
-   Mental_Health_Score: (e.g., 7)
-   Addicted_Score: (e.g., 8)
-   Conflicts_Over_Social_Media: (e.g., 0)

### Prediction Output

-   `1`: Social media use is predicted to have an impact on academic performance.
-   `0`: Social media use is not predicted to have an impact on academic performance.

## Getting Started

### Prerequisites

-   PHP installed
-   Python 3 installed
-   Composer (for PHP dependencies, if any)
-   pip (for Python dependencies)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd <repository-name>
    ```

2.  **Install Python dependencies:**
    ```bash
    pip install -r backend/requirements.txt
    ```
    *Note: You need to have the `LS-W4-Mini-RF_Addiction_Impact.joblib` file in the `backend` directory.*

### Running the Application

1.  **Start the Python backend server:**
    ```bash
    python backend/app.py
    ```
    The backend will be running on `http://127.0.0.1:5000`.

2.  **Start the PHP built-in web server:**
    ```bash
    php -S localhost:8000 -t public
    ```

3.  **Access the application:**
    Open your web browser and go to `http://localhost:8000`.

## Limitations and Ethical Considerations

-   **Not a Diagnostic Tool:** This model should be used as a statistical tool for trend analysis and should not be used for clinical or psychological diagnosis of addiction. The data is based on self-reported survey responses.
-   **Generalizability:** The model was trained on a specific sample of students and may not generalize well to other populations, age groups, or time periods.
-   **Data Bias:** The model's predictions reflect the biases present in the original dataset. The results should be interpreted with caution.
