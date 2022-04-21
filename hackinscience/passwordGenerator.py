from random import randint, shuffle, choice
from string import ascii_lowercase, ascii_uppercase, digits

def pwgen(length, with_digits = True, with_uppercase = True):

    length = int(length)
    password = ''

    if with_digits == False and with_uppercase:

        for i in range(length):
            randomInt = randint(0, 1)

            if (randomInt == 0):
                password += choice(ascii_lowercase)
            elif (randomInt == 1):
                password += choice(ascii_uppercase)

    elif with_digits and with_uppercase == False:

        for i in range(length):
            randomInt = randint(0, 1)

            if (randomInt == 0):
                password += choice(ascii_lowercase)
            elif (randomInt == 1):
                password += choice(digits)

    elif with_digits == False and with_uppercase == False:

        for i in range(length):
            password += choice(ascii_lowercase)
    
    else:
        for i in range(length):
            randomInt = randint(0, 2)

            if (randomInt == 0):
                password += choice(ascii_lowercase)
            elif (randomInt == 1):
                password += choice(ascii_uppercase)
            elif (randomInt == 2):
                password += choice(digits)

    if not any(lowercase in password for lowercase in ascii_lowercase):

        password = password.replace(password[-1], choice(ascii_lowercase))
        passwordList = list(password)
        shuffle(passwordList)
        password = ''.join(passwordList)
    
    if with_uppercase and not any(uppercase in password for uppercase in ascii_uppercase):

        password = password.replace(password[-1], choice(ascii_uppercase))
        passwordList = list(password)
        shuffle(passwordList)
        password = ''.join(passwordList)

    if with_digits and not any(digit in password for digit in digits):

        password =  password.replace(password[-1], choice(digits))
        passwordList = list(password)
        shuffle(passwordList)
        password = ''.join(passwordList)

    return password

print(pwgen(15))