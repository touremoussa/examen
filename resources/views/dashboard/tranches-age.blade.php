@extends('default')

@section('content')
    <div> 
        <h3>Candidats Par Tranches D'age</h3>
    </div>


    <div id="tranches-age"></div>
<div>
        <table class="table">
            <tr>
                <th>Tranche d'Age</th>
                <th>Total</th>
            </tr>
            @if($tranchesAge->count() != 0)
            @foreach($tranchesAge as $TA)
                <tr>
                    <td>{{$TA->tranche_age}}</td>
                    <td>{{$TA->total}}</td>
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
  // Récupération des données depuis Laravel
        var data = {!! json_encode($tranchesAge) !!};

        console.log(data);
        // Configuration du graphique
        var margin = {top: 20, right: 30, bottom: 30, left: 40},
            width = 600 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;

        // Création de l'échelle en X
        var x = d3.scaleBand()
            .range([0, width])
            .domain(data.map(function(d) { return d.tranche_age; }))
            .padding(0.1);

        // Création de l'échelle en Y
        var y = d3.scaleLinear()
            .range([height, 0])
            .domain([0, d3.max(data, function(d) { return d.total; })]);

        // Création de l'axe en X
        var xAxis = d3.axisBottom(x);

        // Création de l'axe en Y
        var yAxis = d3.axisLeft(y);

        // Création du graphique
        var svg = d3.select("#tranches-age")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                    "translate(" + margin.left + "," + margin.top + ")");

        // Création des barres
        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.tranche_age); })
            .attr("width", x.bandwidth())
            .attr("y", function(d) { return y(d.total); })
            .attr("height", function(d) { return height - y(d.total); })
            .attr("rx", 6) // Ajout de border radius sur les coins supérieurs des barres

        // Ajout de l'axe en X
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        // Ajout de l'axe en Y
        svg.append("g")
            .call(yAxis);

        // Ajout du titre du graphique
        svg.append("text")
            .attr("x", (width / 2))
            .attr("y", 0 - (margin.top / 2))
            .attr("text-anchor", "middle")
            .style("font-size", "16px")
            .text("Répartition des candidats par tranche d'âge");
</script>

@endsection

@endsection