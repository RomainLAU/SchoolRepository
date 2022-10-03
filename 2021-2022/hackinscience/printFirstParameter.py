from sys import argv

if len(argv) > 1:
    print(argv[len(argv)-1])
else:
    print('usage: python3 solution.py PARAM')