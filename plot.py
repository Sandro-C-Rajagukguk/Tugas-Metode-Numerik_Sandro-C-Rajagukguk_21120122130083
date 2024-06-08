import pandas as pd
import matplotlib.pyplot as plt

# Baca data dari CSV yang dihasilkan oleh skrip PHP
linear_data = pd.read_csv('linear_regression.csv', header=None, names=['Hours Studied', 'Performance Index', 'Linear Prediction'])
power_data = pd.read_csv('power_regression.csv', header=None, names=['Hours Studied', 'Performance Index', 'Power Prediction'])

# Plot grafik titik data asli
plt.figure(figsize=(14, 7))

plt.subplot(1, 2, 1)
plt.scatter(linear_data['Hours Studied'], linear_data['Performance Index'], color='blue', label='Actual Data')
plt.plot(linear_data['Hours Studied'], linear_data['Linear Prediction'], color='red', label='Linear Regression')
plt.xlabel('Hours Studied')
plt.ylabel('Performance Index')
plt.title('Linear Regression')
plt.legend()

plt.subplot(1, 2, 2)
plt.scatter(power_data['Hours Studied'], power_data['Performance Index'], color='blue', label='Actual Data')
plt.plot(power_data['Hours Studied'], power_data['Power Prediction'], color='green', label='Power Regression')
plt.xlabel('Hours Studied')
plt.ylabel('Performance Index')
plt.title('Power Regression')
plt.legend()

plt.tight_layout()
plt.show()
