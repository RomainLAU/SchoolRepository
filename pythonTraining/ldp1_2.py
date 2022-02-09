# <------ S1LDP1 ------->

# Exercice 3

from datetime import datetime
from operator import and_


def myHelloWorld():
    print('Hello World')

# myHelloWorld()

# Exercice 4

def myEcho(data):
    print(data, '\n')

# myEcho('I')
# myEcho('CALL')
# myEcho('THE')
# myEcho('CYBER')
# myEcho('POLICE')

# Exercice 5

def concat(sentence1, sentence2):
    print(sentence1, sentence2)

# concat('Hello', 'World')

# Exercice 7

def oddOrEven(data):
    if data %2 == 0:
        print('Even')
    else:
        print('Odd')

# oddOrEven(345)

# Exercice 8

def isOdd(data):
    if data %2 == 0:
        return True
    else:
        return False

# print(isOdd(346))

# Exercice 9

def somme(number1, number2):
    return number1 + number2

# print(somme(2, 3))

# Exercice 10

from datetime import datetime

currentDateTime = datetime.now()
date = currentDateTime.date()
currentYear = date.strftime("%Y")

def isAdult(year):
    if int(currentYear) - int(year) >= 18:
        return True
    else:
        return False

# print(isAdult(2005))

# Exercice 11

def isSmaller(number1, number2, number3):
    if ((number1 < number2) and (number1 < number3)):
        print(number1)
    elif ((number2 < number1) and (number2 < number3)):
        print(number2)
    else:
        print(number3)

# isSmaller(-1, -2, 3)

# Exercice 12

def getComment(note, triche:bool, rendu:bool):
    if rendu == False:
        print('Vous n\'avez pas rendu de devoir')
    elif note == 0:
        print('Aucun effort')
    elif note == 5:
        print('A essayé')
    elif note == 7:
        print('C\'est mieux que 5')
    elif note == 10:
        print('Pile poil la moyenne')
    elif note == 12:
        print('Assez bien')
    elif note == 14:
        print('Bien')
    elif ((note == 16) and (triche == False)):
        print('Très bien')
    elif ((note == 16) and (triche == True)):
        print('Triche')
    elif ((note == 20) and (triche == False)):
        print('Excellent')
    elif ((note == 20) and (triche == True)):
        print('Triche Excellente')

# getComment(0, False, False)
# print('\n') 
# getComment(0, False, True)
# print('\n')
# getComment(5, False, True)
# print('\n')
# getComment(7, False, True)
# print('\n')
# getComment(10, False, True)
# print('\n')
# getComment(12, False, True)
# print('\n')
# getComment(14, False, True)
# print('\n')
# getComment(16, False, True)
# print('\n')
# getComment(16, True, True)
# print('\n')
# getComment(20, False, True)
# print('\n')
# getComment(20, True, True)



# <------ S1LDP2 ------->

# Exercice 0

i = 0

while i <= 10:
    # print(i)
    i+=1

# Exercice 1

# for a in range(0, 11):
    # print(a)

# Exercice 2

# *********************
# ********************
# *******************
# *********************
# *********************
# *******************
# *********************
# ******************************************
# *********************
# *********************
# *******************

# b = 0

# while b < 11:
#     if b == 1:
#         print('********************\n')
#     elif ((b == 2) or (b == 5) or (b == 10)):
#         print('*******************\n')
#     elif b == 7:
#         print('******************************************\n')
#     else:
#         print('*********************\n')
#     b+=1

# Exercice 3

# ******************************************
# ******************************************
# *******************
# *********************
# *********************
# *******************
# *********************
# ******************************************
# *********************
# *********************
# ******************************************

# for b in range(0, 11):
#     if b == 2 or b == 5:
#         print('*******************\n')
#     elif b == 0 or b == 1 or b == 7 or b == 10:
#         print('******************************************\n')
#     else:
#         print('*********************\n')

# Exercice 4

# for b in range(0, 101):
#     if not(isOdd(b)):
#         print(b)

# Exercice 5

tab = ['Le Guide du voyageur galactique', 'Le Dernier Restaurant avant la fin du monde', 'La Vie, l\'Univers et le Reste', 'Salut et encore merci pour le poison', 'Globalment onoffensive']

# for books in tab:
    # print(books, '\n')

# Exercice 6

tab0 = ['Goodbye', 'Dennis']

tab1 = ['U', 'DUN', 'GOOFED']

tab2 = {'name':'Glenn', 'first_name':'kenny', 'pets':'dusty', 'crime':'animal abuse', 'achievement':'goofed'}

tab3 = ['bananas', 'apple', {'fish': 'sharktopus'}, 'lemon', 'pineapple', 'pear', 'cherry']

tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk']


def myArrayPrint(array):
    if type(array) == list:
        for index in array:
            if type(index) == dict:
                for key, value in index.items():
                    print(key, ' => ', value, '\n')
            else:
                print(array.index(index), ' => ', index, '\n')
    elif type(array) == dict:
        for key, value in array.items():
            print(key, ' => ', value, '\n')


# myArrayPrint(tab3)

# Exercice 7

def myCount(array):
    values = 0
    for value in array:
        values += 1
    print(values)

# myCount(tab3)

# Exercice 8

def mySuperCount(array):
    characters = 0

    if type(array) == list:
        for index in array:
            if type(index) == dict:
                for key, value in index.items():
                        for character in value:
                            characters += 1
            else:
                for character in index:
                    characters += 1

    elif type(array) == dict:
        for key, value in array.items():
            for character in value:
                characters += 1

    print(characters)

# mySuperCount(tab3)

# Exercice 9

def onlyTheBest(array):
    theBest = {'word': '', 'letters': 0}

    if type(array) == list:
        for index in array:
            if type(index) == dict:
                for key, value in index.items():
                    characters = 0
                    for character in value:
                        characters += 1
                    if characters > theBest['letters']:
                        theBest['word'] = value
                        theBest['letters'] = characters
            else:
                characters = 0
                for character in index:
                    characters += 1
                if characters > theBest['letters']:
                    theBest['word'] = index
                    theBest['letters'] = characters

    elif type(array) == dict:
        for key, value in array.items():
            characters = 0
            for character in value:
                characters += 1
            if characters > theBest['letters']:
                theBest['word'] = value
                theBest['letters'] = characters

    print(theBest['word'])

# onlyTheBest(tab4)

# Exercice 10

def onlyTheBestKey(array):
    theBestKey = {'key': '', 'letters': 0}

    if type(array) == list:
        strFirst = False
        for index in array:
            if type(index) == dict:
                strFirst = True
                for key, value in index.items():
                    characters = 0
                    for character in key:
                        characters += 1
                    if characters > theBestKey['letters']:
                        theBestKey['key'] = key
                        theBestKey['letters'] = characters
            else:
                if strFirst == True:
                    next
                elif array.index(index) > theBestKey['letters']:
                    theBestKey['key'] = array.index(index)
                    theBestKey['letters'] = array.index(index)

    elif type(array) == dict:
        for key, value in array.items():
            characters = 0
            for character in key:
                characters += 1
            if characters > theBestKey['letters']:
                theBestKey['key'] = key
                theBestKey['letters'] = characters

    print(theBestKey['key'])

onlyTheBestKey(tab0)