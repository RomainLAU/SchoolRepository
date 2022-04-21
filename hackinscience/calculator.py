from sys import argv
import operator

ops = {
    '+' : operator.add,
    '-' : operator.sub,
    '*' : operator.mul,
    '/' : operator.truediv,
    '%' : operator.mod,
    '^' : operator.pow,
}

if(len(argv) == 4):
    try:
        print(ops[argv[len(argv)-2]](int(argv[len(argv)-3]), int(argv[len(argv)-1])))  
    except:
        print('input error')
else:
    print('usage: ./solution.py a_number (an_operator +-*/%^) a_number')