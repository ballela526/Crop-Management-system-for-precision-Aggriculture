import pandas as pd
import numpy as np
import pickle
import sys
from sklearn.ensemble import RandomForestClassifier

# Check if script is running for training or prediction
if len(sys.argv) == 2 and sys.argv[1] == "--train":
    # Load the dataset
    dataset = pd.read_csv("Crop_recommendation.csv")

    # Separate features (X) and target labels (y)
    X = dataset.iloc[:, :-1].values  # All columns except the last one
    y = dataset.iloc[:, -1].values   # Last column (crop type)

    # Train the model
    classifier = RandomForestClassifier(n_estimators=10, criterion="entropy", random_state=42)
    classifier.fit(X, y)

    # Save the trained model
    with open("crop_model.pkl", "wb") as model_file:
        pickle.dump(classifier, model_file)

    print(" Model training complete! The trained model is saved as 'crop_model.pkl'.")

else:
    # Ensure correct number of arguments
    if len(sys.argv) != 9:
        print(" Incorrect number of arguments. Usage:")
        print('python recommendcrop.py N P K temperature humidity pH rainfall model_path')
        sys.exit(1)

    # Parse user inputs (convert to appropriate types)
    try:
        N = float(sys.argv[1])
        P = float(sys.argv[2])
        K = float(sys.argv[3])
        temperature = float(sys.argv[4])
        humidity = float(sys.argv[5])
        pH = float(sys.argv[6])
        rainfall = float(sys.argv[7])
        model_path = sys.argv[8]
    except ValueError:
        print(" Invalid input: Please enter numeric values for N, P, K, temperature, humidity, pH, and rainfall.")
        sys.exit(1)

    # Load the trained model
    try:
        with open(model_path, "rb") as model_file:
            model = pickle.load(model_file)
    except FileNotFoundError:
        print(f" Model file not found: {model_path}")
        sys.exit(1)

    # Prepare input data
    user_input = np.array([[N, P, K, temperature, humidity, pH, rainfall]])

    # Predict the crop
    predicted_crop = model.predict(user_input)[0]

    print(f"{predicted_crop}")
