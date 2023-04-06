def Menu():
    while True:
        # Wyświetlenie menu i pobranie wyboru użytkownika
        print("PYTHON.SH - APACHE+SFTP")
        print("1. Add website+SFTP")
        print("2. Remove website+STP")
        print("3. Exit")
        choice = input("Wybierz opcję (1-3): ")


        json = json.Json("config/data.json")
        # Dodanie elementu
        if choice == "1":
            Shell.ShCommand("sh sh/add.sh").printLn()
            website_to_dell(json)

        # Usunięcie elementu
        elif choice == "2":
            print("usnieto")


        # Wyjście z programu
        elif choice == "3":
            print("Do widzenia!")
            break

        # Nieprawidłowy wybór
        else:
            print("Nieprawidłowa opcja.")