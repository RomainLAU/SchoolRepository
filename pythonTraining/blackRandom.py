from time import sleep
from turtle import *
from random import randint
from random import choice

window = Screen()
window.bgcolor("black")
screensize(1920,1080)

colormode(255)

def art(turn,x):
  r = randint(0,255)
  g = randint(0,255)
  b = randint(0,255)
  coin(turn,x)

def coin(turn,x):
  penup()
  hideturtle()
    # pour commander la tortue
  speed(0)
  if turn > 0:
    print("Il reste", turn, "tours")
    
    if x == 0:
      SetCircle(turn-1, x)
    
    elif x == 1:
      SetTriangle(turn-1, x)

    elif x == 2:
      drawSquare(turn-1, x)
    
    elif x == 3:
      drawPara(turn-1, x)
                
  elif turn <= 0:
    penup()

    sleep(10)

    False  

def drawSquare(turn, x):
  pen_size = randint(2, 4)
  size = randint(25,200)
  if size >= 25 and size <= 75:
    position_x = randint(-890, 890)
    position_y = randint(-520, 520)
  elif size <= 200 and size > 75:
    position_x = randint(-910, 910)
    position_y = randint(-540, 540)
  r = randint(0,255)
  g = randint(0,255)
  b = randint(0,255)
  pensize(pen_size)
  color(r, g, b)
  setheading(0)
  goto(position_x,position_y)
  pendown()
  forward(size)
  left(90)
  forward(size)
  left(90)
  forward(size)
  left(90)
  forward(size)
  penup()
  coin(turn, x)

def SetCircle(turn, x):
  pen_size = randint(2, 4)
  size = randint(25,250)
  if size >= 25 and size < 50:
    position_x = randint(-160, 140)
    position_y = randint(-125, 95)
  elif size <= 250 and size > 50:
    position_x = randint(-200, 180)
    position_y = randint(-140,90)
  r = randint(0,255)
  g = randint(0,255)
  b = randint(0,255)
  pensize(pen_size)
  color(r, g, b)
  setheading(0)
  goto(position_x,position_y)
  pendown()
  circle(size)
  penup()
  coin(turn, x)


def SetTriangle(turn, x):
  pen_size = randint(2, 4)
  triangleRotation = [120,240]
  triangleRotation2 = choice(triangleRotation)
  size = randint(25,250)
  if triangleRotation2 == 120:
    if size <= 100:
      position_x = randint(-175, 140)
      position_y = randint(-125, 100)
    else:
      position_x = randint(-200, 140)
      position_y = randint(-160, 100)
  elif triangleRotation2 == 240:
    if size <= 100:  
      position_x = randint(-175, 140)
      position_y = randint(-100, 120)
    else:
      position_x = randint(-200, 140)
      position_y = randint(-100, 200)
  r = randint(0,255)
  g = randint(0,255)
  b = randint(0,255)
  pensize(pen_size)
  color(r, g, b)
  setheading(0)
  goto(position_x,position_y)
  pendown()
  forward(size)
  left(triangleRotation2)
  forward(size)
  left(triangleRotation2)
  forward(size)
  coin(turn, x)
  
def drawPara(turn, x):
  pen_size = randint(2, 4)
  size = randint(25,250)
  size_2 = size/2
  if size >= 25 and size < 100:
    position_x = randint(-170, 140)
    position_y = randint(-110, 95)
  elif size <= 250 and size > 100:
    position_x = randint(-210, 140)
    position_y = randint(-130,90)
  r = randint(0,255)
  g = randint(0,255)
  b = randint(0,255)
  pensize(pen_size)
  color(r, g, b)
  goto(position_x,position_y)
  setheading(0)
  pendown()
  forward(size)
  left(110)
  forward(size_2)
  setheading(0)
  left(180)
  forward(size)
  left(110)
  forward(size_2)
  coin(turn, x)

art(100, 0)