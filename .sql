import turtle

# Create a Turtle screen
screen = turtle.Screen()
screen.bgcolor("white")  # Set the background color

# Create a Turtle object
heart = turtle.Turtle()
heart.shape("triangle")
heart.color("blue")
heart.speed(1)  # Set the drawing speed

# Move to the starting position
heart.penup()
heart.goto(0, -200)  # Adjust the starting position
heart.pendown()

# Function to draw the heart
def draw_heart():
    heart.begin_fill()
    heart.left(140)
    heart.forward(200)
    for _ in range(200):
        heart.right(1)
        heart.forward(2)
    heart.left(120)
    for _ in range(200):
        heart.right(1)
        heart.forward(2)
    heart.forward(200)
    heart.end_fill()
# Animate the drawing of the heart
draw_heart()

# Close the Turtle graphics window on click
screen.exitonclick()
