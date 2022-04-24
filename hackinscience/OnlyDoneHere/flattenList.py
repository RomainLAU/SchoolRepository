import functools
import operator

def flatten(a_list):                

    print(functools.reduce(operator.iconcat, a_list, []))

    # print(flatten_list)


flatten([[1], [[3, 4], 5], [[[]]], [[[6]]], []])