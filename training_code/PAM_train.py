import tensorflow as tf
from tensorflow.keras.models import Model
from tensorflow.keras.layers import Input, Concatenate
from tensorflow.keras.layers import Dense, Dropout, Activation, Flatten, Multiply
from tensorflow.keras.layers import Conv1D, AveragePooling1D
import numpy as np
import pandas as pd
from sklearn import metrics
import sklearn


dataset1 = pd.read_excel('PATH_TO_DATASET', header=0,index_col=None,engine='openpyxl')

start=0
length=30

def preprocess_seq(data):
    print("Start preprocessing the sequence done 2d")
    global length
    global start

    DATA_X = np.zeros((len(data),length,4), dtype=int)
    print(np.shape(data), len(data), length)
    for l in range(len(data)):
        for i in range(length):

            try: data[l][i+start]
            except: print(data[l], i+start, length, len(data))

            if data[l][i+start]in "Aa":    DATA_X[l, i, 0] = 1
            elif data[l][i+start] in "Cc": DATA_X[l, i, 1] = 1
            elif data[l][i+start] in "Gg": DATA_X[l, i, 2] = 1
            elif data[l][i+start] in "Tt": DATA_X[l, i, 3] = 1
            elif data[l][i+start] in "Xx": pass
            else:
                print("Non-ATGC character " + data[l])
                print(i)
                print(data[l][i+start])
                sys.exit()
        #loop end: i
    #loop end: l
    print("Preprocessing the sequence done")
    return DATA_X

dataset_seq_masked = preprocess_seq(dataset1['seq'])
dataset_seq_masked = pd.Series(list(dataset_seq_masked),name='seq_one')

dataset_all = pd.concat([dataset1,dataset_seq_masked],axis=1)

print("Building model")
PAM_Input_SEQ = Input(shape=(length,4))
PAM_SEQ = PAM_Input_SEQ
for _ in range(CONV_LAYERS):
    PAM_SEQ = Conv1D(CON_DIMS, CON_FILTER_SIZE, padding='same',activation='relu')(PAM_SEQ)
    PAM_SEQ = AveragePooling1D(CON_POOLING)(PAM_SEQ)
PAM_SEQ = Flatten()(PAM_SEQ)

for _ in range(NUM_LAYERS):
    PAM_SEQ=Dense(NUM_DIMS, activation='relu')(PAM_SEQ)
    PAM_SEQ=Dropout(DROPOUT_RATE)(PAM_SEQ)
PAM_D3 = Dense(256, activation='relu')(PAM_SEQ)
PAM_DO4= Dropout(DROPOUT_RATE)(PAM_D3)
PAM_Output = Dense(255, activation='softmax')(PAM_DO4)
PAM = Model(inputs=[PAM_Input_SEQ], outputs=[PAM_Output])
PAM.compile(optimizer=tf.keras.optimizers.Adam(0.0001), loss='mean_absolute_error')

X_train_seq = np.stack(dataset_all['seq_one'])
X_train_target=np.asarray(dataset_all['Efficiency']).astype(np.float32)

PAM.fit(X_train_seq, X_train_target, batch_size=batch_size, epochs=epochs)
