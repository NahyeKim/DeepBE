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

seq_length = 30

dataset_seq_masked = preprocess_seq(dataset1['seq'])
dataset_seq_masked = pd.Series(list(dataset_seq_masked),name='seq_one')

dataset_all = pd.concat([dataset1,dataset_seq_masked],axis=1)

def motif_index(orig_seq, req_seq):
    window_start = 6
    window_size = 8
    index = []
    WT = []
    for seq_index in range(len(list(req_seq))):
        if seq_index == 0:
            WT.append(req_seq[seq_index])
            labels_index = -1
            index.append(labels_index)
        elif orig_seq[seq_index]==orig_seq[seq_index-1]:
            WT.append(WT[seq_index-1])
            labels_index = -1
            for ind in range(window_size): #change to 2
                if req_seq[seq_index][ind] == WT[seq_index][ind]: pass
                else:
                    labels_index += 2**(window_size - 1-ind)
            if labels_index < 0:
                #raise ValueError
                labels_index = -1
            index.append(labels_index)
        else:
            WT.append(req_seq[seq_index])
            labels_index = -1
            for ind in range(window_size): #change to 2
                if req_seq[seq_index][ind] == WT[seq_index][ind]: pass
                else:
                    labels_index += 2**(window_size - 1-ind)
            if labels_index < 0:
                #raise ValueError
                labels_index = -1
            index.append(labels_index)
    return index

motif_index = motif_index(dataset_all['seq'],dataset_all['Motif'])
motif_index_pd = pd.DataFrame(motif_index, columns=['motif_index'])
dataset_all=pd.concat([dataset_all,motif_index_pd],axis=1)

def output_df(dataset):
    count=sum(1 for i in range(len(dataset['seq'])) if dataset['seq'].iloc[i]!=dataset['seq'].iloc[i-1])+1
    one_hot = dataset.drop_duplicates(subset=['Filename'],keep='first')
    motif_len = len(dataset['Motif'][0])
    output=pd.DataFrame(np.zeros((count+7, 2**(motif_len)+1)))
    orig = []
    for seq_index in range(len(dataset)):
        if seq_index == 0:
            orig.append(seq_index)
            output.iloc[seq_index,dataset['motif_index'][seq_index]+2] += dataset['Proportion'][seq_index]
            output.iloc[seq_index,0]=dataset['Filename'][seq_index]

        elif dataset['Filename'][seq_index]==dataset['Filename'][seq_index-1]:
            orig.append(orig[seq_index-1])
            output.iloc[orig[seq_index],dataset['motif_index'][seq_index]+2] += dataset['Proportion'][seq_index]
            output.iloc[orig[seq_index],0]=dataset['Filename'][seq_index]
        else:
            orig.append(orig[seq_index-1]+1)
            output.iloc[orig[seq_index],dataset['motif_index'][seq_index]+2] += dataset['Proportion'][seq_index]
            output.iloc[orig[seq_index],0]=dataset['Filename'][seq_index]
    output=pd.concat([output,one_hot['seq_one'].reset_index(drop=True)],axis=1)
    output=pd.concat([output,one_hot['Fold'].reset_index(drop=True)],axis=1)
    output=pd.concat([output,one_hot['PAM_variant'].reset_index(drop=True)],axis=1)

    output = output[output[1]!=1]
    output = output[output[1]!=0]

    for i in range(len(output)):
        output.iloc[i,2:2**(motif_len)+1]=output.iloc[i,2:2**(motif_len)+1]/(1-output.iloc[i,1])

    return output

output=output_df(dataset_all)

print("Building model")
Proportion_Input_SEQ = Input(shape=(length,4))
Proportion_SEQ = Proportion_Input_SEQ
for _ in range(CONV_LAYERS):
    Proportion_SEQ = Conv1D(CON_DIMS, CON_FILTER_SIZE, padding='same',activation='relu')(Proportion_SEQ)
    Proportion_SEQ = AveragePooling1D(CON_POOLING)(Proportion_SEQ)
Proportion_SEQ = Flatten()(Proportion_SEQ)

for _ in range(NUM_LAYERS):
    Proportion_SEQ=Dense(NUM_DIMS, activation='relu')(Proportion_SEQ)
    Proportion_SEQ=Dropout(DROPOUT_RATE)(Proportion_SEQ)
Proportion_D3 = Dense(256, activation='relu')(Proportion_SEQ)
Proportion_DO4= Dropout(DROPOUT_RATE)(Proportion_D3)
Proportion_Output = Dense(255, activation='softmax')(Proportion_DO4)
Proportion = Model(inputs=[Proportion_Input_SEQ], outputs=[Proportion_Output])
Proportion.compile(optimizer=tf.keras.optimizers.Adam(0.0001), loss='mean_absolute_error')

X_train_seq = np.stack(output['seq_one'])
X_train_target=np.asarray(output.iloc[:,2:257]).astype(np.float32)

Proportion.fit(X_train_seq, X_train_target, batch_size=batch_size, epochs=epochs)
