import os
import sys


def main():
	path = sys.argv[1]
	
	FILE = open(os.path.join(path, "input_original.txt"), "r")
	seq = FILE.readlines()[0]
	FILE.close()

	FILE = open(os.path.join(path, "EDITOR.txt"), "r")
	EDITOR = int(FILE.readlines()[0][0])
	FILE.close()

	FILE = open(os.path.join(path, "PAM.txt"), "r")
	PAM = int(FILE.readlines()[0][0])
	FILE.close()

	EDITORS = ["ABE8e(V106W)", "ABE8.17m+V106W", "YE1-BE4max", "SsAPOBEC3B", "CGBE1", "miniCGBE1", "APOBEC-nCas9-Ung"]
	PAMS = ["SpCas9", "VRQR variant", "SpCas9-NG", "SpCas9-NRRH", "SpCas9-NRTH", "SpCas9-NRCH", "SpG", "SpRY", "Sc++"]

	OUTPUT = open(os.path.join(path, "input.txt"), "w")
	OUTPUT.write("\t".join(["Model"] + [""] * 5 + ["DeepBE"] + [""]) + "\n")
	OUTPUT.write("\t".join(["Nickase"] + [""] * 5 + [PAMS[int(PAM)]]) + "\n")
	OUTPUT.write("\t".join(["ID", "Location", "Input Sequence (30bp)", "Target Sequence (30bp)", "Guide RNA Sequence (20bp)", "GC Contents (%)"] +
						   [EDITORS[int(EDITOR)]]) + "\n")

	gc = (seq[4:24].count("G") + seq[4:24].count("C")) / 20.0 * 100
	string = "\t".join(["0", "%d:%d" % (1, 30), seq, seq, seq[4:24], "%d" % gc, "."]) + "\n"

	OUTPUT.write(string)
	OUTPUT.close()

	return


if __name__ == '__main__':
	main()
	
