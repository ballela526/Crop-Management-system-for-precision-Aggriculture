import sys
import pickle
import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
import os
import warnings
warnings.filterwarnings("ignore")  # Suppress all warnings

#  Paths for model & encoders
model_path = r"C:\Users\hball\Downloads\crop-management-system-main\fertilizer_model.pkl"
encoders_path = r"C:\Users\hball\Downloads\crop-management-system-main\label_encoders.pkl"
dataset_path = r"C:\Users\hball\Downloads\crop-management-system-main\crop-management-system-main\fertilizer_recommendation.csv"

#  Function to train model if not available
def train_model():
    df = pd.read_csv(dataset_path)
    df.rename(columns=lambda x: x.strip(), inplace=True)

    #  Encode categorical variables
    le_soil = LabelEncoder()
    le_crop = LabelEncoder()
    le_fertilizer = LabelEncoder()

    #df["Soil Type"] = le_soil.fit_transform(df["Soil Type"])
    #df["Crop Type"] = le_crop.fit_transform(df["Crop Type"])
    df["Fertilizer Name"] = le_fertilizer.fit_transform(df["Fertilizer Name"])

    #  Define features & target
    X = df[['Temparature', 'Humidity', 'Soil Moisture', 'Soil Type', 'Crop Type', 'Nitrogen', 'Potassium', 'Phosphorous']]
    y = df["Fertilizer Name"]

    #  Train the model
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
    model = RandomForestClassifier(n_estimators=100, random_state=42)
    model.fit(X_train, y_train)

    #  Save model & encoders
    with open(model_path, "wb") as f:
        pickle.dump(model, f)

    with open(encoders_path, "wb") as f:
        pickle.dump({"soil": le_soil, "crop": le_crop, "fertilizer": le_fertilizer}, f)

    print(" Model trained and saved successfully!")

#  Train if model doesn't exist
if not os.path.exists(model_path) or not os.path.exists(encoders_path):
    print(" Model or encoders not found. Training the model now...")
    train_model()

#  Load trained model & encoders
try:
    with open(model_path, "rb") as f:
        model = pickle.load(f)

    with open(encoders_path, "rb") as f:
        encoders = pickle.load(f)

    #  Verify encoders loaded correctly
    if not isinstance(encoders, dict) or "soil" not in encoders or "crop" not in encoders or "fertilizer" not in encoders:
        raise ValueError(" Encoders dictionary structure is incorrect. Re-training the model.")
    
    #  Debug: Print available categories
    #print(" Available Soil Types:", list(encoders["soil"].classes_))
    #print(" Available Crop Types:", list(encoders["crop"].classes_))

except Exception as e:
    print(f" Error loading model or encoders: {e}")
    print(" Re-training the model...")
    train_model()

#  Function to predict fertilizer
def predict_fertilizer(n, p, k, t, h, sm, soil, crop):
    try:
        #  Validate input against trained encoders
        if soil not in encoders["soil"].classes_:
            return f" Error: '{soil}' is not a recognized Soil Type. Available: {list(encoders['soil'].classes_)}"
        
        if crop not in encoders["crop"].classes_:
            return f" Error: '{crop}' is not a recognized Crop Type. Available: {list(encoders['crop'].classes_)}"

        #  Encode categorical inputs safely
        soil_encoded = encoders["soil"].transform([soil])[0]
        crop_encoded = encoders["crop"].transform([crop])[0]

        #  Prepare input array
        input_data = np.array([[t, h, sm, soil_encoded, crop_encoded, n, k, p]])

        #  Make prediction
        pred = model.predict(input_data)

        #  Decode prediction
        fertilizer_name = encoders["fertilizer"].inverse_transform(pred)[0]
        return f" {fertilizer_name}"

    except Exception as e:
        return f" Error: {str(e)}"

#  Run from command-line with inputs
if __name__ == "__main__":
    if len(sys.argv) != 9:
        print(f" Error: Invalid number of inputs. Expected 8 parameters, received {len(sys.argv)-1}.")
        print(" Received parameters:", sys.argv[1:])
        sys.exit(1)

    #  Get inputs from command line
    n = float(sys.argv[1])  # Nitrogen
    p = float(sys.argv[2])  # Phosphorus
    k = float(sys.argv[3])  # Potassium
    t = float(sys.argv[4])  # Temperature
    h = float(sys.argv[5])  # Humidity
    sm = float(sys.argv[6])  # Soil Moisture
    soil = sys.argv[7]  # Soil Type
    crop = sys.argv[8]  # Crop Type

    # Get prediction & print result
    result = predict_fertilizer(n, p, k, t, h, sm, soil, crop)
    print(result)
