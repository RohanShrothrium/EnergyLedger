import numpy as np
import pandas as pd
from scipy import stats
import sys
from pyod.models.abod import ABOD
from pyod.utils.data import generate_data, get_outliers_inliers

data = int(sys.argv[1])

# generate random data with two features
X_train, Y_train = generate_data(n_train=2000, train_only=True, n_features=1)

# store outliers and inliers in different numpy arrays
x_outliers, x_inliers = get_outliers_inliers(X_train, Y_train)

clf = ABOD(contamination=0.1)

clf.fit(X_train)

# prediction of a datapoint category outlier or inlier
y_pred = clf.predict(X_train)

output = clf.predict(data)
