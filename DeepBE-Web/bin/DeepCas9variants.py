import os
import sys
import numpy as np
import datetime

import tensorflow as tf
os.environ['CUDA_VISIBLE_DEVICES'] = '0'

gpus = tf.config.experimental.list_physical_devices('GPU')
for gpu in gpus:
    tf.config.experimental.set_memory_growth(gpu, True)

model_names = ["SpCas9", "VRQR", "NG", "NRRH", "NRTH", "NRCH", "SpG", "SpRY", "Sc++"]

def main():
    path = sys.argv[1]
    with open(os.path.join(path, "input.txt"), "r") as FILE:
        lines = FILE.readlines()

    TIME = open(os.path.join(path, "TIME.txt"), "w")
    START = datetime.datetime.now()

    start = datetime.datetime.now()
    SEQ = preprocess(lines[3:])
    end = datetime.datetime.now()
    TIME.write(" ".join(['preprocess', 'elapsed time:', str(end - start)]) + "\n")

    scores = []
    for model_name in model_names:
        start = datetime.datetime.now()
        model = tf.keras.models.load_model('bin/DeepCas9variants/PAM_variant_%s_model.h5' % model_name, compile=False)
        score = model.predict(SEQ, batch_size=4096)
        scores.append(score)
        end = datetime.datetime.now()
        TIME.write(" ".join([model_name, 'elapsed time:', str(end - start)]) + "\n")

    start = datetime.datetime.now()
    with open(os.path.join(path, "DeepCas9variants_Results.txt"), "w") as OUTPUT:
        for l in range(len(lines)):
            if l < 3:
                OUTPUT.write(lines[l])
            else:
                data = lines[l].strip().split("\t")
                for i in range(len(data[6:])):
                    if data[6+i] == ".":
                        data[6+i] = "%.3f" % scores[i][l-3] if scores[i][l-3] > 10 else "No activity"
                OUTPUT.write("\t".join(data) + "\n")
    end = datetime.datetime.now()
    TIME.write(" ".join(['print', 'elapsed time:', str(end - start)]) + "\n")

    END = datetime.datetime.now()
    TIME.write("\n" + " ".join(['TOTAL:', 'elapsed time:', str(END - START)]) + "\n")
    TIME.close()

    return


def preprocess(lines, length=30):
    SEQ = np.zeros((len(lines), length, 4), dtype=int)

    for l in range(len(lines)):
        seq = lines[l].split("\t")[3]
        for i in range(length):
            if seq[i] in "Aa":   SEQ[l, i, 0] = 1
            elif seq[i] in "Cc": SEQ[l, i, 1] = 1
            elif seq[i] in "Gg": SEQ[l, i, 2] = 1
            elif seq[i] in "Tt": SEQ[l, i, 3] = 1

    return SEQ


if __name__ == '__main__':
    main()
