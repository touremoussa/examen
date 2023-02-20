@extends('default')

@section('content')
<div> 
    <h3>Formations Par Referentiel</h3>
</div>
    <div id="formations-par-referentiel"></div>
    <div>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Total</th>
            </tr>
            @if($formations->count() != 0)
            @foreach($formations as $formation)
                <tr>
                    <td>{{$formation->libelle}}</td>
                    <td>{{$formation->total}}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="2"><h2>Desolee Aucune donnée a representer</h2></td>
            </tr>
            @endif
        </table>
</div>

@section('scripts')
<script src="https://d3js.org/d3.v6.min.js"></script>

<script>
    // Récupération des données depuis la méthode formationsParReferentiel du contrôleur
    var data = {!! json_encode($formations) !!};

    console.log(data);
    // Création du tableau de données pour D3.js
    var chartData = [];
    for (var i = 0; i < data.length; i++) {
        chartData.push({
            referentiel: data[i].libelle,
            total: data[i].total
        });
    }

    // Définition des dimensions du graphique
    var margin = {top: 20, right: 20, bottom: 30, left: 40},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    // Définition de l'échelle pour l'axe X
    var x = d3.scaleBand()
        .range([0, width])
        .padding(0.1);

    // Définition de l'échelle pour l'axe Y
    var y = d3.scaleLinear()
        .range([height, 0]);

    // Création du conteneur SVG pour le graphique
    var svg = d3.select("#formations-par-referentiel").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
      .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // Mise à jour des échelles de l'axe X et Y
    x.domain(chartData.map(function(d) { return d.referentiel; }));
    y.domain([0, d3.max(chartData, function(d) { return d.total; })]);

    // Ajout de l'axe X
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x));

    // Ajout de l'axe Y
    svg.append("g")
        .attr("class", "y axis")
        .call(d3.axisLeft(y).ticks(10));

    // Ajout des barres du graphique
    svg.selectAll(".bar")
        .data(chartData)
      .enter().append("rect")
        .attr("class", "bar")
        .attr("x", function(d) { return x(d.referentiel); })
        .attr("width", x.bandwidth())
        .attr("y", function(d) { return y(d.total); })
        .attr("height", function(d) { return height - y(d.total); });
</script>
@endsection
    
@endsection