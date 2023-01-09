import os
import sys


def main():
	path = sys.argv[1]
	
	FILE = open(os.path.join(path, "input_original.fasta"), "r")
	FASTA_lines = FILE.readlines()
	FILE.close()

	FILE = open(os.path.join(path, "MODEL.txt"), "r")
	MODEL = int(FILE.readlines()[0][0])
	FILE.close()

	FILE = open("src/PAM_list.txt", "r")
	PAM_lines = [line for line in FILE.readlines() if len(line) > 1]
	FILE.close()
	if MODEL != 0:
		PAM_lines = [PAM_lines[2]] + PAM_lines
	PAM_dicts = []
	for PAM_line in PAM_lines:
		tokens = PAM_line.strip().split("\t")
		PAM = {}
		for i in range(1, len(tokens)):
			PAM[tokens[i]] = 1
		PAM_dicts.append(PAM)

	strings = []
	l, num = 0, 0
	while l + 1 < len(FASTA_lines):
		line = FASTA_lines[l].strip()

		ID = ""
		if len(line) == 0:
			continue
		elif line[0] != ">":
			print("Input must be in FASTA format (line %d)." % l)
			return
		else:
			ID = line[1:].strip().split()[0]
			if len(ID) == 0: ID = str(num)
			num += 1

		SEQ = ""
		while l + 1 < len(FASTA_lines):
			l = l + 1
			line = FASTA_lines[l].strip()
			if line[0] == ">":
				break
			else:
				SEQ += line

		NUM = 0
		seq, seq_rev = preprocess(SEQ)
		for i in range(len(seq) - 30 + 1):
			skip = True
			placeholders = []
			for PAM in PAM_dicts:
				if seq[i+24:i+28] in PAM:
					if MODEL == 0:
						placeholders.append(".")
					elif MODEL in [1, 2]:
						placeholders += ["."] * 2
					else:
						placeholders += ["."] * 3
					skip = False
				else:
					if MODEL == 0:
						placeholders.append("No activity")
					elif MODEL in [1, 2]:
						placeholders += ["."] * 2
					else:
						placeholders += ["."] * 3
			if skip: continue

			gc = (seq[i+4:i+24].count("G") + seq[i+4:i+24].count("C")) / 20.0 * 100
			strings.append("\t".join([str(ID), "%d:%d" % (i+1, i+30), seq[i:i+30], seq[i:i+30], seq[i+4:i+24], "%d" % gc] + placeholders) + "\n")

		for i in range(len(seq_rev) - 30 + 1):
			skip = True
			placeholders = []
			for PAM in PAM_dicts:
				if seq_rev[i+24:i+28] in PAM:
					if MODEL == 0:
						placeholders.append(".")
					elif MODEL in [1, 2]:
						placeholders += ["."] * 2
					else:
						placeholders += ["."] * 3
					skip = False
				else:
					if MODEL == 0:
						placeholders.append("No activity")
					elif MODEL in [1, 2]:
						placeholders += ["."] * 2
					else:
						placeholders += ["."] * 3
			if skip: continue

			gc = (seq_rev[i+4:i+24].count("G") + seq_rev[i+4:i+24].count("C")) / 20.0 * 100
			strings.append("\t".join([str(ID), "%d:%d" % (len(seq_rev) - i, len(seq_rev) - (i+29)), preprocess(seq_rev[i:i+30])[1], seq_rev[i:i+30], seq_rev[i+4:i+24], "%d" % gc] + placeholders) + "\n")

	if len(strings) > 0:
		OUTPUT = open(os.path.join(path, "input.txt"), "w")
		if MODEL == 0:
			OUTPUT.write("\t".join(["Model", "", "", "", "", "",
									"DeepCas9variants", "", "", "", "", "", "", "", "", ""]) + "\n")
			OUTPUT.write("\t".join(["Nuclease or nickase", "", "", "", "", "",
									"SpCas9", "VRQR variant", "SpCas9-NG", "SpCas9-NRRH", "SpCas9-NRTH", "SpCas9-NRCH", "SpG", "SpRY", "Sc++"]) + "\n")
			OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)", "GC Contents (%)",
									"(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19", "(G/g)N19"]) + "\n")
		elif MODEL == 1:
			OUTPUT.write("\t".join(["Model"] + [""] * 5 +  ["DeepNG-BE"] + [""] * (2 - 1) + ["DeepBE"] + [""] * (2 * 9 - 1)) + "\n")
			OUTPUT.write("\t".join(["Nickase"] + [""] * 5 + ["SpCas9-NG"] + [""] * 1 + ["SpCas9"] + [""] * 1 + ["VRQR variant"] + [""] * 1 +
								    ["SpCas9-NG"] + [""] * 1 + ["SpCas9-NRRH"] + [""] * 1 + ["SpCas9-NRTH"] + [""] * 1 + ["SpCas9-NRCH"] + [""] * 1 +
								    ["SpG"] + [""] * 1 + ["SpRY"] + [""] * 1 + ["Sc++"] + [""] * 1) + "\n")
			OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)", "GC Contents (%)"] +
								   ["ABE8e(V106W)", "ABE8.17m+V106W"] * 10) + "\n")
		elif MODEL == 2:
			OUTPUT.write("\t".join(["Model"] + [""] * 5 +  ["DeepNG-BE"] + [""] * (2 - 1) + ["DeepBE"] + [""] * (2 * 9 - 1)) + "\n")
			OUTPUT.write("\t".join(["Nickase"] + [""] * 5 + ["SpCas9-NG"] + [""] * 1 + ["SpCas9"] + [""] * 1 + ["VRQR variant"] + [""] * 1 +
								    ["SpCas9-NG"] + [""] * 1 + ["SpCas9-NRRH"] + [""] * 1 + ["SpCas9-NRTH"] + [""] * 1 + ["SpCas9-NRCH"] + [""] * 1 +
								    ["SpG"] + [""] * 1 + ["SpRY"] + [""] * 1 + ["Sc++"] + [""] * 1) + "\n")
			OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)", "GC Contents (%)"] +
								   ["YE1-BE4max", "SsAPOBEC3B"] * 10) + "\n")
		else:
			OUTPUT.write("\t".join(["Model"] + [""] * 5 +  ["DeepNG-BE"] + [""] * (3 - 1) + ["DeepBE"] + [""] * (3 * 9 - 1)) + "\n")
			OUTPUT.write("\t".join(["Nickase"] + [""] * 5 + ["SpCas9-NG"] + [""] * 2 + ["SpCas9"] + [""] * 2 + ["VRQR variant"] + [""] * 2 +
								    ["SpCas9-NG"] + [""] * 1 + ["SpCas9-NRRH"] + [""] * 2 + ["SpCas9-NRTH"] + [""] * 2 + ["SpCas9-NRCH"] + [""] * 2 +
								    ["SpG"] + [""] * 2 + ["SpRY"] + [""] * 2 + ["Sc++"] + [""] * 2) + "\n")
			OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)", "GC Contents (%)"] +
								   ["CGBE1", "miniCGBE1", "APOBEC-nCas9-Ung"] * 10) + "\n")

		for string in strings:
			OUTPUT.write(string)
		OUTPUT.close()

		print(1)
		return

	else:

		print("The input sequence length must be >= 30 .")
		return


def preprocess(seq):
	c, rc = "", ""
	L = len(seq)

	for i in range(L):
		if seq[i] in "Aa":   c += "A"
		elif seq[i] in "Tt": c += "T"
		elif seq[i] in "Gg": c += "G"
		elif seq[i] in "Cc": c += "C"

	for i in range(L):
		if seq[L-1-i] in "Aa":   rc += "T"
		elif seq[L-1-i] in "Tt": rc += "A"
		elif seq[L-1-i] in "Gg": rc += "C"
		elif seq[L-1-i] in "Cc": rc += "G"

	return c, rc


if __name__ == '__main__':
	main()
	
