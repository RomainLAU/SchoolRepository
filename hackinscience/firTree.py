from sys import argv

if (len(argv) == 2):
    if int(argv[-1]) != 0:
        for i in range(0, int(argv[-1])):
            for j in range(1, 9, 2):
                if j == 7:
                    print('*' * j)
                else:
                    print(' ' * ((6-j)//2), '*' * j, ' ' * ((6-j)//2))
        print(' ' * ((6 - int(argv[-1]))//2), '|', ' ' * ((6 - int(argv[-1]))//2))
    else:
        exit
else:
    print('usage: ./solution.py int')