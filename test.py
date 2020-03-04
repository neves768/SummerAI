import speech_recognition as summer

rec = summer.Recognizer()
with summer.Microphone() as source:
    print("Hey. I'm Summer, I was made to help you with anything.")
    audio = rec.listen(source)

words = rec.recognize_google(audio)
print(words)

