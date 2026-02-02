<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Jezičke linije za validaciju
    |--------------------------------------------------------------------------
    |
    | Sledeće jezičke linije sadrže podrazumevane poruke o greškama koje koristi
    | validator klasa. Neke od ovih pravila imaju više verzija, kao što su pravila za veličinu.
    | Slobodno prilagodite svaku od ovih poruka ovde.
    |
    */

    'accepted' => 'Polje :attribute mora biti prihvaćeno.',
    'accepted_if' => 'Polje :attribute mora biti prihvaćeno kada je :other :value.',
    'active_url' => 'Polje :attribute mora biti validan URL.',
    'after' => 'Polje :attribute mora biti datum nakon :date.',
    'after_or_equal' => 'Polje :attribute mora biti datum nakon ili jednak :date.',
    'alpha' => 'Polje :attribute može sadržati samo slova.',
    'alpha_dash' => 'Polje :attribute može sadržati samo slova, brojeve, crtice i donje crte.',
    'alpha_num' => 'Polje :attribute može sadržati samo slova i brojeve.',
    'array' => 'Polje :attribute mora biti niz.',
    'ascii' => 'Polje :attribute može sadržati samo jedno-bajtne alfanumeričke karaktere i simbole.',
    'before' => 'Polje :attribute mora biti datum pre :date.',
    'before_or_equal' => 'Polje :attribute mora biti datum pre ili jednak :date.',
    'between' => [
        'array' => 'Polje :attribute mora imati između :min i :max stavki.',
        'file' => 'Polje :attribute mora biti između :min i :max kilobajta.',
        'numeric' => 'Polje :attribute mora biti između :min i :max.',
        'string' => 'Polje :attribute mora biti između :min i :max karaktera.',
    ],
    'boolean' => 'Polje :attribute mora biti true ili false.',
    'can' => 'Polje :attribute sadrži nedozvoljenu vrednost.',
    'confirmed' => 'Potvrda za polje :attribute se ne poklapa.',
    'contains' => 'Polje :attribute nedostaje zahtevana vrednost.',
    'current_password' => 'Lozinka je netačna.',
    'date' => 'Polje :attribute mora biti validan datum.',
    'date_equals' => 'Polje :attribute mora biti datum jednak :date.',
    'date_format' => 'Polje :attribute mora odgovarati formatu :format.',
    'decimal' => 'Polje :attribute mora imati :decimal decimalnih mesta.',
    'declined' => 'Polje :attribute mora biti odbijeno.',
    'declined_if' => 'Polje :attribute mora biti odbijeno kada je :other :value.',
    'different' => 'Polje :attribute i :other moraju biti različiti.',
    'digits' => 'Polje :attribute mora biti :digits cifara.',
    'digits_between' => 'Polje :attribute mora imati između :min i :max cifara.',
    'dimensions' => 'Polje :attribute ima nevalidne dimenzije slike.',
    'distinct' => 'Polje :attribute ima dupliranu vrednost.',
    'doesnt_end_with' => 'Polje :attribute ne sme završavati sa jednim od sledećih: :values.',
    'doesnt_start_with' => 'Polje :attribute ne sme početi sa jednim od sledećih: :values.',
    'email' => 'Polje :attribute mora biti validna email adresa.',
    'ends_with' => 'Polje :attribute mora se završiti sa jednim od sledećih: :values.',
    'enum' => 'Izabrano :attribute je nevalidno.',
    'exists' => 'Izabrano :attribute je nevalidno.',
    'extensions' => 'Polje :attribute mora imati jednu od sledećih ekstenzija: :values.',
    'file' => 'Polje :attribute mora biti fajl.',
    'filled' => 'Polje :attribute mora imati vrednost.',
    'gt' => [
        'array' => 'Polje :attribute mora imati više od :value stavki.',
        'file' => 'Polje :attribute mora biti veće od :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti veće od :value.',
        'string' => 'Polje :attribute mora imati više od :value karaktera.',
    ],
    'gte' => [
        'array' => 'Polje :attribute mora imati :value stavki ili više.',
        'file' => 'Polje :attribute mora biti veće ili jednako :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti veće ili jednako :value.',
        'string' => 'Polje :attribute mora imati :value karaktera ili više.',
    ],
    'hex_color' => 'Polje :attribute mora biti validna heksadecimalna boja.',
    'image' => 'Polje :attribute mora biti slika.',
    'in' => 'Izabrano :attribute je nevalidno.',
    'in_array' => 'Polje :attribute mora postojati u :other.',
    'integer' => 'Polje :attribute mora biti ceo broj.',
    'ip' => 'Polje :attribute mora biti validna IP adresa.',
    'ipv4' => 'Polje :attribute mora biti validna IPv4 adresa.',
    'ipv6' => 'Polje :attribute mora biti validna IPv6 adresa.',
    'json' => 'Polje :attribute mora biti validan JSON string.',
    'list' => 'Polje :attribute mora biti lista.',
    'lowercase' => 'Polje :attribute mora biti u malim slovima.',
    'lt' => [
        'array' => 'Polje :attribute mora imati manje od :value stavki.',
        'file' => 'Polje :attribute mora biti manji od :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti manji od :value.',
        'string' => 'Polje :attribute mora imati manje od :value karaktera.',
    ],
    'lte' => [
        'array' => 'Polje :attribute ne sme imati više od :value stavki.',
        'file' => 'Polje :attribute mora biti manje ili jednako :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti manje ili jednako :value.',
        'string' => 'Polje :attribute mora imati manje ili jednako :value karaktera.',
    ],
    'mac_address' => 'Polje :attribute mora biti validna MAC adresa.',
    'max' => [
        'array' => 'Polje :attribute ne sme imati više od :max stavki.',
        'file' => 'Polje :attribute ne sme biti veće od :max kilobajta.',
        'numeric' => 'Polje :attribute ne sme biti veće od :max.',
        'string' => 'Polje :attribute ne sme biti duže od :max karaktera.',
    ],
    'max_digits' => 'Polje :attribute ne sme imati više od :max cifara.',
    'mimes' => 'Polje :attribute mora biti fajl tipa: :values.',
    'mimetypes' => 'Polje :attribute mora biti fajl tipa: :values.',
    'min' => [
        'array' => 'Polje :attribute mora imati najmanje :min stavki.',
        'file' => 'Polje :attribute mora biti najmanje :min kilobajta.',
        'numeric' => 'Polje :attribute mora biti najmanje :min.',
        'string' => 'Polje :attribute mora biti najmanje :min karaktera.',
    ],
    'min_digits' => 'Polje :attribute mora imati najmanje :min cifara.',
    'missing' => 'Polje :attribute mora biti odsutno.',
    'missing_if' => 'Polje :attribute mora biti odsutno kada je :other :value.',
    'missing_unless' => 'Polje :attribute mora biti odsutno osim ako :other nije :value.',
    'missing_with' => 'Polje :attribute mora biti odsutno kada je :values prisutno.',
    'missing_with_all' => 'Polje :attribute mora biti odsutno kada su :values prisutni.',
    'multiple_of' => 'Polje :attribute mora biti višekratnik od :value.',
    'not_in' => 'Izabrano :attribute je nevalidno.',
    'not_regex' => 'Format polja :attribute je nevalidan.',
    'numeric' => 'Polje :attribute mora biti broj.',
    'password' => [
        'letters' => 'Polje :attribute mora sadržati barem jedno slovo.',
        'mixed' => 'Polje :attribute mora sadržati barem jedno veliko i jedno malo slovo.',
        'numbers' => 'Polje :attribute mora sadržati barem jedan broj.',
        'symbols' => 'Polje :attribute mora sadržati barem jedan simbol.',
        'uncompromised' => 'Polje :attribute se pojavilo u sigurnosnom incidentu. Molimo vas da izaberete drugu vrednost.',
    ],
    'present' => 'Polje :attribute mora biti prisutno.',
    'present_if' => 'Polje :attribute mora biti prisutno kada je :other :value.',
    'present_unless' => 'Polje :attribute mora biti prisutno osim ako :other nije :value.',
    'present_with' => 'Polje :attribute mora biti prisutno kada su :values prisutni.',
    'present_with_all' => 'Polje :attribute mora biti prisutno kada su :values prisutni.',
    'prohibited' => 'Polje :attribute je zabranjeno.',
    'prohibited_if' => 'Polje :attribute je zabranjeno kada je :other :value.',
    'prohibited_unless' => 'Polje :attribute je zabranjeno osim ako :other nije u :values.',
    'prohibits' => 'Polje :attribute zabranjuje prisustvo :other.',
    'regex' => 'Format polja :attribute je nevalidan.',
    'required' => 'Polje :attribute je obavezno.',
    'required_array_keys' => 'Polje :attribute mora sadržati stavke za: :values.',
    'required_if' => 'Polje :attribute je obavezno kada je :other :value.',
    'required_if_accepted' => 'Polje :attribute je obavezno kada je :other prihvaćeno.',
    'required_if_declined' => 'Polje :attribute je obavezno kada je :other odbijeno.',
    'required_unless' => 'Polje :attribute je obavezno osim ako :other nije u :values.',
    'required_with' => 'Polje :attribute je obavezno kada su :values prisutni.',
    'required_with_all' => 'Polje :attribute je obavezno kada su :values prisutni.',
    'required_without' => 'Polje :attribute je obavezno kada :values nije prisutno.',
    'required_without_all' => 'Polje :attribute je obavezno kada nijedno od :values nije prisutno.',
    'same' => 'Polje :attribute mora biti isto kao :other.',
    'size' => [
        'array' => 'Polje :attribute mora sadržati :size stavki.',
        'file' => 'Polje :attribute mora biti :size kilobajta.',
        'numeric' => 'Polje :attribute mora biti :size.',
        'string' => 'Polje :attribute mora biti :size karaktera.',
    ],
    'starts_with' => 'Polje :attribute mora početi sa jednim od sledećih: :values.',
    'string' => 'Polje :attribute mora biti string.',
    'timezone' => 'Polje :attribute mora biti validna vremenska zona.',
    'unique' => 'Polje :attribute je već zauzeto.',
    'uploaded' => 'Polje :attribute nije uspelo da se otpremi.',
    'uppercase' => 'Polje :attribute mora biti u velikim slovima.',
    'url' => 'Polje :attribute mora biti validan URL.',
    'ulid' => 'Polje :attribute mora biti validan ULID.',
    'uuid' => 'Polje :attribute mora biti validan UUID.',

    /*
    |--------------------------------------------------------------------------
    | Prilagođene jezičke linije za validaciju
    |--------------------------------------------------------------------------
    |
    | Ovde možete da definišete prilagođene poruke o validaciji za atribute koristeći
    | konvenciju "attribute.rule" da nazovete linije. Ovo omogućava brzo definisanje
    | specifične prilagođene jezičke linije za određeno pravilo atributa.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'email' => [
        'regex' => 'Unesite email u ispravnom formatu.',
    ],
    'name' => [
        'regex' => 'Unesite ime i prezime u formatu "Ime Prezime"',
    ],
    'phone' => [
        'regex' => 'Unesite broj telefona u formatu "06x xxx xxxx"',
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Prilagođeni atributi za validaciju
    |--------------------------------------------------------------------------
    |
    | Sledeće jezičke linije koriste se da zamene naš atribut placeholder
    | sa nečim što je lakše za čitanje, kao što je "E-Mail Address" umesto
    | "email". Ovo nam pomaže da poruke učinimo izražajnijim.
    |
    */

    'attributes' => [
        'city' => 'grad',
        'phone' => 'telefon',
        'username' => 'korisničko ime',
        'password' => 'lozinka',
        'name' => 'ime i prezime',
        'title' => 'naslov',
        'description' => 'opis',
        'img' => 'slika',
        'pet' => 'ljubimac',
        'category' => 'kategorija',
        'price' => 'cena',
        'first-name' => 'ime',
        'last-name' => 'prezime',
        'question' => 'pitanje'

    
    ],

];
