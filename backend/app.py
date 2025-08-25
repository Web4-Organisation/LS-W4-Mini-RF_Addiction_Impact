from flask import Flask, request, jsonify
import pandas as pd
import joblib
import os

app = Flask(__name__)

# Path to the model
MODEL_PATH = os.path.join(os.path.dirname(__file__), 'LS-W4-Mini-RF_Addiction_Impact.joblib')

# Load the model
if os.path.exists(MODEL_PATH):
    model = joblib.load(MODEL_PATH)
else:
    model = None
    print(f"Warning: Model file not found at {MODEL_PATH}")
    print("The application will not be able to make predictions.")


@app.route('/predict', methods=['POST'])
def predict():
    if model is None:
        return jsonify({'error': 'Model not loaded'}), 500

    try:
        data = request.get_json(force=True)
        
        # Create a pandas DataFrame from the input data
        new_data = pd.DataFrame({
            'Gender': [data.get('Gender')],
            'Academic_Level': [data.get('Academic_Level')],
            'Most_Used_Platform': [data.get('Most_Used_Platform')],
            'Relationship_Status': [data.get('Relationship_Status')],
            'Age': [int(data.get('Age'))],
            'Avg_Daily_Usage_Hours': [float(data.get('Avg_Daily_Usage_Hours'))],
            'Sleep_Hours_Per_Night': [int(data.get('Sleep_Hours_Per_Night'))],
            'Mental_Health_Score': [int(data.get('Mental_Health_Score'))],
            'Addicted_Score': [int(data.get('Addicted_Score'))],
            'Conflicts_Over_Social_Media': [int(data.get('Conflicts_Over_Social_Media'))]
        })

        # Make a prediction
        prediction = model.predict(new_data)
        
        # Return the prediction as JSON
        return jsonify({'prediction': int(prediction[0])})

    except Exception as e:
        return jsonify({'error': str(e)}), 400

if __name__ == '__main__':
    app.run(debug=True, port=5000)
