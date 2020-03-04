import speech_recognition as speech
from calcs import *

class Summer:
    '''
        Instantiate Summer AI Voice System
    '''
    def __init__(self):
        self._call = "Hello Summer"
        self._reco = speech.Recognizer()
        self._mat = logic()

    def start(self):
        with speech.Microphone() as s:
            print("Hey. I'm Summer, I was made to help you with anything.")
            audio = self._reco.listen(s)
        words = self._reco.recognize_google(audio)
        print(words)
        print(self._mat.routeToOp(words))


if __name__ == "__main__":
    vAI = Summer()
    vAI.start()

