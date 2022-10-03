from random import randint, shuffle
from string import ascii_lowercase

password = '1833U237YK5F65Z'

randomLowercase = ascii_lowercase[randint(0, len(ascii_lowercase)) - 1]

print(password)
passwordList = list(password)
password = password.replace(password[-1], 'a')
# shuffle(passwordList)
# password = ''.join(passwordList)
print(password, 'replaced')