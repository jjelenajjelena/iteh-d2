<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Prijave</title>
</head>

<body>
    <h4 align="center">Ovde ce biti prikazane prijave za vakcinaciju (ukoliko postoje)</h4>
    <ul class="nav nav-tabs" id="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="sajam" data-toggle="tab" href="#hala-sajam" role="tab" aria-controls="sajam"
                aria-selected="true">Hala Sajam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="belekspo" data-toggle="tab" href="#zy" role="tab" aria-controls="belekspo"
                aria-selected="false">Belekspo centar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bogojevic" data-toggle="tab" href="#bogojevic" role="tab" aria-controls="bogojevic"
                aria-selected="false">Hala "Gordana Goca Bogojevic"</a>
        </li>
    </ul>
    <div class="tab-content" id="tabsContent">
        <div class="tab-pane fade show active" id="hala-sajam" role="tabpanel" aria-labelledby="hala-sajam">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Jmbg</th>
                        <th>Vakcinacija u</th>
                        <th>Vakcina</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prijaveSajam as $p)
                        <tr>
                            <td>{{ $p->korisnik->ime }}</td>
                            <td>{{ $p->korisnik->prezime }}</td>
                            <td>{{ $p->korisnik->jmbg }}</td>
                            <td>{{ date('d.m.y. h:i', $p->zakazano_u) }}</td>
                            <td>{{ $p->vakcina->proizvodjac }}</td>
                            <td>
                                <button type="button" name="" id="{{ $p->id }}"
                                    class="btn btn-danger btn-lg btn-block del">Obrisi prijavu</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="zy" role="tabpanel" aria-labelledby="belekspo">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Jmbg</th>
                        <th>Vakcinacija u</th>
                        <th>Vakcina</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prijaveBelekspo as $p)
                        <tr>
                            <td>{{ $p->korisnik->ime }}</td>
                            <td>{{ $p->korisnik->prezime }}</td>
                            <td>{{ $p->korisnik->jmbg }}</td>
                            <td>{{ date('d.m.y. m:i', $p->zakazano_u) }}</td>
                            <td>{{ $p->vakcina->proizvodjac }}</td>
                            <td>
                                <button type="button" name="" id="{{ $p->id }}"
                                    class="btn btn-danger btn-lg btn-block del">Obrisi prijavu</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="bogojevic" role="tabpanel" aria-labelledby="bogojevic">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Jmbg</th>
                        <th>Vakcinacija u</th>
                        <th>Vakcina</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prijaveBogojevic as $p)
                        <tr>
                            <td>{{ $p->korisnik->ime }}</td>
                            <td>{{ $p->korisnik->prezime }}</td>
                            <td>{{ $p->korisnik->jmbg }}</td>
                            <td>{{ date('d.m.y. m:i', $p->zakazano_u) }}</td>
                            <td>{{ $p->vakcina->proizvodjac }}</td>
                            <td>
                                <button type="button" name="" id="{{ $p->id }}"
                                    class="btn btn-danger btn-lg btn-block del">Obrisi prijavu</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>

</body>

</html>
