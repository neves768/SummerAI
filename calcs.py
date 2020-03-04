import re
class logic:
    '''
        This class creates mathematics functionalities to Summer AI
    '''
    op = {}
    def __init__(self):
        logic.op = {"+":logic.add}
    
    @staticmethod
    def add(string):
        n = re.findall("([+.0-9]{1,7})", string)
        if(len(n) > 2):
            for i in range(len(n)-1):
                if(n[i+1] == "+"):
                    return int(n[i])+int(n[i+2])
        else:
            return False

    def routeToOp(self, string):
        for i, f in logic.op.items():
            if(string.find(i)):
                return f(string)

class A:
    @staticmethod
    def bcb():
        print('ffa')
