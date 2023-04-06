import module.ShCommand as Shell
import module.Json as json

cmd = Shell.ShCommand("ls -l")
cmd.printSh()

def website_to_del(json):
    json.read()
    try:
        number_del = int(input("\n >> Podaj storne do usuniecia: "))
        json.removeById(number_del)
    except Exception:
        print(" ")

json = json.Json("config/data.json")
website_to_del(json)

# json.add("Judasz", "zsoitmiastko.pl")
# json.add("Piwo", "xd.pl")
# json.removeByName("dupasss", "dupa.pl")