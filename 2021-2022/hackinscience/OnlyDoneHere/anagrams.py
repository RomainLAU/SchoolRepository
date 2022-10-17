from unidecode import unidecode

def is_anagram(left, right):
    left, right = unidecode(left.lower()).replace(" ", ""), unidecode(right.lower()).replace(" ", "")
    for letter in left:
        if right.count(letter) != left.count(letter):
            return False
    
    return True