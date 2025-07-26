import joblib
import pandas as pd
import sys

# Ensure correct number of arguments
if len(sys.argv) != 7:
    print("❌ Error: Incorrect number of arguments.")
    #print("Usage: python yield_prediction.py <State_Name> <District_Name> <Crop_Year> <Season> <Crop> <Area>")
    sys.exit(1)

# Load the trained model and OneHotEncoder
model = joblib.load(r"C:\Users\hball\Downloads\crop-management-system-main\crop_production_model.pkl")
ohe = joblib.load(r"C:\Users\hball\Downloads\crop-management-system-main\one_hot_encoder.pkl")

# Read inputs from command line
state = sys.argv[1]
district = sys.argv[2]
year = int(sys.argv[3])
season = sys.argv[4]
crop = sys.argv[5]
area = float(sys.argv[6])

# Prepare input dictionary
user_input = {
    'State_Name': state,
    'District_Name': district,
    'Season': season,
    'Crop': crop,
    'Crop_Year': year,
    'Area': area
}

# Convert input to DataFrame
user_df = pd.DataFrame([user_input])

# Apply OneHotEncoding
X_encoded = ohe.transform(user_df[['State_Name', 'District_Name', 'Season', 'Crop', 'Crop_Year']])
X_encoded_df = pd.DataFrame(X_encoded, columns=ohe.get_feature_names_out())

# Add numerical feature 'Area'
X_final = pd.concat([X_encoded_df, user_df[['Area']].reset_index(drop=True)], axis=1)

# Ensure features match the trained model
trained_features = model.feature_names_in_
X_final = X_final.reindex(columns=trained_features, fill_value=0)

# Make prediction
prediction = model.predict(X_final)
print(f"{prediction[0]}")
