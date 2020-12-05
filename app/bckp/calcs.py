import re
class logic:
    '''
        This class creates mathematics functionalities to Summer AI
    '''
    op = {}
    def __init__(self):
        logic.op = {
            "+":logic.add,
            "-":logic.sub,
            "*":logic.times
        }

    @staticmethod
    def times(string):
        n = re.findall("([\*.0-9]{1,7})", string)
        if(len(n) > 2):
            for i in range(len(n)-1):
                if(n[i+1] == "*"):
                    return float(n[i])*float(n[i+2])
        else:
            return False
    
    @staticmethod
    def add(string):
        n = re.findall("([+.0-9]{1,7})", string)
        if(len(n) > 2):
            for i in range(len(n)-1):
                if(n[i+1] == "+"):
                    return float(n[i])+float(n[i+2])
        else:
            return False

    @staticmethod
    def sub(string):
        n = re.findall("([\-.0-9]{1,7})", string)
        if(len(n) > 2):
            for i in range(len(n)-1):
                if(n[i+1] == "-"):
                    return float(n[i])-float(n[i+2])
        else:
            return False

    def routeToOp(self, string):
        for i, f in logic.op.items():
            if(string.find(i) != -1):
                return f(string)

class A:
    @staticmethod
    def bcb():
        print('ffa')
