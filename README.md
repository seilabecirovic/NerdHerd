# NerdHerd
Nerd Herd stranica će predstavljati stranicu sa najnovijim vijestima i kritikama iz svijeta muzike, knjiga, filmova, igrica i serija. Šeila Bećirović 17118

# Spirala 1
 
## I Urađeno:

-Mockup-ovi stranica

-6 stranica koje su responzivne i imaju grid-view

-Stranice su adaptivne mobilnim uređajima

-3 html forme su implementirane na stranicama contact,add a review, review

-Meni web stranice je konzistentan i prisutan na svim podstranicama i prilagođen je mobilnim uređajima

-Izgled stranice je konzistentan, nisu pronađeni glitchevi i svi elementi su poravnati korištenjem pravila responzivnog dizajna

-HTML i CSS su formatirani i validirani

## II Šta nije urađeno:

-Sve što zahtijeva korištenje biblioteka i framework-a

## III i IV Bugovi

## V File-ovi


### Folder MockUp 

-index - mockup glavne stranice

-indexmob - mockup glavne stranice za mobitel

-allreviews - mockup stranice svih recenzija, kritika

-allreviewsmob - mockup stranice svih recenzija, kritika za mobitel

-addreview - mockup stranice dodavanja kritike

-addreviewmob - mockup stranice dodavanja kritike za mobitel

-about - mockup stranice o stranici 

-aboutmob - mockup stranice o stranici za mobitel

-contact - mockup stranice za kontaktiranje vlasnika stranice

-contactmob - mockup stranice za kontaktiranje vlasnika stranice za mobitel

-review - mockup stranice s kritikom

-reviewmob - mockup stranice s kritikom za mobitel


### Folder NerdHerd

-index - html glavne stranice s najnovijim kritikama

-allreview -  html stranice svih recenzija, kritika

-addreview -  html stranica dodavanja kritike

-about - html stranica o stranici 

-contact - html stranica za kontaktiranje vlasnika stranice

-review - html stranica s kritikom


# Spirala 2

 ## I Urađeno:

-HTML i CSS su formatirani i validirani

-Validacija unosa na stranicama: Review, Add a review i Contact. (Submit je onemogućen dok sva polja ne budu valid)

-Dropdown meni kad je display <700px.

-Na stranici Review urađen je Carousel/Slider koji predstavlja galeriju. Klik na sliku raširi sliku preko cijelog ekrana, a escape vraća pogled nazad na Review.

-Stranice se učitavaju bez reload-a, omogućen back i forward.

-JavaScript odvojen u poseban file.

## II Šta nije urađeno:

-Sve što zahtijeva korištenje biblioteka i framework-a

## III i IV Bugovi

-Napomena: 
Validacija css javlja warning/error radi webkit animacija. 
Refresh stranice vraća na početnu stranicu.

## V File-ovi


### Folder MockUp 

-index - mockup glavne stranice

-indexmob - mockup glavne stranice za mobitel

-allreviews - mockup stranice svih recenzija, kritika

-allreviewsmob - mockup stranice svih recenzija, kritika za mobitel

-addreview - mockup stranice dodavanja kritike

-addreviewmob - mockup stranice dodavanja kritike za mobitel

-about - mockup stranice o stranici 

-aboutmob - mockup stranice o stranici za mobitel

-contact - mockup stranice za kontaktiranje vlasnika stranice

-contactmob - mockup stranice za kontaktiranje vlasnika stranice za mobitel

-review - mockup stranice s kritikom

-reviewmob - mockup stranice s kritikom za mobitel


### Folder NerdHerd

-index - html glavne stranice

-latestreview - html stranice s najnovijim kritikama

-allreview -  html stranice svih recenzija, kritika

-addreview -  html stranica dodavanja kritike

-about - html stranica o stranici 

-contact - html stranica za kontaktiranje vlasnika stranice

-review - html stranica s kritikom

# Spirala 3
 
## I Urađeno:

-Izvršena je serijalizacija svih podataka u XML. Svi podaci su validirani - client/server side. Dosta pažnje se posvetilo na XSS ranjivost koda. Omogućen je login s podacima username: __admin__ i password: __pass__. Registrovanje nije omogućeno radi ekskluzivnosti stranice i dopuštenih admin-a. Admin ima pravo da briše ili potvrdi nepotvrđene recenzije te da iste uređuje, kao i da briše i potvrdi komentare. 

-Omogućen je download podataka o primljenim porukama u obliku csv-file.

-Omogućen je export recenzije sa slikama i komentarima u pdf file.

-Omogućena je pretraga preko polja naziv recenzije i ime autora.

-Urađen je deployment stranice na openshift: http://nerdherdgit-nerdherd.44fs.preview.openshiftapps.com/

## II Šta nije urađeno:

-Sve što nema smisla s datom temom stranice.

