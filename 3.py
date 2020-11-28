patternList = int(input("Input angka pattern: "))

def printPattern(patternList):
    n = patternList
    if patternList >= 15:
        for i in range((n+1)//2):
            
            if i == 0:
                for j in range((n)):
                    print("*",end='')
            else:
                for j in range((n//2)-i+1):
                    print("*",end='')
                if i == 1:
                    for k in range(i):
                        print(" ",end='')
                elif i+i-1 >= 13:
                    for k in range(i-6):
                        print(" ",end='')                                        
                    print("dumbwaysid",end='')
                    for k in range(i-5):
                        print(" ",end='')                    
                else:
                    for k in range(i):
                        print(" ",end='')
                    for k in range(i-1):
                        print(" ",end='')    

                for l in range((n//2)-i+1):
                    print("*",end='')
                          
            print()

        for i in reversed(range((n+1)//2)):
            if i == 0:
                pass   
            elif i == 1:   
                for j in range(n):
                    print("*",end='')
            else:      
                for j in range(((n+1)//2)-i+1):
                    print("*",end='')
                if i+i-3 >= 13:
                    for k in range(i-7):
                        print(" ",end='')                                        
                    print("dumbwaysid",end='')
                    for k in range(i-6):
                        print(" ",end='')
                else:
                    for k in range(i-1):
                        print(" ",end='')
                    for k in range(i-2):
                        print(" ",end='')
                    

                for l in range(((n+1)//2)-i+1):
                    print("*",end='')
                print()
    else:
        for i in range((n+1)//2):
            
            if i == 0:
                for j in range((n)):
                    print("*",end='')
            else:
                for j in range((n//2)-i+1):
                    print("*",end='')
                if i == 1:
                    for k in range(i):
                        print(" ",end='')                  
                else:
                    for k in range(i):
                        print(" ",end='')
                    for k in range(i-1):
                        print(" ",end='')    

                for l in range((n//2)-i+1):
                    print("*",end='')
                          
            print()

        for i in reversed(range((n+1)//2)):
            if i == 0:
                pass   
            elif i == 1:   
                for j in range(n):
                    print("*",end='')
            else:      
                for j in range(((n+1)//2)-i+1):
                    print("*",end='')
                
                
                for k in range(i-1):
                    print(" ",end='')
                for k in range(i-2):
                    print(" ",end='')
                    

                for l in range(((n+1)//2)-i+1):
                    print("*",end='')
                print()

printPattern(patternList)
input()