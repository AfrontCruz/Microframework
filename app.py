import csv
import model
import controller

classes = []

with open('./classes/ejemplo.csv') as File:  
    reader = csv.reader(File)
    for row in reader:
        classes.append(row)

classname = classes.pop(0)
classes.pop(0)
mod = model.Model(classname, classes)
con = controller.Controller(classname, classes)
mod.getFormat()
con.getFormat()