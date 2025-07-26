
import joblib

model = joblib.load("crop_suggestion_model.pkl")
print(f"Model expects {model.n_features_in_} features")
