from string import ascii_lowercase
frequences = {}

with open('words.txt', 'rt') as f:
    file = f.read()
    textLength = len(file)
    for letter in ascii_lowercase:
        if letter in file:
            nbOfLetter = file.count(letter)
            frequences[letter] = round(nbOfLetter / textLength, 2)

for key in frequences:
    print(f"{key}: {frequences[key]}", sep="")