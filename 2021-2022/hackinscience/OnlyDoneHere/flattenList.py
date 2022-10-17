# from functools import reduce
# from operator import iconcat

# def flatten(a_list):                
#     # flatten_list = [reduce(iconcat, a_list, [])]
#     # if any(isinstance(item, list) for item in a_list):
#     #     print(flatten_list)
#     #     flatten(flatten_list)
#     # return flatten_list

#     return [reduce(iconcat, a_list, [])]


# print(flatten([[1], [[3, 4], 5], [[[]]], [[[6]]], []]))

from collections import abc

def yield_flatten(a_list):
    for item in a_list:
        if isinstance(item, abc.Iterable) and not isinstance(item, (str, bytes)):
            yield from yield_flatten(item)
        else:
            yield item

def flatten(a_list):
    return(list(yield_flatten(a_list)))

print(flatten([[1], [[3, 4], 5], [[[]]], [[[6]]], []]))