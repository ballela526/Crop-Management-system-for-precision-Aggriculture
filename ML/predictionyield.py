import joblib
import pandas as pd

# Load the trained model
model = joblib.load(r"C:\Users\hball\Downloads\crop-management-system-main\crop_production_model.pkl")

# Load the correct OneHotEncoder
ohe = joblib.load(r"C:\Users\hball\Downloads\crop-management-system-main\one_hot_encoder.pkl")

# Define input data (example)
user_input = {
    'State_Name': 'Andhra pradesh',
    'District_Name': 'Guntur',
    'Season': 'Kharif',
    'Crop': 'Rice',
    'Crop_Year': 2026,
    'Area': 100
}

# Convert input to DataFrame
user_df = pd.DataFrame([user_input])

# Apply OneHotEncoding (with correct feature order)
X_encoded = ohe.transform(user_df[['State_Name', 'District_Name', 'Season', 'Crop', 'Crop_Year']])
X_encoded_df = pd.DataFrame(X_encoded, columns=ohe.get_feature_names_out())

# Add numerical feature 'Area'
X_final = pd.concat([X_encoded_df, user_df[['Area']].reset_index(drop=True)], axis=1)

# Ensure features match the trained model
trained_features = model.feature_names_in_
X_final = X_final.reindex(columns=trained_features, fill_value=0)

# Make prediction
prediction = model.predict(X_final)
print(f"✅ Predicted Yield: {prediction[0]} tons")
