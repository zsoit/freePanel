import subprocess
class ShCommand:
    def __init__(self, cmd):
        self.cmd = cmd

    def execute(self):
        try:
            result = subprocess.run(self.cmd, shell=True, capture_output=True, text=True)
            return result.stdout
        except subprocess.CalledProcessError as e:
            return e.stderr
    def printSh(self):
        print(self.execute())