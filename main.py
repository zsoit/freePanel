import module.ShCommand as Shell
import module.Json as json


cmd = Shell.ShCommand("sh sh/add.sh dupa dupa")
cmd.printSh()

json = json.Json("config/data.json")


json.add("dupasss", "chuj.pl.com")

# json.remove("dupasss", "chuj.pl.com")