<?php

class Broker
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('localhost','root','','outfit');
        $this->konekcija->set_charset('utf8');
    }

    public function login($username, $password){
        $query = "SELECT * from korisnik where username='$username' AND password='$password' LIMIT 1";
        $rezultat = $this->konekcija->query($query);

        while($red = $rezultat->fetch_assoc()){
            $_SESSION['login'] = true;
            $_SESSION['korisnik'] = $red;
            return true;
        }

        return false;
    }

    public function registracija($ime, $prezime, $username, $password){
        $query = "INSERT INTO korisnik VALUES (null, '$ime','$prezime','$username','$password')";

        if($this->konekcija->query($query)){
            return true;
        }

        return false;
    }

    public function unosOutfita($naziv, $opis, $slika, $korisnikID){
        $query = "INSERT INTO outfit VALUES (null, '$naziv','$opis','$slika',$korisnikID)";

        if($this->konekcija->query($query)){
            return true;
        }

        return false;
    }

    public function vratiOutfiteZaKorisnika($korisnikID)
    {
        $query = "SELECT * from outfit where korisnikID=$korisnikID";
        $rezultat = $this->konekcija->query($query);

        $niz = [];

        while($red = $rezultat->fetch_object()){
            $niz[] = $red;
        }

        return $niz;
    }

    public function izmeni($outfitID, $naziv, $opis)
    {
        $query = "UPDATE outfit SET naziv = '$naziv', opis= '$opis' WHERE outfitID = $outfitID";

        if($this->konekcija->query($query)){
            return true;
        }

        return false;
    }

    public function obrisi($outfitID)
    {
        $query = "DELETE FROM outfit  WHERE outfitID = $outfitID";

        if($this->konekcija->query($query)){
            return true;
        }

        return false;
    }

    public function pretrazi($pretraga, $sortiranje)
    {

        $query = "SELECT count(s.id) as brojSvidjanja, o.*, k.* from outfit o join korisnik k on o.korisnikID = k.korisnikID left join svidjanja s on o.outfitID = s.outfitID WHERE k.ime LIKE '%$pretraga%' OR k.prezime LIKE '%$pretraga%' group by o.outfitID ORDER by brojSvidjanja $sortiranje";
        $rezultat = $this->konekcija->query($query);

        $niz = [];

        while($red = $rezultat->fetch_object()){
            $niz[] = $red;
        }

        return $niz;
    }

    public function proveriDaLiJeVecLajkovano($outfitID, $korisnikID)
    {
        $query = "SELECT * from svidjanja WHERE outfitID = $outfitID and korisnikID = $korisnikID";
        $rezultat = $this->konekcija->query($query);


        while($red = $rezultat->fetch_object()){
            return true;
        }

        return false;
    }

    public function lajkuj($outfitID, $korisnikID)
    {
        $query = "INSERT INTO svidjanja VALUES (null,$outfitID,$korisnikID)";

        if($this->konekcija->query($query)){
            return true;
        }

        return false;
    }
}