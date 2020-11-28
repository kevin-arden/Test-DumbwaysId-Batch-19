listPutar = ['a', 'b', 'c', 'd', 'e']

def putarArray(listPutar):
    print(listPutar)
    for i in range(1,5):
        listPutar = listPutar[1:] + list(listPutar[0])
        print("Putaran",i,":",listPutar)
        


putarArray(listPutar)
input()