## III i IV Bugovi

## V File-ovi

### Folder MockUp 

-index - mockup glavne stranice

-indexmob - mockup glavne stranice za mobitel

-allreviews - mockup stranice svih recenzija, kritika

-allreviewsmob - mockup stranice svih recenzija, kritika za mobitel

-addreview - mockup stranice dodavanja kritike

-addreviewmob - mockup stranice dodavanja kritike za mobitel

-about - mockup stranice o stranici 

-aboutmob - mockup stranice o stranici za mobitel

-contact - mockup stranice za kontaktiranje vlasnika stranice

-contactmob - mockup stranice za kontaktiranje vlasnika stranice za mobitel

-review - mockup stranice s kritikom

-reviewmob - mockup stranice s kritikom za mobitel


### Folder NerdHerd

-index - php glavne stranice s najnovijim kritikama

-allreview -  php stranice svih recenzija, kritika

-addreview -  php stranica dodavanja kritike

-about - php stranica o stranici 

-contact - php stranica za kontaktiranje vlasnika stranice

-review - php stranica s kritikom

-approved - php stranica za admin-a s listom recenzija gdje je omogućen export u pdf

-ExportPDF - php za export u pdf /admin privilages

-login - php stranica za login/logout

-messages - php za export u csv /admin privilages

-pretraga - php za pretragu

-search - php stranica za pretragu

-unconfiremdComments - php stranica s tabelom nepotvrđenih komentara za admina

-unconfirmedReviews - php stranica s tabelom nepotvrđenih recenzija

### XML Files:

-users - podaci o adminu

-unconfirmedReviews - podaci o nepotvrđenim recenzijama

-uncomments - podaci o nepotvrđenim komentarima

-reviews - podaci o kritikama

-contacts - poruke adminu

-comments - podaci kritika

### CSS i JS:

-stil.css

-nerdherd.js

### Ostali folderi:

-FPDF - biblioteka ekporta u pdf

-uploads - slike sa stranice


# Spirala 4
 
## I Urađeno:

-Kreirana je baza. Svi podaci se učitivaju iz baze i upisuju u bazu. 

-Omogućen je transfer podataka iz xml-a u bazu.

-Kreiran je web servis, koji vraća json i izvršeno je testiranje istog.

-Urađen je deployment stranice na openshift: http://nerdherdgit-nerdherd.44fs.preview.openshiftapps.com/

## II Šta nije urađeno:

-Sve što nema smisla s datom temom stranice.

## III i IV Bugovi

## V File-ovi

### Folder MockUp 

-index - mockup glavne stranice

-indexmob - mockup glavne stranice za mobitel

-allreviews - mockup stranice svih recenzija, kritika

-allreviewsmob - mockup stranice svih recenzija, kritika za mobitel

-addreview - mockup stranice dodavanja kritike

-addreviewmob - mockup stranice dodavanja kritike za mobitel

-about - mockup stranice o stranici 

-aboutmob - mockup stranice o stranici za mobitel

-contact - mockup stranice za kontaktiranje vlasnika stranice

-contactmob - mockup stranice za kontaktiranje vlasnika stranice za mobitel

-review - mockup stranice s kritikom

-reviewmob - mockup stranice s kritikom za mobitel


### Folder NerdHerd

-index - php glavne stranice s najnovijim kritikama

-allreview -  php stranice svih recenzija, kritika

-addreview -  php stranica dodavanja kritike

-about - php stranica o stranici 

-contact - php stranica za kontaktiranje vlasnika stranice

-review - php stranica s kritikom

-approved - php stranica za admin-a s listom recenzija gdje je omogućen export u pdf

-ExportPDF - php za export u pdf /admin privilages

-xmlToDB - php za import podataka u bazu

-login - php stranica za login/logout

-messages - php za export u csv /admin privilages

-pretraga - php za pretragu

-search - php stranica za pretragu

-unconfiremdComments - php stranica s tabelom nepotvrđenih komentara za admina

-unconfirmedReviews - php stranica s tabelom nepotvrđenih recenzija

### XML Files:

-users - podaci o adminu

-unconfirmedReviews - podaci o nepotvrđenim recenzijama

-uncomments - podaci o nepotvrđenim komentarima

-reviews - podaci o kritikama

-contacts - poruke adminu

-comments - podaci kritika

### CSS i JS:

-stil.css

-nerdherd.js

### Ostali folderi:

-FPDF - biblioteka ekporta u pdf

-uploads - slike sa stranice

-Baza - dvije kopije baze (.sql)

-IzvjestajTestiranjePostman - izvještaj s rezultatima testiranja

-NerdHerdLocalTesting - folder za lokalno testiranje. Kreirati user-a u bazi: username: __spirala4__ i password: __spirala4__

-nerdherdDB - shema baze
