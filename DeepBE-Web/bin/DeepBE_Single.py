import os
import sys
import random
import itertools
import numpy as np
import datetime

import tensorflow as tf
os.environ['CUDA_VISIBLE_DEVICES'] = '0'

gpus = tf.config.experimental.list_physical_devices('GPU')
for gpu in gpus:
    tf.config.experimental.set_memory_growth(gpu, True)

def main():
    BASE_MODEL_NAMES = ["SpCas9", "VRQR variant", "SpCas9-NG", "SpCas9-NRRH", "SpCas9-NRTH", "SpCas9-NRCH", "SpG", "SpRY", "Sc++"]
    base_model_names = ["SpCas9", "VRQR", "NG", "NRRH", "NRTH", "NRCH", "SpG", "SpRY", "Sc++"]
    EDITOR_NAMES = ["ABE8e(V106W)", "ABE8.17m+V106W", "YE1-BE4max", "SsAPOBEC3B", "CGBE1", "miniCGBE1", "APOBEC-nCas9-Ung"]
    editor_names = ["8e", "17m", "YE1", "Ss", "CGBE1", "mini", "Bi"]
    starts = [6, 6, 7, 6, 7, 7, 7]
    lengths = [8, 8, 5, 7, 5, 5, 5]

    path = sys.argv[1]

    FILE = open(os.path.join(path, "EDITOR.txt"), "r")
    EDITOR = int(FILE.readlines()[0][0])
    FILE.close()

    FILE = open(os.path.join(path, "PAM.txt"), "r")
    PAM = int(FILE.readlines()[0][0])
    FILE.close()

    BASE_MODEL_NAME = BASE_MODEL_NAMES[PAM]
    base_model_name = base_model_names[PAM]
    EDITOR_NAME = EDITOR_NAMES[EDITOR]
    editor_name = editor_names[EDITOR]
    start = starts[EDITOR]
    length = lengths[EDITOR]

    with open(os.path.join(path, "input.txt"), "r") as FILE:
        lines = FILE.readlines()

    TIME = open(os.path.join(path, "TIME.txt"), "w")
    TIME_START = datetime.datetime.now()

    time_start = datetime.datetime.now()
    seq, SEQ_PAM = preprocess_seq_pam(lines[3:])
    SEQ = preprocess_seq(lines[3:], start, length)
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % 'preprocess', "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")


    time_start = datetime.datetime.now()
    MODEL_BASE = tf.keras.models.load_model('bin/DeepCas9variants/PAM_variant_%s_model.h5' % base_model_name, compile=False)
    MODEL = tf.keras.models.load_model('bin/DeepBE/DeepBE_%s_model' % editor_name, compile=False)
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % "model_load", "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")


    scores = []
    time_start = datetime.datetime.now()
    base_score = MODEL_BASE.predict(SEQ_PAM, batch_size=4096)
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % (base_model_name+"-pred"), "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")

    time_start = datetime.datetime.now()
    score = MODEL.predict([[SEQ, base_score], SEQ_PAM], batch_size=4096)
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % (editor_name + "-pred"), "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")

    time_start = datetime.datetime.now()
    alist = []
    for x in range(length):
        b = []
        for i in range(1, 2**x + 1):
            for k in range(1, 2**(length-1 - x) + 1):
                b.append(2**(length - x) * i - k - 1)
        alist.append(b)
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % "create-alist", "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")

    time_start = datetime.datetime.now()
    for i in range(len(score)):
        eff = score[i].sum()
        motif = seq[i][start:start+length]
        non = []
        for k in range(length):
            if ((editor_name in ["YE1", "Ss"] and motif[k] in 'Cc') or
                (editor_name in ["8e", "17m"] and motif[k] in 'Aa') or
                (editor_name in ["CGBE1", "mini", "Bi"] and motif[k] in 'Cc')):
                non.append(2**(length-1 - k))
        on = []
        for j in range(len(non)):
            iter = list(itertools.combinations(non, j+1))
            for k in iter:
                on.append(sum(k))
        on = [x - 1 for x in on]
        off = list(set(list(range(2**(length)-1))) - set(on))


        # for m in off:
        #     score[score == score[i, m]] = 0
        score[i, off] = 0


        patt = score[i].sum()
        score[i] = (score[i] / patt) * eff * 100
    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % "set-score", "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")


    time_start = datetime.datetime.now()
    output = "DeepBE_Single_Result.txt"

    with open(os.path.join(path, output), "w") as OUTPUT:
        OUTPUT.write("\t".join(["Model", "", "", "", "", "", "", "DeepBE"]) + "\n")
        OUTPUT.write("\t".join(["Nuclease or nickase", "", "", "", "", "", "", BASE_MODEL_NAME]) + "\n")
        OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)",
                                "Outcome Sequence (30bp)", "GC Contents (%)", EDITOR_NAME]) + "\n")
        data = lines[3].strip().split("\t")
        OUTPUT.write("\t".join(data[:5] + [seq[i], data[5], "-"]) + "\n")

        scores.append([])
        for i in range(len(seq)):
            strings = []

            data = lines[i+3].strip().split("\t")
            score_sum = 0
            for j in range(2**(length)-1):
                strings.append(data[:5] + [seq[i], data[5], "%.3f" % score[i, j] if data[6+len(scores)-1] == "." else "0"])
                if float(strings[-1][-1]) > 0:
                    score_sum += float(strings[-1][-1])
            scores[-1].append(score_sum)

            for k in range(len(alist)):
                for j in alist[k]:
                    if float(strings[j][-1]) > 0:
                        if editor_name in ["YE1", "Ss"]:
                            strings[j][5] = strings[j][5][:k+start] + "t" + strings[j][5][k+1+start:]
                        elif editor_name in ["8e", "17m"]:
                            strings[j][5] = strings[j][5][:k+start] + "g" + strings[j][5][k+1+start:]
                        elif editor_name in ["CGBE1", "mini", "Bi"]:
                            strings[j][5] = strings[j][5][:k+start] + "g" + strings[j][5][k+1+start:]

            strings_dict = {}
            for string in strings:
                if float(string[-1]) > 0:
                    v = float(string[-1]) * -1
                    while 1:
                        if v not in strings_dict:
                            strings_dict[v] = string
                            break
                        else:
                            v += random.random() * 0.0000001

            for _, string in sorted(strings_dict.items()):
                OUTPUT.write("\t".join(string) + "\n")

    time_end = datetime.datetime.now()
    TIME.write("\t".join(["%30s" % "print", "%30s" % 'elapsed time:', str(time_end - time_start)]) + "\n")

    TIME_END = datetime.datetime.now()
    TIME.write("\n" + "\t".join(["%30s" % 'TOTAL:', "%30s" % 'elapsed time:', str(TIME_END - TIME_START)]) + "\n")
    TIME.close()

    return


