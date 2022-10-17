from random import randint


class Dice:
    def __init__(self, value):
        self.value = value

    def throw(self):
        self.value = randint(1, 6)
