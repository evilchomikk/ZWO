
<?php

class Zdjecia_i_filmy {
    public int $id_m;
    public string $nazwa;
    public string $komentarz;
    public string $kategoria;
    public string $tresc;
    public string $typ_pliku;
    public string $referencja;
    public string $obraz; // Typ string dla MEDIUMBLOB

    public function __construct(array $data) {

        $this->id_m = $data["id_m"];
        $this->nazwa = $data["nazwa"];
        $this->komentarz = $data["komentarz"];
        $this->kategoria = $data["kategoria"];
        $this->tresc = $data["tresc"];
        $this->typ_pliku = $data["typ_pliku"];
        $this->referencja = $data["referencja"];
        $this->obraz = $data["obraz"];

    }
}

?>
