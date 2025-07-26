import joblib
import pandas as pd
from sklearn.preprocessing import OneHotEncoder

# Load dataset
df = pd.read_csv(r"C:\Users\hball\Downloads\crop-management-system-main\crop-management-system-main\crop_production_india.csv")

# Define categorical columns
categorical_cols = ['State_Name', 'District_Name', 'Season', 'Crop', 'Crop_Year']

# Initialize and fit OneHotEncoder
ohe = OneHotEncoder(handle_unknown='ignore', sparse=False)
ohe.fit(df[categorical_cols])  # Fit on the entire dataset

# Save the encoder and column names
joblib.dump(ohe, r"C:\Users\hball\Downloads\crop-management-system-main\one_hot_encoder.pkl")
joblib.dump(ohe.get_feature_names_out().tolist(), r"C:\Users\hball\Downloads\crop-management-system-main\ohe_columns.pkl")

print("✅ OneHotEncoder saved successfully with correct feature names.")