def preprocess_seq(lines, start, length):
    DATA_X = np.zeros((len(lines), length + 2, 4), dtype=int)
    for l in range(len(lines)):
        seq = lines[l].split("\t")[3]
        for i in range(length + 2):
            if seq[i + start - 1] in "Aa":    DATA_X[l, i, 0] = 1
            elif seq[i + start - 1] in "Cc":  DATA_X[l, i, 1] = 1
            elif seq[i + start - 1] in "Gg":  DATA_X[l, i, 2] = 1
            elif seq[i + start - 1] in "Tt":  DATA_X[l, i, 3] = 1

    return DATA_X


def preprocess_seq_pam(lines, seq_length=30):
    seqs = []
    DATA_X_PAM = np.zeros((len(lines), seq_length, 4), dtype=int)
    for l in range(len(lines)):
        seq = lines[l].split("\t")[3]
        seqs.append(seq)

        for i in range(seq_length):
            if seq[i]in "Aa":    DATA_X_PAM[l, i, 0] = 1
            elif seq[i] in "Cc": DATA_X_PAM[l, i, 1] = 1
            elif seq[i] in "Gg": DATA_X_PAM[l, i, 2] = 1
            elif seq[i] in "Tt": DATA_X_PAM[l, i, 3] = 1

    return seqs, DATA_X_PAM


if __name__ == '__main__':
    main()
