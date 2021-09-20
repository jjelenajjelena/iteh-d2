$(function () {
    const api = "http://127.0.0.1:8000/api/";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let novoVreme;
    let prijavaId;
    ucitaj();

    $('#prijava-form').submit(function (e) {
        e.preventDefault();
        const prijava = {
            ime: $('#ime').val(),
            prezime: $('#prezime').val(),
            jmbg: $('#jmbg').val(),
            ustanovaId: $('#ustanove-select').val(),
            vakcinaId: $('#vakcine-select').val(),
            napomena: $('#napomena').val(),
        }
        if (prijavaValidacija(prijava))
            dodajPrijavu(prijava);
    });

    $('.prihvati').click(function (e) {
        e.preventDefault();
        promeniVreme(novoVreme, prijavaId)
    });

    /* Pomocne funkcije */
    function ucitaj() {
        getUstanove();
        getVakcine();
    }


    function getUstanove() {
        $.ajax({
            type: "GET",
            url: api + "ustanove",
            dataType: "JSON",
            success: function (response) {
                napuniSelectUstanova(response);
            }
        });
    }
    function getVakcine() {
        $.ajax({
            type: "GET",
            url: api + "vakcine",
            dataType: "JSON",
            success: function (response) {
                napuniSelectVakcina(response);
            }
        });
    }

    function napuniSelectUstanova(ustanove) {
        ustanove.forEach(element => {
            $('#ustanove-select').append(
                `
                <option value="${element.id}">${element.adresa}, ${element.naziv_ustanova}</option>
                `
            );
        });
    }
    function napuniSelectVakcina(vakcine) {
        vakcine.forEach(element => {
            $('#vakcine-select').append(
                `
                <option value="${element.id}">${element.proizvodjac}, ${element.drzava_porekla}</option>
                `
            );
        });
    }

    function dodajPrijavu(prijava) {
        $.ajax({
            type: "POST",
            url: api + "prijave",
            data: {
                ime: prijava.ime,
                prezime: prijava.prezime,
                jmbg: prijava.jmbg,
                ustanovaId: prijava.ustanovaId,
                vakcinaId: prijava.vakcinaId,
                napomena: prijava.napomena,
            },
            success: function (res) {
                if (res.postoji) {
                    $('#vec-prijavljen-modal').modal('show');
                    $('#modal-text').text(
                        `
                        Ako Vam ne odgovara trenutno vreme, mozemo Vam ponuditi vreme: ${res.novoVremeFormat}
                        `
                    )


                }
                else {
                    alert(res.poruka);
                }
                prijavaId = res.prijava_id;
                novoVreme = res.novoVreme;

            },
        });
    }

    function prijavaValidacija(prijava) {
        if (prijava.ime == "" || prijava.jmbg == "" || prijava.prezime == "" || prijava.ustanovaId == "" || prijava.vakcinaId == "") {
            alert("Greska prilikom popunjavanja forme. Popunite sva neophodna polja.");
            return false;
        }
        else return true;
    }

    function promeniVreme(novoVreme, prijavaId) {
        $.ajax({
            type: "POST",
            url: api + "prijave/" + prijavaId,
            data: {
                _method: 'PUT',
                novoVreme: novoVreme,
            },
            success: function (response) {
                alert(response.poruka)
                $('#vec-prijavljen-modal').modal('hide');
            }
        });
    }

});
