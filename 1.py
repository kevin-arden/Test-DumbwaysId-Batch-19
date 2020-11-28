kalori = int(input("Input Kalori: "))

def tentukanOlahraga(kalori):
    if kalori > 750:
        olahraga = "Lari"
    elif kalori > 500:
        olahraga = "Badminton"
    else:
        olahraga = "Renang"
    
    waktu = kalori // 10

    print("Jumlah Kalori:",kalori,"kalori")
    print("Jenis Olahraga:",olahraga) 
    print("Waktu Olahraga:",waktu,"menit")

tentukanOlahraga(kalori)
input()