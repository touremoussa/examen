@extends('default')

@section('content')
<div> 
    <h3>Formations Par Statut</h3>
</div>
<div id="formations-par-statut"></div>
<div>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Total</th>
            </tr>
            @if(formations->count() != 0)
            @foreach($formations as $formation)
                <tr>
                    <td>{{$formation->isStarted ? 'En_cours' : 'En_attente'}}</td>
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
<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
    var data = {!! json_encode($formations) !!};

    var width = 400;
    var height = 400;
    var radius = Math.min(width, height) / 2;

    var color = d3.scaleOrdinal()
        .domain(data.map(function(d) { return d.isStarted; }))
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

    var svg = d3.select("#formations-par-statut")
        .append("svg")
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
        .style("fill", function(d) { return color(d.data.isStarted); });

    g.append("text")
        .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
        .attr("dy", ".35em")
        .text(function(d) { return (d.data.isStarted ? 'En_cours' : 'En_attente') + ": " + d.data.total; });
        
</script>
@endsection

@endsection