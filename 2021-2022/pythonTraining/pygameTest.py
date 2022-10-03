from ctypes.wintypes import RGB

from time import sleep

import turtle

from random import randint

from random import choice

turtle.colormode(255)


def drawArt(nbOfTurns):

    if nbOfTurns == 0:

        sleep(4)

        breakpoint

    else:

        nbOfTurns -= 1

            # caractere aléatoire

        coin_flip = 0 # randint(0,3)

            # pour commander la tortue

        turtle.speed(100)

        if coin_flip == 0:

            turtle.penup()

            drawSquare(nbOfTurns)            



        elif coin_flip == 1:

            turtle.penup()

            drawCircle(nbOfTurns)            

        

        elif coin_flip == 2:

            turtle.penup()

            drawTriangle(nbOfTurns)

        

        elif coin_flip == 3:

            turtle.penup()

            drawLetter(nbOfTurns)



def drawSquare(nbOfTurns):

    pen_size = randint(1, 5)

    size = randint(25,250)

    if size >= 25 and size < 50:

        position_x = randint(-960, 960)

        position_y = randint(-130, 80)

    elif size <= 250 and size >= 50:

        position_x = randint(-960, 960)

        position_y = randint(-160,160)

    r = randint(0,255)

    g = randint(0,255)

    b = randint(0,255)

    turtle.pensize(pen_size)

    turtle.color(r,g,b)

    turtle.setheading(0)

    turtle.goto(position_x,position_y)

    turtle.pendown()

    turtle.forward(size)

    turtle.left(90)

    turtle.forward(size)

    turtle.left(90)

    turtle.forward(size)

    turtle.left(90)

    turtle.forward(size)

    turtle.penup()

    drawArt(nbOfTurns)



def drawCircle(nbOfTurns):

    pen_size = randint(1, 5)

    size = randint(25,250)

    if size >= 25 and size < 50:

        position_x = randint(-960, 960)

        position_y = randint(-130, 80)

    elif size <= 250 and size > 50:

        position_x = randint(-960, 960)

        position_y = randint(-160,160)

    r = randint(0,255)

    g = randint(0,255)

    b = randint(0,255)

    turtle.pensize(pen_size)

    turtle.color(r,g,b)

    turtle.setheading(0)

    turtle.goto(position_x,position_y)

    turtle.pendown()

    turtle.circle(size)

    turtle.penup()

    drawArt(nbOfTurns)



def drawTriangle(nbOfTurns):

    pen_size = randint(1, 5)

    size = randint(25,250)

    if size >= 25 and size < 50:

        position_x = randint(-960, 960)

        position_y = randint(-130, 80)

    elif size <= 250 and size > 50:

        position_x = randint(-960, 960)

        position_y = randint(-160,160)

    r = randint(0,255)

    g = randint(0,255)

    b = randint(0,255)

    turtle.pensize(pen_size)

    turtle.color(r,g,b)

    turtle.setheading(0)

    turtle.goto(position_x,position_y)

    turtle.pendown()

    turtle.forward(size)

    turtle.left(120)

    turtle.forward(size)

    turtle.left(120)

    turtle.forward(size)

    turtle.penup()

    drawArt(nbOfTurns)



def drawLetter(nbOfTurns):

    letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o",  "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"]

    pen_size = randint(1, 5)

    size = randint(25,250)

    letter = letters[randint(0, len(letters)-1)]

    if size >= 25 and size < 50:

        position_x = randint(-960, 960)

        position_y = randint(-130, 80)

    elif size <= 250 and size >= 50:

        position_x = randint(-960, 960)

        position_y = randint(-160,160)

    r = randint(0,255)

    g = randint(0,255)

    b = randint(0,255)

    turtle.pensize(pen_size)

    turtle.color(r,g,b)

    turtle.setheading(0)

    turtle.goto(position_x,position_y)

    turtle.pendown()

    turtle.write(letter)

    turtle.penup()

    drawArt(nbOfTurns)

drawArt(150)