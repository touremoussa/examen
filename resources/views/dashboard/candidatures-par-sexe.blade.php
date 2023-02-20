@extends('default')

@section('content')
<div> 
    <h3>Candidatures Par Sexe</h3>
</div>
    <div id="candidatures-par-sexe"></div>
    <div>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Total</th>
            </tr>
            @if($candidatures->count() != 0)
            @foreach($candidatures as $candidature)
                <tr>
                    <td>{{$candidature->sexe}}</td>
                    <td>{{$candidature->total}}</td>
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
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
        // Récupération des données depuis le contrôleur
        var data = {!! json_encode($candidatures) !!};

        // Création du pie chart
        var width = 600,
            height = 400,
            radius = Math.min(width, height) / 2;

        var color = d3.scaleOrdinal()
                    .range(["#98abc5", "#8a89a6"]);

        var arc = d3.arc()
                    .outerRadius(radius - 10)
                    .innerRadius(0);

        var labelArc = d3.arc()
                        .outerRadius(radius - 40)
                        .innerRadius(radius - 40);

        var pie = d3.pie()
                    .sort(null)
                    .value(function(d) { return d.total; });

        var svg = d3.select("#candidatures-par-sexe").append("svg")
                    .attr("width", width)
                    .attr("height", height)
                    .append("g")
                    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

        var g = svg.selectAll(".arc")
                .data(pie(data))
                .enter().append("g")
                .attr("class", "arc");

        g.append("path")
        .attr("d", arc)
        .style("fill", function(d) { return color(d.data.sexe); });

        g.append("text")
        .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
        .attr("dy", ".35em")
        .text(function(d) { return d.data.sexe + " (" + d.data.total + ")"; });
</script>

@endsection

@endsection

