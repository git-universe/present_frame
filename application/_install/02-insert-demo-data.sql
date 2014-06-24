INSERT INTO `present_frame`.`users`
(`id`, `username`, `email`, `pass_hash`, `create_time`, `admin`, `disabled`)
VALUES
(null, 'admin', 'admin@admin.admin', '$2y$10$HvC1IZarAQHjFry1wvO18emdQ.xzqu9lSipkQEfQNlo2jEdau5FCu', current_timestamp, true, false);


INSERT INTO `present_frame`.`languages`
(`id`, `name`, `short`)
VALUES
(null, 'English', 'en'),
(null, 'Slovenščina', 'si'),
(null, 'Deutsch', 'de');


INSERT INTO `present_frame`.`pages`
(`id`, `name`, `content`, `first`, `languages_id`, `pages_id`)
VALUES
(null, 'Homepage', '<div class="jumbotron"> <h1>Welcome</h1> <p>Welcome to PresentFrame home page.</p> </div>', true, 1, null),
(null, 'Doma', '<div class="jumbotron"> <h1>Dobrodošli</h1> <p>Dobrodošli na domači strani PresentFrame.</p> </div>', true, 2, 1);


INSERT INTO `present_frame`.`categories`
(`id`, `sys_name`, `priority`, `parent_id`)
VALUES
(null, 'main1', 1, null),
(null, 'sub1.1', 1, 1),
(null, 'sub1.2', 0, 1),

(null, 'main2', 0, null);

INSERT INTO `present_frame`.`category_translation`
(`id`, `name`, `languages_id`, `categories_id`)
VALUES
(null, 'Main Category 1', 1, 1),
(null, 'Glavna kategorija 1', 2, 1),

(null, 'Sub category 1', 1, 2),
(null, 'Podkategorija 1', 2, 2),
(null, 'UnderKategoren 1', 3, 2),

(null, 'Sub category 2', 1, 3),
(null, 'Podkategorija 2', 2, 3),

(null, 'Main Category 2', 1, 4),
(null, 'Glavna kategorija 2', 2, 4),
(null, 'Kategoren 2', 3, 4);


INSERT INTO `present_frame`.`translations`
(`id`, `translation`, `languages_id`, `translations_id`)
VALUES
(null, "Login", 1, null),
(null, "Register", 1, null),
(null, "Home", 1, null),
(null, "Language", 1, null),
(null, "Register a new user", 1, null),
(null, "Username (only letters and numbers, 2 to 32 characters)", 1, null),
(null, "User's email", 1, null),
(null, "Password (min. 6 characters)", 1, null),
(null, "Repeat password", 1, null),
(null, "Cancel", 1, null),
(null, "Submit", 1, null),
(null, "Username", 1, null),
(null, "Password", 1, null),
(null, "Logout", 1, null),
(null, "Wellcome", 1, null),
(null, "User was disabled by administrators on this page...", 1, null),
(null, "Wrong username or password...", 1, null),
(null, "Passwords are not matching!", 1, null),
(null, "User with that username already exists!", 1, null),
(null, "User with that email already exists!", 1, null),
(null, "User registered successfully. You can now login to the page.", 1, null),
(null, "User registered unsuccsessfully. Please try again later...", 1, null),
(null, "Administration panel", 1, null),
(null, "Edit pages", 1, null),


(null, "Prijava", 2, 1),
(null, "Registracija", 2, 2),
(null, "Domov", 2, 3),
(null, "Jezik", 2, 4),
(null, "Registracija novega uporabnika", 2, 5),
(null, "Uporabniško ime (samo črke in številke, 2 do 32 znakov)", 2, 6),
(null, "Elektronska pošta uporabnika", 2, 7),
(null, "Geslo (minimalno 6 znakov)", 2, 8),
(null, "Ponovi geslo", 2, 9),
(null, "Prekliči", 2, 10),
(null, "Potrdi", 2, 11),
(null, "Uporabniško ime", 2, 12),
(null, "Geslo", 2, 13),
(null, "Odjava", 2, 14),
(null, "Dobrodošli", 2, 15),
(null, "Uporabniku je bil onemogočen dostop do strani...", 1, 16),
(null, "Uporabniško ime ali geslo sta napačni...", 2, 17),
(null, "Gesli se ne ujemata!", 2, 18),
(null, "Uporabnik s takšnim uporabniškim imenom že obstaja!", 2, 19),
(null, "Uporabnik s takšnim e-poštnim naslovom že obstaja!", 2, 20),
(null, "Uspešno ste registrirali uporabnika. Sedaj se lahko prijavite.", 2, 21),
(null, "Neuspešna registracija. Prosimo poskusite še enkrat...", 2, 22),
(null, "Administracijski panel", 2, 23),
(null, "Edit pages", 2, 24)
;
