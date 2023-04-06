import json
from os.path import exists

class Json:

    def __init__(self, file):
        self.file = file
        if (exists(self.file)==False):
            print("Create a config file")
            self.createConfig()

    def createConfig(self):
        with open(self.file, "w") as json_file:
            data = json.dumps({ "website" : [{"user":"","domain":""}]})
            json_file.write(data)

    def write(self, data):
        with open (self.file, "w") as f:
            json.dump(data,f, indent=4)

    def add(self,user,domain):
        with open(self.file) as json_file:
            data = json.load(json_file)
            temp = data["website"]
            y = {"user":user,"domain":domain}
            temp.append(y)
            self.write(data)

    def remove(self,user,domain):
        with open(self.file) as json_file:
            data = json.load(json_file)
            data = data["website"]
            for i in range(len(data)):
                i = i-1
                try:
                    # print(data[i])
                    try:
                        if(data[i] == {"user": user, "domain": domain}):
                            print(f"> Usunięto! {data[i]['domain']}")
                            data.remove(data[i])
                    except KeyError:
                        break
                except IndexError:
                    break

            data = { "website" : data}
            self.write(data)

    def read(self):
        with open(self.file) as json_file:
            data = json.load(json_file)
            temp = data["website"]
            for element in temp:
                print(f"User: {element['user']} Domain {element['domain']}")

