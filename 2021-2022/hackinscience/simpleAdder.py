from sys import argv

if len(argv) > 2:
    print(int(argv[len(argv)-2]) + int(argv[len(argv)-1]))
else:
    print('usage: python3 solution.py OP1 OP2')