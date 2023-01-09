import os
import sys


def main():
    path = sys.argv[1]

    FILE = open(os.path.join(path, "MODEL.txt"), "r")
    lines = FILE.readlines()
    FILE.close()

    print(lines[0][0])


if __name__ == '__main__':
    main()



